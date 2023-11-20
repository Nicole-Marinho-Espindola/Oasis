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

    $id = filter_input(INPUT_GET, 'cd_projeto');

    if ($id !== null && $id !== false && $id !== '') {
        try {
            $delete = $conn->prepare("DELETE FROM tb_projeto WHERE cd_projeto = :id");
            $delete->bindValue(':id', $id);
            $delete->execute();

            header("Location: ../../../../views/pages/projetos/projetosOng.php?excluir_sucesso=true");
            exit();
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    } else {
        echo 'ID inválido ou ausente';
    }
?>
