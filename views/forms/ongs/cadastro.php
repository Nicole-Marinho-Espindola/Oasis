<?php
    function includeURL($path = '') {
        return sprintf(
            "%s/%s/%s",
            $_SERVER['DOCUMENT_ROOT'],
            'Oasis',
            $path
        );
    }

    include_once(includeURL('/config/database.php'));
    include_once(includeURL('/services/helpers.php'));
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
        <form action="<?= baseUrl('/services/controllers/ongs/cadastro_action.php') ?>" method="POST"
                    class="form">
            <div class="section active">
                <div class="form-title">
                    <h1 class="title">Criar conta</h1>
                    <div class="line line-config"></div>
                    <p class="form-subtitle">Junte-se a nós para descobrir o que temos a oferecer.</p>
                </div>
                <div class="user-info-block">
                <label class="label-style" for="">Nome
                    <div class="input-block required">
                        <i class="fa-solid fa-user icon-green"></i>
                        <input class="input input-size" type="text"
                            id="nomeOng" name="nomeOng" oninput="nameValidate()" value="Sereia Azul">
                    </div>
                    <span class="span-required">O nome deve conter mais de 3 letras</span>
                </label>
                </div>
                <div class="user-info-block">
                    <label class="label-style" for="">Razão social
                        <div class="input-block">
                            <i class="fa-solid fa-users-between-lines icon-green"></i>
                            <input class="input input-size" type="text"
                            id="razaoOng" name="razaoOng" value="Grupo Sereia Azul">
                        </div>
                    </label>
                </div>
                <div class="user-info-block">
                    <label class="label-style" for="">Missão
                        <div class="input-block">
                            <i class="fa-solid fa-rocket icon-green"></i>
                            <input class="input input-size" type="text"
                            id="missaoOng" name="missaoOng" value="Ajudar o mundo por meio do voluntariado ambiental">
                        </div>
                    </label>
                </div>
                <button type="button" class="btn btn-color btn-margin" onclick="passarEtapa()">Próximo</button>
                <span class="redirecionar-login">Já tem uma conta? <a href="../login.php" class="purple-link">Entrar</a></span>            </div> 
            <div class="section">
                <div class="form-title">
                    <h1 class="title">Últimos passos</h1>
                    <div class="line line-config"></div>
                    <p class="form-subtitle">Falta pouco para você fazer parte do nosso Oásis!</p>
                </div>
                <div class="user-info-block">
                <label class="label-style" for="">CNPJ
                    <div class="input-block">
                        <i class="fa-solid fa-address-card icon-green"></i>
                        <input class="input input-size" type="number"
                            id="cnpjOng" name="cnpjOng" value="00.520.304/0001-80.">
                    </div>
                </label>
                </div>
                <div class="user-info-block">
                    <label class="label-style" for="">Endereço
                        <div class="input-block">
                            <i class="fa-solid fa-location-dot icon-green"></i>
                            <input class="input input-size" type="text"
                            id="enderecoOng" name="enderecoOng" value="Praia Grande, Cidade Ocian">
                        </div>
                    </label>
                </div>
                <div class="user-info-block">
                    <label class="label-style" for="">Celular
                        <div class="input-block">
                            <i class="fa-solid fa-phone icon-green"></i>
                            <input class="input input-size" type="number"
                            id="celularOng" name="celularOng" value="(13)99153-3252">
                        </div>
                    </label>
                </div>
                <div class="btn-form-position">
                    <button type="button" class="btn btn-color btn-margin btn-section-config btn-back" onclick="voltarEtapa()">Voltar</button>
                    <button type="button" class="btn btn-color btn-margin btn-section-config" onclick="passarEtapa()">Próximo</button>
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
                                <input class="input input-size" type="email"
                                id="emailOng" name="emailOng" requerid value="sereiaazul@gmail.com">
                            </div>
                        </label>
                    </div>
                    <div class="user-info-block">
                        <label class="label-style" for="">Senha
                            <div class="input-block">
                                <i class="fa-solid fa-lock icon-green"></i>
                                <input class="input" type="password"
                                id="senhaOng" name="senhaOng" required value="123">
                                <!-- <i class="fa-regular fa-eye-slash icon-green"></i> -->
                            </div>
                        </label>
                    </div>
                    <div class="check-block">
                        <input class="checkbox" type="checkbox" id="termos" name="check" required>
                        <label for="check" class="terms-label">Concordo com os <a href="" class="purple-link">termos de uso</a> e <a href="" class="purple-link">politicas de privacidade</a>.</label>
                    </div>
                    <div class="btn-sign-up-block">
                        <button type="button" class="btn btn-color btn-margin btn-section-config btn-back" onclick="voltarEtapa()">Voltar</button>
                        <button type="submit" class="btn btn-color btn-margin btn-section-config">Cadastrar</button>
                    </div>
                </div>
        </form>
    </div>
    <div class="img-block">
        <img class="form-img" src="<?= baseUrl('/assets/img/Sign up-pana.png')?>" alt="">
    </div>
</section>

<script src="<?= baseUrl('/assets/js/cadastroEtapas.js') ?>"></script>
<script src="<?= baseUrl('/assets/js/validarInput.js') ?>"></script>