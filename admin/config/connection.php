<?php

//conexão com o banco

    $conn = new PDO(
        "mysql:host=" . getenv('DB_HOST') . ";dbname=" . getenv('DB_NAME'),
        getenv('DB_USER'),
        getenv('DB_PWD'));

    try {
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e)   {
            die("Erro na conexão com o banco de dados: " . $e->getMessage());
                                    }

?>