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

$id = filter_input(INPUT_GET, 'id');
$idVoluntario = filter_input(INPUT_GET, 'id_voluntario');

if ($id !== null && $id !== false && $id !== '' && $idVoluntario !== null && $idVoluntario !== false && $idVoluntario !== '') {
    try {
        $delete = $conn->prepare("DELETE FROM tb_inscricao WHERE cd_evento = :id AND cd_voluntario = :id_voluntario");
        $delete->bindValue(':id', $id);
        $delete->bindValue(':id_voluntario', $idVoluntario);
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
