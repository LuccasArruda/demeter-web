<?php

namespace App\Controllers;

use App\Models\RedeEletricaModel;
use App\Models\GeradorModel;

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

    public function cadastrarGerador()
    {
        $session = session();
        $usuarioId = $session->get('usuarioId');

        if (!$usuarioId) {
            return redirect()->to('/login')->with('error', 'É necessário estar logado.');
        }

        $nome = $this->request->getPost('nome');
        $energiaGerada = $this->request->getPost('energiaGerada');
        $redeEletricaId = $this->request->getPost('redeEletrica');

        $foto = $this->request->getFile('foto');
        $nomeFoto = null;

        if ($foto && $foto->isValid()) {
            $nomeFoto = $foto->getRandomName();
            $foto->move(WRITEPATH . 'uploads', $nomeFoto);
        }

        $geradorModel = new GeradorModel();
        $geradorModel->insert([
            'NOME' => $nome,
            'ENERGIA_GERADA' => $energiaGerada,
            //'TIPO' => 
            'ID_REDE_ELETRICA' => $redeEletricaId,
            //'IMAGEM_CAMINHO' => $nomeFoto ? 'uploads/' . $nomeFoto : null,
        ]);

        return redirect()->to('/aparelhos')->with('success', 'Gerador cadastrado com sucesso!');
    }
}
