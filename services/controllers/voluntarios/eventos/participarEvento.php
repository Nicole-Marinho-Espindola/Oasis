<?php
session_start();

include_once('../../../../config/database.php');

$idEvento = filter_input(INPUT_POST, 'idEvento');
$idVoluntario = filter_input(INPUT_POST, 'idVoluntario');


try {
    // verificar se o voluntário já está inscrito no evento
    $stmt_verificar_inscricao = $conn->prepare("SELECT cd_inscricao FROM tb_inscricao WHERE cd_voluntario = :idVoluntario AND cd_evento = :idEvento");
    $stmt_verificar_inscricao->bindParam(':idVoluntario', $idVoluntario);
    $stmt_verificar_inscricao->bindParam(':idEvento', $idEvento);
    $stmt_verificar_inscricao->execute();

    if ($stmt_verificar_inscricao->rowCount() > 0) {
        header("Location: ../../../../views/pages/eventos/eventosVoluntario.php?inscricao_repetida=true");
        exit();
    }

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
