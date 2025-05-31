<?php
    namespace App\Models;
    use CodeIgniter\Model;

    class EstadoModel extends Model {
        protected $table = 'ESTADO';
        protected $primaryKey = 'ID';
        protected $allowedFields = ['NOME', 'SIGLA'];

        public function getEstados(){
            return $this->findAll();
        }
    }
?>