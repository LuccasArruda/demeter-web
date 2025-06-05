<?php

namespace App\Models;

use CodeIgniter\Model;

class ViewAparelhoRedeEletricaModel extends Model
{
    
    protected $table         = 'VIEW_REDE_ELETRICA';
    protected $primaryKey    = 'ID';

    protected $allowedFields = [
                                'ID',	
                                'GASTO_TOTAL',	
                                'GASTO_ABATIDO',	
                                'TOTAL_APARELHOS',	
                                'ID_APARELHO',	
                                'DESCRICAO_APARELHO',	
                                'CONSUMO',	
                                'FABRICANTE',	
                                'TEMPO_DE_USO',	
                                'ENCE',	
                                'MODELO',	
                                'TIPO',	
                                'ID_GERADOR',	
                                'DESCRICAO_GERADOR',	
                                'ENERGIA_GERADA'
                            ];

    protected $useTimestamps = false;
    
    public function getAparelhosPorRede($idRede)
    {
        return $this->select('VIEW_REDE_ELETRICA.*')
            ->where('VIEW_REDE_ELETRICA.ID', $idRede)
            ->findAll();
    }
}
?>