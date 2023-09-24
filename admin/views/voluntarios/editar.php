<?php

    include_once('../../views/includes/head.php');
    include_once('../../config/database.php');
    include_once('../../config/autenticacao.php');
    
    $row = null; // Inicializa a variável $row
    
    if (isset($_GET['cd_voluntario'])) {
        $id = filter_input(INPUT_GET, 'cd_voluntario');
    
        try {
            $select = $conn->prepare("SELECT * FROM tb_voluntario WHERE cd_voluntario = :id");
            $select->bindParam(':id', $id);
    
            if ($select->execute()) {
                $row = $select->fetch(PDO::FETCH_ASSOC);
            } else {
                echo "Erro na consulta: " . $select->errorInfo()[2];
            }
        } catch (PDOException $e) {
            echo "Erro: " . $e->getMessage();
        }
    } else {
        echo "Não foi possível pegar o ID do voluntário.";
    }

    // Recupera os interesses do voluntário
    $voluntario_interesses = array();

    if (isset($_GET['cd_voluntario'])) {
        $id = filter_input(INPUT_GET, 'cd_voluntario');

        try {
            $selectInteresses = $conn->prepare('SELECT cd_interesse FROM tb_escolha WHERE cd_voluntario = :id');
            $selectInteresses->bindParam(':id', $id);
            $selectInteresses->execute();

            while ($rowInteresse = $selectInteresses->fetch(PDO::FETCH_ASSOC)) {
                $voluntario_interesses[] = $rowInteresse['cd_interesse'];
            }
        } catch (PDOException $e) {
            echo "Erro ao listar interesses do voluntário: " . $e->getMessage();
        }
    }

    // Recupera a situação do usuário
    if (isset($_GET['cd_voluntario'])) {
        $id = filter_input(INPUT_GET, 'cd_voluntario');
    
        try {
            $selectSituacao = $conn->prepare('SELECT cd_situacao FROM tb_voluntario WHERE cd_voluntario = :id');
            $selectSituacao->bindParam(':id', $id);
            $selectSituacao->execute();
            
            while ($rowSituacao = $selectSituacao->fetch(PDO::FETCH_ASSOC)) {
                $voluntario_situacao = $rowSituacao['cd_situacao'];
            }

        } catch (PDOException $e) {
            echo "Erro ao listar situação do voluntário: " . $e->getMessage();
        }
    }

?>

<link rel="stylesheet" href="<?= baseUrl('/assets/css/form.css') ?>">

