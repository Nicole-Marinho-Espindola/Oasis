<?php

    include_once(includeURL('/services/helpers.php'));

    if (!empty($_POST)) {
        $email = $_POST['email'];
        $senha = $_POST['senha'];

        include_once('../../config/database.php');

        try {
            // Buscar as informações do usuário pelo email no banco de dados
            $stmt = $conn->prepare("SELECT cd_senha FROM tb_voluntario WHERE ds_email = :email");
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($row) {
                $hashDaSenhaNoBancoDeDados = $row['cd_senha'];

                // Verificar se a senha coincide com o hash no banco de dados
                if (password_verify($senha, $hashDaSenhaNoBancoDeDados)) {
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