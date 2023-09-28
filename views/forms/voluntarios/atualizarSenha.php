<?php
    function includeURL($path = '') {
        return sprintf(
            "%s/%s/%s",
            $_SERVER['DOCUMENT_ROOT'],
            'Oasis',
            $path
        );
    }

    include_once(includeURL('/services/helpers.php'));

    $token_senha = filter_input(INPUT_GET, 'token_senha', FILTER_DEFAULT);

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
        <form action="<?= baseUrl('/services/controllers/voluntarios/senha/atualizarSenha_action.php') ?>" method="POST">
        <div class="section active">
            <div class="form-title">
                <h1 class="title">Atualizar senha</h1>
                <div class="line line-config"></div>
                <p class="form-subtitle">Não lembra sua senha? Podemos resolver isso pra você!</p>
            </div>
            <div class="card-senha">
                <div class="card-senha-head">
                    <!-- <img class="mail-icon" src="<?= baseUrl('/assets/img/email-img.png')?>" alt=""> -->
                </div>
                <div class="card-senha-text-block">
                    <h3 class="card-senha-title">Digite sua nova senha</h3>
                    <div class="user-info-block">
                        <label class="label-style" for="">Senha
                            <div class="input-block input-block-size">
                                <i class="fa-regular fa-envelope icon-green"></i>
                                <input class="input input-size" type="text"
                                    id="senha" name="senha">
                            </div>
                        </label>
                        <label class="label-style" for="">Confirmar senha
                            <div class="input-block input-block-size">
                                <i class="fa-regular fa-envelope icon-green"></i>
                                <input class="input input-size" type="text"
                                    id="confirmar_senha" name="confirmar_senha">
                                <input type="hidden" name="token_senha" value="<?= $token_senha ?>">
                            </div>
                        </label>
                    </div>
                </div>
                <button type="submit" class="btn btn-purple btn-larger">Enviar</button>
            </div>
        </div>
    </div>
    <div class="img-block">
        <img class="form-img" src="<?= baseUrl('/assets/img/Forgot password-pana.png')?>" alt="">
    </div>