<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="pt-Br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/4719b1c3ae.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.27/dist/sweetalert2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/global.css">
    <link rel="stylesheet" href="../assets/css/form.css">
    <title>Form | Login</title>
</head>
<body>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.27/dist/sweetalert2.all.min.js"></script>
    <script src="../assets/js/alertSweet.js"></script>

    <script>

        <?php

            if (isset($_GET['acesso_negado']) && $_GET['acesso_negado'] == 'true') {
                echo "alertAcesso();";
            }
            if (isset($_GET['sair_sucesso']) && $_GET['sair_sucesso'] == 'true') {
                echo "alertLogout();";
            }
            if (isset($_GET['login_errado']) && $_GET['login_errado'] == 'true') {
                echo "alertLogin();";
            }
            if (isset($_GET['sessao_expirada']) && $_GET['sessao_expirada'] == 'true') {
                echo "alertSessao();";
            }

        ?>

    </script>

<div class="main-content">
    <div class="form-block">
        <div class="form-title">
            <h1 class="title">Bem vindo de volta!</h1>
            <div class="line"></div>
        </div>
        <form class="form" action="../config/login.php" method="POST" id="form">
            <div class="user-info-block">
                <label class="" for="">User:</label>
                <div class="input-block">
                    <i class="fa-regular fa-envelope" style="color: #586D48;"></i>
                    <input class="input input-size" type="text" name="user" placeholder="Digite seu usuário...">
                </div>
            </div>
            <div class="user-info-block">
                <label for="">Senha:</label>
                <div class="input-block">
                    <i class="fa-solid fa-lock" style="color: #586D48;"></i>
                    <input class="input" type="password" name="senha" placeholder="Digite sua senha..." 
                        id="password" onChange="buttonToggle()">
                    <i class="fa-regular fa-eye-slash" style="color: #586D48;"></i>
                </div>
            </div>
            <button class="btn btn-color">Entrar</a></button>
        </form>
    </div>
    <div class="img-block">
        <img class="form-img" src="../../assets/img/Tablet login-bro.png" alt="">
    </div>
</div>
</body>
</html>