<?php

include_once('../../config/database.php');

$cod = $_POST['codigo'];
$nome = $_POST['nome'];
$cpf = $_POST['cpf'];
$rg = $_POST['rg'];
$cep = $_POST['cep'];
$num = $_POST['numero'];
$email = $_POST['email'];
$cel = $_POST['celular'];

	try
	{

		$stmt = $conn->prepare("UPDATE tb_cliente SET nm_cliente = :nome,
													cd_cpf = :cpf,
													cd_rg = :rg,
													cd_cep = :cep,
													nm_endereco = :num,
                                                    nm_email = :email,
													cd_celular = :cel WHERE cd_cliente = :cod");

		$stmt->execute(array(':cod' => $cod,
                            ':nome' => $nome,
                            ':cpf' => $cpf,
                            ':rg' => $rg,
                            ':cep' => $cep,
                            ':num' => $num,
                            ':email' => $email,
                            ':cel' => $cel));
		
		header( "refresh:0;url=consultaCliente.php" );
		echo "<script>alert('CLIENTE ALTERADO COM SUCESSO');</script>";
	}
	catch(PDOException $e)
	{
		echo 'Error: ' . $e->getMessage();
	}
?>