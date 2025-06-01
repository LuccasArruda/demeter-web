<?= $this->include('layouts/header') ?>

</head>

<body class="bg-body-secondary">
    <?= $this->include('layouts/navbar') ?>

    <div class="cadastro-ambiente bg-light rounded-5 position-absolute top-50 start-50 translate-middle">
        <a href="<?= site_url('ambientes') ?>" class="retornar">← Retornar</a>
        <form action="<?= site_url('ambiente/salvar') ?>" method="post" enctype="multipart/form-data">
            <div class="d-flex flex-wrap justify-content-between">
                <?= csrf_field() ?>
                <div class="formulario col col-12 col-md-6 my-3 d-flex align-items-center">
                    <div>
                        <h1>Cadastrar Rede Elétrica</h1>
                        <div class="linha">
                            <input type="text" name="descricao" placeholder="Descrição da Rede Elétrica" required>
                            <select name="ambiente">
                                <?php foreach($ambientes as $ambiente): ?>
                                    <option value="<?= esc($ambiente['ID'])?>"><?= esc($ambiente['DESCRICAO'])?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col col-sm-12 col-md-5">
                    <label class="upload">
                        <img id="imagemPlaceholder" src="<?= base_url('assets/img/upload.svg') ?>" alt="Upload" style="display: block;" class="imagem-placeholder" />
                        <img id="imagemPreview" src="" alt="Pré-visualização" style="display: none;" class="rounded-3 imagem-preview p-0">
                        <span id="labelInsiraFoto" style="display: block;">Insira uma foto da rede elétrica</span>
                        <p class="text-muted">Clique ou arraste uma imagem</p>
                        <input type="file" name="foto" accept="image/*" id="inputImagem">
                    </label>
                </div>
            </div>
            <button type="submit" class="w-100">Cadastrar</button>
    </div>
    </form>

    <script>
        document.querySelectorAll('input[name="tipo"]').forEach(radio => {
            radio.addEventListener('change', function() {
                document.getElementById('aviso-pessoal').classList.toggle('d-none', this.value !== 'pessoal');
            });
        });

        const input = document.getElementById('inputImagem');
        const img = document.getElementById('imagemPreview');
        const placeholder = document.getElementById('imagemPlaceholder');
        const labelInsiraFoto = document.getElementById('labelInsiraFoto');

        input.addEventListener('change', function() {
            const arquivo = this.files[0];
            if (arquivo) {
                const leitor = new FileReader();
                leitor.onload = function(e) {
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