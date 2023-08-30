<?php
    include_once('../../views/includes/head.php');
    include_once('../../assets/mocks/interesse.php');

    $id = $_GET['id'];

    $interesse = [];
    foreach( $interesses as $int){
        if( $id == $int['id']){
            $interesse = $int;
            break;
        }
    }
?>
    <div class="content">
        <div class="form-block">
            <div class="form-title">
                <h1 class="title">Editar de interesse!</h1>
                <div class="line"></div>
            </div>
            <form class="form" action="">
                <input type="hidden" name="id" value="<?= $interesse['id']?>">
                <div class="section active">
                    <div class="user-info-block">
                        <label class="" for="">Interesse:
                            <div class="input-block">
                                <i class="fa-solid fa-user icon-green"></i>
                                <input class="input input-size icon-green" type="text" value="<?= $interesse['interesse']?>" name="interesse">
                            </div>
                        </label>
                    </div>
                    <button type="submit" class="btn btn-color">Enviar</button>
                </div>
            </form>
        </div> 
    </div>
</body>
<script src="<?= baseUrl('/assets/js/cadastroEtapas.js') ?>"></script>