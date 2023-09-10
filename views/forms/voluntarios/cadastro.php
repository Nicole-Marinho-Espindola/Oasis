<?php
    function includeURL($path = '') {
        return sprintf(
            "%s/%s/%s",
            $_SERVER['DOCUMENT_ROOT'],
            'Oasis',
            $path
        );
    }

    include_once(includeURL('/services/helpers.php'))
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/4719b1c3ae.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="<?= baseUrl('/assets/css/global.css')?>">
    <link rel="stylesheet" href="<?= baseUrl('/assets/css/navbar.css')?>">
    <link rel="stylesheet" href="<?= baseUrl('/assets/css/form.css')?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Cadastro | Oásis</title>
</head>

<section class="main-content">
    <div class="form-block">
        <div class="back-block">
            <a href="<?= baseUrl('/index.php') ?>" class="back-green-btn">
                <i class="fa-solid fa-chevron-left"></i>
            </a>
        </div>
        <form action="../../services/controllers/voluntario/cadastro_action.php" class="form">
            <div class="section active">
                <div class="form-title">
                    <h1 class="title">Criar conta</h1>
                    <div class="line line-config"></div>
                    <p class="form-subtitle">Junte-se a nós para descobrir o que temos a oferecer.</p>
                </div>
                <div class="user-info-block">
                <label class="label-style" for="">Nome
                    <div class="input-block">
                        <i class="fa-solid fa-user icon-green"></i>
                        <input class="input input-size" type="text"
                            id="nomeVoluntario" name="nomeVoluntario">
                    </div>
                </label>
                </div>
                <div class="user-info-block">
                    <label class="label-style" for="">Sobrenome
                        <div class="input-block">
                            <i class="fa-solid fa-user icon-green"></i>
                            <input class="input input-size" type="text">
                        </div>
                    </label>
                </div>
                <div class="user-info-block">
                    <label class="label-style" for="">Data de nascimento
                        <div class="input-block">
                        <i class="fa-regular fa-calendar icon-green"></i>
                            <input class="input input-size" type="text">
                        </div>
                    </label>
                </div>
                <button type="button" class="btn btn-color btn-margin" onclick="passarEtapa()">Próximo</button>
                <span class="redirecionar-login">Já tem uma conta? <a href="" class="purple-link">Entrar</a></span>
            </div> 
            <div class="section">
                <div class="form-title">
                    <h1 class="title">Selecione seus interesses</h1>
                    <div class="line line-config"></div>
                    <p class="form-subtitle">Escolha até 3 interesses (relaxa, você pode mudar depois).</p>
                </div>
                <div class="user-info-block">
                    <div class="container center-itens">
                            <div class="label-interesse">
                                <label class="label-content-int">
                                    <input type="checkbox" class="input-interesse" name="praia" id="praia">
                                    <div class="int-content">
                                        <img class="img-interesse" src="<?= baseUrl('/assets/img/palmeira.png')?>" alt="">
                                    </div>
                                    Praia
                                </label>
                            </div>
                            <div class="label-interesse">
                                <label class="label-content-int">
                                    <input type="checkbox" name="" class="input-interesse" id="natureza">
                                    <div class="int-content">
                                        <img class="img-interesse" src="<?= baseUrl('/assets/img/natureza.png')?>" alt="">
                                    </div>
                                Natureza
                            </label>
                            </div>
                            <div class="label-interesse">
                                <label class="label-content-int">
                                    <input type="checkbox" name="" class="input-interesse" id="eventos">
                                    <div class="int-content">
                                        <img class="img-interesse" src="<?= baseUrl('/assets/img/eventos.png')?>" alt="">
                                    </div>
                                    Eventos
                                </label>
                            </div>
                            <div class="label-interesse">
                                <label class="label-content-int">
                                    <input type="checkbox" name="" class="input-interesse" id="animais">
                                    <div class="int-content">
                                        <img class="img-interesse" src="<?= baseUrl('/assets/img/flamingo.png')?>" alt="">
                                    </div>
                                    Animais
                                </label>
                            </div>
                            <div class="label-interesse">
                                <label class="label-content-int">
                                    <input type="checkbox" name="" class="input-interesse" id="limpeza">
                                    <div class="int-content">
                                        <img class="img-interesse" src="<?= baseUrl('/assets/img/vassoura.png')?>" alt="">
                                    </div>
                                    Limpeza
                                </label>
                            </div>
                            <div class="label-interesse">
                                <label class="label-content-int">
                                    <input type="checkbox" name="" class="input-interesse" id="plantas">
                                    <div class="int-content">
                                        <img class="img-interesse" src="<?= baseUrl('/assets/img/lavanda.png')?>" alt="">
                                    </div>
                                    Plantas
                                </label>
                            </div>
                            <div class="label-interesse">
                                <label class="label-content-int">
                                    <input type="checkbox" name="" class="input-interesse" id="reciclagem">
                                    <div class="int-content">
                                        <img class="img-interesse" src="<?= baseUrl('/assets/img/reciclagem.png')?>" alt="">
                                    </div>
                                    Reciclagem
                                </label>
                            </div>
                            <div class="label-interesse">
                                <label class="label-content-int">
                                    <input type="checkbox" name="" class="input-interesse" id="esportes">
                                    <div class="int-content">
                                        <img class="img-interesse" src="<?= baseUrl('/assets/img/futebol.png')?>" alt="">
                                    </div>
                                    Esportes
                                </label>
                            </div>
                            <button type="button" class="btn btn-color btn-margin btn-section-config btn-back" onclick="voltarEtapa()">Voltar</button>
                            <button type="button" class="btn btn-color btn-margin btn-section-config" onclick="passarEtapa()">Próximo</button>
                    </div>
                </div>
            </div>
            <div class="section">
                    <div class="form-title">
                        <h1 class="title">Finalizar cadastro</h1>
                        <div class="line line-config"></div>
                        <p class="form-subtitle">Finalize o cadastro para ingressar no nosso Oásis.</p>
                    </div>
                    <div class="user-info-block">
                        <label class="label-style" for="">Email
                            <div class="input-block">
                                <i class="fa-regular fa-envelope icon-green"></i>
                                <input class="input input-size" type="text">
                            </div>
                        </label>
                    </div>
                    <div class="user-info-block">
                        <label class="label-style" for="">Senha
                            <div class="input-block">
                                <i class="fa-solid fa-lock"></i>
                                <input class="input" type="text">
                                <i class="fa-regular fa-eye-slash icon-green"></i>
                            </div>
                        </label>
                    </div>
                    <div class="check-block">
                        <input class="checkbox" type="checkbox" id="termos" name="check">
                        <label for="check" class="terms-label">Concordo com os <a href="" class="purple-link">termos de uso</a> e <a href="" class="purple-link">politicas de privacidade</a>.</label>
                    </div>
                    <div class="btn-sign-up-block">
                        <button type="button" class="btn btn-color btn-margin btn-section-config btn-back" onclick="voltarEtapa()">Voltar</button>
                        <button type="button" class="btn btn-color btn-margin btn-section-config">Cadastrar</button>
                    </div>
                </div>
        </form>
    </div>
    <div class="img-block">
        <img class="form-img" src="<?= baseUrl('/assets/img/Sign up-bro.png')?>" alt="">
    </div>
</section>

<script src="<?= baseUrl('/assets/js/cadastroEtapas.js') ?>"></script>
<script src="<?= baseUrl('/assets/js/validarInput.js') ?>"></script>