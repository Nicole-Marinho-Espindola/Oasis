<?php
    include_once('../../../config/database.php');

    $id = filter_input(INPUT_POST, 'idOng');
    $nome = filter_input(INPUT_POST, 'nomeOng');
    $razao = filter_input(INPUT_POST, 'razaoOng');
    $cnpj = filter_input(INPUT_POST, 'cnpjOng');
    $email = filter_input(INPUT_POST, 'emailOng');
    $situacao = filter_input(INPUT_POST, 'situacaoOng');

    try {
        $stmt_verificar = $conn->prepare("SELECT cd_ong FROM tb_ong WHERE ds_email = :email
        AND cd_ong <> :idOng");
        $stmt_verificar->bindParam(':email', $email);
        $stmt_verificar->bindParam(':idOng', $id);  
        $stmt_verificar->execute();

            if ($stmt_verificar->rowCount() > 0) {

                header("Location: ../../../views/ongs/index.php?email_repetido=true");

            } else{

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
            }
    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }
?>
