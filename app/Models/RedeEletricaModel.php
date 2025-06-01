<?php

namespace App\Models;

use CodeIgniter\Model;

class RedeEletricaModel extends Model
{
    protected $table         = 'REDE_ELETRICA';   
    protected $primaryKey    = 'ID';      

    protected $allowedFields = ['ID_AMBIENTE', 'DESCRICAO', 'FOTO'];

    protected $useTimestamps = false; 


    public function getRedesPorAmbienteEUsuario($idAmbiente, $usuarioId)
    {
        return $this->select('REDE_ELETRICA.*')
            ->join('AMBIENTE', 'AMBIENTE.ID = REDE_ELETRICA.ID_AMBIENTE')
            ->where('REDE_ELETRICA.ID_AMBIENTE', $idAmbiente)
            ->where('AMBIENTE.ID_USUARIO', $usuarioId)
            ->findAll();
    }

    public function getTodasRedesPorUsuario($usuarioId)
    {
        return $this->select('REDE_ELETRICA.*')
            ->join('AMBIENTE', 'AMBIENTE.ID = REDE_ELETRICA.ID_AMBIENTE')
            ->where('AMBIENTE.ID_USUARIO', $usuarioId)
            ->findAll();
    }

}