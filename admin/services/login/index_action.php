<?php

    session_start();

    if (!empty($_POST)) {
        $email = $_POST['email'];
        $senha = $_POST['senha'];

        include_once('../../config/database.php');

        try {

            $_SESSION['email'] = $email;
            
            $stmt = $conn->prepare("SELECT cd_senha FROM tb_voluntario WHERE ds_email = :email");
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($row) {
                $hashDaSenhaNoBancoDeDados = $row['cd_senha'];

                if (password_verify($senha, $hashDaSenhaNoBancoDeDados)) {

                    header("Location: ../../views/home-admin.php");
                    exit();
                } else {
                    echo "Senha incorreta. Tente novamente.";
                }
            } else {
                echo "Usuário não encontrado.";
            }
        } catch (PDOException $e) {
            echo "Erro durante o login: " . $e->getMessage();
        }
        $conn = null;
    }

?>