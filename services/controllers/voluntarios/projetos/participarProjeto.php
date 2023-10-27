<?php
session_start();

include_once('../../../../config/database.php');

$idProjeto = filter_input(INPUT_POST, 'idProjeto');
$idVoluntario = filter_input(INPUT_POST, 'idVoluntario');



try {
    $stmt_verificar = $conn->prepare("SELECT cd_voluntario FROM tb_voluntario WHERE cd_voluntario = :idVoluntario");
    $stmt_verificar->bindParam(':idVoluntario', $idVoluntario);
    $stmt_verificar->execute();

    if ($stmt_verificar->rowCount() === 0) {
        header("Location: ../../../views/pages/projetos/projetosVoluntario/index.php?voluntario_nao_existe=true");
        exit();
    }

    $stmt = $conn->prepare("INSERT INTO tb_inscricao(cd_voluntario, cd_projeto) VALUES (:idVoluntario, :idProjeto)");
    $stmt->bindParam(':idProjeto', $idProjeto);
    $stmt->bindParam(':idVoluntario', $idVoluntario);
    $stmt->execute();

    header("Location: ../../../../views/pages/projetos/projetosVoluntario.php?inscricao_sucesso=true");
    exit();
} catch (PDOException $e) {
    echo 'Erro ao se inscrever: ' . $e->getMessage();
}
