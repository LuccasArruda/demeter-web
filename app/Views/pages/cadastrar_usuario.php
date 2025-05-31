<?= $this->include('layouts/header') ?>

</head>

<body>
  <div class="pagina-cadastro">
    <div class="painel-esquerdo">
      <img src="<?= base_url('assets/img/logo.png'); ?>" alt="Logo" class="logo">

      <div class="titulo">Criar Conta</div>

      <form action="<?= base_url('cadastrar-usuario') ?>" method="post">
        <div class="campo-input">
          <input type="text" name="nome" id="nome" placeholder="Nome" required>
        </div>

        <div class="campo-input">
          <input type="email" name="email" id="email" placeholder="E-mail" required>
        </div>

        <div class="campo-input">
          <input type="tel" name="telefone" id="telefone" placeholder="Telefone" pattern="[0-9]*" inputmode="numeric"
            oninput="this.value = this.value.replace(/\D/g, '')">
        </div>

        <div class="campo-input senha-wrapper">
          <input type="password" name="senha" id="senha" placeholder="Senha" required>
          <span class="material-icons icone" onclick="alternarSenha()">visibility</span>
        </div>

        <button type="submit">Cadastrar</button>
      </form>

      <?php
      $success = session()->getFlashdata('success');
      $error = session()->getFlashdata('error');
      $errors = session()->getFlashdata('errors');
      ?>

      <?php if ($success || $error || $errors): ?>
        <div class="modal fade" id="feedbackModal" tabindex="-1" aria-labelledby="feedbackModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header 
                          <?= session()->getFlashdata('success') ? 'bg-success' : 'bg-danger' ?> 
                          text-white">
                <h5 class="modal-title" id="feedbackModalLabel">
                  <?= session()->getFlashdata('success') ? 'Sucesso' : 'Erro' ?>
                </h5>
              </div>
              <div class="modal-body">
                <?php if (session()->getFlashdata('success')): ?>
                  <?= esc(session()->getFlashdata('success')) ?>
                <?php elseif (session()->getFlashdata('error')): ?>
                  <?= esc(session()->getFlashdata('error')) ?>
                <?php elseif (session()->getFlashdata('errors')): ?>
                  <ul class="mb-0">
                    <?php foreach (session()->getFlashdata('errors') as $erro): ?>
                      <li><?= esc($erro) ?></li>
                    <?php endforeach; ?>
                  </ul>
                <?php endif; ?>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn 
                              <?= session()->getFlashdata('success') ? 'btn-success' : 'btn-danger' ?>"
                  data-bs-dismiss="modal">Fechar</button>
              </div>
            </div>
          </div>
        </div>
      <?php endif; ?>

      <div class="voltar-login">
        Já tem uma conta?
        <a href="<?= base_url('/login') ?>"> Entrar</a>
      </div>
    </div>

    <div class="d-sm-none d-md-block painel-direito"></div>


  </div>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      var modalEl = document.getElementById('feedbackModal');
      if (modalEl) {
        var modal = new bootstrap.Modal(modalEl);
        modal.show();
      }
    });
  </script>

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

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

<?= $this->include('layouts/footer') ?>