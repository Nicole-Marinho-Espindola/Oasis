<?php

	session_unset(); //remove todas as variáveis de sessão
	session_destroy(); // destrói a sessão

	header("Location: ../../../views/index.php");

?>
