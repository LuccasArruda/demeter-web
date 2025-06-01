<?= $this->include('layouts/header') ?>

<style>
</style>

</head>

<body class="bg-body-secondary">
    <?= $this->include('layouts/navbar') ?>

    <main class="w-100 h-100 ">
        <div class="carrossel-cards d-flex overflow-x-hidden justify-content-center bg-light rounded-5">
            <?php if (!empty($redes)): ?>
                <?php foreach ($redes as $rede): ?>
                    <div class="card my-3 bg-card m-2 card-exibicao">
                        <img src="<?= base_url("assets/img/teste/ambiente1.png") ?>" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="text-verde-primaria text-center"><?= esc($rede['ID']) ?></h5>
                            <div class="d-flex align-items-center w-100 justify-content-between">
                                <div class="d-flex">
                                    <span class="material-icons mb-3 rounded text-verde-primaria">electric_bolt</span>
                                    <p class="ms-2">Gasto</p>
                                </div>
                                <p class="me-2 text-end">40000 KWh</p>
                            </div>
                            <div class="d-flex align-items-center w-100 justify-content-between">
                                <div class="d-flex">
                                    <span class="material-icons mb-3 rounded text-verde-primaria">devices</span>
                                    <p class="ms-2">Aparelhos</p>
                                </div>
                                <p class="me-2 text-end">40000 KWh</p>
                            </div>
                            <div class="d-flex align-items-center w-100 justify-content-between">
                                <div class="d-flex">
                                    <span class="material-icons mb-3 rounded text-verde-primaria">savings</span>
                                    <p class="ms-2">Economia</p>
                                </div>
                                <p class="me-2 text-end">40000 KWh</p>
                            </div>
                            <div class="medidor-sustentabilidade">
                                <div class="progresso" style="width: 100%">
                                    <div class="medidor translate-middle-y top-50" style="left: 90%;">
                                        <span class="material-icons rounded">energy_savings_leaf</span>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-center w-100 py-2">
                                <a href="/aparelhos/<?= esc($rede['ID']) ?>" class="text-decoration-none btn-card bg-cor-primaria text-light d-block">Visualizar</a>
                                <a href="" class="text-decoration-none btn-card bg-perigo-outline d-block">Excluir</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php elseif (!isset($mensagem_status)): // Se $ambientes estiver vazio e não houver mensagem_status 
            ?>
                <p>Nenhuma Rede encontrada para esse ambeinte.</p>
            <?php endif; ?>

        </div>
    </main>

    <?= $this->include('layouts/footer') ?>