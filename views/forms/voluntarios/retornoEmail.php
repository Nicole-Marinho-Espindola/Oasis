<?php

    function includeURL($path = '') {
        return sprintf(
            "%s/%s/%s",
            $_SERVER['DOCUMENT_ROOT'],
            'Oasis',
            $path
        );
    }

    include_once(includeURL('/services/helpers.php'));

?>

<?php

    include_once(includeURL('/config/database.php'));

    $token_email = filter_input(INPUT_GET, "token_email", FILTER_SANITIZE_STRING);
    $id = filter_input(INPUT_GET, "cd_voluntario", FILTER_SANITIZE_STRING);

    if(!empty($token_email)){

        $stmt = $conn->prepare("SELECT cd_voluntario FROM tb_voluntario WHERE cd_token_email = :token_email LIMIT 1");
        $stmt->bindParam(':token_email', $token_email, PDO::PARAM_STR);
        $stmt->execute();

        if (($stmt) and ($stmt->rowCount() != 0)) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            extract($row);

            $stmtUpdate = $conn->prepare("UPDATE tb_voluntario SET cd_situacao = 1, cd_token_email = :token_email WHERE cd_voluntario=$id");
            $token_email = NULL;
            $stmtUpdate->bindParam(':token_email', $token_email, PDO::PARAM_STR);

            if($stmtUpdate->execute()){
                $success = true;
            }else{
                $success = false;
            }

        } else {
            $success = false;
        }

    }else{
        $success = false;

    }

    if ($success) {
        $returnData = ['deu certo amigao' => true];
    } else {
        // Em caso de erro, você pode definir uma mensagem de erro personalizada.
        $errorMessage = "deu merda.";
        $returnData = ['success' => false, 'error' => $errorMessage];
    }

?>