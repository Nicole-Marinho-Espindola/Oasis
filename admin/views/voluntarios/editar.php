<?php

    include_once('../../views/includes/head.php');
    include_once('../../config/database.php');
    
    $row = null; // Inicializa a variável $row
    
    if (isset($_GET['cd_voluntario'])) {
        $id = filter_input(INPUT_GET, 'cd_voluntario');
    
        try {
            $select = $conn->prepare("SELECT * FROM tb_voluntario WHERE cd_voluntario = :id");
            $select->bindParam(':id', $id);
    
            if ($select->execute()) {
                $row = $select->fetch(PDO::FETCH_ASSOC);
                print_r($row);
            } else {
                echo "Erro na consulta: " . $select->errorInfo()[2];
            }
        } catch (PDOException $e) {
            echo "Erro: " . $e->getMessage();
        }
    } else {
        echo "Não foi possível pegar o ID do voluntário.";
    }

?>

<link rel="stylesheet" href="<?= baseUrl('/assets/css/form.css') ?>">

<div class="content">
    <div class="form-block">
        <div class="form-title">
            <h1 class="title">Atualizar cadastro de voluntários!</h1>
            <div class="line"></div>
        </div>
        <form class="form" action="../../services/CRUD/voluntario/editar_action.php">
        <div class="section active">
                    <div class="user-info-block">
                        <label class="" for="">Nome:
                            <div class="form-input-block required">
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
                            <div class="form-input-block">
                                <i class="fa-solid fa-user icon-green"></i>
                                <input class="input input-size" type="text"
                                    id="sobrenomeVoluntario" name="sobrenomeVoluntario"
                                        value="<?= $row['nm_sobrenome'] ?? '' ?>">
                            </div>
                        </label>
                    </div>
                    <div class="user-info-block">
                        <label class="" for="">Data de nascimento:
                            <div class="form-input-block">
                                <input class="input input-size" type="date"
                                    id="nascimentoVoluntario" name="nascimentoVoluntario"
                                        value="<?= $row['dt_nascimento'] ?? '' ?>">
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
                                <input class="input input-size" type="text" oninput="emailValidate()"
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
                    <button type="submit" class="btn btn-color">Alterar dados</button>
        </div>
        </form>
    </div>
</div>
</body>

<script src="<?= baseUrl('/assets/js/cadastroEtapas.js') ?>"></script>