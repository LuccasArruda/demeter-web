<?= $this->include('layouts/header') ?>

</head>

<body class="bg-body-secondary">

    <div class="cadastro-ambiente bg-light my-5 rounded-5">

        <a href="<?= site_url('/') ?>" class="retornar">← Retornar</a>

        <form action="<?= site_url('ambiente/salvar') ?>" method="post" enctype="multipart/form-data">
            <div class="row">
                <!-- Painel de Ilustração -->
                <div class="col d-none d-sm-none d-md-block">
                    <div class="ilustracao">
                        <img src="<?= base_url('assets/img/ilustracao-aparelhos.svg') ?>" alt="Ilustração Ambiente" class="" />
                    </div>
                </div>
                <!-- Formulário -->
                <?= csrf_field() ?>
                <div class="formulario col-12 col-md-6">
                    <h1>Cadastrar Novo Aparelho</h1>
                    <div class="my-5">
                        <div class="linha">
                            <input type="text" name="nome" placeholder="Nome do aparelho" required>
                            <input type="number" name="consumo" placeholder="Consumo (KWh)" required>
                            <input type="number" name="tempoUsoMedio" placeholder="Tempo de Uso Médio (Horas)" required>
                        </div>
    
                        <div class="linha">
                            <select name="ENCE">
                                <option value="">Classificação ENCE</option>
                                <option value="A">A</option>
                                <option value="B">B</option>
                                <option value="C">C</option>
                                <option value="D">D</option>
                                <option value="E">E</option>
                                <option value="F">F</option>
                                <option value="G">G</option>
                            </select>
                            <select name="redeEletrica">
                                <option value="">Rede Elétrica</option>
                                <?php foreach($redesEletricas as $redeEletrica): ?>
                                    <option value="<?= esc($redeEletrica['ID']) ?>"><?= esc($redeEletrica['DESCRICAO'])?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                </div>
                <label class="upload">
                    <img src="<?= base_url('assets/img/upload.svg') ?>" alt="Upload" />
                    <span>Insira uma foto do aparelho</span>
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