<?php

    session_start();

    if (!empty($_POST)) {
        $email = $_POST['email'];
        $senha = $_POST['senha'];
        $_SESSION['email'] = $_POST['email'];

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
                        header("Location: ../../../index.php");
                        exit();
                    } else {
                        // Senha correta, mas o email não foi confirmado
                        echo "Necessário confirmar o email antes de fazer login.";
                    }
                } else {
                    // Senha incorreta
                    echo "Senha incorreta. Tente novamente.";
                }
            } else {
                // Usuário não encontrado
                echo "Usuário não encontrado.";
            }
        } catch (PDOException $e) {
            echo "Erro durante o login: " . $e->getMessage();
        }
        $conn = null;
    }


?>