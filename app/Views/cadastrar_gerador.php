<?php
$redes = [
    ['id' => 1, 'nome' => 'Rede Elétrica Principal'],
    ['id' => 2, 'nome' => 'Rede de Emergência'],
    ['id' => 3, 'nome' => 'Rede Solar'],
    // Adicione mais redes conforme necessário
];

?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8" />
    <title>Cadastrar Rede Elétrica</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/reset.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/variaveis.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/cadastrogerador.css') ?>">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>

<body>

    <div class="cadastro-ambiente">

        <a href="<?= site_url('/') ?>" class="retornar">← Retornar</a>

        <form action="<?= site_url('gerador/salvar') ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field() ?>
            <div class="row">
                <!-- Painel de Ilustração -->
                <div class="col d-none d-sm-none d-md-block">
                    <div class="ilustracao">
                        <img src="<?= base_url('assets/img/Gerador.svg') ?>" alt="Ilustração Gerador" />
                    </div>
                </div>

                <!-- Formulário -->
                <div class="formulario col-12 col-md-6">
                    <h1>Cadastre as informações do Gerador</h1>
                    <p class="subtitulo">Forneça o máximo de informações sobre o gerador!</p>

                    <div class="linha">
                        <input type="text" name="nome" placeholder="Nome" required>
                    </div>

                    <div class="linha">
                        <input type="number" name="energia_gerada" placeholder="Energia Gerada (KWh)" step="0.01"
                            required>

                        <select name="rede_eletrica_id" required>
                            <option value="">Rede Elétrica</option>
                            <?php foreach ($redes as $rede): ?>
                                <option value="<?= $rede['id'] ?>"><?= $rede['nome'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="linha checkbox">
                        <input type="checkbox" name="renovavel" id="renovavel" value="1">
                        <label for="renovavel">Gerador de Energia Renovável</label>
                    </div>
                </div>
            </div>
            <label class="upload">
                <img src="<?= base_url('assets/img/upload.svg') ?>" alt="Upload" />
                <span>Insira uma foto do ambiente</span>
                <p class="text-muted">Clique ou arraste uma imagem</p>
                <input type="file" name="foto" accept="image/*">
            </label>

            <button type="submit">Cadastrar</button>
    </div>
    </div>
    </form>

    <script>
        document.querySelectorAll('input[name="tipo"]').forEach(radio => {
            radio.addEventListener('change', function () {
                document.getElementById('aviso-pessoal').classList.toggle('d-none', this.value !== 'pessoal');
            });
        });
    </script>

</body>

</html>