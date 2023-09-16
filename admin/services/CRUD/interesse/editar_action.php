<?php

    include_once('../../../config/database.php');
    include_once('../../../services/helpers.php');

    $id = filter_input(INPUT_POST, 'idInteresse');
    $interesse = filter_input(INPUT_POST, 'interesse');
    $icone = $_FILES['icone'];

    try {
    // pegando o caminho da imagem anterior do banco de dados
    $stmt = $conn->prepare("SELECT nm_icone FROM tb_interesse WHERE cd_interesse = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $iconeBanco = $row['nm_icone'];

    // verificando se um novo icone foi enviado
    if ($icone['error'] === UPLOAD_ERR_OK) {
        $dir = "../../../assets/img/interesses/";
        date_default_timezone_set('America/Sao_Paulo');
        $extensao = strtolower(substr($icone['name'], -4));
        $novo_nome = date("Y.m.d-H.i.s") . $extensao;
        $caminhoIMG = $dir . $novo_nome;
        $caminhoRelativo = str_replace('../../../', '/', $caminhoIMG);

        // move o novo icone para a pasta
        if (move_uploaded_file($icone['tmp_name'], $caminhoIMG)) {
            // excluir a imagem anterior, se ela existir
            if (file_exists("../../../assets/img/interesses/" . basename($iconeBanco))) {
                unlink("../../../assets/img/interesses/" . basename($iconeBanco));
            }

            // atualizar com o novo icone
            $stmtUpdate = $conn->prepare("UPDATE tb_interesse SET ds_interesse = :interesse,
                                                                nm_icone = :icone
                                                                WHERE cd_interesse = :id");
            $stmtUpdate->bindParam(':id', $id);
            $stmtUpdate->bindParam(':interesse', $interesse);
            $stmtUpdate->bindParam(':icone', $caminhoRelativo);
            $stmtUpdate->execute();

            header("Location: ../../../views/interesses/index.php?editar_sucesso=true");
            exit();

        } else {
            echo 'Erro ao mover o novo arquivo de imagem.';
        }
        
    } else {
        // se nao foi enviado um novo icone, editar apenas o nome
        $stmtUpdate = $conn->prepare("UPDATE tb_interesse SET ds_interesse = :interesse WHERE cd_interesse = :id");
        $stmtUpdate->bindParam(':id', $id);
        $stmtUpdate->bindParam(':interesse', $interesse);
        $stmtUpdate->execute();

        header("Location: ../../../views/interesses/index.php?editar_sucesso=true");
        exit();
    }

    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }

?>
