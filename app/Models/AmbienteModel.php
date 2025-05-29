<?php

namespace App\Models;

use CodeIgniter\Model;

class AmbienteModel extends Model
{
    protected $table         = 'AMBIENTE';   
    protected $primaryKey    = 'ID';      

    protected $allowedFields = ['DESCRICAO', 'TIPO', 'ID_USUARIO', 'ID_ENDERECO'];

    protected $useTimestamps = false; 


    public function getAmbientesPorUsuario($id_usuario)
    {   
        return $this->where('ID_USUARIO', $id_usuario)->findAll();  // Está retornando um array de objetos, caso futuramente precisemos retornar como array de arrays, podemos usar ->asArray()->findAll();
    }

    // public function cadastrarAmbiente($dados) { ... }
    // public function atualizarAmbiente($id, $dados) { ... }
    // public function deletarAmbiente($id) { ... }
}