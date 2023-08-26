<?php

include_once('../../config/database.php');

    $id = filter_input(INPUT_GET, 'cd_voluntario');

    try{

        $stmt = $conn->prepare("DELETE FROM tb_voluntario WHERE cd_voluntario :id");
        $stmt->bindValue('id', $id);
        $stmt->execute();

    header("Location: ../../../views/voluntarios/index.php?excluir_sucesso=true");
        exit();
    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }

?>