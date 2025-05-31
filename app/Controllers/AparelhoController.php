<?php

namespace App\Controllers;

use App\Models\RedeEletricaModel;

class AparelhoController extends BaseController
{
    public function paginaCadastroAparelho()
    {
        $session = session();
        $usuarioId = $session->get('usuarioId');

        if (!$usuarioId) {
            return redirect()->to('/pages/login')->with('error', 'É necessário estar logado.');
        }

        $ambiente = 1;

        $redeEletricaModel = new RedeEletricaModel();
        $redesEletricas = $redeEletricaModel->getRedesPorAmbienteEUsuario($ambiente, $usuarioId);

        $dados = [
            'redesEletricas' => $redesEletricas,
            'tituloTela' => 'Deméter - Cadastrar Aparelho'
        ];

        return view('pages/cadastrar_aparelho', $dados);
    }

    public function visualizar(): string
    {
        return view('pages/aparelhos');
    }
}
