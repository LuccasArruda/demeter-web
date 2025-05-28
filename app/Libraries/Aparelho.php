<?php

namespace App\Libraries;

class Aparelho
{
    private int $codigo;
    private string $nome;
    private float $potencia;
    private float $tensao;

    public function __construct(int $codigo, string $nome, float $potencia, float $tensao)
    {
        $this->codigo = $codigo;
        $this->nome = $nome;
        $this->potencia = $potencia;
        $this->tensao = $tensao;
    }

    public function getCodigo(): int { return $this->codigo; }
    public function getNome(): string { return $this->nome; }
    public function getPotencia(): float { return $this->potencia; }
    public function getTensao(): float { return $this->tensao; }
}
?>