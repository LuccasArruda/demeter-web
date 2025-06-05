<?php

namespace App\Models;

use CodeIgniter\Model;

class GeradorModel extends Model
{
    protected $table = 'GERADOR';
    protected $primaryKey = 'ID';

    protected $allowedFields = ['DESCRICAO', 'ENERGIA_GERADA', 'TIPO', 'ID_REDE_ELETRICA'];

    protected $useTimestamps = false;
}
?>