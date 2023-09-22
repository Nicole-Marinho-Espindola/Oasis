<?php

    session_start();

    if (!empty($_POST)) {
        $email = $_POST['email'];
        $senha = $_POST['senha'];

        include_once('../../config/database.php');

        try {
            // Verificar se o email pertence a uma ONG
            $stmtOng = $conn->prepare("SELECT cd_senha FROM tb_ong WHERE ds_email = :email");
            $stmtOng->bindParam(':email', $email);
            $stmtOng->execute();
            $rowOng = $stmtOng->fetch(PDO::FETCH_ASSOC);

            // Verificar se o email pertence a um voluntário, se não pertencer a uma ONG
            if (!$rowOng) {
                $stmtVoluntario = $conn->prepare("SELECT cd_senha FROM tb_voluntario WHERE ds_email = :email");
                $stmtVoluntario->bindParam(':email', $email);
                $stmtVoluntario->execute();
                $rowVoluntario = $stmtVoluntario->fetch(PDO::FETCH_ASSOC);

                if ($rowVoluntario) {
                    $hashDaSenha = $rowVoluntario['cd_senha'];
                }
            } else {
                $hashDaSenha = $rowOng['cd_senha'];
            }

            if (isset($hashDaSenha)) {
                // Verificar se a senha fornecida coincide com o hash no banco de dados
                if (password_verify($senha, $hashDaSenha)) {
                    // Senha correta, continue com o processo de login
                    echo "Login bem-sucedido!";
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