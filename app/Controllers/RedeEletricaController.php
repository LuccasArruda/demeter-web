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
            'ambientes' => $ambientes,
            'nomeAmbiente' => '',
            'nomeRedeEletrica' => '',
            'tituloExibicao' => ''
        ];

        return view('/pages/cadastrar_rede_eletrica', $dados);
    }

    public function cadastrar()
    {
        $session = session();
        $usuarioId = $session->get('usuarioId');

        if (!$usuarioId) {
            return redirect()->to('/login')->with('error', 'É necessário estar logado.');
        }

        // Dados do formulário
        $descricao = $this->request->getPost('descricao');
        $idAmbiente = $this->request->getPost('ambiente');
        
        // Upload da foto
        $foto = $this->request->getFile('foto');
        $nomeFoto = null;
        if ($foto && $foto->isValid()) {
            $nomeFoto = $foto->getRandomName();
            $foto->move(WRITEPATH . 'uploads', $nomeFoto);
        }

        // Verificar se o ambiente pertence ao usuário
        $ambienteModel = new \App\Models\AmbienteModel();
        $ambiente = $ambienteModel->where(['ID' => $idAmbiente, 'ID_USUARIO' => $usuarioId])->first();

        if (!$ambiente) {
            return redirect()->to('/cadastrar-rede-eletrica')->with('error', 'Ambiente inválido.');
        }

        // Inserir dados
        $redeModel = new \App\Models\RedeEletricaModel();
        $redeModel->insert([
            'DESCRICAO' => $descricao,
            'ID_AMBIENTE' => $idAmbiente,
            
        ]);

        return redirect()->to("/redes-eletricas/$idAmbiente")->with('success', 'Rede elétrica cadastrada com sucesso!');
        
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
        
        $ambienteModel = new AmbienteModel();
        $ambiente = $ambienteModel->getAmbientePorID($id);
        if(isset($ambiente)){
            $ambiente['DESCRICAO'] = $ambiente['DESCRICAO'].' |';
        }

        $nomeAmbiente = $ambiente['DESCRICAO'];

        $dados = [
            'redes' => $redes,
            'nomeAmbiente' => $nomeAmbiente,
            'nomeRedeEletrica' => '',
            'tituloExibicao' => 'Redes Elétricas'
        ];

        return view('/pages/redes_eletricas', $dados);
    }

    public function editar($idRedeEletrica)
    {
        $sessao = session();
        $usuarioId = $sessao->get('usuarioId');

        if (!$usuarioId) {
            return redirect()->to('/login')->with('error', 'Acesso negado. Faça login para continuar.');
        }
        
        $redeEletricaModel = new RedeEletricaModel();
        $redeEletrica = $redeEletricaModel->getRedeEletricaPorID($idRedeEletrica);

        $ambienteModel = new AmbienteModel();
        $ambientes = $ambienteModel->getAmbientesPorUsuario($usuarioId);
        $ambienteRedeEletrica = $ambienteModel->getAmbientePorID($redeEletrica['ID_AMBIENTE']);

        $dados = [
            'ambientes' => $ambientes,
            'redeEletrica' => $redeEletrica,
            'ambienteRedeEletrica' => $ambienteRedeEletrica,
            'nomeAmbiente' => '',
            'nomeRedeEletrica' => '',
            'tituloExibicao' => ''
        ];

        return view('/pages/editar_rede_eletrica', $dados);
    }

    public function atualizar($idRedeEletrica)
    {
        $session = session();
        $usuarioId = $session->get('usuarioId');

        if (!$usuarioId) {
            return redirect()->to('/login')->with('error', 'É necessário estar logado.');
        }

        // Dados do formulário
        $descricao = $this->request->getPost('descricao');
        $idAmbiente = $this->request->getPost('ambiente');

        // Upload da foto
        $foto = $this->request->getFile('foto');
        $nomeFoto = null;

        if ($foto && $foto->isValid()) {
            $nomeFoto = $foto->getRandomName();
            $foto->move(WRITEPATH . 'uploads', $nomeFoto);
        }

        // Verificar se o ambiente pertence ao usuário
        $ambienteModel = new AmbienteModel();
        $ambiente = $ambienteModel->where(['ID' => $idAmbiente, 'ID_USUARIO' => $usuarioId])->first();

        if (!$ambiente) {
            return redirect()->to('/cadastrar-rede-eletrica')->with('error', 'Ambiente inválido.');
        }

        // Inserir dados
        $redeModel = new RedeEletricaModel();
        $redeModel->update($idRedeEletrica, [
            'DESCRICAO' => $descricao,
            'ID_AMBIENTE' => $idAmbiente,
        ]);

        return redirect()->to("/redes-eletricas/$idAmbiente")->with('success', 'Rede elétrica atualizada com sucesso!');
    }

    public function excluir($id)
    {
        $sessao = session();
        $usuarioId = $sessao->get('usuarioId');

        if (!$usuarioId) {
            return redirect()->to('/login')->with('error', 'Acesso negado. Faça login para continuar.');
        }

        $redeModel = new \App\Models\RedeEletricaModel();
        $ambienteModel = new \App\Models\AmbienteModel();
        $aparelhoModel = new \App\Models\AparelhoModel();
        $geradorModel = new \App\Models\GeradorModel();
        $sustentabilidadeService = new \App\Libraries\SustentabilidadeService();

        $rede = $redeModel->find($id);

        if (!$rede) {
            return redirect()->back()->with('error', 'Rede elétrica não encontrada.');
        }

        $ambienteId = $rede['ID_AMBIENTE'];

        // Verifica se existem aparelhos ou geradores ligados à rede
        $aparelhos = $aparelhoModel->where('ID_REDE_ELETRICA', $id)->countAllResults();
        $geradores = $geradorModel->where('ID_REDE_ELETRICA', $id)->countAllResults();

        if ($aparelhos > 0 || $geradores > 0) {
            //return redirect()->back()->with('error', 'A rede possui aparelhos ou geradores vinculados e não pode ser excluída.');
        }

        if (!$redeModel->delete($id)) {
            return redirect()->back()->with('error', 'Erro ao excluir a rede elétrica.');
        }

        // Atualiza pontuação de sustentabilidade do ambiente
        if ($ambienteId) {
            $pontuacaoAmbiente = round($sustentabilidadeService->calcularPorAmbiente($ambienteId));
            $ambienteModel->update($ambienteId, ['PERCENTUAL_SUSTENTABILIDADE' => $pontuacaoAmbiente]);
        }

        return redirect()->to("/redes-eletricas/$ambienteId")->with('success', 'Rede Elétrica excluída com sucesso!');
    }

}
