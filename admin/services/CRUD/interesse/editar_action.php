<?php
    include_once('../../../config/database.php');

    $id = filter_input(INPUT_POST, 'idInteresse');
    $interesse = filter_input(INPUT_POST, 'interesse');

    try {
        $stmt = $conn->prepare("UPDATE tb_interesse SET ds_interesse = :interesse
                                        WHERE cd_interesse = :id");

        $stmt->execute(array(':id' => $id,
                            ':interesse' => $interesse));

        header("Location: ../../../views/interesses/index.php?editar_sucesso=true");
        exit();
    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }
?>
