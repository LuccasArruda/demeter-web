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
                                <p class="d-block">Paineis Solares podem gerar uma economia de até 90%</p>
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
                        <?php
                        if (esc($ambiente['TIPO']) == "PE") {
                            echo '<img src="' . base_url("assets/img/teste/ambiente-pessoal.png") . '" class="card-img-top" alt="...">';
                        } else {
                            echo '<img src="' . base_url("assets/img/teste/ambiente-profissional.jpg") . '" class="card-img-top" alt="...">';
                        }
                        ?>
                        <div class="card-body d-flex flex-column justify-content-between">
                            <h5 class="text-verde-primaria text-center titulo-card"><?= esc($ambiente['DESCRICAO']) ?></h5>
                            <div class="d-flex align-items-center w-100 justify-content-between">
                                <div class="d-flex">
                                    <span class="material-icons rounded text-verde-primaria">electric_bolt</span>
                                    <p class="ms-2">Gasto Total</p>
                                </div>
                                <p class="me-2 text-end text-body-secondary"><?= esc($ambiente['GASTO_TOTAL_AMBIENTE']) ?> KWh</p>
                            </div>
                            <div class="d-flex align-items-center w-100 justify-content-between">
                                <div class="d-flex ">
                                    <span class="material-icons rounded text-verde-primaria">devices</span>
                                    <p class="ms-2">Aparelhos</p>
                                </div>
                                <p class="me-2 text-end text-body-secondary"><?= esc($ambiente['TOTAL_APARELHOS_AMBIENTE']) ?></p>
                            </div>
                            <div class="d-flex align-items-center w-100 justify-content-between">
                                <div class="d-flex">
                                    <span class="material-icons rounded text-verde-primaria">savings</span>
                                    <p class="ms-2">Economia</p>
                                </div>
                                <p class="me-2 text-end text-body-secondary"><?= esc($ambiente['GASTO_ABATIDO_AMBIENTE']) ?> KWh</p>
                            </div>
                            <div class="medidor-sustentabilidade">
                                <div class="progresso" style="width: <?= esc($ambiente['PERCENTUAL_SUSTENTABILIDADE']) ?>%">
                                    <div class="medidor translate-middle-y top-50" style="left: 90%;">
                                        <span class="material-icons rounded">energy_savings_leaf</span>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-center w-100 py-2">
                                <a href="/redes-eletricas/<?= esc($ambiente['ID']) ?>" class="text-decoration-none btn-card bg-visualizar-outline d-block" title="Visualizar Redes Elétricas">
                                    <span class="material-icons rounded">schema</span>
                                </a>
                                <a href="/ambiente/editar/<?= esc($ambiente['ID']) ?>" class="text-decoration-none btn-card bg-alterar-outline d-block">
                                    <span class="material-icons rounded">edit</span>
                                </a>
                                <a href="/ambiente/excluir/<?= esc($ambiente['ID']) ?>" class="text-decoration-none btn-card bg-perigo-outline d-block">
                                    <span class="material-icons rounded">delete</span>
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: // Se $ambientes estiver vazio e não houver mensagem_status 
            ?>
                <div class="placeholder-sem-itens d-flex flex-column">
                    <img src="<?= base_url("assets/img/ilustracao-ambiente.svg") ?>" alt="object-fit-cover" class="">
                </div>
                <div class="d-flex flex-column align-items-center">
                    <h1 class="text-verde-primaria text-center">Nenhum ambiente foi cadastrado!</h1>
                    <p>Parece que você ainda não cadastrou nenhum ambiente!</p>
                    <a href="/cadastrar-ambiente" class="btn-card bg-visualizar-outline text-decoration-none d-flex">
                        <span class="material-icons rounded pe-2">add_home_work</span>
                        <p>Cadastrar Ambiente</p>
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </main>

    <?= $this->include('layouts/footer') ?>