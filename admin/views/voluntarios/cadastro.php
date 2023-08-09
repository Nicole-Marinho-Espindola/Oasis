<?php
    function includeURL($path = '') {
        return sprintf(
            "%s/%s/%s",
            $_SERVER['DOCUMENT_ROOT'],
            'Oásis/admin',
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
    <link rel="stylesheet" href="<?= baseUrl('/assets/css/global.css') ?>">
    <link rel="stylesheet" href="<?= baseUrl('/assets/css/form.css') ?>">
    <title>Form | Cadastro</title>
</head>
<body>
    <div class="main-content">
        <div class="form-block">
            <div class="form-title">
                <h1 class="title">Junte-se a nós!</h1>
                <div class="line"></div>
            </div>
            <form class="form" action="">
                <div class="section1 active">
                    <div class="user-info-block">
                        <label class="" for="">Nome:</label>
                        <div class="input-block">
                            <i class="fa-regular fa-envelope" style="color: #586D48;"></i>
                            <input class="input input-size" type="text">
                        </div>
                    </div>
                    <div class="user-info-block">
                        <label class="" for="">Sobrenome:</label>
                        <div class="input-block">
                            <i class="fa-regular fa-envelope" style="color: #586D48;"></i>
                            <input class="input input-size" type="text">
                        </div>
                    </div>
                    <div class="user-info-block">
                        <label class="" for="">Data de nascimento:</label>
                        <div class="input-block">
                            <i class="fa-regular fa-envelope" style="color: #586D48;"></i>
                            <input class="input input-size" type="text">
                        </div>
                    </div> 
                    <button type="button" class="btn btn-color" onclick="passarEtapa()">Próximo</button>
                </div>
                <div class="section2">
                    <div class="user-info-block">
                        <label class="" for="">Selecione 3 interesses:</label>
                        <!-- <div class="line"></div> -->
                    </div>
                    <button type="button" class="btn btn-color" onclick="passarEtapa()">Próximo</button>
                </div>
                <div class="section3">
                    <div class="user-info-block">
                        <label class="" for="">Email:</label>
                        <div class="input-block">
                            <i class="fa-regular fa-envelope" style="color: #586D48;"></i>
                            <input class="input input-size" type="text">
                        </div>
                    </div>
                    <div class="user-info-block">
                        <label for="">Senha:</label>
                        <div class="input-block">
                            <i class="fa-solid fa-lock" style="color: #586D48;"></i>
                            <input class="input" type="text">
                            <i class="fa-regular fa-eye-slash" style="color: #586D48;"></i>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-color">Cadastrar</button>
                </div>
                <!-- <button class="btn btn-color">Entrar</button> -->
            </form>
        </div> 
        <div class="img-block">
            <img class="form-img" src="../../assets/img/Sign up-bro.png" alt="">
        </div>
    </div>
</body>
<script src="<?= baseUrl('/assets/js/cadastroEtapas.js') ?>"></script>