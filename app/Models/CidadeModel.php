<?php
    namespace App\Models;
    use CodeIgniter\Model;

    class CidadeModel extends Model {
        protected $table = 'CIDADE';
        protected $primaryKey = 'ID';
        protected $allowedFields = ['NOME', 'ID_ESTADO'];

        public function getCidadePorID($idCidade)
        {
            return $this->select('CIDADE.*')
                ->where('ID', $idCidade)
                ->first();
        }
    }

?>