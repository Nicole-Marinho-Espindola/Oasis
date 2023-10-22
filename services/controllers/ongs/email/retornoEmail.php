<?php

function includeURL($path = '')
{
    return sprintf(
        "%s/%s/%s",
        $_SERVER['DOCUMENT_ROOT'],
        'Oasis',
        $path
    );
}

include_once(includeURL('/config/database.php'));

$token_email = filter_input(INPUT_GET, "token_email", FILTER_SANITIZE_STRING);
$redirecionamento = "http://localhost/oasis/index.php";

try {
    $conn->beginTransaction();

    $stmt = $conn->prepare("SELECT v.cd_ong
                                FROM tb_ong v
                                JOIN tb_token_ong t ON v.cd_ong = t.cd_ong
                                WHERE t.ds_token = :token_email AND t.cd_tipo_token = 1 AND t.cd_token_usado = 0 LIMIT 1");
    $stmt->bindParam(':token_email', $token_email, PDO::PARAM_STR);
    $stmt->execute();

    if ($stmt->rowCount() === 1) {
        $stmtUpdate = $conn->prepare("UPDATE tb_ong v
                                        INNER JOIN tb_token_ong t ON v.cd_ong = t.cd_ong
                                        SET v.cd_situacao = 1, t.cd_token_usado = 1
                                        WHERE t.ds_token = :token_email");
        $stmtUpdate->bindParam(':token_email', $token_email, PDO::PARAM_STR);

        if ($stmtUpdate->execute()) {
            $conn->commit();
            echo '<script src="../../../../assets/js/alerts.js"></script>';
            echo '<script>alertEmailConfirm();</script>';
            header("Refresh: 1.5; URL=http://localhost/oasis/index.php");
            exit();
        } else {
            echo '<script src="../../../../assets/js/alerts.js"></script>';
            echo '<script>alertEmailFail();</script>';
            header("Refresh: 1.5; URL=http://localhost/oasis/index.php");
            exit();
        }
    } else {
        echo '<script src="../../../../assets/js/alerts.js"></script>';
        echo '<script>alertEmailFail();</script>';
        header("Refresh: 1.5; URL=http://localhost/oasis/index.php");
        exit();
    }

    $conn->commit();
} catch (PDOException $e) {
    $conn->rollBack();
    echo "Algo deu errado: " . $e->getMessage();
}
