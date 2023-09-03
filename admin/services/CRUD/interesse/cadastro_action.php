<?php

if (!empty($_POST) && !isset($_SESSION['cadastro_realizado'])) {
    
    $interesse = $_POST['interesse'];

    include_once('../../../config/database.php');


    try {

        $stmt = $conn->prepare("INSERT INTO tb_interesse(ds_interesse)
                                VALUES (:interesse)");

        $stmt->bindParam(':interesse', $interesse);

        $stmt->execute();

        header("Location: ../../../views/interesses/index.php?cadastro_sucesso=true");
        exit();

        
    }catch (PDOException $e) {
        echo "Erro ao cadastrar: " . $e->getMessage();
    }

    }

    $conn = null;


?>