<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Recuperar Senha</title>

  <link rel="stylesheet" href="<?= base_url('assets/css/reset.css') ?>">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="<?= base_url('assets/css/variaveis.css') ?>">

  <!-- Font e estilo customizado opcional -->
  <link href="https://fonts.googleapis.com/css2?family=Bai+Jamjuree:wght@200;300;400;500;600;700&display=swap"
    rel="stylesheet">
  <link rel="stylesheet" href="<?= base_url('assets/css/recuperar-senha.css') ?>">

  
  
</head>

<body>
  <div class="login-page">
    <!-- Painel Esquerdo -->
    <div class="left-panel text-center w-100">
      <img src="<?= base_url('assets/img/logo.png'); ?>" alt="Logo" class="logo">
      <h2 class="title">Recuperar Senha</h2>

      <form method="post" action="" onsubmit="return enviarEmail()" class="w-100" style="max-width: 300px;">
        <div class="mb-3 text-start">
          <input type="email" id="email" name="email" class="form-control" placeholder="Digite seu e-mail" required>
        </div>

        <button type="submit" class="btn btn-success w-100">Enviar link</button>
      </form>

      <div class="forgot mt-3">
        <a href="/login" class="text-success fw-bold">Voltar ao login</a>
      </div>
    </div>

    <!-- Painel Direito (oculto no mobile) -->
    <div class="right-side d-none d-md-block"></div>
  </div>

  <script>
    function enviarEmail() {
      const email = document.getElementById('email').value;
      alert(`Link de recuperação enviado para: ${email}`);
      return false; // evita recarregar a página
    }
  </script>

  <!-- Bootstrap Bundle JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>