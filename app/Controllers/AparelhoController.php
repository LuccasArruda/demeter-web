<?php

namespace App\Controllers;

class AparelhoController extends BaseController
{
    public function paginaCadastroAparelho(): string
    {
        return view('pages/cadastrar_aparelho');
    }

    public function visualizar(): string
    {
        return view('pages/aparelhos');
    }
}
