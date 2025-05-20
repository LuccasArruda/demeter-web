<?php

namespace App\Controllers;

class CadastroUsuario extends BaseController
{
    public function index(): string
    {
        return view('cadastro_usuario');
    }
}
