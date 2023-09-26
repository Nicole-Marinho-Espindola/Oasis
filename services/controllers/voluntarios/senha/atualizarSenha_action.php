<?php

    function includeURL($path = '') {
        return sprintf(
            "%s/%s/%s",
            $_SERVER['DOCUMENT_ROOT'],
            'Oasis',
            $path
        );
    }

    include_once(includeURL('/services/helpers.php'));
    include_once(includeURL('/config/database.php'));


    $token_senha = filter_input(INPUT_GET, 'token_senha', FILTER_DEFAULT);

    if (!empty($token_senha)) {

        $stmt = $conn->prepare("SELECT v.cd_voluntario
                                FROM tb_voluntario v
                                JOIN tb_token_voluntario t ON v.cd_voluntario = t.cd_voluntario
                                WHERE t.ds_token = :token_senha AND t.cd_tipo_token = 2 AND t.cd_token_usado = 0 LIMIT 1");
        $stmt->bindParam(':token_senha', $token_senha, PDO::PARAM_STR);
        $stmt->execute();

        if ($stmt->rowCount() != 0) {

            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            $id = $row['cd_voluntario'];

            if (!empty($_POST)) {

                $senha = $_POST['senha'];
                $hashDaSenha = password_hash($senha, PASSWORD_DEFAULT);

                $stmtSenha = $conn->prepare("UPDATE tb_voluntario
                                            SET cd_senha = :senha
                                            WHERE cd_voluntario = :id");

                $stmtSenha->bindParam(':senha', $hashDaSenha, PDO::PARAM_STR); 
                $stmtSenha->bindParam(':id', $id, PDO::PARAM_INT);

                if ($stmtSenha->execute()) {
                    $_SESSION['msg'] = "<p style='color: green'>Senha atualizada com sucesso!</p>";
                    header("Location: index.php");
                    exit(); // Termina a execução após redirecionar.
                } else {
                    echo "<p style='color: #ff0000'>Erro: Tente novamente!</p>";
                }
            }
        } else {
            $_SESSION['msg_rec'] = "<p style='color: #ff0000'>Erro: Link inválido, solicite um novo link para atualizar a senha!</p>";
            header("Location: recuperar_senha.php");
            exit(); // Termina a execução após redirecionar.
        }
    } else {
        $_SESSION['msg_rec'] = "<p style='color: #ff0000'>Erro: Link inválido, solicite um novo link para atualizar a senha!</p>";
        header("Location: recuperar_senha.php");
        exit(); // Termina a execução após redirecionar.
    }
?>