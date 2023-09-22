<?php
    include_once(includeURL('/services/helpers.php'));
    include_once(includeURL('/config/autenticacao.php'));
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/4719b1c3ae.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="<?= baseUrl('/assets/css/global.css')?>">
    <link rel="stylesheet" href="<?= baseUrl('/assets/css/navbar.css')?>">
    <link rel="stylesheet" href="<?= baseUrl('/assets/css/perfil.css')?>">
    <title>Perfil voluntario | Oásis</title>
</head>

<nav class="nav-perfil">
    <div class="back-block">
        <a href="<?= baseUrl('/index.php') ?>" class="back-green-btn">
            <i class="fa-solid fa-chevron-left"></i>
        </a>
    </div>
    <div class="logo-block">
        <img class="logo" src="<?= baseUrl('/assets/img/logo-oasis.png') ?>" alt="Logo da Oásis">
        <span class="logo-nome">Oásis</span>
    </div>
    <div class="btn-block">
        <button class="">Sair</button>
    </div>
</nav>