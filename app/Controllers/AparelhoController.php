<?php

namespace App\Controllers;

use App\Models\RedeEletricaModel;
use App\Models\AparelhoModel;

class AparelhoController extends BaseController
{
    public function paginaCadastroAparelho()
    {
        $session = session();
        $usuarioId = $session->get('usuarioId');

        if (!$usuarioId) {
            return redirect()->to('/login')->with('error', 'É necessário estar logado.');
        }

        $ambiente = 1;

        $redeEletricaModel = new RedeEletricaModel();
        $redesEletricas = $redeEletricaModel->getRedesPorAmbienteEUsuario($ambiente, $usuarioId);

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
            'NOME' => $nome,
            'POTENCIA' => $consumo,
            'TEMPO_USO' => $tempoUso,
            'ENCE' => $ence,
            'ID_REDE_ELETRICA' => $redeEletricaId,
            'FOTO' => $nomeFoto
        ]);

        return redirect()->to('/aparelhos')->with('success', 'Aparelho cadastrado com sucesso!');
    }

    public function visualizar(): string
    {
        $nomeAmbiente = 'Carlos';
        $nomeRedeEletrica = 'Escritório';
        $dados = [
            'nomeAmbiente' => $nomeAmbiente,
            'nomeRedeEletrica' => $nomeRedeEletrica,
            'tituloExibicao' => 'Aparelhos'
        ];

        return view('pages/aparelhos', $dados);
    }
}
