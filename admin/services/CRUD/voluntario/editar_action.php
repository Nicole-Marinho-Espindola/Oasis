<?php

    include_once('../../config/database.php');

    $nome = filter_input(INPUT_POST, 'nm_voluntario');
    $sobrenome = filter_input(INPUT_POST, 'nm_sobrenome');
    $dt_nasc = filter_input(INPUT_POST, 'dt_nasc');
    $email = filter_input(INPUT_POST, 'email');
    $senha = filter_input(INPUT_POST, 'senha');
    

	try
	{

		$stmt = $conn->prepare("UPDATE tb_cliente SET nm_voluntario, nm_sobrenome, dt_nascimento, ds_email, cd_senha where 

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