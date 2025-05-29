<?php

namespace App\Controllers;

class RedeEletricaController extends BaseController
{
    public function paginaCadastro(): string
    {
        return view('cadastrar_rede_eletrica');
    }
    
    public function visualizar(): string
    {
        return view('redes_eletricas');
    }
}
