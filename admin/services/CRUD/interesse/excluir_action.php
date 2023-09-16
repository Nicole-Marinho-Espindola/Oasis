<?php
    include_once('../../../config/database.php');

    $id = filter_input(INPUT_POST, 'idInteresse');

    try {
        // Pegando o caminho da imagem anterior do banco de dados
        $stmt = $conn->prepare("SELECT nm_icone FROM tb_interesse WHERE cd_interesse = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $iconeBanco = $row['nm_icone'];

        // Excluir a imagem da pasta tb, para nao ocupar espaço
        if (file_exists("../../../assets/img/interesses/" . basename($iconeBanco))) {
            unlink("../../../assets/img/interesses/" . basename($iconeBanco));
        }

        $delete_associacao = $conn->prepare("DELETE FROM tb_escolha WHERE cd_interesse = :id");
        $delete_associacao->bindValue(':id', $id);
        $delete_associacao->execute();

        $delete = $conn->prepare("DELETE FROM tb_interesse WHERE cd_interesse = :id");
        $delete->bindValue(':id', $id);
        $delete->execute();

        header("Location: ../../../views/interesses/index.php?excluir_sucesso=true");
        exit();
    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }
?>