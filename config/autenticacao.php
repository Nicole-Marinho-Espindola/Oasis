<?php
    // Configuração de tempo da sessão
    ini_set('session.gc_maxlifetime', 6000); // Em segundos
    ini_set('session.cookie_lifetime', 6000); // Em segundos

    session_start();

    include_once(includeURL('/config/database.php'));

    try {
        if (isset($_SESSION['email'])) {
            $email = $_SESSION['email'];

            $sql = "SELECT 
                v.nm_voluntario AS nome_usuario,
                v.nm_imagem AS imagem_usuario,
                NULL AS cnpj_ong
                FROM tb_voluntario v
                WHERE v.ds_email = :email
                UNION ALL
                SELECT
                    o.nm_ong AS nome_usuario,
                    o.nm_imagem AS imagem_usuario,
                    o.cd_cnpj AS cnpj_ong
                FROM tb_ong o
                WHERE o.ds_email = :email";

            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':email', $email);
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($row) {
                $_SESSION['nome_usuario'] = $row['nome_usuario'];
                $_SESSION['imagem_usuario'] = $row['imagem_usuario'];

                if (!empty($row['cnpj_ong'])) {
                    $_SESSION['tipo_usuario'] = 'ong';
                } else {
                    $_SESSION['tipo_usuario'] = 'voluntario';
                }
            } else {
                // Usuário não encontrado
                echo "Usuário não encontrado.";
            }
        }

        // Agora definindo a expiração da sessão

        // Vendo o tempo da última atividade em cada página
        $_SESSION['last_activity'] = time();

        // Verificar a inatividade
        if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > 600)) {
            // A sessão expirou devido à inatividade
            if (isset($_SESSION['email'])) {
                // A variável 'email' está definida, podemos destruir a sessão
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

                // Redireciona para a página de login com a mensagem de sessão expirada
                header("Location: ./index.php?sessao_expirada=true");
                exit();
            }
        }
    } catch (PDOException $e) {
        echo "Erro no banco de dados: " . $e->getMessage();
    }
?>
