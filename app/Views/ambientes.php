<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title><?= esc($titulo ?? 'Meus Ambientes') ?></title>
    <style>
        body { font-family: sans-serif; margin: 20px; }
        .ambiente { border: 1px solid #ccc; padding: 10px; margin-bottom: 10px; border-radius: 5px; }
        .ambiente h3 { margin-top: 0; }
    </style>
</head>
<body>

    <h1><?= esc($titulo ?? 'Meus Ambientes') ?></h1>

    <?php if (isset($mensagem_status)): ?>
        <p><strong><?= esc($mensagem_status) ?></strong></p>
    <?php endif; ?>

    <?php if (!empty($ambientes)): ?>
        <?php foreach ($ambientes as $ambiente): ?>
            <div class="ambiente">
                <h3>Ambiente ID: <?= esc($ambiente['ID']) ?></h3>
                <p><strong>Descrição:</strong> <?= esc($ambiente['DESCRICAO']) ?></p>
                <p><strong>Tipo:</strong> <?= esc($ambiente['TIPO']) ?></p>
                <p><strong>ID do Endereço:</strong> <?= esc($ambiente['ID_ENDERECO']) ?></p>
                </div>
        <?php endforeach; ?>
    <?php elseif (!isset($mensagem_status)): // Se $ambientes estiver vazio e não houver mensagem_status ?>
        <p>Nenhum ambiente encontrado para este usuário.</p>
    <?php endif; ?>

    <p><a href="<?= site_url('/dashboard') ?>">Voltar ao Painel</a></p>

</body>
</html>