<?php

    include_once('../../../config/database.php');

    $id = filter_input(INPUT_POST, 'cd_voluntario');
    $nome = filter_input(INPUT_POST, 'nomeVoluntario');
    $sobrenome = filter_input(INPUT_POST, 'sobrenomeVoluntario');
    $dt_nasc = filter_input(INPUT_POST, 'nascimentoVoluntario');
    $email = filter_input(INPUT_POST, 'emailVoluntario');
    
	try
	{

		$stmt = $conn->prepare("UPDATE tb_voluntario SET nm_voluntario = :nome,
                                                        nm_sobrenome = :sobrenome,
                                                        dt_nascimento = :dt_nasc,
                                                        ds_email = :email
                                                        WHERE cd_voluntario = :id");

		$stmt->execute(array(':id' => $id,
                            ':nome' => $nome,
                            ':sobrenome' => $sobrenome,
                            ':dt_nasc' => $dt_nasc,
                            ':email' => $email));

        header("Location: ../../../views/voluntarios/index.php?editar_sucesso=true");
        exit();
                            
	}
	catch(PDOException $e)
	{
		echo 'Error: ' . $e->getMessage();
	}
    
?>