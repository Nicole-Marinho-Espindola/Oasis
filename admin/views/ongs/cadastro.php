<?php
    include_once('../../views/includes/head.php');
?>
    <div class="content">
        <div class="form-block">
            <div class="form-title">
                <h1 class="title">Cadastro de ONGS!</h1>
                <div class="line"></div>
            </div>
            <form class="form" action=<?= baseUrl('services/CRUD/ongs/cadastro_action.php') ?>
                        method="POST" id="form">
                <div class="section active">
                    <div class="user-info-block">
                        <label class="" for="">Nome:
                            <div class="form-input-block required">
                                <i class="fa-solid fa-user icon-green"></i>
                                <input class="input input-size icon-green" type="text"
                                    id="nomeOng" name="nomeOng" requerid>
                                <input class="input input-size icon-green" type="text" required oninput="nameValidate()">
                            </div>
                            <span class="span-required">Mínimo de 3 caracteres</span>
                        </label>
                    </div>
                    <div class="user-info-block">
                        <label class="" for="">Razão social:
                            <div class="form-input-block ">
                                <i class="fa-solid fa-tag icon-green"></i>
                                <input class="input input-size" type="text"
                                    id="razaoOng" name="razaoOng" requerid>
                            </div>
                        </label>
                    </div>
                    <div class="user-info-block">
                        <label class="" for="">Missão:
                            <div class="form-input-block ">
                                <i class="fa-solid fa-tag icon-green"></i>
                                <input class="input input-size" type="text"
                                    id="razaoOng" name="razaoOng" requerid>
                            </div>
                        </label>
                    </div>
                    <button type="button" class="btn btn-color" onclick="passarEtapa()">Próximo</button>
                </div>
                <div class="section">
                    <div class="user-info-block">
                    <label class="" for="">CNPJ:
                            <div class="form-input-block">
                                <i class="fa-regular fa-id-card icon-green"></i>
                                <input class="input input-size" type="text" oninput="validarCNPJ(this.value)"
                                    id="cnpjOng" name="cnpjOng" requerid>
                            </div>
                        </label>
                    </div>
                    <div class="user-info-block">
                    <label for="">Telefone:
                            <div class="form-input-block">
                                <i class="fa-solid fa-lock icon-green"></i>
                                <input class="input" type="number"
                                    id="senhaOng" name="senhaOng" >
                                <i class="fa-regular fa-eye-slash icon-green"></i>
                            </div>
                        </label>
                    </div>
                    <button type="button" class="btn btn-color" onclick="passarEtapa()">Próximo</button>
                </div>
                <div class="section">
                    <div class="user-info-block">
                        <label class="" for="email">Email:
                            <div class="form-input-block required">
                                <i class="fa-regular fa-envelope icon-green"></i>
                                <input class="input input-size" type="text" oninput="validarEmail(this.value)"
                                    id="emailOng" name="emailOng" requerid>
                                <span class="span-required">Email inválido</span>
                            </div>
                            <span class="span-required">Email inválido</span>
                        </label>
                    </div>
                    <div class="user-info-block">
                    <label for="">Senha:
                            <div class="form-input-block">
                                <i class="fa-solid fa-lock icon-green"></i>
                                <input class="input" type="password"
                                    id="senhaOng" name="senhaOng" required>
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

<script src="<?= baseUrl('/assets/js/validarEmail.js') ?>"></script>
<script src="<?= baseUrl('/assets/js/cadastroEtapas.js') ?>"></script>
<script src="<?= baseUrl('/assets/js/validarCNPJ.js') ?>"></script>
<script src="<?= baseUrl('/assets/js/validarInput.js') ?>"></script>
<script src="<?= baseUrl('/assets/js/cadastroEtapas.js') ?>"></script>

