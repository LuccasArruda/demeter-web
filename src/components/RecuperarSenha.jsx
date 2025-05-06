import React, { useState } from 'react';
import './RecuperarSenha.scss';
import logo from '../assets/logo.png';

export default function RecuperarSenha() {
  const [email, setEmail] = useState('');

  const handleSubmit = (e) => {
    e.preventDefault();
    // Simular envio de e-mail
    alert(`Link de recuperação enviado para: ${email}`);
  };

  return (
    <div className="login-page">
      <div className="left-panel">
        <img src={logo} alt="Logo" className="logo" />
        <h2 className="title">Recuperar Senha</h2>

        <form onSubmit={handleSubmit}>
          <div className="input-wrapper">
            <input
              type="email"
              placeholder="Digite seu e-mail"
              value={email}
              onChange={(e) => setEmail(e.target.value)}
              required
            />
            <span className="icon">
              <i className="bi bi-envelope"></i>
            </span>
          </div>

          <button type="submit">Enviar link</button>
        </form>

        <div className="forgot">
          <a href="/">Voltar ao login</a>
        </div>
      </div>

      <div className="right-side"></div>
    </div>
  );
}
