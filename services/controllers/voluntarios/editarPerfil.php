<?php
    include_once('../../../config/database.php');

    $idVoluntario = filter_input(INPUT_POST, 'idVoluntario');
    $nome = filter_input(INPUT_POST, 'nomeVoluntario');
    $email = filter_input(INPUT_POST, 'emailVoluntario');
    $imagem = $_FILES['imagemVoluntario'];

    try {
        $stmt_verificar = $conn->prepare("SELECT cd_voluntario FROM tb_voluntario WHERE ds_email = :email AND cd_voluntario != :idVoluntario");
        $stmt_verificar->bindParam(':email', $email);
        $stmt_verificar->bindParam(':idVoluntario', $idVoluntario);
        $stmt_verificar->execute();

        if ($stmt_verificar->rowCount() > 0) {
            header("Location: ../../../views/voluntarios/index.php?email_repetido=true");
            exit();
        }

        if ($imagem['error'] === UPLOAD_ERR_OK) {
            $dir = "../../../uploads/voluntarios/";
            date_default_timezone_set('America/Sao_Paulo');
            $extensao = strtolower(substr($imagem['name'], -4));
            $novo_nome = date("Y.m.d-H.i.s") . $extensao;
            $caminhoIMG = $dir . $novo_nome;
            $caminhoRelativo = str_replace('../../../', '/', $caminhoIMG);

            // Move a foto para a pasta
            if (move_uploaded_file($imagem['tmp_name'], $caminhoIMG)) {
                $stmt = $conn->prepare("UPDATE tb_voluntario SET nm_voluntario = :nome, ds_email = :email, nm_imagem = :imagem WHERE cd_voluntario = :id");
                $stmt->bindParam(':id', $idVoluntario);
                $stmt->bindParam(':nome', $nome);
                $stmt->bindParam(':email', $email);
                $stmt->bindParam(':imagem', $caminhoRelativo);
                $stmt->execute();
            }
        } else {
            // Se nenhuma imagem for enviada, atualize apenas o nome e o email
            $stmt = $conn->prepare("UPDATE tb_voluntario SET nm_voluntario = :nome, ds_email = :email WHERE cd_voluntario = :id");
            $stmt->bindParam(':id', $idVoluntario);
            $stmt->bindParam(':nome', $nome);
            $stmt->bindParam(':email', $email);
            $stmt->execute();
        }

        header("Location: ../../../views/pages/perfils/perfilVoluntario.php?editar_sucesso=true");
        exit();
    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }
?>
