<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use Config\Database;

class Teste extends Controller
{
    public function testarConexao()
    {
        try {
            $db = Database::connect();

            $query = $db->query('SELECT 1');
            $result = $query->getResult();
            
            if ($result) {
                echo "Conexão com o banco de dados está funcionando!";
            } else {
                echo "Erro: Não foi possível executar a consulta.";
            }
        } catch (\Exception $e) {
            echo "Erro na conexão: " . $e->getMessage();
        }
    }
}