<?php
    include_once('../../views/includes/head.php');
    include_once('../../config/database.php');
    
    $row = null; // Inicializa a variável $row
    
    if (isset($_GET['cd_ong'])) {
        $id = filter_input(INPUT_GET, 'cd_ong');
    
        try {
            $select = $conn->prepare("SELECT * FROM tb_ong WHERE cd_ong = :id");
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
        echo "Não foi possível pegar o ID da ONG.";
    }

?>

<link rel="stylesheet" href="<?= baseUrl('/assets/css/form.css') ?>">
    <div class="content">
        <div class="form-block">
            <input type="hidden" name="id" value="<?= $row['cd_ong']?>">
            <div class="form-title">
                <h1 class="title">Atualizar cadastro de ONGS!</h1>
                <div class="line"></div>
            </div>
            <form class="form" action=<?= baseUrl('services/CRUD/ongs/editar_action.php') ?>>
                <div class="section active">
                    <div class="user-info-block">
                        <label class="" for="">Nome:
                            <div class="form-input-block">
                                <i class="fa-solid fa-user icon-green"></i>
                                <input class="input input-size icon-green" type="text"
                                    id="nomeOng" name="nomeOng"
                                        value="<?= $row['nm_ong'] ?? '' ?>">
                            </div>
                        </label>
                    </div>
                    <div class="user-info-block">
                        <label class="" for="">Razão social:
                            <div class="form-input-block">
                                <i class="fa-solid fa-user icon-green"></i>
                                <input class="input input-size icon-green" type="text"
                                    id="razaoOng" name="razaoOng"
                                        value="<?= $row['nm_razao'] ?? '' ?>">
                            </div>
                        </label>
                    </div>
                    <div class="user-info-block">
                        <label class="" for="">CNPJ:
                            <div class="form-input-block">
                            <i class="fa-regular fa-calendar icon-green"></i>
                            <input class="input input-size icon-green" type="text"
                                    id="cnpjOng" name="cnpjOng"
                                        value="<?= $row['cd_cnpj'] ?? '' ?>">
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
                                <input class="input input-size" type="text"
                                    id="emailOng" name="emailOng"
                                        value="<?= $row['ds_email'] ?? '' ?>">
                            </div>
                        </label>
                    </div>
                    <div class="user-info-block">
                        <label for="">Redefinir Senha:
                            <div class="form-input-block">
                                <i class="fa-solid fa-lock"></i>
                                <input class="input" name="senha" type="text" value="<?= $ong['senha']?>">
                                <i class="fa-regular fa-eye-slash icon-green"></i>
                            </div>
                        </label>
                    </div>
                    <button type="submit" class="btn btn-color">Alterar dados</button>
                </div>
            </form>
        </div>
    </div>
</body>
<script src="<?= baseUrl('/assets/js/cadastroEtapas.js') ?>"></script>

