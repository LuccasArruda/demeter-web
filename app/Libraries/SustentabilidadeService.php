<?php

namespace App\Libraries;

use App\Models\AparelhoModel;
use App\Models\GeradorModel;

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
            $potencia = $aparelho['CONSUMO'];
            $horasDia = $aparelho['TEMPO_DE_USO'];
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
            $kwh = $gerador['POTENCIA'];
            $tipo = strtoupper($gerador['TIPO']);

            if ($tipo === 'RE') {
                $bonus += $kwh * 5;
            } elseif ($tipo === 'NR') {
                $bonus -= $kwh * 3;
            }
        }

        $bonus = min($bonus, 50);
        $pontuacao = 100 - $penalidadeTotal + $bonus;

        return max(0, min(100, $pontuacao));
    }

    public function calcularPorAmbiente(int $ambienteId): float
    {
        $redeModel = new \App\Models\RedeEletricaModel();
        $redes = $redeModel->where('ID_AMBIENTE', $ambienteId)->findAll();
        $idsRedes = array_column($redes, 'ID');

        if (empty($idsRedes)) {
            return 100;
        }

        $aparelhos = $this->aparelhoModel->whereIn('ID_REDE_ELETRICA', $idsRedes)->findAll();
        $geradores = $this->geradorModel->whereIn('ID_REDE_ELETRICA', $idsRedes)->findAll();

        return $this->calcularPontuacao($aparelhos, $geradores);
    }

    public function calcularPorRede(int $redeId): float
    {
        $aparelhos = $this->aparelhoModel->where('ID_REDE_ELETRICA', $redeId)->findAll();
        $geradores = $this->geradorModel->where('ID_REDE_ELETRICA', $redeId)->findAll();

        return $this->calcularPontuacao($aparelhos, $geradores);
    }
}
