<?php

    // Tempo máximo de inatividade (10 minutos)
    $max_inactivity = 300; // Em segundos

    // Configuração de tempo da sessão
    ini_set('session.gc_maxlifetime', $max_inactivity);
    ini_set('session.cookie_lifetime', $max_inactivity);

    session_start();

    if (!isset($_SESSION['user'])) {
        header("Location: ../../views/index.php?acesso_negado=true");
        exit();
    }

    try {

        require_once 'lib/vendor/autoload.php';

        $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
        $dotenv->load();

        // Definindo o usuário
        $usuarioAdmin = $_ENV['LOGIN_USER'];

        if ($_SESSION['user'] !== $usuarioAdmin) {
            header("Location: ../../views/index.php?acesso_negado=true");
            exit();
        }

        // vendo o tempo da última atividade em cada página
        $_SESSION['last_activity'] = time();

        // Verificar a inatividade
        if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > $max_inactivity)) {
            // A sessão expirou devido à inatividade
            session_unset();
            session_destroy();
            // Remove os cookies de sessão, se aplicável
            if (ini_get("session.use_cookies")) {
                $params = session_get_cookie_params();
                setcookie(session_name(), '', time() - 42000,
                    $params["path"], $params["domain"],
                    $params["secure"], $params["httponly"]
                );
            }
            header("Location: ../../views/index.php?sessao_expirada=true"); // Redirecione para a página de login
            exit();
        }
    } catch (PDOException $e) {
        echo "Erro durante a verificação: " . $e->getMessage();
    }

?>