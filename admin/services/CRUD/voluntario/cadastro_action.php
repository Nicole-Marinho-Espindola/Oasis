<?php

if (!empty($_POST) && !isset($_SESSION['cadastro_realizado'])) {
    
    $nome = $_POST['nomeVoluntario'];
    $sobrenome = $_POST['sobrenomeVoluntario'];
    $dt_nasc = $_POST['nascimentoVoluntario'];
    $email = $_POST['emailVoluntario'];
    $senha = $_POST['senhaVoluntario'];
    $interesses = $_POST['interesses'];

    include_once('../../../config/database.php');

    try {
        $stmt_verificar = $conn->prepare("SELECT ds_email FROM tb_voluntario WHERE ds_email = :email");
        $stmt_verificar->bindParam(':email', $email);
        $stmt_verificar->execute();

        if ($stmt_verificar->rowCount() > 0) {
            header("Location: ../../../views/voluntarios/index.php?email_repetido=true");
            exit();
        } else {
            $hashDaSenha = password_hash($senha, PASSWORD_DEFAULT);

            $stmt = $conn->prepare("INSERT INTO tb_voluntario(nm_voluntario, nm_sobrenome, dt_nascimento, ds_email, cd_senha)
                                    VALUES (:nome, :sobrenome, :dt_nasc, :email, :senha)");
            
            $stmt->bindParam(':nome', $nome);
            $stmt->bindParam(':sobrenome', $sobrenome);
            $stmt->bindParam(':dt_nasc', $dt_nasc);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':senha', $hashDaSenha);
            
            $stmt->execute();

            $cd_voluntario = $conn->lastInsertId();

            // Insere as associações na tabela tb_escolha
            foreach ($interesses as $interesse) {

                $stmt_associacao = $conn->prepare("INSERT INTO tb_escolha (cd_voluntario, cd_interesse) VALUES (:voluntario, :interesse)");
                $stmt_associacao->bindParam(':voluntario', $cd_voluntario);
                $stmt_associacao->bindParam(':interesse', $interesse);
                $stmt_associacao->execute();
            }

            header("Location: ../../../views/voluntarios/index.php?cadastro_sucesso=true");
            exit();
        }
    } catch (PDOException $e) {
        echo "Erro ao cadastrar: " . $e->getMessage();
    }

    $conn = null;
}

?>
