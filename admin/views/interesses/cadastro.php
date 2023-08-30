<?php
    include_once('../../views/includes/head.php');
?>
    <div class="content">
        <div class="form-block">
            <div class="form-title">
                <h1 class="title">Cadastro de interesses!</h1>
                <div class="line"></div>
            </div>
            <form class="form" action=<?= baseUrl('services/CRUD/interesse/cadastro_action.php') ?>
                        method="POST" id="form">
                <div class="section active">
                    <div class="user-info-block">
                        <label class="" for="">Interesse:
                            <div class="form-input-block">
                                <i class="fa-solid fa-user icon-green"></i>
                                <input class="input input-size icon-green" type="text" name="interesse" required>
                            </div>
                        </label>
                    </div>
                    <button type="submit" class="btn btn-color">Cadastrar</button>
                </div>
            </form>
        </div> 
    </div>
</body>
<script src="<?= baseUrl('/assets/js/cadastroEtapas.js') ?>"></script>