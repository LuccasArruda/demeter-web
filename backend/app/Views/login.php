<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
</head>

<body>

    <h1>Login</h1>

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