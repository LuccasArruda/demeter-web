<?php

namespace App\Controllers;

class GeradorController extends BaseController
{
    public function paginaCadastroGerador(): string
    {
        return view('pages/cadastrar_gerador');
    }
}
