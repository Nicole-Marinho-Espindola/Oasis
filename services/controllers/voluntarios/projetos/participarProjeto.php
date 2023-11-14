<?php
    session_start();

    include_once('../../../../config/database.php');

    $idProjeto = filter_input(INPUT_POST, 'idProjeto');
    $idVoluntario = filter_input(INPUT_POST, 'idVoluntario');

    try {
        // verificar se o voluntário já está inscrito no projeto
        $stmt_verificar_inscricao = $conn->prepare("SELECT cd_inscricao FROM tb_inscricao WHERE cd_voluntario = :idVoluntario AND cd_projeto = :idProjeto");
        $stmt_verificar_inscricao->bindParam(':idVoluntario', $idVoluntario);
        $stmt_verificar_inscricao->bindParam(':idProjeto', $idProjeto);
        $stmt_verificar_inscricao->execute();

        if ($stmt_verificar_inscricao->rowCount() > 0) {
            header("Location: ../../../../views/pages/projetos/projetosVoluntario.php?inscricao_repetida=true");
            exit();
        }

        // verificar se o voluntário existe
        $stmt_verificar_voluntario = $conn->prepare("SELECT cd_voluntario FROM tb_voluntario WHERE cd_voluntario = :idVoluntario");
        $stmt_verificar_voluntario->bindParam(':idVoluntario', $idVoluntario);
        $stmt_verificar_voluntario->execute();

        if ($stmt_verificar_voluntario->rowCount() === 0) {
            header("Location: ../../../../views/pages/projetos/projetosVoluntario.php?inscricao_sucesso=false");
            exit();
        }

        $stmt_inscricao = $conn->prepare("INSERT INTO tb_inscricao(cd_voluntario, cd_projeto) VALUES (:idVoluntario, :idProjeto)");
        $stmt_inscricao->bindParam(':idProjeto', $idProjeto);
        $stmt_inscricao->bindParam(':idVoluntario', $idVoluntario);
        $stmt_inscricao->execute();

        header("Location: ../../../../views/pages/projetos/projetosVoluntario.php?inscricao_sucesso=true");
        exit();
    } catch (PDOException $e) {
        echo 'Erro ao se inscrever: ' . $e->getMessage();
    }
?>