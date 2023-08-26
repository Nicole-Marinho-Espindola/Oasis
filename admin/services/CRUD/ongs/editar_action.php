<?php

    include_once('../../config/database.php');

    $id = filter_input(INPUT_POST, 'cd_ong');
    $nome = filter_input(INPUT_POST, 'nomeOng');
    $razao = filter_input(INPUT_POST, 'razaoOng');
    $cnpj = filter_input(INPUT_POST, 'cnpjOng');
    $email = filter_input(INPUT_POST, 'emailOng');

    try {
        $stmt = $conn->prepare("UPDATE tb_ongs SET nm_ong = :nome,
                                                nm_razao = :razao,
                                                cd_cnpj = :cnpj,
                                                ds_email = :email
                            WHERE cd_ong = :id");

        $stmt->execute(array(':id' => $id,
                            ':nome' => $nome,
                            ':razao' => $razao,
                            ':cnpj' => $cnpj,
                            ':email' => $email));

        header("Location: " . baseUrl('views/ongs/index.php?editar_sucesso=true'));
        exit();
    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }
        
?>
