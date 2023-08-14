<?php
    function baseUrl($path = '') { //abertura da função que retorna a url base
        return sprintf( // ele esta retornando o retorno da função sprintf
            "%s://%s/%s%s", // formato como a string vai retornar que recebera os valores abaixo
            isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https' : 'http', // compara se é https ou http (http=off e https=on)
            $_SERVER['SERVER_NAME'], //nome do server (localhost)
            'Oasis/admin/', // pasta root
            $path
        );
    }