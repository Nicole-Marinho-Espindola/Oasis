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
$nome = filter_input(INPUT_POST, 'nomeProjeto');
$descricao = filter_input(INPUT_POST, 'descricaoProjeto');
$endereco = filter_input(INPUT_POST, 'enderecoProjeto');
$data = filter_input(INPUT_POST, 'dataProjeto');
$imagem = $_FILES['imagemProjeto'];


try {
    if ($imagem['error'] === UPLOAD_ERR_OK) {
        $dir = "../../../../uploads/projetos/";
        date_default_timezone_set('America/Sao_Paulo');
        $extensao = strtolower(substr($imagem['name'], -4));
        $novo_nome = date("Y.m.d-H.i.s") . $extensao;
        $caminhoIMG = $dir . $novo_nome;
        $caminhoRelativo = str_replace('../../../../', '/', $caminhoIMG);

        if (move_uploaded_file($imagem['tmp_name'], $caminhoIMG)) {
            $stmt = $conn->prepare("UPDATE tb_projeto SET nm_titulo_projeto = :nome,
                                                ds_projeto = :descricao,
                                                ds_endereco = :endereco,
                                                dt_projeto = :dataProjeto,
                                                nm_imagem = :imagem
                                        WHERE cd_projeto = :id");

            $stmt->execute(array(':id' => $id,
                                ':nome' => $nome,
                                ':descricao' => $descricao,
                                ':endereco' => $endereco,
                                ':imagem' => $caminhoRelativo,
                                ':dataProjeto' => $data));

            header("Location: ../../../../views/pages/projetos/projetosOng.php?editar_sucesso=true");
            exit();
        }
    } else {
        // se não foi enviado um novo ícone, editar apenas o nome
        $stmtUpdate = $conn->prepare("UPDATE tb_projeto SET nm_titulo_projeto = :nome,
                                            ds_projeto = :descricao,
                                            ds_endereco = :endereco,
                                            dt_projeto = :dataProjeto
                                    WHERE cd_projeto = :id");

        $stmtUpdate->execute(array(':id' => $id,
                                    ':nome' => $nome,
                                    ':descricao' => $descricao,
                                    ':endereco' => $endereco,
                                    ':dataProjeto' => $data));

        header("Location: ../../../../views/pages/projetos/projetosOng.php?editar_sucesso=true");
        exit();
    }
} catch (PDOException $e) {
    echo 'Error: ' . $e->getMessage();
}
?>
