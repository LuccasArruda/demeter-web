<?php

namespace App\Controllers;

use App\Libraries\Usuario;
use CodeIgniter\Controller;
use Config\Database;
use App\Models\UsuarioModel;

class UsuarioController extends Controller
{
    public function paginaCadastro()
    {
        return view('cadastrar_usuario');
    }

    public function paginaLogin(): string
    {
        return view('login');
    }

    public function paginaRecuperarSenha(): string
    {
        return view('recuperar_senha');
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

        $dados = [
            'NOME' => $nome,
            'EMAIL' => $email,
            'TELEFONE' => $telefone,
            'SENHA' => $senha
        ];

        $usuarioModel = new UsuarioModel();
        $operacaoRealizada = $usuarioModel->cadastrarUsuario($dados);

        if ($operacaoRealizada) {
            return redirect()->to('/login')->with('success', 'Usuário cadastrado com sucesso!');
        } else {
            return redirect()->back()->with('error', 'Erro ao cadastrar usuário.');
        }

    }

    public function autenticar()
    {

        $email = $this->request->getPost('email');
        $senha = $this->request->getPost('senha');

        $usuarioModel = new UsuarioModel();
        $usuario = $usuarioModel->buscaUsuarioPorEmail($email);

        if ($usuario && password_verify($senha, $usuario['SENHA'])) {
            session()->set('usuarioId', $usuario['ID']);
            session()->set('usuarioNome', $usuario['NOME']);
            return redirect()->to('/ambientes');
        } else {
            return redirect()->back()->with('error', 'E-mail ou senha inválidos.');
        }
    }


}

?>