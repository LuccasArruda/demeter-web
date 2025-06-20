<?= $this->include('layouts/header') ?>

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
        <a href="/login">Voltar ao login</a>
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
<?= $this->include('layouts/footer') ?>