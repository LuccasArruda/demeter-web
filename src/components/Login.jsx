import './Login.scss';
import logo from '../assets/logo.png'; // ajuste o caminho se necessário

export default function Login() {
  return (
    <div className="login-page">
      <div className="left-panel">
        <img src={logo} alt="Logo Deméter" className="logo" />
        <h1 className="title">Deméter</h1>

        <input type="email" placeholder="E-mail" />
        
        <div className="password-wrapper">
          <input type="password" placeholder="Senha" />
          <span className="material-icons icon">visibility</span>
        </div>

        <span className="forgot">Esqueci minha senha</span>
        <button>Entrar</button>
      </div>

      <div className="right-side"></div>
    </div>
  );
}
