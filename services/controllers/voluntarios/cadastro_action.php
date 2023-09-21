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
?>

<?php

    session_start();

    if (!empty($_POST) && !isset($_SESSION['cadastro_realizado'])) {

        $nome = $_POST['nomeVoluntario'];
        $sobrenome = $_POST['sobrenomeVoluntario'];
        $dt_nasc = $_POST['nascimentoVoluntario'];
        $email = $_POST['emailVoluntario'];
        $senha = $_POST['senhaVoluntario'];
        $interesses = $_POST['interesses'];
        $_SESSION['interesses_temporarios'] = $interesses;
        
        include_once(includeURL('/config/database.php'));

        try {

            $stmt_verificar = $conn->prepare("SELECT ds_email FROM tb_voluntario WHERE ds_email = :email");
            $stmt_verificar->bindParam(':email', $email);
            $stmt_verificar->execute();

            if ($stmt_verificar->rowCount() > 0) {
                header("Location: ../../../views/voluntarios/cadastro.php?email_repetido=true");

            } else {

                $hashDaSenha = password_hash($senha, PASSWORD_DEFAULT);

                //token do confirmar email
                $token_email = password_hash($email . date("Y-m-d H:i:s"), PASSWORD_DEFAULT);

                $stmt = $conn->prepare("INSERT INTO tb_voluntario(nm_voluntario, nm_sobrenome, dt_nascimento, ds_email, cd_senha, cd_token_email)
                                        VALUES (:nome, :sobrenome, :dt_nasc, :email, :senha, :token_email)");

                $stmt->bindParam(':nome', $nome);
                $stmt->bindParam(':sobrenome', $sobrenome);
                $stmt->bindParam(':dt_nasc', $dt_nasc);
                $stmt->bindParam(':email', $email);
                $stmt->bindParam(':senha', $hashDaSenha);
                $stmt->bindParam(':token_email', $token_email, PDO::PARAM_STR);
                $stmt->execute();

            if (!empty($_SESSION['interesses_temporarios'])) {

                $cd_voluntario = $conn->lastInsertId();

                foreach ($_SESSION['interesses_temporarios'] as $interesse){

                    $stmt_associacao = $conn->prepare("INSERT INTO tb_escolha(cd_voluntario, cd_interesse)
                                                        VALUES (:voluntario, :interesse)");

                    $stmt_associacao->bindParam(':voluntario', $cd_voluntario);
                    $stmt_associacao->bindParam(':interesse', $interesse);
                    $stmt_associacao->execute();
                }

                unset($_SESSION['interesses_temporarios']);
            }

            //adicionar redirecionamento para confirmação de email
            header("Location: ../../../views/forms/voluntarios/confirmarEmail.php?cd_voluntario=" . $cd_voluntario);
            exit();
            }
            
        }catch (PDOException $e) {
            echo "Erro ao cadastrar: " . $e->getMessage();
        }


        // Feche a conexão com o banco de dados
        $conn = null;

    }
?>
