<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8" />
    <title>Cadastrar Rede Elétrica</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/reset.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/variaveis.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/cadastroaparelho.css') ?>">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>

<body>

    <div class="cadastro-ambiente">

        <a href="<?= site_url('/') ?>" class="retornar">← Retornar</a>

        <form action="<?= site_url('aparelho/salvar') ?>" method="post">
            <div class="row">
                <!-- Painel de Ilustração -->
                <div class="col d-none d-sm-none d-md-block">
                    <div class="ilustracao">
                        <img src="<?= base_url('assets/img/aparelhos.svg') ?>" alt="Ilustração Ambiente"
                            class="" />
                    </div>
                </div>
                <div class="formulario col-12 col-md-6">
                    <h1>Cadastre as informações do Aparelho</h1>
                    <p class="subtitulo">Forneça o máximo de informações sobre o aparelho!</p>

                    <div class="linha">
                        <input type="text" name="nome" placeholder="Nome" required>
                        <input type="number" name="consumo" placeholder="Consumo" required>
                        <input type="number" name="tempo_uso" placeholder="Tempo de Uso (Média)" required>
                    </div>

                    <div class="linha">
                        <select name="classificacao_ence" required>
                            <option value="">Classificação ENCE</option>
                            <option value="A">A</option>
                            <option value="B">B</option>
                            <option value="C">C</option>
                            <option value="D">D</option>
                            <option value="E">E</option>
                        </select>

                        <select name="rede_eletrica" required>
                            <option value="">Rede Elétrica</option>
                            <option value="110">110V</option>
                            <option value="220">220V</option>
                            <option value="bivolt">Bivolt</option>
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