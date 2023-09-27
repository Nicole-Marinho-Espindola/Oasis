<?php

    function includeURL($path = '') {
        return sprintf(
            "%s/%s/%s",
            $_SERVER['DOCUMENT_ROOT'],
            'Oasis',
            $path
        );
    }

    include_once(includeURL('/config/database.php'));
    include_once(includeURL('/services/helpers.php'));

    session_start();

    if (!empty($_POST) && !isset($_SESSION['cadastro_realizado'])) {
        $nome = $_POST['nomeVoluntario'];
        $sobrenome = $_POST['sobrenomeVoluntario'];
        $dt_nasc = $_POST['nascimentoVoluntario'];
        $email = $_POST['emailVoluntario'];
        $senha = $_POST['senhaVoluntario'];
        $interesses = $_POST['interesses'];
        $_SESSION['interesses_temporarios'] = $interesses;
        

        try {
            $stmt_verificar = $conn->prepare("SELECT ds_email FROM tb_voluntario WHERE ds_email = :email");
            $stmt_verificar->bindParam(':email', $email);
            $stmt_verificar->execute();

            if ($stmt_verificar->rowCount() > 0) {
                header("Location: ../../../views/voluntarios/cadastro.php?email_repetido=true");
                exit();
            }

            $hashDaSenha = password_hash($senha, PASSWORD_DEFAULT);

            $stmt = $conn->prepare("INSERT INTO tb_voluntario(nm_voluntario, nm_sobrenome, dt_nascimento, ds_email, cd_senha)
                                    VALUES (:nome, :sobrenome, :dt_nasc, :email, :senha)");
            $stmt->bindParam(':nome', $nome);
            $stmt->bindParam(':sobrenome', $sobrenome);
            $stmt->bindParam(':dt_nasc', $dt_nasc);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':senha', $hashDaSenha);
            $stmt->execute();

            // Lida com o token de confirmação de e-mail
            $cd_voluntario = $conn->lastInsertId();
            $_SESSION['cd_voluntario'] = $cd_voluntario;
            $token = bin2hex(random_bytes(32));
            $tipoToken = 1; // 1 é confirmação de e-mail
            date_default_timezone_set('America/Sao_Paulo');
            $dt_pedido = date('Y-m-d H:i:s');
            $dt_expiracao = date('Y-m-d H:i:s', strtotime('+1 day')); // 1 dia a partir do pedido

            $stmtToken = $conn->prepare("INSERT INTO tb_token_voluntario (cd_tipo_token, cd_voluntario, ds_token, dt_pedido, dt_expiracao) 
                                        VALUES (:tipo_token, :voluntario, :token, :dt_pedido, :dt_expiracao)");
            $stmtToken->bindParam(':tipo_token', $tipoToken);
            $stmtToken->bindParam(':voluntario', $cd_voluntario);
            $stmtToken->bindParam(':token', $token);
            $stmtToken->bindParam(':dt_pedido', $dt_pedido);
            $stmtToken->bindParam(':dt_expiracao', $dt_expiracao);
            $stmtToken->execute();

            // Lida com os interesses
            if (!empty($_SESSION['interesses_temporarios'])) {
                foreach ($_SESSION['interesses_temporarios'] as $interesse) {
                    $stmt_associacao = $conn->prepare("INSERT INTO tb_escolha(cd_voluntario, cd_interesse)
                                                    VALUES (:voluntario, :interesse)");
                    $stmt_associacao->bindParam(':voluntario', $cd_voluntario);
                    $stmt_associacao->bindParam(':interesse', $interesse);
                    $stmt_associacao->execute();
                }
                unset($_SESSION['interesses_temporarios']);
            }

            // vai para a confirmação de e-mail
            header("Location: ../../../views/forms/voluntarios/confirmarEmail.php");
            exit();
        } catch (PDOException $e) {
            echo "Erro ao cadastrar: " . $e->getMessage();
        }
    }
    
?>
