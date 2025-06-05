<?= $this->include('layouts/header') ?>

<style>
</style>

</head>

<body class="bg-body-secondary">
    <?= $this->include('layouts/navbar') ?>

    <main class="w-100 h-100 ">
        <div class="carrossel-cards row overflow-x-scroll justify-content-center bg-light rounded-5">
            <?php if (!empty($redes)): ?>
                <?php foreach ($redes as $rede): ?>
                    <div class="card my-3 bg-card m-2 card-exibicao p-0">
                        <img src="<?= base_url("assets/img/teste/rede-eletrica.jpg") ?>" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="text-verde-primaria text-center"><?= esc($rede['DESCRICAO']) ?></h5>
                            <div class="d-flex align-items-center w-100 justify-content-between">
                                <div class="d-flex">
                                    <span class="material-icons mb-3 rounded text-verde-primaria">electric_bolt</span>
                                    <p class="ms-2">Gasto</p>
                                </div>
                                <p class="me-2 text-end"><?= esc($rede['GASTO_TOTAL']) ?> KWh</p>
                            </div>
                            <div class="d-flex align-items-center w-100 justify-content-between">
                                <div class="d-flex">
                                    <span class="material-icons mb-3 rounded text-verde-primaria">devices</span>
                                    <p class="ms-2">Aparelhos</p>
                                </div>
                                <p class="me-2 text-end"><?= esc($rede['TOTAL_APARELHOS']) ?></p>
                            </div>
                            <div class="d-flex align-items-center w-100 justify-content-between">
                                <div class="d-flex">
                                    <span class="material-icons mb-3 rounded text-verde-primaria">savings</span>
                                    <p class="ms-2">Economia</p>
                                </div>
                                <p class="me-2 text-end"><?= esc($rede['GASTO_ABATIDO']) ?> KWh</p>
                            </div>
                            <div class="medidor-sustentabilidade">
                                <div class="progresso" style="width: <?= esc($rede['PERCENTUAL_SUSTENTABILIDADE']) ?>%">
                                    <div class="medidor translate-middle-y top-50" style="left: 90%;">
                                        <span class="material-icons rounded">energy_savings_leaf</span>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-center w-100 py-2">
                                <a href="/aparelhos/<?= esc($rede['ID']) ?>" class="text-decoration-none btn-card bg-visualizar-outline d-block" title="Visualizar Aparelhos">
                                    <span class="material-icons rounded">devices</span>
                                </a>
                                <a href="/rede-eletrica/editar/<?= esc($rede['ID']) ?>" class="text-decoration-none btn-card bg-alterar-outline d-block">
                                    <span class="material-icons rounded">edit</span>
                                </a>
                                <a href="/rede-eletrica/excluir/<?= esc($rede['ID']) ?>" class="text-decoration-none btn-card bg-perigo-outline d-block">
                                    <span class="material-icons rounded">delete</span>
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: // Se $ambientes estiver vazio e não houver mensagem_status 
            ?>
                <div class="placeholder-sem-itens d-flex flex-column">
                    <img src="<?= base_url("assets/img/ilustracao-rede-eletrica.svg") ?>" alt="object-fit-cover" class="">
                </div>
                <div class="d-flex flex-column align-items-center">
                    <h1 class="text-verde-primaria text-center">Nenhuma rede elétrica foi cadastrada!</h1>
                    <p>Parece que você ainda não cadastrou nenhuma rede elétrica!</p>
                    <a href="/cadastrar-rede-eletrica" class="btn-card bg-visualizar-outline text-decoration-none d-flex">
                        <span class="material-icons rounded pe-2">schema</span>
                        <p>Cadastrar Rede Elétrica</p>
                    </a>
                </div>
            <?php endif; ?>

        </div>
    </main>

    <?= $this->include('layouts/footer') ?>