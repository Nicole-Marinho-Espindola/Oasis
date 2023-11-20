<?php
    function includeURL($path = '') {
        return sprintf(
            "%s/%s/%s",
            $_SERVER['DOCUMENT_ROOT'],
            'Oasis',
            $path
        );
    }

    include_once(includeURL('config/database.php'));

    $id = filter_input(INPUT_GET, 'cd_evento');

    if ($id !== null && $id !== false && $id !== '') {
        try {
            $delete = $conn->prepare("DELETE FROM tb_evento WHERE cd_evento = :id");
            $delete->bindValue(':id', $id);
            $delete->execute();

            header("Location: ../../../../views/pages/eventos/eventosOng.php?excluir_sucesso=true");
            exit();
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    } else {
        echo 'ID inválido ou ausente';
    }
?>
