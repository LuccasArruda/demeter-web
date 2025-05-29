<?php

namespace App\Controllers;

class AmbienteController extends BaseController
{
    public function paginaCadastro()
    {
        return view('cadastrar_ambiente');
    }

    public function cadastrar()
    {
        $foto = $this->request->getFile('foto');
        $data = [
            'nome' => $this->request->getPost('nome'),
            'cep' => $this->request->getPost('cep'),
            'cidade' => $this->request->getPost('cidade'),
            'estado' => $this->request->getPost('estado'),
            'rua' => $this->request->getPost('rua'),
            'bairro' => $this->request->getPost('bairro'),
            'tipo' => $this->request->getPost('tipo'),
        ];

        if ($foto && $foto->isValid()) {
            $newName = $foto->getRandomName();
            $foto->move(WRITEPATH . 'uploads', $newName);
            $data['foto'] = $newName;
        }

        return redirect()->to('/')->with('success', 'Ambiente cadastrado com sucesso!');
    }

    public function visualizar(): string
    {
        return view('ambientes');
    }
}
