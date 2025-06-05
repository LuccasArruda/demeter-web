<?php

namespace App\Models;

use CodeIgniter\Model;

class ViewEnderecoModel extends Model
{
    protected $table = 'VIEW_ENDERECO';
    protected $primaryKey = 'ID_ENDERECO';
    protected $returnType = 'array';
    protected $allowedFields = ['RUA', 'NUMERO', 'BAIRRO', 'CIDADE', 'ESTADO_SIGLA', 'ESTADO_NOME'];
    protected $useAutoIncrement = false;
    public $timestamps = false;
}
?>