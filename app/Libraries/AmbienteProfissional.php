<?php

namespace App\Libraries;

class AmbienteProfissional extends Ambiente
{
    /** @var RedeEletrica[] */
    private array $redeEletrica;

    public function __construct(int $codigo, string $descricao, array $redeEletrica)
    {
        parent::__construct($codigo, $descricao);
        $this->redeEletrica = $redeEletrica;
    }

    public function getRedeEletrica(): array
    {
        return $this->redeEletrica;
    }
}
?>