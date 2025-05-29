<?php

namespace App\Controllers;

class AparelhoController extends BaseController
{
    public function paginaCadastroAparelho(): string
    {
        return view('cadastrar_aparelho');
    }

    public function visualizar(): string
    {
        return view('aparelhos');
    }
}
