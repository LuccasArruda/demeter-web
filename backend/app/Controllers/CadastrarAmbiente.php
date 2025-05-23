<?php
namespace App\Controllers;

use CodeIgniter\Controller;
use Config\Database;

class CadastrarAmbiente extends Controller
{
    public function index()
    {
        return view('cadastrar_ambiente');
    }
}


?>