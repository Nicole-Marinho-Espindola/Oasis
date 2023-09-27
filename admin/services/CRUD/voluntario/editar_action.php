<?php

    include_once('../../../config/database.php');

    $idVoluntario = filter_input(INPUT_POST, 'idVoluntario');
    $nome = filter_input(INPUT_POST, 'nomeVoluntario');
    $sobrenome = filter_input(INPUT_POST, 'sobrenomeVoluntario');
    $dt_nasc = filter_input(INPUT_POST, 'nascimentoVoluntario');
    $email = filter_input(INPUT_POST, 'emailVoluntario');
    $situacao = filter_input(INPUT_POST, 'situacaoVoluntario');
    $interesses = $_POST['interesses'];

    try {
        $stmt = $conn->prepare("UPDATE tb_voluntario SET nm_voluntario = :nome,
                                                        nm_sobrenome = :sobrenome,
                                                        dt_nascimento = :dt_nasc,
                                                        ds_email = :email,
                                                        cd_situacao = :situacao
                                                        WHERE cd_voluntario = :id");

        $stmt->execute(array(':id' => $idVoluntario,
                            ':nome' => $nome,
                            ':sobrenome' => $sobrenome,
                            ':dt_nasc' => $dt_nasc,
                            ':email' => $email,
                            ':situacao' => $situacao,));

        // Remove os interesses antigos do voluntário
        $stmtDelete = $conn->prepare("DELETE FROM tb_escolha WHERE cd_voluntario = :id");
        $stmtDelete->bindParam(':id', $idVoluntario);
        $stmtDelete->execute();

        // Insere os novos interesses do voluntário
        $stmtInsert = $conn->prepare("INSERT INTO tb_escolha(cd_voluntario, cd_interesse) 
                            VALUES (:idVoluntario, :idInteresse)");

        foreach ($interesses as $idInteresse) {
            $stmtInsert->bindParam(':idVoluntario', $idVoluntario);
            $stmtInsert->bindParam(':idInteresse', $idInteresse);
            $stmtInsert->execute();
        }


        header("Location: ../../../views/voluntarios/index.php?editar_sucesso=true");
        exit();
    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }

?>
