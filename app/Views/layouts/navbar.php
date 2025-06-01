<navbar class="d-sm-none d-md-block d-none">
    <div class="bg-cor-primaria text-light navbar-site position-fixed start-0 d-flex align-items-end z-3">
        <ul class="p-0 w-100">
            <li>
                <a href="/ambientes" class="text-decoration-none text-verde-primaria">
                    <div class="logo-navbar rounded-circle ms-4 position-absolute top-0 mt-5 d-flex align-items-center">
                        <img src="<?= base_url('assets/img/logo-sem-padding.png') ?>" alt="Logo Deméter">
                        <h1 class="ms-3"><?= esc($tituloExibicao ?? '') ?></h1>
                    </div>
                </a>
            </li>
            <li class="text-center">
                <a href="/cadastrar-aparelho" class="text-light text-decoration-none">
                    <span class="material-icons mb-2 p-1 rounded">devices</span>
                </a>
            </li>
            <li class="text-center">
                <a href="/cadastrar-ambiente" class="text-light text-decoration-none">
                    <span class="material-icons mb-2 p-1 rounded">add_home_work</span>
                </a>
            </li>
            <li class="text-center">
                <a href="/cadastrar-rede-eletrica" class="text-light text-decoration-none">
                    <span class="material-icons mb-2 p-1 rounded">schema</span>
                </a>
            </li>
            <li class="text-center">
                <a href="" class="text-light text-decoration-none">
                    <span class="material-icons mb-2 p-1 rounded">logout</span>
                </a>
            </li>
        </ul>
    </div>
</navbar>