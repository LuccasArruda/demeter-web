<?php

namespace App\Libraries;

use App\Models\AparelhoModel;
use App\Models\GeradorModel;
use App\Models\RedeEletricaModel;

class SustentabilidadeService
{
    private $aparelhoModel;
    private $geradorModel;

    public function __construct()
    {
        $this->aparelhoModel = new AparelhoModel();
        $this->geradorModel = new GeradorModel();
    }

    

    public function calcularPontuacao(array $aparelhos, array $geradores): float
    {   
        log_message('debug', '--- Iniciando calcularPontuacao ---');
        log_message('debug', 'Dados de Aparelhos recebidos: ' . print_r($aparelhos, true));
        log_message('debug', 'Dados de Geradores recebidos: ' . print_r($geradores, true));

        $pontuacao = 100; // Pontuação base

        $pesoENCE = [
            'A' => 1.0,
            'B' => 1.2,
            'C' => 1.4,
            'D' => 1.6,
            'E' => 1.8,
            'F' => 2.0,
            'G' => 2.2
        ];

        $penalidadeTotal = 0.0;

        // Logar as chaves do array de pesos ENCE apenas uma vez para verificação
        if (empty($GLOBALS['pesoENCE_keys_logged_sust_service'])) { // Usando uma global para logar só uma vez por request
            log_message('debug', 'Chaves disponíveis em $pesoENCE: ' . implode(', ', array_keys($pesoENCE)));
            $GLOBALS['pesoENCE_keys_logged_sust_service'] = true;
        }

        foreach ($aparelhos as $aparelho) {
            // É uma boa prática verificar se as chaves esperadas existem antes de usá-las
            if (!isset($aparelho['CONSUMO'], $aparelho['TEMPO_DE_USO'], $aparelho['ENCE'], $aparelho['DESCRICAO'])) {
                log_message('debug', 'Aparelho com dados incompletos, pulando: ' . print_r($aparelho, true));
                continue;
            }

            $nomeAparelho = $aparelho['DESCRICAO'];
            $potencia = floatval($aparelho['CONSUMO']); // Valor de 'CONSUMO' do banco
            $horasDia = floatval($aparelho['TEMPO_DE_USO']); // Valor de 'TEMPO_DE_USO' do banco
            
            // Limpa e padroniza o valor de ENCE
            $ence = strtoupper(trim($aparelho['ENCE']));

            log_message('debug', "Processando Aparelho: {$nomeAparelho} | Consumo (do BD): {$potencia} | TempoUso (do BD): {$horasDia} | ENCE (original): '{$aparelho['ENCE']}' | ENCE (tratado): '[{$ence}]' (Comprimento: " . strlen($ence) . ")");

            // ***** ATENÇÃO AQUI: Defina como $consumoDiario deve ser calculado com base nas unidades corretas *****
            // Você precisa escolher UMA destas lógicas ou adaptá-la:

            // Hipótese 1: Se $potencia (aparelho.CONSUMO) é Potência em Watts (W) e $horasDia é horas/dia
            // $consumoDiario = ($potencia / 1000) * $horasDia;
            // log_message('debug', "{$nomeAparelho} - Consumo Diário (kWh) calculado (Watts/1000 * h): {$consumoDiario}");

            // Hipótese 2: Se $potencia (aparelho.CONSUMO) é Potência em Quilowatts (kW) e $horasDia é horas/dia
            // $consumoDiario = $potencia * $horasDia;
            // log_message('debug', "{$nomeAparelho} - Consumo Diário (kWh) calculado (kW * h): {$consumoDiario}");

            // Hipótese 3: Se $potencia (aparelho.CONSUMO) já é o Consumo Diário em kWh (campo $horasDia pode ser informativo)
            // $consumoDiario = $potencia;
            // log_message('debug', "{$nomeAparelho} - Consumo Diário (kWh) calculado (CONSUMO direto): {$consumoDiario}");

            // Hipótese 4: Se $potencia (aparelho.CONSUMO) é Consumo Mensal em kWh (campo $horasDia pode ser informativo)
            // Esta foi a hipótese usada nos seus logs anteriores que resultou em 1.8 para a geladeira
            $consumoDiario = $potencia / 30;
            log_message('debug', "{$nomeAparelho} - Consumo Diário (kWh) calculado (CONSUMO Mensal/30): {$consumoDiario}");
            // ***************************************************************************************************

            if (!isset($pesoENCE[$ence])) {
                log_message('debug', "{$nomeAparelho} - ERRO: ENCE '[{$ence}]' não encontrado no array de pesos. Verifique se o valor de ENCE é uma das chaves válidas (A-G) e não contém caracteres inesperados. Pulando penalidade para este aparelho.");
                continue;
            } else {
                log_message('debug', "{$nomeAparelho} - SUCESSO: ENCE '[{$ence}]' encontrado! Peso: " . $pesoENCE[$ence]);
                
                // Fator de penalidade (ex: 10). Considere ajustar este valor para balancear a pontuação.
                $fatorPenalidade = 2;
                $penalidadeAparelho = $consumoDiario * $pesoENCE[$ence] * $fatorPenalidade;
                $penalidadeTotal += $penalidadeAparelho;
                log_message('debug', "{$nomeAparelho} - Penalidade do aparelho (consDiario * peso * {$fatorPenalidade}): {$penalidadeAparelho} | Penalidade Total Acumulada: {$penalidadeTotal}");
            }
        }

        $bonus = 0.0;
        foreach ($geradores as $gerador) {
            if (!isset($gerador['ENERGIA_GERADA'], $gerador['TIPO'], $gerador['DESCRICAO'])) {
                log_message('debug', 'Gerador com dados incompletos, pulando: ' . print_r($gerador, true));
                continue;
            }
            $nomeGerador = $gerador['DESCRICAO'];
            $kwh = floatval($gerador['ENERGIA_GERADA']); // Energia gerada (ex: kWh/mês ou kWh/dia - defina a unidade!)
            $tipo = strtoupper(trim($gerador['TIPO']));

            log_message('debug', "Processando Gerador: {$nomeGerador} | Energia Gerada: {$kwh} | Tipo (tratado): '[{$tipo}]'");

            // Fatores de bônus/penalidade para geradores. Considere ajustar.
            $fatorBonusRenovavel = 5;
            $fatorPenalidadeNaoRenovavel = 3;

            if ($tipo === 'R') { // Renovável
                $bonusGerador = $kwh * $fatorBonusRenovavel;
                $bonus += $bonusGerador;
                log_message('debug', "{$nomeGerador} - Bônus gerador (R) (kWh * {$fatorBonusRenovavel}): {$bonusGerador} | Bônus Total Acumulado: {$bonus}");
            } elseif ($tipo === 'NR') { // Não Renovável
                $penalidadeGerador = $kwh * $fatorPenalidadeNaoRenovavel;
                $bonus -= $penalidadeGerador; // Subtrai do bônus total
                log_message('debug', "{$nomeGerador} - Penalidade gerador (NR) (kWh * {$fatorPenalidadeNaoRenovavel}): {$penalidadeGerador} | Bônus Total Acumulado (subtraído): {$bonus}");
            }
        }

        log_message('debug', "Penalidade Total Final de todos aparelhos: {$penalidadeTotal}");
        log_message('debug', "Bônus Total (antes do limite): {$bonus}");
        
        // Limite do bônus. Considere se este limite é adequado.
        $limiteMaximoBonus = 30;
        $bonus = min($bonus, $limiteMaximoBonus);
        log_message('debug', "Bônus Total (após limite de {$limiteMaximoBonus}): {$bonus}");

        $pontuacao = 100 - $penalidadeTotal + $bonus;
        log_message('debug', "Pontuação (100 - PenalidadeTotal + Bonus): {$pontuacao}");

        $pontuacaoFinal = max(0, min(100, $pontuacao)); // Garante que a pontuação fique entre 0 e 100
        log_message('debug', "Pontuação Final (após min/max 0-100): {$pontuacaoFinal}");
        log_message('debug', '--- Finalizando calcularPontuacao ---');

        return $pontuacaoFinal;
    }

