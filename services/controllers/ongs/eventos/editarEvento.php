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

$id = filter_input(INPUT_POST, 'id');
$nome = filter_input(INPUT_POST, 'nomeEvento');
$descricao = filter_input(INPUT_POST, 'descricaoEvento');
$endereco = filter_input(INPUT_POST, 'enderecoEvento');
$data = filter_input(INPUT_POST, 'dataEvento');
$imagem = $_FILES['imagemEvento'];

try {
    if ($imagem['error'] === UPLOAD_ERR_OK) {
        $dir = "../../../../uploads/eventos/";
        date_default_timezone_set('America/Sao_Paulo');
        $extensao = strtolower(substr($imagem['name'], -4));
        $novo_nome = date("Y.m.d-H.i.s") . $extensao;
        $caminhoIMG = $dir . $novo_nome;
        $caminhoRelativo = str_replace('../../../../', '/', $caminhoIMG);

        if (move_uploaded_file($imagem['tmp_name'], $caminhoIMG)) {
            $stmt = $conn->prepare("UPDATE tb_evento SET nm_titulo_evento = :nome,
                                                ds_evento = :descricao,
                                                ds_endereco = :endereco,
                                                dt_evento = :dataEvento,
                                                nm_imagem = :imagem
                                        WHERE cd_evento = :id");

            $stmt->execute(array(':id' => $id,
                                ':nome' => $nome,
                                ':descricao' => $descricao,
                                ':endereco' => $endereco,
                                ':imagem' => $caminhoRelativo,
                                ':dataEvento' => $data));

            header("Location: ../../../../views/pages/eventos/eventosOng.php?editar_sucesso=true");
            exit();
        }
    } else {
        // se não foi enviado uma nova foto, editar o resto
        $stmtUpdate = $conn->prepare("UPDATE tb_evento SET nm_titulo_evento = :nome,
                                            ds_evento = :descricao,
                                            ds_endereco = :endereco,
                                            dt_evento = :dataEvento
                                    WHERE cd_evento = :id");

        $stmtUpdate->execute(array(':id' => $id,
                                    ':nome' => $nome,
                                    ':descricao' => $descricao,
                                    ':endereco' => $endereco,
                                    ':dataEvento' => $data));

            header("Location: ../../../../views/pages/eventos/eventosOng.php?editar_sucesso=true");
        exit();
    }
} catch (PDOException $e) {
    echo 'Error: ' . $e->getMessage();
}
?>
