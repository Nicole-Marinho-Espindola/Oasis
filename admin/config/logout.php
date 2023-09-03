<?php
	session_start();

	if (isset($_SESSION['user'])) {
		session_unset(); // Remove todas as variáveis de sessão
		session_destroy(); // Destrói a sessão
		// Remove os cookies de sessão, se aplicável
		if (ini_get("session.use_cookies")) {
			$params = session_get_cookie_params();
			setcookie(session_name(), '', time() - 42000,
				$params["path"], $params["domain"],
				$params["secure"], $params["httponly"]
			);
		}

		header("Location: ../views/index.php?sair_sucesso=true");
		exit();

	} else {
		header("Location: ../views/index.php");
		exit();

	}
?>
