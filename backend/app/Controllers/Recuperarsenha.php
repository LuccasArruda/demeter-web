<?php

namespace App\Controllers;

class Recuperarsenha extends BaseController
{
    public function getIndex(): string
    {
        return view('recuperarsenha');
    }
}