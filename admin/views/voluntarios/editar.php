<?php
    include_once('../../views/includes/head.php');
?>

<link rel="stylesheet" href="<?= baseUrl('/assets/css/form.css') ?>">

    <div class="content">
        <div class="form-block">
            <input type="hidden" name="id" value="<?= $voluntario['id']?>">
            <div class="form-title">
                <h1 class="title">Cadastro de voluntarios!</h1>
                <div class="line"></div>
            </div>
            <form class="form" action="">
                <div class="section active">
                    <div class="user-info-block">
                        <label class="" for="">Nome:
                            <div class="form-input-block">
                                <i class="fa-solid fa-user icon-green"></i>
                                <input class="input input-size icon-green" name="nome" type="text" value="<?= $voluntario['interesse']?>">
                            </div>
                        </label>
                    </div>
                    <div class="user-info-block">
                        <label class="" for="">Sobrenome:
                            <div class="form-input-block">
                                <i class="fa-solid fa-user icon-green"></i>
                                <input class="input input-size" name="sobrenome" type="text">
                            </div>
                        </label>
                    </div>
                    <div class="user-info-block">
                        <label class="" for="">Data de nascimento:
                            <div class="form-input-block">
                            <i class="fa-regular fa-calendar icon-green"></i>
                                <input class="input input-size" name="nascimento" type="text">
                            </div>
                        </label>
                    </div> 
                    <button type="button" class="btn btn-color" onclick="passarEtapa()">Próximo</button>
                </div>
                <div class="section">
                    <div class="user-info-block">
                        <div class="center-itens subtitle-block">
                            <span class="subtitle">Selecione 3 interesses:</span>
                            <div class="line line-thin"></div>
                        </div>
                        <div class="container">
                                <div class="label-interesse">
                                    <input type="checkbox" name="praia" id="praia">
                                    <label for="praia">Praia</label>
                                </div>
                                <div class="label-interesse">
                                    <input type="checkbox" name="ambiente" id="ambiente">
                                    <label for="ambiente">Meio ambiente</label>
                                </div>
                                <div class="label-interesse">
                                    <input type="checkbox" name="limpeza" id="limpeza">
                                    <label for="limpeza">Limpeza na praia</label>
                                </div>
                                <div class="label-interesse">
                                    <input type="checkbox" name="esportes" id="esportes">
                                    <label for="esportes">Esportes na praia</label>
                                </div>
                                <div class="label-interesse">
                                    <input type="checkbox" name="eventos" id="eventos">
                                    <label for="eventos">Eventos</label>
                                </div>
                                <div class="label-interesse">
                                    <input type="checkbox" name="natureza" id="natureza">
                                    <label for="natureza">Cuidar da natureza</label>
                                </div>
                                <div class="label-interesse">
                                    <input type="checkbox" name="plantas" id="plantas">
                                    <label for="plantas">Cuidar das plantas</label>
                                </div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-color" onclick="passarEtapa()">Próximo</button>
                </div>
                <div class="section">
                    <div class="user-info-block">
                        <label class="" for="">Email:
                            <div class="form-input-block">
                                <i class="fa-regular fa-envelope icon-green"></i>
                                <input class="input input-size" name="email" type="text">
                            </div>
                        </label>
                    </div>
                    <div class="user-info-block">
                        <label for="">Senha:
                            <div class="form-input-block">
                                <i class="fa-solid fa-lock"></i>
                                <input class="input" name="senha" type="text">
                                <i class="fa-regular fa-eye-slash icon-green"></i>
                            </div>
                        </label>
                    </div>
                    <button type="submit" class="btn btn-color">Cadastrar</button>
                </div>
                <!-- <button class="btn btn-color">Entrar</button> -->
            </form>
        </div> 
    </div>
</body>
<script src="<?= baseUrl('/assets/js/cadastroEtapas.js') ?>"></script>

