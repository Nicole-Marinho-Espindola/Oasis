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
            <h1 class="title">Alterar ONG</h1>
            <div class="line"></div>
        </div>
        <form class="form" action="../../services/CRUD/ongs/editar_action.php">
                    <div class="user-info-block">
                        <label class="" for="">Nome:
                            <div class="form-input-block required">
                                <i class="fa-solid fa-user icon-green"></i>
                                <input class="input input-size" type="text"
                                    id="nomeOng" name="nomeOng"
                                        value="<?= $row['nm_ong'] ?? '' ?>">
                            </div>
                            <span class="span-required">Mínimo de 3 caracteres</span>
                        </label>
                    </div>
                    <div class="user-info-block">
                        <label class="" for="">Razão social:
                            <div class="form-input-block">
                                <i class="fa-solid fa-user icon-green"></i>
                                <input class="input input-size" type="text"
                                    id="razaoOng" name="razaoOng"
                                        value="<?= $row['nm_sobrenome'] ?? '' ?>">
                            </div>
                        </label>
                    </div>
                    <div class="user-info-block">
                        <label class="" for="">Missão:
                            <div class="form-input-block">
                                <i class="fa-regular fa-calendar icon-green"></i>
                                <input class="input input-size" type="text"
                                    id="missaoOng" name="missaoOng"
                                        value="<?= $row['dt_nascimento'] ?? '' ?>" >
                            </div>
                        </label>
                    </div>
                    <div class="user-info-block">
                        <label class="" for="">CNPJ:
                            <div class="form-input-block">
                                <i class="fa-regular fa-calendar icon-green"></i>
                                <input class="input input-size" type="number"
                                    id="cnpjOng" name="cnpjOng"
                                        value="<?= $row['ds_cnpj'] ?? '' ?>" >
                            </div>
                        </label>
                    </div>
                    <div class="user-info-block">
                        <label class="" for="">Telefone:
                            <div class="form-input-block">
                                <i class="fa-regular fa-calendar icon-green"></i>
                                <input class="input input-size" type="number"
                                    id="telefoneOng" name="telefoneOng"
                                        value="<?= $row['dt_nascimento'] ?? '' ?>" >
                            </div>
                        </label>
                    </div>
                    <div class="user-info-block">
                        <label class="" for="email">Email:
                            <div class="form-input-block required">
                                <i class="fa-regular fa-envelope icon-green"></i>
                                <input class="input input-size" type="text" oninput="emailValidate()"
                                    id="emailOng" name="emailOng"
                                        value="<?= $row['ds_email'] ?? '' ?>" >
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
                    <button type="submit" class="btn btn-color">Alterar</button>
        </form>
    </div>
</div>
</body>