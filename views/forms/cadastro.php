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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/4719b1c3ae.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../../assets/css/global.css">
    <link rel="stylesheet" href="../../assets/css/navbar.css">
    <link rel="stylesheet" href="../../assets/css/form.css">
    <title>Form | Cadastro</title>
</head>
<body>
    <div class="main-content">
        <div class="form-block">
            <div class="form-title-block">
                <div class="logo-block">
                    <a href="<?= baseUrl('/views/index.php') ?>" class="back-green-btn">
                        <i class="fa-solid fa-chevron-left"></i>
                    </a>
                    <a href="<?= baseUrl('/views/index.php') ?>" class="back-span">Voltar</a>
                </div>
                <div class="form-title">
                    <h1 class="title">Criar conta</h1>
                    <div class="line line-config"></div>
                    <p class="form-subtitle">Junte-se a nós para descobrir o que temos a oferecer.</p>
                </div>
            </div>
            
            <form class="form" action="">
                <div class="section active">
                    <div class="user-info-block">
                        <label class="label-style" for="">Nome
                            <div class="input-block">
                                <i class="fa-solid fa-user icon-green"></i>
                                <input class="input input-size icon-green" type="text">
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
                </div>
                <div class="section">
                    <div class="user-info-block user-info-block-int">
                        <div class=" subtitle-block">
                            <span class="subtitle">Selecione 3 interesses:</span>
                        </div>
                        <div class="container center-itens">
                                <div class="label-interesse">
                                    <input type="checkbox" name="" id="praia">
                                    <label for="praia">Praia</label>
                                </div>
                                <div class="label-interesse">
                                    <input type="checkbox" name="" id="ambiente">
                                    <label for="ambiente">Meio ambiente</label>
                                </div>
                                <div class="label-interesse">
                                    <input type="checkbox" name="" id="limpeza">
                                    <label for="limpeza">Limpeza na praia</label>
                                </div>
                                <div class="label-interesse">
                                    <input type="checkbox" name="" id="esportes">
                                    <label for="esportes">Esportes na praia</label>
                                </div>
                                <div class="label-interesse">
                                    <input type="checkbox" name="" id="eventos">
                                    <label for="eventos">Eventos</label>
                                </div>
                                <div class="label-interesse">
                                    <input type="checkbox" name="" id="natureza">
                                    <label for="natureza">Cuidar da natureza</label>
                                </div>
                                <div class="label-interesse">
                                    <input type="checkbox" name="" id="plantas">
                                    <label for="plantas">Cuidar das plantas</label>
                                </div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-color btn-margin" onclick="passarEtapa()">Próximo</button>
                </div>
                <div class="section">
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
                    <div class="terms-block">
                        <input type="checkbox" id="termos" name="termos">
                        <label for="termos">Concordo com os <a href="" class="purple-link">termos de uso</a> e <a href="" class="purple-link">politicas de privacidade</a>.</label>
                    </div>
                    
                    <button type="submit" class="btn btn-color btn-margin">Cadastrar</button>
                </div>
                <!-- <button class="btn btn-color">Entrar</button> -->
            </form>
            <span class="redirecionar-login">Já tem uma conta? <a href="" class="purple-link">Entrar</a></span>
        </div> 
        <div class="img-block">
            <img class="form-img" src="../../assets/img/Sign up-bro.png" alt="">
        </div>
    </div>
</body>
<script src="<?= baseUrl('/assets/js/cadastroEtapas.js') ?>"></script>