<?php

    session_start();

    include_once('../../../config/database.php');

    $idong = filter_input(INPUT_POST, 'id');
    $nome = filter_input(INPUT_POST, 'nomeOng');
    $email = filter_input(INPUT_POST, 'emailOng');
    $imagem = $_FILES['imagemong'];

    try {
        $stmt_verificar = $conn->prepare("SELECT cd_ong FROM tb_ong WHERE ds_email = :email AND cd_ong != :id");
        $stmt_verificar->bindParam(':email', $email);
        $stmt_verificar->bindParam(':id', $idong);
        $stmt_verificar->execute();

        if ($stmt_verificar->rowCount() > 0) {
            header("Location: ../../../views/ongs/index.php?email_repetido=true");
            exit();
        }

        function obterNovoEmailDoong($idong, $conn) {
            try {
                $stmt = $conn->prepare("SELECT ds_email FROM tb_ong WHERE cd_ong = :id");
                $stmt->bindParam(':id', $idong);
                $stmt->execute();

                $row = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($row) {
                    return $row['ds_email'];
                } else {
                    return null;
                }
            } catch (PDOException $e) {
                return null;
            }
        }

        // Verifica se uma imagem foi enviada
        if ($imagem['error'] === UPLOAD_ERR_OK) {
            $dir = "../../../uploads/ongs/";
            date_default_timezone_set('America/Sao_Paulo');
            $extensao = strtolower(substr($imagem['name'], -4));
            $novo_nome = date("Y.m.d-H.i.s") . $extensao;
            $caminhoIMG = $dir . $novo_nome;
            $caminhoRelativo = str_replace('../../../', '/', $caminhoIMG);

            // Move a foto para a pasta
            if (move_uploaded_file($imagem['tmp_name'], $caminhoIMG)) {
                $stmt = $conn->prepare("UPDATE tb_ong SET nm_ong = :nome, ds_email = :email, nm_imagem = :imagem WHERE cd_ong = :id");
                $stmt->bindParam(':id', $idong);
                $stmt->bindParam(':nome', $nome);
                $stmt->bindParam(':email', $email);
                $stmt->bindParam(':imagem', $caminhoRelativo);
                $stmt->execute();
            }
        } else {
            // Se nenhuma imagem for enviada, atualize apenas o nome e o email
            $stmt = $conn->prepare("UPDATE tb_ong SET nm_ong = :nome, ds_email = :email WHERE cd_ong = :id");
            $stmt->bindParam(':id', $idong);
            $stmt->bindParam(':nome', $nome);
            $stmt->bindParam(':email', $email);
            $stmt->execute();
        }

        // atualizar a sessão com o novo email
        $novoEmail = obterNovoEmailDoong($idong, $conn);

        if ($novoEmail) {

            $_SESSION['email'] = $novoEmail;

        } else {
            echo "Erro ao atualizar o email na sessão.";
        }

        header("Location: ../../../views/pages/perfils/perfilong.php?editar_sucesso=true");
        exit();
    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }
?>
