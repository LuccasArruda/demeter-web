<?php

namespace App\Controllers;

use App\Models\AmbienteModel;
use App\Models\RedeEletricaModel;

class RedeEletricaController extends BaseController
{
    public function paginaCadastro()
    {
        $sessao = session();
        $usuarioId = $sessao->get('usuarioId');

        if (!$usuarioId) {
            return redirect()->to('/login')->with('error', 'Acesso negado. Faça login para continuar.');
        }

        $ambienteModel = new AmbienteModel();
        $ambientes = $ambienteModel->getAmbientesPorUsuario($usuarioId);

        $dados = [ 
            'ambientes' => $ambientes
        ];
        return view('/pages/cadastrar_rede_eletrica', $dados);
    }
    
    public function visualizar($id)
    {
        $sessao = session();
        $usuarioId = $sessao->get('usuarioId');

        if (!$usuarioId) {
            return redirect()->to('/login')->with('error', 'Acesso negado. Faça login para continuar.');
        }

        $redeEletricaModel = new RedeEletricaModel();
        $redes = $redeEletricaModel->getRedesPorAmbienteEUsuario($id, $usuarioId);

        return view('/pages/redes_eletricas', ['redes' => $redes]);
    }
}