    public function calcularPorAmbiente(int $ambienteId): float
    {
        $redeModel = new RedeEletricaModel();
        $redes = $redeModel->where('ID_AMBIENTE', $ambienteId)->asArray()->findAll(); // MODIFICADO: Adicionado asArray()
        $idsRedes = array_column($redes, 'ID');

        if (empty($idsRedes)) {
            return 100; // Retorna 100 se não houver redes no ambiente
        }

        // Documentação: Busca todos os aparelhos associados às redes do ambiente como arrays.
        $aparelhos = $this->aparelhoModel->whereIn('ID_REDE_ELETRICA', $idsRedes)->asArray()->findAll(); // MODIFICADO: Adicionado asArray()
        // Documentação: Busca todos os geradores associados às redes do ambiente como arrays.
        $geradores = $this->geradorModel->whereIn('ID_REDE_ELETRICA', $idsRedes)->asArray()->findAll(); // MODIFICADO: Adicionado asArray()

        return $this->calcularPontuacao($aparelhos, $geradores);
    }

    public function calcularPorRede(int $redeId): float
    {
        // Documentação: Busca todos os aparelhos associados à rede elétrica especificada como arrays.
        $aparelhos = $this->aparelhoModel->where('ID_REDE_ELETRICA', $redeId)->asArray()->findAll(); // MODIFICADO: Adicionado asArray()
        // Documentação: Busca todos os geradores associados à rede elétrica especificada como arrays.
        $geradores = $this->geradorModel->where('ID_REDE_ELETRICA', $redeId)->asArray()->findAll(); // MODIFICADO: Adicionado asArray()

        return $this->calcularPontuacao($aparelhos, $geradores);
    }
}