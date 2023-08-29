<?php
include_once('../../../config/database.php');

    $id = filter_input(INPUT_POST, 'idOng');

    try {
        $delete = $conn->prepare("DELETE FROM tb_ong WHERE cd_ong = :id");
        $delete->bindValue(':id', $id);
        $delete->execute();

        header("Location: ../../../views/ongs/index.php?excluir_sucesso=true");
        exit();
    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }
?>
