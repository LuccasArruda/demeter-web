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
}
