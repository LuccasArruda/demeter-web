<?php

namespace App\Controllers;
use App\Models\AmbienteModel;
use App\Models\BairroModel;
use App\Models\CidadeModel;
use App\Models\EnderecoModel;
use App\Models\EstadoModel;

class AmbienteController extends BaseController
{
    public function paginaCadastro()
    {
        $estadoModel = new EstadoModel();
        $estados = $estadoModel->getEstados();

        $dados = [ 
            'estados' => $estados,
            'nomeAmbiente' => '',
            'nomeRedeEletrica' => '',
            'tituloExibicao' => ''
        ];

        return view('pages/cadastrar_ambiente', $dados);
    }

    public function editar($idAmbiente){
        $estadoModel = new EstadoModel();
        $estados = $estadoModel->getEstados();

        $ambienteModel = new AmbienteModel();
        $bairroModel = new BairroModel();
        $enderecoModel = new EnderecoModel();
        $cidadeModel = new CidadeModel();

        $ambiente = $ambienteModel->getAmbientePorID($idAmbiente);
        $enderecoAmbiente = $enderecoModel->getEnderecoPorID($ambiente['ID_ENDERECO']);
        $bairroAmbiente = $bairroModel->getBairroPorID($enderecoAmbiente['ID_BAIRRO']);
        $cidadeAmbiente = $cidadeModel->getCidadePorID($bairroAmbiente['ID_CIDADE']);
        $estadoAmbiente = $estadoModel->getEstadoPorID($cidadeAmbiente['ID_ESTADO']);

        $dados = [
            'ambiente' => $ambiente,
            'enderecoAmbiente' => $enderecoAmbiente,
            'bairroAmbiente' => $bairroAmbiente,
            'cidadeAmbiente' => $cidadeAmbiente,
            'estadoAmbiente' => $estadoAmbiente,
            'estados' => $estados,
            'nomeAmbiente' => '',
            'nomeRedeEletrica' => '',
            'tituloExibicao' => ''
        ];

        return view('pages/editar_ambiente', $dados);
    }

    public function atualizar($idAmbiente)
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
        $tipo = $this->request->getPost('tipo');
        $valorContaLuz = $this->request->getPost('valorMedioContaLuz');

        // FOTO
        $foto = $this->request->getFile('foto');
        $nomeFoto = null;
        if ($foto && $foto->isValid()) {
            $nomeFoto = $foto->getRandomName();
            $foto->move(WRITEPATH . 'uploads', $nomeFoto);
        }

        // MODELS
        $cidadeModel = new CidadeModel();
        $bairroModel = new BairroModel();
        $enderecoModel = new EnderecoModel();
        $ambienteModel = new AmbienteModel();

        $ambiente = $ambienteModel->getAmbientePorID($idAmbiente);

        $cidade = $cidadeModel->where(['NOME' => $cidadeNome, 'ID_ESTADO' => $estadoId])->first();
        if (!$cidade) {
            $cidadeId = $cidadeModel->insert(['NOME' => $cidadeNome, 'ID_ESTADO' => $estadoId]);
        } else {
            $cidadeId = $cidade['ID'];
        }

        // // BAIRRO
        $bairro = $bairroModel->where(['NOME' => $bairroNome, 'ID_CIDADE' => $cidadeId])->first();
        if (!$bairro) {
            $bairroId = $bairroModel->insert(['NOME' => $bairroNome, 'ID_CIDADE' => $cidadeId]);
        } else {
            $bairroId = $bairro['ID'];
        }

        // ENDEREÇO
        $enderecoId = $enderecoModel->update($ambiente['ID_ENDERECO'], [
            'RUA' => $rua,
            'NUMERO' => $numero,
            'ID_BAIRRO' => $bairroId
        ]);

        // AMBIENTE
        $ambienteModel->update($idAmbiente, [
            'DESCRICAO' => $descricao,
            'TIPO' => strtoupper($tipo[0]) . strtoupper($tipo[1]),
            'VL_MEDIO_CONTA_LUZ' => $valorContaLuz,
            //'PERCENTUAL_SUSTENTABILIDADE' => 0,
            'ID_USUARIO' => $usuarioId,
            'ID_ENDERECO' => $enderecoId,
            //'FOTO' => $nomeFoto
        ]);

        return redirect()->to('/ambientes')->with('success', 'Ambiente cadastrado com sucesso!');
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
            'TIPO' => strtoupper($tipo[0]) . strtoupper($tipo[1]), // transforma 'pessoal' em 'P', etc
            'VL_MEDIO_CONTA_LUZ' => $valorContaLuz,
            'PERCENTUAL_SUSTENTABILIDADE' => 0,
            'ID_USUARIO' => $usuarioId,
            'ID_ENDERECO' => $enderecoId,
            //'FOTO' => $nomeFoto
        ]);

        return redirect()->to('/ambientes')->with('success', 'Ambiente cadastrado com sucesso!');
    }

    public function meusAmbientes() 
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
            'tituloExibicao' => 'Meus Ambientes'
        ];

        if (empty($ambientes)) {
            $dados['mensagem_status'] = 'Você ainda não possui ambientes cadastrados.';
        }

        return view('pages/ambientes', $dados); 
    }

    public function excluir($id) 
    {

        $sessao = session();
        $usuarioId = $sessao->get('usuarioId');

        if (!$usuarioId) {
            return redirect()->to('/login')->with('error', 'Acesso negado. Faça login para continuar.');
        }

        $ambienteModel = new AmbienteModel();
        $ambiente = $ambienteModel->getAmbientePorID($id);

        if (!$ambiente) {
            return redirect()->to('/ambientes')->with('error', 'Ambiente não encontrado.');
        }

        if (!$ambienteModel->deletarAmbiente($id, $usuarioId)) {
            return redirect()->to('/ambientes')->with('error', 'Não é possível excluir o ambiente. Verifique se ele possui redes elétricas associadas.');
        }

        return redirect()->to('/ambientes')->with('success', 'Ambiente excluído com sucesso!');
    }
}
