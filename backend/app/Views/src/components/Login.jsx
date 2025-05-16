import React, { useState } from 'react';
import { Link } from "react-router-dom";
import './Login.scss';
import logo from '../assets/logo.png';

const Login = () => {
  const [showPassword, setShowPassword] = useState(false);

  const togglePassword = () => {
    setShowPassword(!showPassword);
  };

  return (
    <div className="login-page">
      <div className="left-panel mb-position-absolute mb-top-50 mb-start-50 mb-translate-middle"> 
          <img src={logo} alt="Logo" className="logo" />
        <h1 className="title">Deméter</h1>

        <div className="input-wrapper">
          <input type="email" placeholder="E-mail" />
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

        <div className="forgot">Esqueci minha senha</div>
        <div className="signup text-center mt-2">
          Não tem uma conta? <Link to="/Cadastro">Criar conta</Link>
        </div>

        <button>Entrar</button>
      </div>

      <div className="right-side"></div>
    </div>
  );
};

export default Login;
