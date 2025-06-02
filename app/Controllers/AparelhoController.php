<?php

namespace App\Controllers;

use App\Models\RedeEletricaModel;
use App\Models\AparelhoModel;
use App\Models\AmbienteModel;

class AparelhoController extends BaseController
{
    public function paginaCadastroAparelho()
    {
        $session = session();
        $usuarioId = $session->get('usuarioId');

        if (!$usuarioId) {
            return redirect()->to('/login')->with('error', 'É necessário estar logado.');
        }

        $redeEletricaModel = new RedeEletricaModel();
        $redesEletricas = $redeEletricaModel->getTodasRedesPorUsuario($usuarioId);

        $dados = [
            'redesEletricas' => $redesEletricas,
            'nomeAmbiente' => '',
            'nomeRedeEletrica' => '',
            'tituloExibicao' => '',
            'tituloTela' => 'Deméter - Cadastrar Aparelho'
        ];

        return view('pages/cadastrar_aparelho', $dados);
    }

    public function cadastrar()
    {
        $session = session();
        $usuarioId = $session->get('usuarioId');

        if (!$usuarioId) {
            return redirect()->to('/login')->with('error', 'É necessário estar logado.');
        }

        $nome = $this->request->getPost('nome');
        $consumo = $this->request->getPost('consumo');
        $tempoUso = $this->request->getPost('tempoUsoMedio');
        $ence = $this->request->getPost('ENCE');
        $redeEletricaId = $this->request->getPost('redeEletrica');

        $foto = $this->request->getFile('foto');
        $nomeFoto = null;

        if ($foto && $foto->isValid()) {
            $nomeFoto = $foto->getRandomName();
            $foto->move(WRITEPATH . 'uploads', $nomeFoto);
        }

        $aparelhoModel = new AparelhoModel();
        $aparelhoModel->insert([
            'DESCRICAO' => $nome,
            'CONSUMO' => $consumo,
            'TEMPO_DE_USO' => $tempoUso,
            'ENCE' => $ence,
            'ID_REDE_ELETRICA' => $redeEletricaId,
            
        ]);

        $redeId = $redeEletricaId; 
        $redeModel = new RedeEletricaModel();
        $rede = $redeModel->find($redeId);
        $ambienteId = $rede['ID_AMBIENTE'];

        $ambienteModel = new AmbienteModel();
        $pontuacao = $ambienteModel->calcularPontuacaoSustentabilidadePorAmbiente($ambienteId);
        $ambienteModel->update($ambienteId, ['PERCENTUAL_SUSTENTABILIDADE' => $pontuacao]);

        return redirect()->to("/aparelhos/$redeEletricaId")->with('success', 'Aparelho cadastrado com sucesso!');
    }

    public function visualizar($idRede)
    {
        $sessao = session();
        $usuarioId = $sessao->get('usuarioId');

        if (!$usuarioId) {
            return redirect()->to('/login')->with('error', 'Acesso negado.');
        }

        $redeModel = new RedeEletricaModel();
        $rede = $redeModel->find($idRede);

        if (!$rede) {
            return redirect()->to('/ambientes')->with('error', 'Rede elétrica não encontrada.');
        }

        $ambienteModel = new AmbienteModel();
        $ambiente = $ambienteModel->find($rede['ID_AMBIENTE']);

        $nomeAmbiente = isset($ambiente) ? $ambiente['DESCRICAO'] . ' |' : '';
        $nomeRedeEletrica = $rede['DESCRICAO'] . ' |';

        $aparelhoModel = new AparelhoModel();
        $aparelhos = $aparelhoModel->getAparelhosPorRedeEUsuario($idRede, $usuarioId);

        $dados =  [
            'aparelhos' => $aparelhos,
            'nomeAmbiente' => $nomeAmbiente,
            'nomeRedeEletrica' => $nomeRedeEletrica,
            'tituloExibicao' => 'Aparelhos'
        ];
    

        return view('/pages/aparelhos', $dados);
    }

}
