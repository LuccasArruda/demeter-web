<?php

namespace App\Models;

use CodeIgniter\Model;

class UsuarioModel extends Model
{
    protected $table = 'USUARIO';
    protected $primaryKey = 'ID';

    protected $allowedFields = ['NOME', 'EMAIL', 'TELEFONE', 'SENHA'];

    protected $useTimestamps = false;

    public function cadastrarUsuario($dados)
    {
        return $this->insert($dados);
    }

    public function buscaUsuarioPorEmail($email)
    {
        return $this->where('EMAIL', $email)->first();
    }

    public function buscaUsuarioPorID($id)
    {
        return $this->where('ID', $id)->first();
    }

}