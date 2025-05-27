<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
</head>

<body>
    <div class="container mt-5 align-content-center text-center">
        <div class="row">
            <div class="col-12">
                <h1>Cadastro de Usuairos</h1>
            </div>
        </div>  
        <!-- Manter o action do formulário -->
        <form action="<?= base_url('cadastrar-usuario') ?>" method="post">
            <div class="row">
                <div class="col-4 mb-3 mx-auto text-start">
                    <label for="nome" class="form-label">Nome</label>
                    <input type="text" class="form-control" id="nome" name="nome" required>
                </div>
            </div>
            <div class="row">
                <div class="col-4 mb-3 mx-auto text-start">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
            </div>
            <div class="row">
                <div class="col-4 mb-3 mx-auto text-start">
                    <label for="telefone" class="form-label">Telefone</label>
                    <input type="text" class="form-control" id="telefone" name="telefone" required>
                </div>
            </div>
            <div class="row">
                <div class=" col-4 mb-3 mx-auto text-start">
                    <label for="senha" class="form-label">Senha</label>
                    <input type="password" class="form-control" id="senha" name="senha" required>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Cadastrar</button>
        </form>
        
    </div>


    <?php if (session()->getFlashdata('success') || session()->getFlashdata('error') || session()->getFlashdata('errors')): ?>
        <div class="modal fade" id="feedbackModal" tabindex="-1" aria-labelledby="feedbackModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header 
                        <?= session()->getFlashdata('success') ? 'bg-success' : 'bg-danger' ?> 
                        text-white">
                        <h5 class="modal-title" id="feedbackModalLabel">
                            <?= session()->getFlashdata('success') ? 'Sucesso' : 'Erro' ?>
                        </h5>
                    </div>
                    <div class="modal-body">
                        <?php if (session()->getFlashdata('success')): ?>
                            <?= esc(session()->getFlashdata('success')) ?>
                        <?php elseif (session()->getFlashdata('error')): ?>
                            <?= esc(session()->getFlashdata('error')) ?>
                        <?php elseif (session()->getFlashdata('errors')): ?>
                            <ul class="mb-0">
                                <?php foreach (session()->getFlashdata('errors') as $erro): ?>
                                    <li><?= esc($erro) ?></li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn 
                            <?= session()->getFlashdata('success') ? 'btn-success' : 'btn-danger' ?>" 
                            data-bs-dismiss="modal">Fechar</button>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <!-- FINAL POPUP de erro de cadastro de usuario -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
</body>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var modalEl = document.getElementById('feedbackModal');
            if (modalEl) {
                var modal = new bootstrap.Modal(modalEl);
                modal.show();
            }
        });
    </script>

</html>