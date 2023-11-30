<?php
// Configuração de tempo da sessão
ini_set('session.gc_maxlifetime', 6000); // Em segundos
ini_set('session.cookie_lifetime', 6000); // Em segundos

session_start();

include_once(includeURL('/config/database.php'));

try {
    // Lógica para verificar o tipo de usuário
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
    $_SESSION['last_activity'] = time();

    // Verificar a inatividade e redirecionar se necessário
    if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > 600)) {
        session_unset();
        session_destroy();

        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(
                session_name(),
                '',
                time() - 42000,
                $params["path"],
                $params["domain"],
                $params["secure"],
                $params["httponly"]
            );
        }

        header("Location: ./index.php?sessao_expirada=true");
        exit();
    }

    // Verificar acesso à página Ong.php
    $paginaAtual = basename($_SERVER['PHP_SELF']);

    if (strpos($paginaAtual, 'Ong.php') !== false) {
        if (!isset($_SESSION['email']) || $_SESSION['tipo_usuario'] !== 'ong') {
            echo "<script>alert('Entrada não permitida.'); window.history.back();</script>";
            exit();
        }
    }

    // Verificar se o usuário está logado para evitar erros de "Undefined array key"
    if (isset($_SESSION['tipo_usuario'])) {
        // Verificar se a página é acessível ao tipo de usuário
        if ($_SESSION['tipo_usuario'] === 'voluntario') {
            if (strpos($paginaAtual, 'Ong.php') !== false) {
                // Se for voluntário e tentar acessar uma página não permitida, redirecione para página de voluntários.
                echo "<script>alert('Página não permitida para voluntários.'); window.history.back();</script>";
                exit();
            }
        // } elseif ($_SESSION['tipo_usuario'] === 'ong') {
        //     if (strpos($paginaAtual, 'Ong.php') !== false) {
        //         // O usuário é uma ONG e está tentando acessar uma página permitida para ONGs.
        //         // Permite o acesso à página das ONGs.
        //         // Continua com o restante do código ou redireciona para a página das ONGs.
        //     } elseif (strpos($paginaAtual, 'Voluntario.php') !== false) {
        //         // Se for ONG e tentar acessar uma página não permitida, redirecione para página de ONGs.
        //         echo "<script>alert('Página não permitida para ONGs.'); window.history.back();</script>";
        //         exit();
        //     }
        }
    }
} catch (PDOException $e) {
    echo "Erro no banco de dados: " . $e->getMessage();
}
