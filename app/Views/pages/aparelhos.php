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
                                <div class="tipo-card bg-cor-primaria d-flex align-items-center justify-content-center <?php $texto = (esc($aparelho['TIPO']) == "A") ? "d-block" : "d-none";
                                                                                                                        echo $texto; ?>" title="Visualizar Aparelhos">
                                    <span class=" material-icons rounded text-light">devices</span>
                                </div>
                                <div class="tipo-card bg-cor-primaria d-flex align-items-center justify-content-center <?php $texto = (esc($aparelho['TIPO']) == "R") ? "d-block" : "d-none";
                                                                                                                        echo $texto; ?>" title="Visualizar Aparelhos">
                                    <span class="material-icons rounded text-light">solar_power</span>
                                </div>
                                <div class="tipo-card bg-cor-primaria d-flex align-items-center justify-content-center <?php $texto = (esc($aparelho['TIPO']) == "NR") ? "d-block" : "d-none";
                                                                                                                        echo $texto; ?>" title="Visualizar Aparelhos">
                                    <span class="material-icons rounded text-light">oil_barrel</span>
                                </div>
                            </div>
                        </div>
                        <?php
                        if (esc($aparelho['TIPO']) == "A") {
                            echo '<img src="' . base_url("assets/img/teste/aparelho.png") . '" class="card-img-top" alt="...">';
                        } else {
                            echo '<img src="' . base_url("assets/img/teste/gerador.jpg") . '" class="card-img-top" alt="...">';
                        }
                        ?>
                        <div class="card-body d-flex flex-column justify-content-between">
                            <h5 class="text-verde-primaria text-center titulo-card"><?= esc(($aparelho['TIPO']) == 'A') ? esc($aparelho['DESCRICAO_APARELHO']) : esc($aparelho['DESCRICAO_GERADOR']) ?></h5>
                            <div class="d-flex align-items-center w-100 justify-content-between">
                                <div class="d-flex">
                                    <span class="material-icons rounded text-verde-primaria">electric_bolt</span>
                                    <p class="ms-2"><?php $texto = esc(($aparelho['TIPO']) == 'A') ? 'Gasto' : 'Energia Gerada';
                                                    echo $texto ?></p>
                                </div>
                                <p class="me-2 text-end text-body-secondary"><?= esc(($aparelho['TIPO']) == 'A') ? esc($aparelho['CONSUMO']) : esc($aparelho['ENERGIA_GERADA']) ?> KWh</p>
                            </div>
                            <div class="d-flex align-items-center w-100 justify-content-between <?php $texto = (esc($aparelho['TIPO']) == "A") ? "d-block" : "d-none";
                                                                                                echo $texto; ?>">
                                <div class=" d-flex">
                                    <span class=" material-icons rounded text-verde-primaria">schedule</span>
                                    <p class="ms-2">Tempo de Uso Médio</p>
                                </div>
                                <p class="me-2 text-end text-body-secondary"><?= esc($aparelho['TEMPO_DE_USO']) ?> Horas</p>
                            </div>
                            <div class="d-flex align-items-center w-100 justify-content-between <?php $texto = (esc($aparelho['TIPO']) == "A") ? "d-block" : "d-none";
                                                                                                echo $texto; ?>">
                                <div class=" d-flex">
                                    <span class="material-icons rounded text-verde-primaria">electric_meter</span>
                                    <p class="ms-2">ENCE</p>
                                </div>
                                <p class="me-2 text-end text-body-secondary"><?= esc($aparelho['ENCE']) ?></p>
                            </div>
                            <div class="d-flex justify-content-center w-100 py-2">
                                <a href="/<?= esc(($aparelho['TIPO']) == 'A') ? 'aparelho' : 'gerador' ?>/editar/<?= esc(($aparelho['TIPO']) == 'A') ? esc($aparelho['ID_APARELHO']) : esc($aparelho['ID_GERADOR']) ?>" class="text-decoration-none btn-card bg-alterar-outline d-block">
                                    <span class="material-icons rounded">edit</span>
                                </a>
                                <a href="/<?= esc(($aparelho['TIPO']) == 'A') ? 'aparelho' : 'gerador' ?>/excluir/<?= esc(($aparelho['TIPO']) == 'A') ? esc($aparelho['ID_APARELHO']) : esc($aparelho['ID_GERADOR']) ?>" class="text-decoration-none btn-card bg-perigo-outline d-block">
                                    <span class="material-icons rounded">delete</span>
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else:
            ?>
                <div class="placeholder-sem-itens d-flex flex-column">
                    <img src="<?= base_url("assets/img/ilustracao-aparelhos.svg") ?>" alt="object-fit-cover" class="">
                </div>
                <div class="d-flex flex-column align-items-center">
                    <h1 class="text-verde-primaria text-center">Nenhum aparelho foi cadastrado!</h1>
                    <p>Parece que você ainda não cadastrou nenhum aparelho!</p>
                    <a href="/cadastrar-aparelho" class="btn-card bg-visualizar-outline text-decoration-none d-flex">
                        <span class="material-icons rounded pe-2">devices</span>
                        <p>Cadastrar Aparelho</p>
                    </a>
                </div>
            <?php endif; ?>

        </div>
    </main>

    <?= $this->include('layouts/footer') ?>