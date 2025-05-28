<?php

namespace App\Controllers;

class Ambiente extends BaseController
{
    public function index()
    {
        return view('cadastro_ambiente');
    }

    public function salvar()
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

        // Aqui você pode salvar $data no banco de dados

        return redirect()->to('/')->with('success', 'Ambiente cadastrado com sucesso!');
    }
}
