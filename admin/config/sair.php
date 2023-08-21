<?php
	session_start();//inicia a sessão
	session_unset(); //remove todas as variáveis de sessão
	session_destroy(); // destrói a sessão
	
	echo "<script>alert('volte sempre, 2bjs');</script>";

	header( "refresh:0;url=../../views/voluntarios/cadastro.php" );

?>
