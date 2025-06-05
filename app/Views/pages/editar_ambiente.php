<?= $this->include('layouts/header') ?>
</head>

<body class="bg-body-secondary">
  <?= $this->include('layouts/navbar') ?>

  <div class="cadastro-ambiente bg-light rounded-5 position-absolute top-50 start-50 translate-middle">
    <a href="<?= site_url('ambientes') ?>" class="retornar">← Retornar</a>

    <form action="<?= site_url('ambiente/salvar/' . $ambiente['ID']) ?>" method="post" enctype="multipart/form-data">
      <div class="d-flex flex-wrap justify-content-between">
        <?= csrf_field() ?>
        <div class="formulario col col-12 col-md-6 my-3">
          <h1>Editar Ambiente</h1>

          <div class="my-4">
            <div class="linha">
              <input type="text" name="nome" placeholder="Nome do ambiente" value="<?= esc($ambiente['DESCRICAO']) ?>" required>
              <input type="number" name="valorMedioContaLuz" placeholder="Vl. Médio Conta de Luz" step="0.01" value="<?= esc($ambiente['VL_MEDIO_CONTA_LUZ']) ?>" required>
            </div>

            <div class="linha">
              <input type="text" name="cep" placeholder="CEP" value="<?= esc($endereco['CEP']) ?>" required>
              <input type="text" name="cidade" placeholder="Cidade" value="<?= esc($endereco['CIDADE']) ?>" required>

              <select name="estado" required>
                <option value="">Estado</option>
                <?php foreach ($estados as $estado): ?>
                  <option value="<?= esc($estado['ID']) ?>" <?= ($estado['SIGLA'] === $endereco['ESTADO_SIGLA']) ? 'selected' : '' ?>>
                    <?= esc($estado['SIGLA']) ?>
                  </option>
                <?php endforeach; ?>
              </select>

              <input type="number" name="numero" placeholder="Número" value="<?= esc($endereco['NUMERO']) ?>" required>
            </div>

            <div class="linha">
              <input type="text" name="rua" placeholder="Rua" value="<?= esc($endereco['RUA']) ?>" required>
              <input type="text" name="bairro" placeholder="Bairro" value="<?= esc($endereco['BAIRRO']) ?>" required>
            </div>

            <div class="radio-group">
              <label>
                <input type="radio" name="tipo" value="pessoal" id="tipoPessoal" <?= $ambiente['TIPO'] === 'pessoal' ? 'checked' : '' ?> required>
                Pessoal
              </label>
              <label>
                <input type="radio" name="tipo" value="profissional" id="tipoProfissional" <?= $ambiente['TIPO'] === 'profissional' ? 'checked' : '' ?> required>
                Profissional
              </label>
            </div>

            <div class="aviso <?= $ambiente['TIPO'] === 'pessoal' ? '' : 'd-none' ?>" id="aviso-pessoal">
              <p class="texto">Ambientes do tipo <strong>Pessoal</strong> só podem ter uma rede elétrica.</p>
            </div>
          </div>
        </div>

        <div class="col col-sm-12 col-md-5">
                    <label class="upload">
                        <img id="imagemPlaceholder" src="<?= base_url('assets/img/upload.svg') ?>" alt="Upload" style="display: block;" class="imagem-placeholder" />
                        <img id="imagemPreview" src="" alt="Pré-visualização" style="display: none;" class="rounded-3 imagem-preview p-0">
                        <span id="labelInsiraFoto" style="display: block;">Insira uma foto do aparelho</span>
                        <p class="text-muted">Clique ou arraste uma imagem</p>
                        <input type="file" name="foto" accept="image/*" id="inputImagem">
                    </label>
                </div>
      </div>
      <button type="submit" class="w-100">Salvar</button>
  </div>
  </form>

  <script>
    document.querySelectorAll('input[name="tipo"]').forEach(radio => {
      radio.addEventListener('change', function () {
        document.getElementById('aviso-pessoal').classList.toggle('d-none', this.value !== 'pessoal');
      });
    });

    const input = document.getElementById('inputImagem');
    const img = document.getElementById('imagemPreview');
    const placeholder = document.getElementById('imagemPlaceholder');
    const labelInsiraFoto = document.getElementById('labelInsiraFoto');

    input.addEventListener('change', function () {
      const arquivo = this.files[0];
      if (arquivo) {
        const leitor = new FileReader();
        leitor.onload = function (e) {
          img.src = e.target.result;
          img.style.display = 'block';
        };
        leitor.readAsDataURL(arquivo);
        placeholder.style.display = 'none';
        labelInsiraFoto.style.display = 'none';
      }
    });
  </script>

  <?= $this->include('layouts/footer') ?>
