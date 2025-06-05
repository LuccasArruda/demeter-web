<?php
    namespace App\Models;
    use CodeIgniter\Model;

    class EnderecoModel extends Model {
        protected $table = 'ENDERECO';
        protected $primaryKey = 'ID';
        protected $allowedFields = ['RUA', 'NUMERO', 'ID_BAIRRO'];

        public function getEnderecoPorID($idEndereco)
        {
            return $this->select('ENDERECO.*')
                ->where('ID', $idEndereco)
                ->first();
        }
    }
?>