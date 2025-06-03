<?= $this->include('layouts/header') ?>

</head>

<body class="bg-body-secondary">
    <?= $this->include('layouts/navbar') ?>

    <main class="w-100 h-100 ">
        <div class="carrossel-cards row overflow-x-scroll justify-content-center bg-light rounded-5">
            <?php if (!empty($ambientes)): ?>
                <?php foreach ($ambientes as $ambiente): ?>
                    <div class="card my-3 bg-card m-2 card-exibicao p-0">
                        <div class="position-absolute top-0 w-100 container-informacoes-ambiente">
                            <div class="bg-verde-transparente position-relative top-0 w-100 text-center d-flex text-light align-middle justify-content-center rounded-top-2 pt-3">
                                <span class="material-icons rounded text-light me-2">solar_power</span>
                                <p class="d-block">Um painel solar economizaria 30R$</p>
                            </div>
                            <div class="container-tipo-card d-flex align-items-center justify-content-end">
                                <div class="tipo-card bg-cor-primaria d-flex align-items-center justify-content-center <?php $texto = (esc($ambiente['TIPO']) == "PR") ? "d-none" : "d-block";
                                                                                                                        echo $texto; ?>" title="Visualizar Aparelhos" style="display: block;">
                                    <span class="material-icons rounded text-light">home</span>
                                </div>
                                <div class="tipo-card bg-cor-primaria d-flex align-items-center justify-content-center <?php $texto = (esc($ambiente['TIPO']) == "PE") ? "d-none" : "d-block";
                                                                                                                        echo $texto; ?>" title="Visualizar Aparelhos" style="display: block;">
                                    <span class="material-icons rounded text-light">store</span>
                                </div>
                            </div>
                        </div>
                        <img src="<?= base_url("assets/img/teste/ambiente1.png") ?>" class="card-img-top" alt="...">
                        <div class="card-body d-flex flex-column justify-content-between">
                            <h5 class="text-verde-primaria text-center titulo-card"><?= esc($ambiente['DESCRICAO']) ?></h5>
                            <div class="d-flex align-items-center w-100 justify-content-between">
                                <div class="d-flex">
                                    <span class="material-icons rounded text-verde-primaria">electric_bolt</span>
                                    <p class="ms-2">Gasto</p>
                                </div>
                                <p class="me-2 text-end text-body-secondary">40000 KWh</p>
                            </div>
                            <div class="d-flex align-items-center w-100 justify-content-between">
                                <div class="d-flex ">
                                    <span class="material-icons rounded text-verde-primaria">devices</span>
                                    <p class="ms-2">Aparelhos</p>
                                </div>
                                <p class="me-2 text-end text-body-secondary">40000 KWh</p>
                            </div>
                            <div class="d-flex align-items-center w-100 justify-content-between">
                                <div class="d-flex">
                                    <span class="material-icons rounded text-verde-primaria">savings</span>
                                    <p class="ms-2">Economia</p>
                                </div>
                                <p class="me-2 text-end text-body-secondary">40000 KWh</p>
                            </div>
                            <div class="medidor-sustentabilidade">
                                <div class="progresso" style="width: 100%">
                                    <div class="medidor translate-middle-y top-50" style="left: 90%;">
                                        <span class="material-icons rounded">energy_savings_leaf</span>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-center w-100 py-2">
                                <a href="/redes-eletricas/<?= esc($ambiente['ID']) ?>" class="text-decoration-none btn-card bg-visualizar-outline d-block" title="Visualizar Redes Elétricas">
                                    <span class="material-icons rounded">schema</span>
                                </a>
                                <a href="" class="text-decoration-none btn-card bg-alterar-outline d-block">
                                    <span class="material-icons rounded">edit</span>
                                </a>
                                <a href="/ambiente/excluir/<?= esc($ambiente['ID']) ?>" class="text-decoration-none btn-card bg-perigo-outline d-block">
                                    <span class="material-icons rounded">delete</span>
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php elseif (!isset($mensagem_status)): // Se $ambientes estiver vazio e não houver mensagem_status 
            ?>
                <p>Nenhum ambiente encontrado para este usuário.</p>
            <?php endif; ?>

        </div>
    </main>

    <?= $this->include('layouts/footer') ?>