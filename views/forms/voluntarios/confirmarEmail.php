<?php
    function includeURL($path = '') {
        return sprintf(
            "%s/%s/%s",
            $_SERVER['DOCUMENT_ROOT'],
            'Oasis',
            $path
        );
    }

    include_once(includeURL('/services/helpers.php'))
?>

<?php

    if (isset($_GET['cd_voluntario'])) {
    $id = filter_input(INPUT_GET, 'cd_voluntario');
    }

?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/4719b1c3ae.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="<?= baseUrl('/assets/css/global.css')?>">
    <link rel="stylesheet" href="<?= baseUrl('/assets/css/navbar.css')?>">
    <link rel="stylesheet" href="<?= baseUrl('/assets/css/form.css')?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Cadastro | Oásis</title>
</head>

<div class="main-content">
    <div class="form">
        <div class="back-block">
            <a href="<?= baseUrl('/index.php') ?>" class="back-green-btn">
                <i class="fa-solid fa-chevron-left"></i>
            </a>
        </div>
        <form action="<?= baseUrl('/services/controllers/voluntarios/email/confirmarEmail_action.php') ?>" method="POST">
        <div class="section active">
            <div class="form-title">
                <h1 class="title">Confirme seu email</h1>
                <div class="line line-config"></div>
                <p class="form-subtitle">Quase lá! Falta pouco para você fazer parte do nosso Oásis.</p>
            </div>
            <div class="card-email">
                <div class="card-email-head">
                    <!-- <i class="fa-regular fa-envelope mail-icon"></i> -->
                    <img class="mail-icon" src="<?= baseUrl('/assets/img/email-img.png')?>" alt="">
                </div>
                <div class="card-email-text-block">
                    <h3 class="card-email-title">Verifique seu email</h3>
                    <p class="card-email-text">Para uma maior segurança gostariamos que você confirmasse seu email,
                        não se preocupe, é rápido!</p>
                </div>
                <button type="submit" class="btn btn-purple btn-larger">
                    <a class="btn-link">Confirmar email</a>
                </button>

            </div>
        </div>
    </div>
    <div class="img-block">
        <img class="form-img" src="<?= baseUrl('/assets/img/Sign up-bro.png')?>" alt="">
    </div>
</div>