<?php
    namespace App\Models;
    use CodeIgniter\Model;

    class BairroModel extends Model {
        protected $table = 'BAIRRO';
        protected $primaryKey = 'ID';
        protected $allowedFields = ['NOME', 'ID_CIDADE'];

        public function getBairroPorID($idBairro)
        {
            return $this->select('BAIRRO.*')
                ->where('ID', $idBairro)
                ->first();
        }
    }
?>