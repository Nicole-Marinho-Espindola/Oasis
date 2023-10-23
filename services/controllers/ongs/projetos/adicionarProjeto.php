<?php

    include_once('../../../../config/database.php');

    $idong = filter_input(INPUT_POST, 'id');
    $titulo = filter_input(INPUT_POST, 'nomeProjeto');
    $descricao = filter_input(INPUT_POST, 'descricaoProjeto');
    $endereco = filter_input(INPUT_POST, 'enderecoProjeto');
    $data = filter_input(INPUT_POST, 'dataProjeto');
    $imagem = $_FILES['imagemProjeto'];

    try {
        $stmt_verificar = $conn->prepare("SELECT cd_ong FROM tb_ong WHERE ds_email = :email AND cd_ong != :id");
        $stmt_verificar->bindParam(':email', $email);
        $stmt_verificar->bindParam(':id', $idong);
        $stmt_verificar->execute();

        if ($imagem['error'] === UPLOAD_ERR_OK) {
            $dir = "../../../../uploads/projetos/";
            date_default_timezone_set('America/Sao_Paulo');
            $extensao = strtolower(substr($imagem['name'], -4));
            $novo_nome = date("Y.m.d-H.i.s") . $extensao;
            $caminhoIMG = $dir . $novo_nome;
            $caminhoRelativo = str_replace('../../../../', '/', $caminhoIMG);

            // Move a foto para a pasta
            if (move_uploaded_file($imagem['tmp_name'], $caminhoIMG)) {
                $stmt = $conn->prepare("INSERT INTO tb_projeto(cd_ong, nm_titulo_projeto, cd_telefone_contato, ds_projeto, ds_endereco, dt_projeto, nm_imagem)
                                    VALUES (:idong, :titulo, :telefone, :descricao, :endereco, :dt, :imagem)");
                $stmt->bindParam(':idong', $idong);
                $stmt->bindParam(':titulo', $titulo);
                $stmt->bindParam(':telefone', $telefone);
                $stmt->bindParam(':descricao', $descricao);
                $stmt->bindParam(':endereco', $endereco);
                $stmt->bindParam(':dt', $data);
                $stmt->bindParam(':imagem', $caminhoRelativo);
                $stmt->execute();

                header("Location: ../../../../views/pages/projetos/projetosOng.php?projeto_sucesso=true");

            }
        } else {
            // Se nenhuma imagem for enviada, avise que deu erro
            header("Location: ../../../../views/pages/projetos/projetosOng.php?projeto_sucesso=false");
        }
    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }

?>