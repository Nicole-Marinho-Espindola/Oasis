<?php
include_once('../../../config/database.php');

    $id = filter_input(INPUT_POST, 'idInteresse');

    try {
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