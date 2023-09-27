<?php

    include_once('../../../config/database.php');

    $id = filter_input(INPUT_POST, 'idVoluntario');

    try {
        
        $delete_situacao = $conn->prepare("DELETE FROM tb_token_voluntario WHERE cd_voluntario = :id");
        $delete_situacao->bindValue(':id', $id);
        $delete_situacao->execute();

        $delete_associacao = $conn->prepare("DELETE FROM tb_escolha WHERE cd_voluntario = :id");
        $delete_associacao->bindValue(':id', $id);
        $delete_associacao->execute();

        $delete = $conn->prepare("DELETE FROM tb_voluntario WHERE cd_voluntario = :id");
        $delete->bindValue(':id', $id);
        $delete->execute();

        header("Location: ../../../views/voluntarios/index.php?excluir_sucesso=true");
        exit();
    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }
?>
