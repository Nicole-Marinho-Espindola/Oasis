<?php

    function includeURL($path = '') {
        return sprintf(
            "%s/%s/%s",
            $_SERVER['DOCUMENT_ROOT'],
            'Oasis',
            $path
        );
    }

    include_once(includeURL('/config/database.php'));
    include_once(includeURL('/services/helpers.php'));

    session_start();

    $email = filter_input(INPUT_GET, 'email', FILTER_DEFAULT);

    try {
            
        $stmt = $conn->prepare("SELECT cd_voluntario, nm_voluntario, ds_email FROM tb_voluntario WHERE ds_email = :email LIMIT 1");
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();

        if ($stmt->rowCount() != 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            date_default_timezone_set('America/Sao_Paulo');
            $dt_compartilhamento = date('Y-m-d H:i:s');

            $stmt = $conn->prepare("INSERT INTO tb_compartilhamento(cd_voluntario, dt_compartilhamento)
                                    VALUES (:voluntario, :dt_compartilhamento)");
            $stmt->bindParam(':voluntario', $row['cd_voluntario']);
            $stmt->bindParam(':dt_compartilhamento', $dt_compartilhamento);

            if ($stmt->execute()) {
                header('Location: ../../../views/pages/doe.php?compartilhar_sucesso=true');
            }

        } else {
            echo "Você precisa fazer login para compartilhar";

        }
    } catch (PDOException $e) {
        echo "Erro no banco de dados: " . $e->getMessage();
    }