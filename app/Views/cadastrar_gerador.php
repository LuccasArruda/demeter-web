<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8" />
    <title>Cadastrar Rede Elétrica</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/reset.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/variaveis.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/cadastroambiente.css') ?>">
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
                        <img src="<?= base_url('assets/img/ilustracao-ambiente.svg') ?>" alt="Ilustração Ambiente" class="" />
                    </div>
                </div>
                <!-- Formulário -->
                <?= csrf_field() ?>
                <div class="formulario col-12 col-md-6">
                    <h1>Cadastrar Novo Gerador</h1>
                    <div class="linha">
                        <input type="text" name="nome" placeholder="Nome do ambiente" required>
                    </div>

                    <div class="linha">
                        <input type="text" name="cep" placeholder="CEP" required>
                        <input type="text" name="cidade" placeholder="Cidade" required>
                        <input type="text" name="estado" placeholder="Estado" required>
                    </div>

                    <div class="linha">
                        <input type="text" name="rua" placeholder="Rua" required>
                        <input type="text" name="bairro" placeholder="Bairro" required>
                    </div>

                    <div class="radio-group">
                        <label>
                            <input type="radio" name="tipo" value="pessoal" id="tipoPessoal" required>
                            Pessoal
                        </label>
                        <label>
                            <input type="radio" name="tipo" value="profissional" id="tipoProfissional" required>
                            Profissional
                        </label>
                    </div>

                    <div class="aviso d-none" id="aviso-pessoal">
                        <p class="texto">Ambientes do tipo <strong>Pessoal</strong> só podem ter uma rede elétrica.</p>
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
            radio.addEventListener('change', function() {
                document.getElementById('aviso-pessoal').classList.toggle('d-none', this.value !== 'pessoal');
            });
        });
    </script>

</body>

</html>