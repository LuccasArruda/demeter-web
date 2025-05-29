<?php

namespace App\Controllers;

class GeradorController extends BaseController
{
    public function paginaCadastroGerador(): string
    {
        return view('cadastrar_gerador');
    }
}
