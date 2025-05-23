<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Criar Conta</title>
  <link rel="stylesheet" href="<?= base_url('assets/css/reset.css') ?>">
  <link rel="stylesheet" href="<?= base_url('assets/css/variaveis.css') ?>">
  <link rel="stylesheet" href="<?= base_url('assets/css/Cadastro.css') ?>">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<div class="pagina-cadastro">
  <div class="painel-esquerdo">
    <img src="<?= base_url('assets/img/logo.png'); ?>" alt="Logo" class="logo">

    <div class="titulo">Criar Conta</div>

    <form action="<?= base_url('cadastro/salvar') ?>" method="post">
      <div class="campo-input">
        <input type="text" name="nome" placeholder="Nome" required>
      </div>

      <div class="campo-input">
        <input type="email" name="email" placeholder="E-mail" required>
      </div>

      <div class="campo-input">
        <input type="tel" name="telefone" placeholder="Telefone" pattern="[0-9]*" inputmode="numeric"
          oninput="this.value = this.value.replace(/\D/g, '')">
      </div>

      <div class="campo-input senha-wrapper">
        <input type="password" name="senha" id="senha" placeholder="Senha" required>
        <span class="material-icons icone" onclick="alternarSenha()">visibility</span>
      </div>

      <button type="submit">Cadastrar</button>
    </form>

    <div class="voltar-login">
      Já tem uma conta?
      <a href="<?= base_url('/') ?>"> Entrar</a>
    </div>
  </div>

  <div class="d-sm-none d-md-block painel-direito"></div>
</div>

<script>
function alternarSenha() {
  const senhaInput = document.getElementById('senha');
  const icone = senhaInput.nextElementSibling;
  if (senhaInput.type === 'password') {
    senhaInput.type = 'text';
    icone.innerText = 'visibility_off';
  } else {
    senhaInput.type = 'password';
    icone.innerText = 'visibility';
  }
}
</script>

</body>
</html>
