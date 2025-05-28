import React, { useState } from 'react';
import './CadastroAmbiente.scss';
import upload from '../assets/upload.svg';
import ilustracaoAmbiente from '../assets/ilustracao-ambiente.svg';

export default function CadastroAmbiente() {
  const [form, setForm] = useState({
    nome: '',
    cep: '',
    cidade: '',
    estado: '',
    rua: '',
    bairro: '',
    tipo: 'pessoal',
    foto: null,
  });

  const handleChange = (e) => {
    const { name, value } = e.target;
    setForm({ ...form, [name]: value });
  };

  const handleFileChange = (e) => {
    setForm({ ...form, foto: e.target.files[0] });
  };

  const handleSubmit = (e) => {
    e.preventDefault();
    // Aqui você pode integrar com seu backend
    alert('Ambiente cadastrado com sucesso!');
  };

  return (
    <form className="cadastro-ambiente" onSubmit={handleSubmit}>
      <a className="retornar" href="/">← Retornar</a>

      <div className="painel">
        <img src={ilustracaoAmbiente} alt="Ambiente" className="ilustracao" />
        <div className="formulario">
          <h1>Cadastrar Novo Ambiente</h1>
          <div className="linha">
            <input type="text" name="nome" placeholder="Nome" onChange={handleChange} />
          </div>
          <div className="linha">
            <input type="text" name="cep" placeholder="CEP" onChange={handleChange} />
            <input type="text" name="cidade" placeholder="Cidade" onChange={handleChange} />
            <input type="text" name="estado" placeholder="Estado" onChange={handleChange} />
          </div>
          <div className="linha">
            <input type="text" name="rua" placeholder="Rua" onChange={handleChange} />
            <input type="text" name="bairro" placeholder="Bairro" onChange={handleChange} />
          </div>

          <div className="radio-group">
            <label>
              <input type="radio" name="tipo" value="pessoal" checked={form.tipo === 'pessoal'} onChange={handleChange} />
              Ambiente Pessoal
            </label>
            <label>
              <input type="radio" name="tipo" value="profissional" checked={form.tipo === 'profissional'} onChange={handleChange} />
              Ambiente Profissional
            </label>
          </div>
          {form.tipo === 'pessoal' && (
            <div className='aviso'>
              <i className='bi bi-info-circle'></i>
              <p className='texto'>Ambientes do tipo <strong>Pessoal</strong> só podem ter uma rede elétrica</p>
            </div>
          )}
        </div>
      </div>

      <label className="upload">
        <img src={upload} alt="Upload" />
        <span>Insira uma foto do Ambiente</span>
        <p>Clique ou arraste uma foto</p>
        <input type="file" accept="image/*" onChange={handleFileChange} hidden />
      </label>


      <button type="submit">Cadastrar</button>
    </form>
  );
}
