<?php

namespace App\Controllers;

use App\Models\RedeEletricaModel;
use App\Models\GeradorModel;
use App\Libraries\SustentabilidadeService;
use App\Models\AmbienteModel;

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
        $redeModel = new RedeEletricaModel();
        $ambienteModel = new AmbienteModel();
        $service = new SustentabilidadeService();

        $rede = $redeModel->find($redeEletricaId);

        // if ($rede) {
        //     // Atualiza rede
        //     $pontuacaoRede = round($service->calcularPorRede($redeEletricaId));
        //     $redeModel->update($redeEletricaId, ['PERCENTUAL_SUSTENTABILIDADE' => $pontuacaoRede]);

        //     // Atualiza ambiente
        //     if (isset($rede['ID_AMBIENTE'])) {
        //         $pontuacaoAmbiente = round($service->calcularPorAmbiente($rede['ID_AMBIENTE']));
        //         $ambienteModel->update($rede['ID_AMBIENTE'], ['PERCENTUAL_SUSTENTABILIDADE' => $pontuacaoAmbiente]);
        //     }
        // }
        
        return redirect()->to("/aparelhos/$redeEletricaId")->with('success', 'Gerador cadastrado com sucesso!');
    }

    public function editar($idGerador)
    {
        $sessao = session();
        $usuarioId = $sessao->get('usuarioId');

        if (!$usuarioId) {
            return redirect()->to('/login')->with('error', 'Acesso negado.');
        }

        $geradorModel = new GeradorModel();
        $gerador = $geradorModel->find($idGerador);

        $redeEletricaModel = new RedeEletricaModel();
        $redesEletricas = $redeEletricaModel->findAll();
        $redeEletricaGerador = $redeEletricaModel->getRedeEletricaPorID($gerador['ID_REDE_ELETRICA']);

        if (!$gerador) {
            return redirect()->to('/ambientes')->with('error', 'Gerador não encontrado.');
        }

        $dados =  [
            'redesEletricas' => $redesEletricas,
            'redeEletricaGerador' => $redeEletricaGerador,
            'gerador' => $gerador,
            'nomeAmbiente' => '',
            'nomeRedeEletrica' => '',
            'tituloExibicao' => ''
        ];

        return view("/pages/editar_gerador", $dados);
    }

    public function atualizar($idGerador)
    {
        $session = session();
        $usuarioId = $session->get('usuarioId');

        if (!$usuarioId) {
            return redirect()->to('/login')->with('error', 'É necessário estar logado.');
        }

        $nome = $this->request->getPost('nome');
        $energiaGerada =  $this->request->getPost('energiaGerada');
        $redeEletricaId = $this->request->getPost('redeEletrica');
        $tipo = $this->request->getPost('tipo');
        $foto = $this->request->getFile('foto');
        $nomeFoto = null;

        if ($foto && $foto->isValid()) {
            $nomeFoto = $foto->getRandomName();
            $foto->move(WRITEPATH . 'uploads', $nomeFoto);
        }

        $geradorModel = new GeradorModel();
        $geradorModel->update($idGerador, [
            'DESCRICAO' => $nome,
            'ENERGIA_GERADA' => $energiaGerada,
            'TIPO' => $tipo,
            'ID_REDE_ELETRICA' => $redeEletricaId,
            //'IMAGEM_CAMINHO' => $nomeFoto ? 'uploads/' . $nomeFoto : null,
        ]);

        // Atualiza a pontuação da rede e do ambiente
        $redeModel = new RedeEletricaModel();
        $ambienteModel = new AmbienteModel();
        $service = new SustentabilidadeService();

        $rede = $redeModel->find($redeEletricaId);

        // if ($rede) {
        //     // Atualiza rede
        //     $pontuacaoRede = round($service->calcularPorRede($redeEletricaId));
        //     $redeModel->update($redeEletricaId, ['PERCENTUAL_SUSTENTABILIDADE' => $pontuacaoRede]);

        //     // Atualiza ambiente
        //     if (isset($rede['ID_AMBIENTE'])) {
        //         $pontuacaoAmbiente = round($service->calcularPorAmbiente($rede['ID_AMBIENTE']));
        //         $ambienteModel->update($rede['ID_AMBIENTE'], ['PERCENTUAL_SUSTENTABILIDADE' => $pontuacaoAmbiente]);
        //     }
        // }

        return redirect()->to("/aparelhos/$redeEletricaId")->with('success', 'Gerador atualizado com sucesso!');
    }

    public function excluir($id)
    {
        $sessao = session();
        $usuarioId = $sessao->get('usuarioId');

        if (!$usuarioId) {
            return redirect()->to('/login')->with('error', 'Acesso negado. Faça login para continuar.');
        }

        $geradorModel = new GeradorModel();
        $redeModel = new RedeEletricaModel();
        $ambienteModel = new AmbienteModel();
        $sustentabilidadeService = new SustentabilidadeService();

        $gerador = $geradorModel->find($id);

        if (!$gerador) {
            return redirect()->back()->with('error', 'Gerador não encontrado.');
        }

        $redeId = $gerador['ID_REDE_ELETRICA'];
        $rede = $redeModel->find($redeId);

        if (!$rede) {
            return redirect()->back()->with('error', 'Rede elétrica vinculada não encontrada.');
        }

        if (!$geradorModel->delete($id)) {
            return redirect()->back()->with('error', 'Erro ao excluir o gerador.');
        }

        if ($rede) {
            // Atualiza rede
            $pontuacaoRede = round($sustentabilidadeService->calcularPorRede($redeId));
            $redeModel->update($redeId, ['PERCENTUAL_SUSTENTABILIDADE' => $pontuacaoRede]);

            // Atualiza ambiente
            if (isset($rede['ID_AMBIENTE'])) {
                $pontuacaoAmbiente = round($sustentabilidadeService->calcularPorAmbiente($rede['ID_AMBIENTE']));
                $ambienteModel->update($rede['ID_AMBIENTE'], ['PERCENTUAL_SUSTENTABILIDADE' => $pontuacaoAmbiente]);
            }
        }

        return redirect()->to("/aparelhos/$redeId")->with('success', 'Aparelho excluído com sucesso!');
    }
}
