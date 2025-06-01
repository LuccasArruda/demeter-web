<?php

namespace App\Controllers;

class GeradorController extends BaseController
{
    public function paginaCadastroGerador(): string
    {
        $dados = [
            'nomeAmbiente' => '',
            'nomeRedeEletrica' => '',
            'tituloExibicao' => ''
        ];

        return view('pages/cadastrar_gerador', $dados);
    }
}
