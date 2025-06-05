<?= $this->include('layouts/header') ?>

</head>

<body class="bg-body-secondary">
    <?= $this->include('layouts/navbar') ?>

    <main class="w-100 h-100 ">
        <div class="carrossel-cards row overflow-x-scroll justify-content-center bg-light rounded-5">
            <?php if (!empty($aparelhos)): ?>
                <?php foreach ($aparelhos as $aparelho): ?>
                    <div class="card my-3 bg-card m-2 card-exibicao p-0">
                        <div class="position-absolute top-0 w-100 container-informacoes-ambiente">
                            <div class="container-tipo-card d-flex align-items-center justify-content-end">
                                <div class="tipo-card bg-cor-primaria d-flex align-items-center justify-content-center" title="Visualizar Aparelhos" style="display: block">
                                    <span class="material-icons rounded text-light">devices</span>
                                </div>
                                <div class="tipo-card bg-cor-primaria d-flex align-items-center justify-content-center" title="Visualizar Aparelhos" style="display: block">
                                    <span class="material-icons rounded text-light">solar_power</span>
                                </div>
                                <div class="tipo-card bg-cor-primaria d-flex align-items-center justify-content-center" title="Visualizar Aparelhos" style="display: block">
                                    <span class="material-icons rounded text-light">oil_barrel</span>
                                </div>
                            </div>
                        </div>
                        <img src="<?= base_url("assets/img/teste/ambiente1.png") ?>" class="card-img-top w-100" alt="...">
                        <div class="card-body d-flex flex-column justify-content-between">
                            <h5 class="text-verde-primaria text-center titulo-card"><?= esc($aparelho['DESCRICAO']) ?></h5>
                            <div class="d-flex align-items-center w-100 justify-content-between">
                                <div class="d-flex">
                                    <span class="material-icons rounded text-verde-primaria">electric_bolt</span>
                                    <p class="ms-2">Gasto</p>
                                </div>
                                <p class="me-2 text-end text-body-secondary"><?= esc($aparelho['CONSUMO']) ?> KWh</p>
                            </div>
                            <div class="d-flex align-items-center w-100 justify-content-between">
                                <div class="d-flex ">
                                    <span class="material-icons rounded text-verde-primaria">schedule</span>
                                    <p class="ms-2">Tempo de Uso Médio</p>
                                </div>
                                <p class="me-2 text-end text-body-secondary"><?= esc($aparelho['TEMPO_DE_USO']) ?></p>
                            </div>
                            <div class="d-flex align-items-center w-100 justify-content-between">
                                <div class="d-flex">
                                    <span class="material-icons rounded text-verde-primaria">electric_meter</span>
                                    <p class="ms-2">ENCE</p>
                                </div>
                                <p class="me-2 text-end text-body-secondary"><?= esc($aparelho['ENCE']) ?></p>
                            </div>
                            <div class="d-flex justify-content-center w-100 py-2">
                                <a href="/aparelho/editar/<?= esc($aparelho['ID'])?>" class="text-decoration-none btn-card bg-alterar-outline d-block">
                                    <span class="material-icons rounded">edit</span>
                                </a>
                                <a href="/aparelho/excluir/<?= esc($aparelho['ID']) ?>" class="text-decoration-none btn-card bg-perigo-outline d-block">
                                    <span class="material-icons rounded">delete</span>
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php elseif (!isset($mensagem_status)):
            ?>
                <p>Nenhum aparelho encontrado para esta rede elétrica.</p>
            <?php endif; ?>

        </div>
    </main>

    <?= $this->include('layouts/footer') ?>