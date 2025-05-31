<?= $this->include('layouts/header') ?>

</head>

<body class="bg-body-secondary">

  <div class="cadastro-ambiente bg-light my-5 rounded-5">

    <a href="<?= site_url('ambientes') ?>" class="retornar">← Retornar</a>

    <form action="<?= site_url('ambiente/salvar') ?>" method="post" enctype="multipart/form-data">
      <div class="row">
        <!-- Painel de Ilustração -->
        <div class="col d-none d-sm-none d-md-block">
          <div class="ilustracao">
            <img src="<?= base_url('assets/img/ilustracao-ambiente.svg') ?>" alt="Ilustração Ambiente" class="" />
          </div>
        </div>
        <!-- Formulário -->
        <?= csrf_field() ?>
        <div class="formulario col-12 col-md-6">
          <h1>Cadastrar Novo Ambiente</h1>
          <div class="linha">
            <input type="text" name="nome" placeholder="Nome do ambiente" required>
            <input type="number" name="valorMedioContaLuz" placeholder="Vl. Médio Conta de Luz" required>
          </div>

          <div class="linha">
            <input type="text" name="cep" placeholder="CEP" required>
            <input type="text" name="cidade" placeholder="Cidade" required>
            <select name="estado">
              <option value="">Estado</option>
              <?php foreach ($estados as $estado): ?>
                <option value="<?= esc($estado['ID']) ?>"><?= esc($estado['SIGLA']) ?></option>
              <?php endforeach; ?>
            </select>
            <input type="number" name="numero" placeholder="Número" required>
          </div>

          <div class="linha">
            <input type="text" name="rua" placeholder="Rua" required>
            <input type="text" name="bairro" placeholder="Bairro" required>
          </div>

          <div class="radio-group">
            <label>
              <input type="radio" name="tipo" value="pessoal" id="tipoPessoal" required>
              Pessoal
            </label>
            <label>
              <input type="radio" name="tipo" value="profissional" id="tipoProfissional" required>
              Profissional
            </label>
          </div>

          <div class="aviso d-none" id="aviso-pessoal">
            <p class="texto">Ambientes do tipo <strong>Pessoal</strong> só podem ter uma rede elétrica.</p>
          </div>

        </div>
        <label class="upload">
          <img src="<?= base_url('assets/img/upload.svg') ?>" alt="Upload" />
          <span>Insira uma foto do ambiente</span>
          <p class="text-muted">Clique ou arraste uma imagem</p>
          <input type="file" name="foto" accept="image/*">
        </label>

        <button type="submit">Cadastrar</button>
      </div>
  </div>
  </form>

  <script>
    document.querySelectorAll('input[name="tipo"]').forEach(radio => {
      radio.addEventListener('change', function() {
        document.getElementById('aviso-pessoal').classList.toggle('d-none', this.value !== 'pessoal');
      });
    });
  </script>

  <?= $this->include('layouts/footer') ?>