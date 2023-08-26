<?php

if (!empty($_POST) && !isset($_SESSION['cadastro_realizado'])) {
    
    $nome = $_POST['nomeOng'];
    $razao = $_POST['razaoOng'];
    $cnpj = $_POST['cnpjOng'];
    $missao = $_POST['missaoOng'];
    $celular = $_POST['celularOng'];
    $email = $_POST['emailOng'];
    $senha = $_POST['senhaOng'];

    include_once('../../../config/database.php');


    try {
        $stmt_verificar = $conn->prepare("SELECT ds_email FROM tb_ong WHERE ds_email = :email");
        $stmt_verificar->bindParam(':email', $email);
        $stmt_verificar->execute();

        if ($stmt_verificar->rowCount() > 0) {

            header("Location: ../../../views/Ongs/index.php?email_repetido=true");

        } else {
            $hashDaSenha = password_hash($senha, PASSWORD_DEFAULT);

        $stmt = $conn->prepare("INSERT INTO tb_ong(nm_ong, nm_razao, cd_cnpj, ds_missao, cd_celular_ong, ds_email, cd_senha)
                                VALUES (:nome, :razao, :cnpj, :missao, :celular, :email, :senha)");

        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':razao', $razao);
        $stmt->bindParam(':cnpj', $cnpj);
        $stmt->bindParam(':missao', $missao);
        $stmt->bindParam(':celular', $celular);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':senha', $hashDaSenha);

        $stmt->execute();

        header("Location: ../../../views/ongs/index.php?cadastro_sucesso=true");
    exit();

        }
    }catch (PDOException $e) {
        echo "Erro ao cadastrar: " . $e->getMessage();
    }

    $conn = null;

}

?>