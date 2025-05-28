import React, { useState } from "react"; // IMPORTANTE
import { Link } from "react-router-dom";
import "./Cadastro.scss";
import logo from '../assets/logo.png';

function Cadastro() {
  const [showPassword, setShowPassword] = useState(false);

  const togglePassword = () => {
    setShowPassword(prev => !prev);
  };

  return (
    <div className="cadastro-page">
      <div className="left-panel">
        <img src={logo} alt="Logo" className="logo" />
        <div className="title">Criar Conta</div>

        <div className="input-wrapper">
          <input type="text" placeholder="Nome" />
        </div>

        <div className="input-wrapper">
          <input type="email" placeholder="E-mail" />
        </div>

        <div className="input-wrapper">
          <input
            type="tel"
            placeholder="Telefone"
            pattern="[0-9]*"
            inputMode="numeric"
            onInput={(e) => {
              e.target.value = e.target.value.replace(/\D/g, '');
            }}
          />
        </div>

        <div className="input-wrapper">
          <input
            type={showPassword ? 'text' : 'password'}
            placeholder="Senha"
          />
          <span className="material-icons icon" onClick={togglePassword}>
            {showPassword ? 'visibility_off' : 'visibility'}
          </span>
        </div>

        <button type="submit">Cadastrar</button>

        <div className="voltar-login">
          Já tem uma conta?
          <Link to="/"> Entrar</Link>
        </div>
      </div>

      <div className="right-side"></div>
    </div>
  );
}

export default Cadastro;
