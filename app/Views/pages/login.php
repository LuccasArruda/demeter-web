<?= $this->include('layouts/header') ?>

</head>

<body>
  <div class="login-page">
    <div class="left-panel mb-position-absolute mb-top-50 mb-start-50 mb-translate-middle d-in">
      <img src="<?= base_url('assets/img/logo.png'); ?>" alt="Logo" class="logo">
      <h1 class="title">Deméter</h1>

      <form method="post" action="<?= base_url('autenticar-usuario') ?>">
        <?= csrf_field() ?>
        <div class="input-wrapper">
          <input type="email" name="email" placeholder="E-mail" required>
        </div>

        <div class="input-wrapper">
          <input type="password" name="senha" id="senha" placeholder="Senha" required>
          <span class="material-icons icon" onclick="togglePassword()">visibility</span>
        </div>

        <div class="forgot">
          <a href="/login/recuperar-senha">Esqueci minha senha</a>
        </div>

        <div class="signup text-center mt-2">
          Não tem uma conta? <a href="/cadastrar-usuario">Criar conta</a>
        </div>

        <button type="submit">Entrar</button>
      </form>
    </div>

    <div class="right-side"></div>
  </div>

  <script>
    function togglePassword() {
      const senha = document.getElementById('senha');
      const icon = document.querySelector('.icon');
      if (senha.type === 'password') {
        senha.type = 'text';
        icon.textContent = 'visibility_off';
      } else {
        senha.type = 'password';
        icon.textContent = 'visibility';
      }
    }
  </script>

<?= $this->include('layouts/footer') ?>