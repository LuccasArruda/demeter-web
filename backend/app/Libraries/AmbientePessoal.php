<?php

namespace App\Libraries;

class AmbientePessoal extends Ambiente
{
    private RedeEletrica $redeEletrica;

    public function __construct(int $codigo, string $descricao, RedeEletrica $redeEletrica)
    {
        parent::__construct($codigo, $descricao);
        $this->redeEletrica = $redeEletrica;
    }

    public function getRedeEletrica(): RedeEletrica
    {
        return $this->redeEletrica;
    }
}
?>