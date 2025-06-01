<?php
    namespace App\Models;
    use CodeIgniter\Model;
    
    class AparelhoModel extends Model
    {
        protected $table = 'APARELHO';
        protected $primaryKey = 'ID';
        protected $allowedFields = ['NOME', 'POTENCIA', 'TEMPO_USO', 'ENCE', 'ID_REDE_ELETRICA', 'FOTO'];
    }
?>