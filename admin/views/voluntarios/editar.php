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
        <form class="form" action=<?= baseUrl('services/CRUD/voluntario/editar_action.php') ?>>
            <div class="section active">
                <div class="user-info-block">
                    <label for="nomeVoluntario">Nome:</label>
                    <div class="form-input-block">
                        <i class="fa-solid fa-user icon-green"></i>
                        <input class="input input-size icon-green" type="text"
                            id="nomeVoluntario" name="nomeVoluntario"
                                value="<?= $row['nm_voluntario'] ?? '' ?>">
                    </div>
                </div>
                <div class="user-info-block">
                    <label for="sobrenomeVoluntario">Sobrenome:</label>
                    <div class="form-input-block">
                        <i class="fa-solid fa-user icon-green"></i>
                        <input class="input input-size" type="text"
                            id="sobrenomeVoluntario" name="sobrenomeVoluntario"
                                value="<?= $row['nm_sobrenome'] ?? '' ?>">
                    </div>
                </div>
                <div class="user-info-block">
                    <label for="nascimentoVoluntario">Data de nascimento:</label>
                    <div class="form-input-block">
                        <i class="fa-regular fa-calendar icon-green"></i>
                        <input class="input input-size" type="date"
                            id="nascimentoVoluntario" name="nascimentoVoluntario"
                                value="<?= $row['dt_nascimento'] ?? '' ?>">
                    </div>
                </div>
                <div class="user-info-block">
                    <label for="nascimentoVoluntario">Email:</label>
                    <div class="form-input-block">
                        <i class="fa-regular fa-calendar icon-green"></i>
                        <input class="input input-size" type="text"
                            id="emailVoluntario" name="emailVoluntario"
                                value="<?= $row['ds_email'] ?? '' ?>">
                    </div>
                </div>
                <button type="button" class="btn btn-color" onclick="passarEtapa()">Próximo</button>
            </div>
        </form>
    </div>
</div>
</body>

<script src="<?= baseUrl('/assets/js/cadastroEtapas.js') ?>"></script>