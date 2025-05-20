<?php

namespace App\Controllers;

class CadastroAmbiente extends BaseController
{
    public function getIndex(): string
    {
        return view('cadastro_ambiente');
    }
}
