
<?php
    include_once('../../views/includes/head.php');
    include_once('../../assets/mocks/ongs.php');

    $id = $_GET['id'];

    $ong = [];
    foreach( $ONG as $ongs){
        if( $id == $ongs['id']){
            $ong = $ongs;
            break;
        }
    }
?>

<link rel="stylesheet" href="<?= baseUrl('/assets/css/form.css') ?>">
    <div class="content">
        <div class="form-block">
            <input type="hidden" name="id" value="<?= $ong['id']?>">
            <div class="form-title">
                <h1 class="title">Cadastro de ONGS!</h1>
                <div class="line"></div>
            </div>
            <form class="form" action="">
                <div class="section active">
                    <div class="user-info-block">
                        <label class="" for="">Nome:
                            <div class="form-input-block">
                                <i class="fa-solid fa-user icon-green"></i>
                                <input class="input input-size icon-green" name="nome" type="text" value="<?= $ong['nome']?>">
                            </div>
                        </label>
                    </div>
                    <div class="user-info-block">
                        <label class="" for="">Razão social:
                            <div class="form-input-block">
                                <i class="fa-solid fa-user icon-green"></i>
                                <input class="input input-size" name="sobrenome" type="text" value="<?= $ong['razao']?>">
                            </div>
                        </label>
                    </div>
                    <div class="user-info-block">
                        <label class="" for="">CNPJ:
                            <div class="form-input-block">
                            <i class="fa-regular fa-calendar icon-green"></i>
                                <input class="input input-size" name="idade" type="text" value="<?= $ong['cnpj']?>">
                            </div>
                        </label>
                    </div> 
                    <button type="button" class="btn btn-color" onclick="passarEtapa()">Próximo</button>
                </div>
                <div class="section">
                    <div class="user-info-block">
                        <label class="" for="">Email:
                            <div class="form-input-block">
                                <i class="fa-regular fa-envelope icon-green"></i>
                                <input class="input input-size" name="email" type="text" value="<?= $ong['email']?>">
                            </div>
                        </label>
                    </div>
                    <div class="user-info-block">
                        <label for="">Senha:
                            <div class="form-input-block">
                                <i class="fa-solid fa-lock"></i>
                                <input class="input" name="senha" type="text" value="<?= $ong['senha']?>">
                                <i class="fa-regular fa-eye-slash icon-green"></i>
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

