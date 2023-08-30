<?php
include_once('../../../config/database.php');

$id = filter_input(INPUT_POST, 'idVoluntario');

try {
    $delete = $conn->prepare("DELETE FROM tb_voluntario WHERE cd_voluntario = :id");
    $delete->bindValue(':id', $id);
    $delete->execute();

    $delete_associacao = $conn->prepare("DELETE FROM tb_escolha WHERE cd_voluntario = :id");
    $delete_associacao->bindValue(':id', $id);
    $delete_associacao->execute();

    header("Location: ../../../views/voluntarios/index.php?excluir_sucesso=true");
    exit();
} catch (PDOException $e) {
    echo 'Error: ' . $e->getMessage();
}
?>
