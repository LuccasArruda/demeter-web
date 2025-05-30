<?php

$ambientes = [
    ['id' => 1, 'nome' => 'Sala de Estar'],
    ['id' => 2, 'nome' => 'Cozinha'],
    ['id' => 3, 'nome' => 'Quarto Principal'],
    ['id' => 4, 'nome' => 'Quarto de Crianças'],
    ['id' => 5, 'nome' => 'Banheiro'],
    // Adicione mais ambientes conforme necessário
];

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8" />
    <title>Cadastrar Rede Elétrica</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/reset.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/variaveis.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/cadastrorede.css') ?>">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>

<body>

    <div class="cadastro-ambiente">

        <a href="<?= site_url('/') ?>" class="retornar">← Retornar</a>

        <form action="<?= site_url('ambiente/salvar') ?>" method="post" enctype="multipart/form-data">
            <div class="row">
                <!-- Painel de Ilustração -->
                <div class="col d-none d-sm-none d-md-block">
                    <div class="ilustracao">
                        <img src="<?= base_url('assets/img/redes.svg') ?>" alt="Ilustração Ambiente"
                            class="" />
                    </div>
                </div>
                <!-- Formulário -->
                <div class="formulario col-12 col-md-6">
                    <h1>Cadastrar Nova Rede Elétrica</h1>
                    <p class="subtitulo">Dê um nome para a nova rede elétrica a ser cadastrada!</p>

                    <div class="linha">
                        <input type="text" name="nome" placeholder="Nome" required>

                        
                        <select name="ambiente" required>
                            <option value="">Ambiente</option>
                            <?php foreach ($ambientes as $ambiente): ?>
                                <option value="<?= $ambiente['id'] ?>"><?= $ambiente['nome'] ?></option>
                            <?php endforeach; ?>
                        </select>
                        
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