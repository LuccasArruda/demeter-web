<?php

namespace App\Models;

use CodeIgniter\Model;

class AmbienteModel extends Model
{
    protected $table         = 'AMBIENTE';   
    protected $primaryKey    = 'ID';      

    protected $allowedFields = ['DESCRICAO', 'TIPO', 'VL_MEDIO_CONTA_LUZ', 'PERCENTUAL_SUSTENTABILIDADE', 'ID_USUARIO', 'ID_ENDERECO', 'FOTO'];

    protected $useTimestamps = false; 


    public function getAmbientesPorUsuario($id_usuario)
    {   
        return $this->where('ID_USUARIO', $id_usuario)->findAll();  // Está retornando um array de objetos, caso futuramente precisemos retornar como array de arrays, podemos usar ->asArray()->findAll();
    }

    public function cadastrarAmbiente($dados)
    {
        return $this->insert($dados); 
    }

    public function atualizarAmbiente($id, $dados)
    {
        return $this->update($id, $dados);
    }

    public function deletarAmbiente($id)
    {
        return $this->delete($id);
    }

    public function getAmbientePorID($id)
    {
        return $this->where('ID', $id)->first();
    }
}