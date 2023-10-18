<?php

require __DIR__ . '/lib/vendor/autoload.php';

    session_start();

    if (!empty($_POST)) {

        $user = $_POST['user'];
        $senha = $_POST['senha'];

        //utilizando o .env
        require_once './lib/vendor/autoload.php';

        $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
        $dotenv->load();
    
        //definindo o usuario e senha
        $usuarioAdmin = $_ENV['LOGIN_USER'];
        $senhaAdmin = $_ENV['LOGIN_SENHA'];

        var_dump($user);
        var_dump($usuarioAdmin);

        //comparando
        if ($user === $usuarioAdmin && $senha === $senhaAdmin) {

            $_SESSION['user'] = $user;
            header("Location: ../views/home-admin.php");
            exit();

        } else {

            header("Location: ../views/index.php?login_errado=true");
            exit();

                }

    } else {

        header("Location: ../views/index.php");
        exit();

    }

?>