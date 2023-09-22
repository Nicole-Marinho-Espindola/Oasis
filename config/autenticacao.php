<?php

    include_once(includeURL('/config/database.php'));

    // Tempo máximo de inatividade (10 minutos)
    $max_inactivity = 600; // Em segundos

    // Configuração de tempo da sessão
    ini_set('session.gc_maxlifetime', $max_inactivity);
    ini_set('session.cookie_lifetime', $max_inactivity);

    session_start();

    if (!isset($_SESSION['email'])) {
        header("Location: ../index.php?acesso_negado=true");
        exit();
    }

    try {

        $email = $_SESSION['email'];

        $sql = "SELECT 
            v.nm_voluntario AS nome_usuario,
            'Voluntário' AS tipo_usuario,
            v.nm_imagem AS imagem_usuario
                FROM tb_voluntario v
                WHERE v.ds_email = :email
                UNION ALL
                SELECT
                    o.nm_ong AS nome_usuario,
                    'ONG' AS tipo_usuario,
                    o.nm_imagem AS imagem_usuario
                FROM tb_ong o
                WHERE o.ds_email = :email";


        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        //agora definindo a expiração de sessão

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
            header("Location: ../index.php?sessao_expirada=true"); // Redirecione para a página de login
            exit();
        }
    } catch (PDOException $e) {
        echo "Erro durante a verificação: " . $e->getMessage();
    }

?>