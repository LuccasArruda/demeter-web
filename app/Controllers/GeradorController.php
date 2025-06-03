<?php

namespace App\Controllers;

use App\Models\RedeEletricaModel;

class GeradorController extends BaseController
{
    public function paginaCadastroGerador()
    {
        $session = session();
        $usuarioId = $session->get('usuarioId');

        if (!$usuarioId) {
            return redirect()->to('/login')->with('error', 'É necessário estar logado.');
        }

        $ambiente = 1;

        $redeEletricaModel = new RedeEletricaModel();
        $redesEletricas = $redeEletricaModel->getTodasRedesPorUsuario($usuarioId);

        $dados = [
            'redesEletricas' => $redesEletricas,
            'nomeAmbiente' => '',
            'nomeRedeEletrica' => '',
            'tituloExibicao' => '',
            'tituloTela' => 'Deméter - Cadastrar Aparelho'
        ];

        return view('pages/cadastrar_gerador', $dados);
    }
}
