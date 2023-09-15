<?php

    if (!isset($_SESSION['user'])) {
        header("Location: ../views/index.php?acesso_negado=true");
        exit();
    }

    try {

        require_once 'vendor/autoload.php';

        $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
        $dotenv->load();
    
        //definindo o usuario
        $usuarioAdmin = $_ENV['LOGIN_USER'];

        if ($_SESSION['user'] !== $usuarioAdmin) {
            header("Location: ../views/index.php?acesso_negado=true");
            exit();
        }

    } catch (PDOException $e) {
        echo "Erro durante a verificação: " . $e->getMessage();
    }

?>