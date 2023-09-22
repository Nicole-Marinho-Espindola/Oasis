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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/4719b1c3ae.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="<?= baseUrl('/assets/css/global.css')?>">
    <link rel="stylesheet" href="<?= baseUrl('/assets/css/navbar.css')?>">
    <link rel="stylesheet" href="<?= baseUrl('/assets/css/form.css')?>">
    <title>Form | Login</title>
</head>
<body>
    <div class="main-content">
        <div class="form-block">
            <div class="back-block">
                <a href="<?= baseUrl('/index.php') ?>" class="back-green-btn">
                    <i class="fa-solid fa-chevron-left"></i>
                </a>
            </div>
            <form class="form" action="<?= baseUrl('/services/controllers/auth/login_action.php') ?>" method="POST">
                <div class="form-title form-title-config">
                    <h1 class="title">Entrar</h1>
                    <div class="line line-config"></div>
                    <p class="form-subtitle">Bem vindo de volta! Por favor, entre para continuar.</p>
                </div>
                <div class="user-info-block">
                    <label class="" for="">Email:</label>
                    <div class="input-block">
                        <i class="fa-regular fa-envelope" style="color: #586D48;"></i>
                        <input class="input input-size" type="text"
                            id="email" name="email"  placeholder="digite seu email">
                    </div>
                </div>
                <div class="user-info-block">
                    <label for="">Senha:</label>
                    <div class="input-block">
                        <i class="fa-solid fa-lock" style="color: #586D48;"></i>
                        <input class="input" type="text"
                                id="senha" name="senha"
                            placeholder="digite sua senha" onChange="buttonToggle()">
                        <i class="fa-regular fa-eye-slash" style="color: #586D48;" id="eyePng" onClick="eyeClick()"></i>
                    </div>
                </div>
                <div class="check-block check-block-config">
                    <input class="checkbox" type="checkbox" id="termos" name="check">
                    <div>
                        <label for="check" class="terms-label">Lembrar de mim</label>
                        <span><a href="alterarSenha.php">Esqueceu a senha?</a></span>

                    </div>
                </div>
                <button class="btn btn-color btn-margin btn-section-config">Entrar</button>
            </form>
            <span class="redirecionar-login">Novo por aqui? <a href="cadastro.php" class="purple-link">Cadastre-se</a></span>
        </div>
        <div class="img-block">
            <img class="form-img" src="<?= baseUrl('/assets/img/Sign up-bro.png')?>" alt="">
        </div>
    </div>
</body>
</html>