<?php

if (!empty($_POST) && !isset($_SESSION['cadastro_realizado'])) {
    // Verificar se 'interesse' e 'icone' existem no POST
    if (isset($_POST['interesse']) && isset($_FILES['icone'])) {
        $interesse = $_POST['interesse'];
        $icone = $_FILES['icone'];
        
        // Verificar se não houve erros durante o upload
        if ($icone['error'] === UPLOAD_ERR_OK) {
            $dir = "../../../assets/img/interesses/";
            date_default_timezone_set('America/Sao_Paulo');
            $extensao = strtolower(substr($icone['name'], -4));
            $novo_nome = date("Y.m.d-H.i.s") . $extensao;
            $caminhoIMG = $dir . $novo_nome;
            $caminhoRelativo = str_replace('../../../', '/', $caminhoIMG);
            
            if (move_uploaded_file($icone['tmp_name'], $caminhoIMG)) {

                include_once('../../../config/database.php');
                
                try {
                    $stmt = $conn->prepare("INSERT INTO tb_interesse(ds_interesse, nm_icone)
                                            VALUES (:interesse, :icone)");
                    
                    $stmt->bindParam(':interesse', $interesse);
                    $stmt->bindParam(':icone',  $caminhoRelativo);
                    
                    if ($stmt->execute()) {

                        $_SESSION['cadastro_realizado'] = true;
                        
                        header("Location: ../../../views/interesses/index.php?cadastro_sucesso=true");
                        exit();
                        
                    } else {
                        echo "Erro ao cadastrar no banco de dados.";
                    }
                } catch (PDOException $e) {
                    echo "Erro ao cadastrar: " . $e->getMessage();
                }
                
                $conn = null;
            } else {
                echo "Erro ao mover o arquivo.";
            }
        } else {
            echo "Erro no upload do arquivo.";
        }
    } else {
        echo "Campos obrigatórios não preenchidos.";
    }
} else {
    echo "Nenhum dado enviado ou cadastro já realizado.";
}
?>
