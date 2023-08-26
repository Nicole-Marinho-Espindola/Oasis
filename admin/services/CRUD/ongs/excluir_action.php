<?php

include_once('../../config/database.php');

    $id = filter_input(INPUT_GET, 'cd_ong');

    try{

        $stmt = $conn->prepare("DELETE FROM tb_ong WHERE cd_ong :id");
        $stmt->bindValue('id', $id);
        $stmt->execute();

    header("Location: ../../../views/ongs/index.php?excluir_sucesso=true");
        exit();
    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }

?>