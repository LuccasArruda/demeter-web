<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use Config\Database;

class CadastrarUsuario extends Controller
{
    public function index()
    {
        return view('cadastrar_usuario');
    }

    public function cadastrar()
    {
        $nome = $this->request->getPost('nome');
        $email = $this->request->getPost('email');
        $telefone = $this->request->getPost('telefone');
        $senha = password_hash($this->request->getPost('senha'), PASSWORD_BCRYPT);

        $db = Database::connect();
        $builder = $db->table('usuario');

        $data = [
            'nome' => $nome,
            'email' => $email,
            'telefone' => $telefone,
            'senha' => $senha
        ];

        if ($builder->insert($data)) {
            return redirect()->to('/login')->with('success', 'Usuário cadastrado com sucesso!');
        } else {
            return redirect()->back()->with('error', 'Erro ao cadastrar usuário.');
        }
    }
}

?>