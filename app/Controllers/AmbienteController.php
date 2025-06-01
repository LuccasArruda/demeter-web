<?php

namespace App\Controllers;
use App\Models\AmbienteModel;
use App\Models\EstadoModel;

class AmbienteController extends BaseController
{
    public function paginaCadastro()
    {
        $estadoModel = new EstadoModel();
        $estados = $estadoModel->getEstados();

        $dados = [ 
            'estados' => $estados,
            'tituloTela' => 'Deméter - Cadastrar Ambiente'
        ];

        return view('pages/cadastrar_ambiente', $dados);
    }

    public function cadastrar()
    {
        $session = session();
        $usuarioId = $session->get('usuarioId');

        if (!$usuarioId) {
            return redirect()->to('/login')->with('error', 'É necessário estar logado.');
        }

        // Receber dados do formulário
        $estadoId = $this->request->getPost('estado');
        $cidadeNome = $this->request->getPost('cidade');
        $bairroNome = $this->request->getPost('bairro');
        $rua = $this->request->getPost('rua');
        $numero = $this->request->getPost('numero');
        $descricao = $this->request->getPost('nome');
        $tipo = $this->request->getPost('tipo'); // 'P' ou 'F'
        $valorContaLuz = $this->request->getPost('valorMedioContaLuz');

        // FOTO
        $foto = $this->request->getFile('foto');
        $nomeFoto = null;
        if ($foto && $foto->isValid()) {
            $nomeFoto = $foto->getRandomName();
            $foto->move(WRITEPATH . 'uploads', $nomeFoto);
        }

        // MODELS
        $cidadeModel = new \App\Models\CidadeModel();
        $bairroModel = new \App\Models\BairroModel();
        $enderecoModel = new \App\Models\EnderecoModel();
        $ambienteModel = new \App\Models\AmbienteModel();

        // CIDADE
        $cidade = $cidadeModel->where(['NOME' => $cidadeNome, 'ID_ESTADO' => $estadoId])->first();
        if (!$cidade) {
            $cidadeId = $cidadeModel->insert(['NOME' => $cidadeNome, 'ID_ESTADO' => $estadoId]);
        } else {
            $cidadeId = $cidade['ID'];
        }

        // BAIRRO
        $bairro = $bairroModel->where(['NOME' => $bairroNome, 'ID_CIDADE' => $cidadeId])->first();
        if (!$bairro) {
            $bairroId = $bairroModel->insert(['NOME' => $bairroNome, 'ID_CIDADE' => $cidadeId]);
        } else {
            $bairroId = $bairro['ID'];
        }

        // ENDEREÇO
        $enderecoId = $enderecoModel->insert([
            'RUA' => $rua,
            'NUMERO' => $numero,
            'ID_BAIRRO' => $bairroId
        ]);

        // AMBIENTE
        $ambienteModel->insert([
            'DESCRICAO' => $descricao,
            'TIPO' => strtoupper($tipo[0]), // transforma 'pessoal' em 'P', etc
            'VL_MEDIO_CONTA_LUZ' => $valorContaLuz,
            'PERCENTUAL_SUSTENTABILIDADE' => 0,
            'ID_USUARIO' => $usuarioId,
            'ID_ENDERECO' => $enderecoId,
            'FOTO' => $nomeFoto
        ]);

        return redirect()->to('/ambientes')->with('success', 'Ambiente cadastrado com sucesso!');
    }

    public function meusAmbientes() 
    {
        $sessao = session();
        $usuarioId = $sessao->get('usuarioId');

        if (!$usuarioId) {
            return redirect()->to('/pages/login')->with('error', 'Acesso negado. Faça login para continuar.');
        }

        $ambienteModel = new AmbienteModel();

        $ambientes = $ambienteModel->getAmbientesPorUsuario($usuarioId);

        $dados = [
            'ambientes' => $ambientes,
            'titulo' => 'Meus Ambientes'
        ];

        if (empty($ambientes)) {
            $dados['mensagem_status'] = 'Você ainda não possui ambientes cadastrados.';
        }

        return view('pages/ambientes', $dados); 
    }
}
