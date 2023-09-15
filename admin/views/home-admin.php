<?php

    include_once('./includes/head.php');
    include_once('../config/autenticacao.php');
    
?>

<div class="grid">
    <div class="text-block">
        <div class="title-block">
            <h1>Bem vindo de volta!</h1>
            <div class="line"></div>
        </div>
        <p class="paragraph-text">Sinta-se livre para usufruir de todas as funções que o
        painel do admin dispõe para a sua empresa, melhorando assim a experiencia de seus usuarios!</p>
        <div class="saiba-mais">
            <a href="https://planejadorweb.com.br/painel-administrativo-wordpress-wp-admin/" target="_blank" class="center-itens saiba-mais-content"><i class="fa-solid fa-angle-right icon arrow-icon"></i> Saiba mais sobre as funcionalidades do painel</a>
        </div>
    </div>
    <div class="img-section">
        <img class="img-size" src=<?= baseUrl('assets/img/Admin-bro.png') ?> alt="">
    </div>
</div>