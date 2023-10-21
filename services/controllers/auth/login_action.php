<?php

    session_start();

    if (!empty($_POST)) {
        $email = $_POST['email'];
        $senha = $_POST['senha'];

        include_once('../../../config/database.php');

        try {
            // Verificar se o email pertence a uma ONG
            $stmtOng = $conn->prepare("SELECT cd_senha, cd_situacao FROM tb_ong WHERE ds_email = :email");
            $stmtOng->bindParam(':email', $email);
            $stmtOng->execute();
            $rowOng = $stmtOng->fetch(PDO::FETCH_ASSOC);

            // Verificar se o email pertence a um voluntário, se não pertencer a uma ONG
            if (!$rowOng) {
                $stmtVoluntario = $conn->prepare("SELECT cd_senha, cd_situacao FROM tb_voluntario WHERE ds_email = :email");
                $stmtVoluntario->bindParam(':email', $email);
                $stmtVoluntario->execute();
                $rowVoluntario = $stmtVoluntario->fetch(PDO::FETCH_ASSOC);

                if ($rowVoluntario) {
                    $hashDaSenha = $rowVoluntario['cd_senha'];
                    $emailConfirmado = $rowVoluntario['cd_situacao'];
                }
            } else {
                $hashDaSenha = $rowOng['cd_senha'];
                $emailConfirmado = $rowOng['cd_situacao'];
            }

            if (isset($hashDaSenha)) {
                // Verificar se a senha fornecida coincide com o hash no banco de dados
                if (password_verify($senha, $hashDaSenha)) {
                    if ($emailConfirmado == 1) {
                        // Senha correta e email confirmado, continue com o processo de login
                        $_SESSION['email'] = $_POST['email'];
                        header("Location: ../../../index.php");
                        exit();
                    } else {
                        // Senha correta, mas o email não foi confirmado
                        header("Location: ../../../views/forms/login.php?email_unconfirmed=true");
                    }
                } else {
                    header("Location: ../../../views/forms/login.php?login_fail=true");
                }
            } else {
                header("Location: ../../../views/forms/login.php?login_fail=true");
            }
        } catch (PDOException $e) {
            echo "Erro durante o login: " . $e->getMessage();
        }
        $conn = null;
    }


?>