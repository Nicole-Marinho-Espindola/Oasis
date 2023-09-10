<?php
    include_once('../includes/head.php');
    include_once('../../config/database.php');
    include_once('../../config/verificacao.php');
    include_once('search.php');
?>

<div class="content">
    <div class="search-block">
            <input class="search" id="searchInputInteresse" type="text" placeholder="Pesquisar...">

                <button class="btn" id="searchButtonInteresse">Pesquisar</button>
                <a class="link-style-none" href="<?= baseUrl('views/interesses/cadastro.php') ?>">
                    <button class="btn btn-color margin-5">Cadastrar</button>
                </a>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="<?= baseUrl('/assets/js/searchAjax.js') ?>"></script>
