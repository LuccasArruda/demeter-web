<?php

namespace App\Models;

use CodeIgniter\Model;

class AmbienteModel extends Model
{
    protected $table         = 'AMBIENTE';   
    protected $primaryKey    = 'ID';      

    protected $allowedFields = ['DESCRICAO', 'TIPO', 'VL_MEDIO_CONTA_LUZ', 'PERCENTUAL_SUSTENTABILIDADE', 'ID_USUARIO', 'ID_ENDERECO', 'FOTO'];

    protected $useTimestamps = false; 


    public function getAmbientesPorUsuario($id_usuario)
    {   
        return $this->where('ID_USUARIO', $id_usuario)->findAll();  // Está retornando um array de objetos, caso futuramente precisemos retornar como array de arrays, podemos usar ->asArray()->findAll();
    }

    public function cadastrarAmbiente($dados)
    {
        return $this->insert($dados); 
    }

    public function atualizarAmbiente($id, $dados)
    {
        return $this->update($id, $dados);
    }

    public function deletarAmbiente($id, $userId)
    {
        // Verifica se o ambiente pertence ao usuário
        $ambiente = $this->where(['ID' => $id, 'ID_USUARIO' => $userId])->first();
        if (!$ambiente) {
            return false; // Ambiente não encontrado ou não pertence ao usuário
        }

        // Verifica se o ambiente possui redes elétricas associadas
        $redeEletricaModel = new \App\Models\RedeEletricaModel();
        $redesEletricas = $redeEletricaModel->where('ID_AMBIENTE', $id)->findAll();
        if (!empty($redesEletricas)) {
            return false; 
        }

        return $this->delete($id);

    }

    public function getAmbientePorID($id)
    {
        return $this->where('ID', $id)->first();
    }

    public function calcularPontuacaoSustentabilidadePorAmbiente($ambienteId)
    {
        $redeModel = new \App\Models\RedeEletricaModel();
        $aparelhoModel = new \App\Models\AparelhoModel();
        //$geradorModel = new \App\Models\GeradorModel();

        // 1. Buscar todas as redes do ambiente
        $redes = $redeModel->where('ID_AMBIENTE', $ambienteId)->findAll();
        $idsRedes = array_column($redes, 'ID');

        if (empty($idsRedes)) {
            return 100; // Sem redes → ambiente 100% sustentável
        }

        // 2. Buscar aparelhos e geradores que pertencem a essas redes
        $aparelhos = $aparelhoModel->whereIn('ID_REDE_ELETRICA', $idsRedes)->findAll();
        //$geradores = $geradorModel->whereIn('ID_REDE_ELETRICA', $idsRedes)->findAll();

        return $this->calcularPontuacaoSustentabilidade($aparelhos, $aparelhos);
    }


    public function calcularPontuacaoSustentabilidade(array $aparelhos, array $geradores): float {
        $pontuacao = 100;

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

        foreach ($aparelhos as $aparelho) {
            $potencia = $aparelho['POTENCIA'];
            $horasDia = $aparelho['HORAS_DIA'];
            $ence = strtoupper($aparelho['ENCE']);

            if (!isset($pesoENCE[$ence])) {
                continue;
            }

            $consumoDiario = $potencia * $horasDia;
            $penalidade = $consumoDiario * $pesoENCE[$ence] * 10;
            $penalidadeTotal += $penalidade;
        }

        $bonus = 0.0;

        foreach ($geradores as $gerador) {
            $kwh = $gerador['KWH_DIA'];
            $renovavel = $gerador['RENOVAVEL']; // deve ser booleano ou 1/0

            if ($renovavel) {
                $bonus += $kwh * 5;
            } else {
                $bonus -= $kwh * 3;
            }
        }

        $bonus = min($bonus, 50);
        $pontuacao = 100 - $penalidadeTotal + $bonus;

        return max(0, min(100, $pontuacao));
    }

}