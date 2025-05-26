<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Recuperar Senha</title>
   <link rel="stylesheet" href="<?= base_url('assets/css/reset.css') ?>">
  <link rel="stylesheet" href="<?= base_url('assets/css/variaveis.css') ?>">
   <link rel="stylesheet" href="<?= base_url('assets/css/recuperarsenha.css') ?>"> 
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body>
  <div class="login-page">
    <div class="left-panel">
      <img src="assets/img/logo.png" alt="Logo" class="logo">
      <h2 class="title">Recuperar Senha</h2>

      <form method="post" action="" onsubmit="return enviarEmail()">
        <div class="input-wrapper">
          <input type="email" id="email" name="email" placeholder="Digite seu e-mail" required>
        </div>

        <button type="submit">Enviar link</button>
      </form>

      <div class="forgot">
        <a href="login.php">Voltar ao login</a>
      </div>
    </div>

    <div class="right-side"></div>
  </div>

  <script>
    function enviarEmail() {
      const email = document.getElementById('email').value;
      alert(`Link de recuperação enviado para: ${email}`);
      return false; // evita recarregar a página
    }
  </script>
</body>
</html>
