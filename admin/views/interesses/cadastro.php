<?php
    include_once('../../views/includes/head.php');
    include_once('../../config/autenticacao.php');
?>
    <div class="content">
        <div class="form-block">
            <div class="form-title">
                <h1 class="title">Cadastro de interesses!</h1>
                <div class="line"></div>
            </div>
            <form class="form" action=<?= baseUrl('services/CRUD/interesse/cadastro_action.php') ?>
                        method="POST" id="form" enctype="multipart/form-data">
                <div class="section active">
                    <div class="user-info-block">
                        <label class="" for="">Interesse:
                            <div class="input-block">
                                <i class="fa-solid fa-user icon-green"></i>
                                <input class="input input-size icon-green" type="text" name="interesse" required>
                            </div>
                        </label>
                    </div>
                    <div class="user-info-block">
                        <label class="" for="">Ícone:
                            <div class="input-block">
                            <!-- precisa colocar o icone para os interesses aqui -->
                                <i class="fa-solid fa-user icon-green"></i> 
                                <input class="input input-size icon-green" type="file" name="icone" required>
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