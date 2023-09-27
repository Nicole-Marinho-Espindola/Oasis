<?php
    include_once('../../../config/database.php');

    $id = filter_input(INPUT_POST, 'idOng');
    $nome = filter_input(INPUT_POST, 'nomeOng');
    $razao = filter_input(INPUT_POST, 'razaoOng');
    $cnpj = filter_input(INPUT_POST, 'cnpjOng');
    $email = filter_input(INPUT_POST, 'emailOng');
    $situacao = filter_input(INPUT_POST, 'situacaoOng');

    try {
        $stmt = $conn->prepare("UPDATE tb_ong SET nm_ong = :nome,
                                                nm_razao = :razao,
                                                cd_cnpj = :cnpj,
                                                ds_email = :email,
                                                cd_situacao = :situacao
                                        WHERE cd_ong = :id");

        $stmt->execute(array(':id' => $id,
                            ':nome' => $nome,
                            ':razao' => $razao,
                            ':cnpj' => $cnpj,
                            ':email' => $email,
                            ':situacao' => $situacao));

        header("Location: ../../../views/ongs/index.php?editar_sucesso=true");
        exit();
    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }
?>
