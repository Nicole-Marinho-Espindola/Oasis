<head>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.27/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.27/dist/sweetalert2.all.min.js"></script>
</head>

<body>


<?php
	session_start();

	if (isset($_SESSION['email'])) {
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

		echo '<script src="../../../assets/js/alerts.js"></script>';
        echo '<script>alertLogout();</script>';
        header("Refresh: 1.5; URL=http://localhost/oasis/index.php");
        exit();

	} else {
		header("Location: ../../../index.php");
		exit();

	}
?>

</body>