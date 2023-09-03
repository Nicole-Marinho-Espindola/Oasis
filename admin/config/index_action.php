<?php

    session_start();

    if (!empty($_POST)) {

        $user = $_POST['user'];
        $senha = $_POST['senha'];

        //utilizando o .env
        require_once 'vendor/autoload.php';

        $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
        $dotenv->load();
    
        //definindo o usuario e senha
        $usuarioAdmin = $_ENV['LOGIN_USER'];
        $senhaAdmin = $_ENV['LOGIN_SENHA'];

        //comparando
        if ($user === $usuarioAdmin && $senha === $senhaAdmin) {

            $_SESSION['user'] = $user;
            header("Location: ../views/home-admin.php");
            exit();

        } else {

            echo "Nome de usuário ou senha incorretos. Tente novamente.";

        }

    } else {

        header("Location: ../../views/index.php");
        exit();

    }

?>