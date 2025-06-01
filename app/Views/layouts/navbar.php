<navbar class="d-sm-none d-md-block d-none">
    <div class="bg-cor-primaria text-light navbar-site position-fixed start-0 d-flex align-items-end z-3">
        <ul class="p-0 w-100">
            <li>
                <a href="/ambientes" class="text-decoration-none text-verde-primaria">
                    <div class="logo-navbar rounded-circle ms-4 position-absolute top-0 mt-3 d-flex align-items-center">
                        <img src="<?= base_url('assets/img/logo-sem-padding.png') ?>" alt="Logo Deméter">
                        <h1 class="ms-3 titulo-pagina">
                            <span class="nome-ambiente me-2">
                                <?= esc($nomeAmbiente) ?? '' ?>
                            </span>
                            <span class="nome-rede-eletrica text-body-secondary me-2">
                                <?= esc($nomeRedeEletrica) ?? '' ?>
                            </span>
                            <span>
                                <?= esc($tituloExibicao ?? '') ?>
                            </span>
                        </h1>
                    </div>
                </a>
            </li>
            <li class="text-center">
                <a href="/cadastrar-aparelho" class="text-light text-decoration-none">
                    <span class="material-icons mb-2 p-1 rounded icone-navbar">devices</span>
                </a>
            </li>
            <li class="text-center">
                <a href="/cadastrar-ambiente" class="text-light text-decoration-none">
                    <span class="material-icons mb-2 p-1 rounded icone-navbar">add_home_work</span>
                </a>
            </li>
            <li class="text-center">
                <a href="/cadastrar-rede-eletrica" class="text-light text-decoration-none">
                    <span class="material-icons mb-2 p-1 rounded icone-navbar">schema</span>
                </a>
            </li>
            <li class="text-center">
                <a href="" class="text-light text-decoration-none">
                    <span class="material-icons mb-2 p-1 rounded icone-navbar">logout</span>
                </a>
            </li>
        </ul>
    </div>
</navbar>