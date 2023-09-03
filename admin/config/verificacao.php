<?php
session_start();

if (!isset($_SESSION['email'])) {
    header("Location: ../views/index.php?acesso_negado=true");
    exit();
}

include_once('database.php');

try {
    $sql = $conn->prepare("SELECT ds_email FROM tb_voluntario WHERE ds_email = :email");
    $sql->bindParam(':email', $_SESSION['email']);
    $sql->execute();
    $row = $sql->fetch();

    if (!$row) {
        header("Location: ../views/index.php?acesso_negado=true");
        exit();
    }
} catch (PDOException $e) {
    echo "Erro durante a verificação: " . $e->getMessage();
}
?>
