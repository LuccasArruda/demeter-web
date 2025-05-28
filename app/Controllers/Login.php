<?php

namespace App\Controllers;

class Login extends BaseController
{
    public function index(): string
    {
        return view('login');
    }

    public function recuperarSenha(): string
    {
        return view('recuperar_senha');
    }
}