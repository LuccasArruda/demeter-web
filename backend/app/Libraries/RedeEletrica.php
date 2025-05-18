<?php

namespace App\Libraries;

class RedeEletrica
{
    private int $codigo;
    private string $descricao;

    /** @var Aparelho[] */
    private array $aparelhos;

    public function __construct(int $codigo, string $descricao, array $aparelhos)
    {
        $this->codigo = $codigo;
        $this->descricao = $descricao;
        $this->aparelhos = $aparelhos;
    }

    public function getCodigo(): int { return $this->codigo; }
    public function getDescricao(): string { return $this->descricao; }
    public function getAparelhos(): array { return $this->aparelhos; }
}
?>