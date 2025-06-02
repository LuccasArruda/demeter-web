<?php

namespace App\Models;

use CodeIgniter\Model;

class AparelhoModel extends Model
{
    protected $table         = 'APARELHO';
    protected $primaryKey    = 'ID';

    protected $allowedFields = ['ID_REDE_ELETRICA', 'DESCRICAO', 'FABRICANTE','TEMPO_DE_USO', 'ENCE', 'CONSUMO', 'FOTO'];

    protected $useTimestamps = false;

    public function getAparelhosPorRedeEUsuario($idRede, $usuarioId)
    {
        return $this->select('APARELHO.*')
            ->join('REDE_ELETRICA', 'REDE_ELETRICA.ID = APARELHO.ID_REDE_ELETRICA')
            ->join('AMBIENTE', 'AMBIENTE.ID = REDE_ELETRICA.ID_AMBIENTE')
            ->where('APARELHO.ID_REDE_ELETRICA', $idRede)
            ->where('AMBIENTE.ID_USUARIO', $usuarioId)
            ->findAll();
    }
}
?>