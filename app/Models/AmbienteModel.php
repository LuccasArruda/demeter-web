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

    public function deletarAmbiente($id, $userId)
    {
        // Verifica se o ambiente pertence ao usuário
        $ambiente = $this->where(['ID' => $id, 'ID_USUARIO' => $userId])->first();
        if (!$ambiente) {
            return false; // Ambiente não encontrado ou não pertence ao usuário
        }

        // Verifica se o ambiente possui redes elétricas associadas
        $redeEletricaModel = new \App\Models\RedeEletricaModel();
        $redesEletricas = $redeEletricaModel->where('ID_AMBIENTE', $id)->findAll();
        if (!empty($redesEletricas)) {
            return false; 
        }

        return $this->delete($id);

    }

    public function getAmbientePorID($id)
    {
        return $this->where('ID', $id)->first();
    }
}