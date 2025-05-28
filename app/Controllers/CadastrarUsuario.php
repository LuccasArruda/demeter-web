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
        
        $regras = [
            'nome' => 'required|min_length[3]',
            'email' => 'required|valid_email|is_unique[usuario.email]',
            'telefone' => 'required|regex_match[/^\(?\d{2}\)?[- ]?\d{4,5}[- ]?\d{4}$/]',
            'senha' => 'required|min_length[6]'
        ];

        $mensagens = [
            'nome' => [
                'required' => 'O nome é obrigatório.',
                'min_length' => 'O nome deve ter pelo menos 3 caracteres.'
            ],
            'email' => [
                'required' => 'O e-mail é obrigatório.',
                'valid_email' => 'Informe um e-mail válido.',
                'is_unique' => 'Este e-mail já está cadastrado.'
            ],
            'telefone' => [
                'required' => 'O telefone é obrigatório.',
                'regex_match' => 'Informe um telefone válido com DDD, como (11) 91234-5678.'
            ],
            'senha' => [
                'required' => 'A senha é obrigatória.',
                'min_length' => 'A senha deve ter pelo menos 6 caracteres.'
            ]
        ];

        if (!$this->validate($regras, $mensagens)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }


        $nome = $this->request->getPost('nome');
        $email = $this->request->getPost('email');
        $telefone = $this->request->getPost('telefone');
        $senha = password_hash($this->request->getPost('senha'), PASSWORD_BCRYPT);

        $conexao = Database::connect();
        $tabela = $conexao->table('usuario');

        $dados = [
            'nome' => $nome,
            'email' => $email,
            'telefone' => $telefone,
            'senha' => $senha
        ];

        $operacaoRealizada = $tabela->insert($dados);

        if ($operacaoRealizada) {
            return redirect()->to('/login')->with('success', 'Usuário cadastrado com sucesso!');
        } else {
            return redirect()->back()->with('error', 'Erro ao cadastrar usuário.');
        }

    }
}

?>