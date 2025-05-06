import { BrowserRouter as Router, Routes, Route } from "react-router-dom";
import Login from "./components/Login";
import Cadastro from "./components/Cadastro";
import RecuperarSenha from "./components/RecuperarSenha";
import CadastroAmbiente from "./components/CadastroAmbiente";

function App() {
  return (
    <Router>
      <Routes>
        <Route path="/" element={<Login />} />
        <Route path="/cadastro" element={<Cadastro />} />
        <Route path="/recuperarsenha" element={<RecuperarSenha />} />
        <Route path="/cadastroambiente" element={<CadastroAmbiente />} />
      </Routes>
    </Router>
  );
}

export default App;
