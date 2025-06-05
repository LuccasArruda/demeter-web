<?php

namespace App\Controllers;

use App\Models\RedeEletricaModel;
use App\Models\GeradorModel;
use App\Libraries\SustentabilidadeService;

class GeradorController extends BaseController
{
    public function paginaCadastroGerador()
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
        $tipo = $this->request->getPost('tipo');
        $foto = $this->request->getFile('foto');
        $nomeFoto = null;

        if ($foto && $foto->isValid()) {
            $nomeFoto = $foto->getRandomName();
            $foto->move(WRITEPATH . 'uploads', $nomeFoto);
        }

        $geradorModel = new GeradorModel();
        $geradorModel->insert([
            'DESCRICAO' => $nome,
            'ENERGIA_GERADA' => $energiaGerada,
            'TIPO' => $tipo,
            'ID_REDE_ELETRICA' => $redeEletricaId,
            //'IMAGEM_CAMINHO' => $nomeFoto ? 'uploads/' . $nomeFoto : null,
        ]);
        
        // Atualiza a pontuação da rede e do ambiente
        $redeModel = new \App\Models\RedeEletricaModel();
        $ambienteModel = new \App\Models\AmbienteModel();
        $service = new SustentabilidadeService();

        $rede = $redeModel->find($redeEletricaId);

        if ($rede) {
            // Atualiza rede
            $pontuacaoRede = round($service->calcularPorRede($redeEletricaId));
            $redeModel->update($redeEletricaId, ['PERCENTUAL_SUSTENTABILIDADE' => $pontuacaoRede]);

            // Atualiza ambiente
            if (isset($rede['ID_AMBIENTE'])) {
                $pontuacaoAmbiente = round($service->calcularPorAmbiente($rede['ID_AMBIENTE']));
                $ambienteModel->update($rede['ID_AMBIENTE'], ['PERCENTUAL_SUSTENTABILIDADE' => $pontuacaoAmbiente]);
            }
        }
        
        return redirect()->to("/aparelhos/$redeEletricaId")->with('success', 'Gerador cadastrado com sucesso!');
    }
}
