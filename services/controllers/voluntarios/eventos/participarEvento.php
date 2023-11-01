<?php
session_start();

include_once('../../../../config/database.php');

$idEvento = filter_input(INPUT_POST, 'idEvento');
$idVoluntario = filter_input(INPUT_POST, 'idVoluntario');


try {
    $stmt_verificar = $conn->prepare("SELECT cd_voluntario FROM tb_voluntario WHERE cd_voluntario = :idVoluntario");
    $stmt_verificar->bindParam(':idVoluntario', $idVoluntario);
    $stmt_verificar->execute();

    if ($stmt_verificar->rowCount() === 0) {
        header("Location: ../../../../views/pages/eventos/eventosVoluntario.php?inscricao_sucesso=false");
        exit();
    }

    $stmt = $conn->prepare("INSERT INTO tb_inscricao(cd_voluntario, cd_evento) VALUES (:idVoluntario, :idEvento)");
    $stmt->bindParam(':idEvento', $idEvento);
    $stmt->bindParam(':idVoluntario', $idVoluntario);
    $stmt->execute();

    header("Location: ../../../../views/pages/eventos/eventosVoluntario.php?inscricao_sucesso=true");
    exit();
} catch (PDOException $e) {
    echo 'Erro ao se inscrever: ' . $e->getMessage();
}