<div class="content">
    <div class="form-block">
        <div class="form-title">
            <h1 class="title">Editar voluntário</h1>
            <div class="line"></div>
        </div>
        <form class="form" action=<?= baseUrl('services/CRUD/voluntario/editar_action.php') ?> method="POST" id="form">
            <input type="hidden" name="idVoluntario" value="<?= $row['cd_voluntario']?>">

                <div class="section active">
                    <div class="user-info-block">
                            <label class="" for="">Nome:
                                <div class="input-block required">
                                    <i class="fa-solid fa-user icon-green"></i>
                                    <input class="input input-size" type="text"
                                        id="nomeVoluntario" name="nomeVoluntario"
                                            value="<?= $row['nm_voluntario'] ?? '' ?>">
                                </div>
                                <span class="span-required">Mínimo de 3 caracteres</span>
                            </label>
                        </div>
                        <div class="user-info-block">
                            <label class="" for="">Sobrenome:
                                <div class="input-block">
                                    <i class="fa-solid fa-file-signature icon-green"></i>
                                    <input class="input input-size" type="text"
                                        id="sobrenomeVoluntario" name="sobrenomeVoluntario"
                                            value="<?= $row['nm_sobrenome'] ?? '' ?>">
                                </div>
                            </label>
                    </div>
                    <button type="button" class="btn btn-color" onclick="passarEtapa()">Próximo</button>
                </div>
                <div class="section">
                    <div class="user-info-block">
                        <div class="center-itens subtitle-block">
                            <span class="subtitle">Selecione até 3 interesses:</span>
                            <div class="line line-thin"></div>
                        </div>
                        <div class="container">
                        <?php
                            try {
                                include_once('../../config/database.php');

                                $selectInteresses = $conn->prepare('SELECT * FROM tb_interesse');
                                $selectInteresses->execute();

                                while ($rowInteresse = $selectInteresses->fetch()) {
                                    $nomeInteresse = $rowInteresse['ds_interesse'];
                                    $cdInteresse = $rowInteresse['cd_interesse'];
                                    $isChecked = in_array($cdInteresse, $voluntario_interesses) ? 'checked' : ''; // Verifica se o interesse está selecionado

                                    ?>
                                    <div class="label-interesse">
                                        <input type="checkbox" name="interesses[]" value="<?= $cdInteresse ?>" id="<?= $nomeInteresse ?>" <?= $isChecked ?>>
                                        <label for="<?= $nomeInteresse ?>"><?= $nomeInteresse ?></label>
                                    </div>
                                    <?php
                                }
                            } catch (PDOException $e) {
                                echo "Erro ao listar interesses: " . $e->getMessage();
                            }
                        ?>
                        </div>
                    </div>
                    <button type="button" class="btn btn-color" onclick="passarEtapa()">Próximo</button>
                </div>
                <div class="section">
                    <div class="user-info-block">
                            <label class="" for="">Data de nascimento:
                                <div class="input-block">
                                    <input class="input input-size" type="date"
                                        id="nascimentoVoluntario" name="nascimentoVoluntario"
                                            value="<?= $row['dt_nascimento'] ?? '' ?>">
                                </div>
                            </label>
                        </div>
                        <div class="user-info-block">
                            <label class="" for="email">Email:
                                <div class="input-block required">
                                    <i class="fa-regular fa-envelope icon-green"></i>
                                    <input class="input input-size" type="email" oninput="emailValidate()"
                                        id="emailVoluntario" name="emailVoluntario"
                                            value="<?= $row['ds_email'] ?? '' ?>">
                                    <span class="span-required">Email inválido</span>
                                </div>
                            </label>
                        </div>
                    <!-- <div class="user-info-block">
                    <label for="">Senha:
                            <div class="form-input-block">
                                <i class="fa-solid fa-lock"></i>
                                <input class="input" type="password"
                                    id="senhaVoluntario" name="senhaVoluntario">
                                <i class="fa-regular fa-eye-slash icon-green"></i>
                            </div>
                        </label>
                    </div> -->
                    <button type="button" class="btn btn-color" onclick="passarEtapa()">Próximo</button>
                </div>

                <div class="section">
                    <div class="user-info-block">
                        <div class="center-itens subtitle-block">
                            <span class="subtitle">Situação do voluntário:</span>
                            <div class="line line-thin"></div>
                        </div>
                        <div class="container">
                        <?php
                            try {
                                include_once('../../config/database.php');

                                $selectSituacao = $conn->prepare('SELECT * FROM tb_situacao');
                                $selectSituacao->execute();

                                while ($rowSituacao = $selectSituacao->fetch()) {
                                    $nomeSituacao = $rowSituacao['nm_situacao'];
                                    $cdSituacao = $rowSituacao['cd_situacao'];
                        ?>
                                    <div class="label-interesse">
                                        <input type="radio" name="situacaoVoluntario" value="<?= $cdSituacao ?>" id="<?= $nomeSituacao ?>" 
                                        <?php if ($voluntario_situacao == $cdSituacao) echo 'checked'; ?>>
                                        <label for="<?= $nomeSituacao ?>"><?= $nomeSituacao ?></label>
                                    </div>
                            <?php
                                }
                            } catch (PDOException $e) {
                                echo "Erro ao listar situações: " . $e->getMessage();
                            }
                            ?>

                        </div>
                    </div>
                    <button type="submit" class="btn btn-color">Alterar</button>
                </div>
                    
        </form>
    </div>
</div>
</body>
<script src="<?= baseUrl('/assets/js/validarInput.js') ?>"></script>
<script src="<?= baseUrl('/assets/js/cadastroEtapas.js') ?>"></script>
<script src="<?= baseUrl('/assets/js/limitarSelecoes.js') ?>"></script>
<script src="<?= baseUrl('/assets/js/validarEmail.js') ?>"></script>
