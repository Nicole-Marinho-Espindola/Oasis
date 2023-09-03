<?php
    include_once('../../views/includes/head.php');
    include_once('../../config/database.php');
    include_once('../../config/verificacao.php');

    // Verifica se o ID da ONG foi fornecido
    if (isset($_GET['cd_ong'])) {
        
        $id = $_GET['cd_ong'];
    
        try {
            $select = $conn->prepare("SELECT * FROM tb_ong WHERE cd_ong = :id");
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
        echo "Não foi possível pegar o ID da ONG.";
        exit();
    }
?>

<link rel="stylesheet" href="<?= baseUrl('/assets/css/form.css') ?>">
<div class="content">
    <div class="form-block">
        <div class="form-title">
            <h1 class="title">Excluir ONG</h1>
            <div class="line"></div>
        </div>
        <form class="form" action=<?= baseUrl('services/CRUD/ongs/excluir_action.php') ?>
                    method="POST" id="form">
            <input type="hidden" name="idOng" value="<?= $row['cd_ong'] ?>">
            <div class="user-info-block">
                <label class="" for="">Nome:
                    <div class="input-block">
                        <i class="fa-solid fa-user icon-green"></i>
                        <input class="input input-size icon-green" type="text" id="nomeOng" name="nomeOng"
                            value="<?= $row['nm_ong'] ?? '' ?>" readonly>
                    </div>
                </label>
            </div>
            <div class="user-info-block">
                <label class="" for="">Razão social:
                    <div class="input-block">
                        <i class="fa-solid fa-tag icon-green"></i>
                        <input class="input input-size" type="text" id="razaoOng" name="razaoOng"
                            value="<?= $row['nm_razao'] ?? '' ?>" readonly>
                    </div>
                </label>
            </div>
            <div class="user-info-block">
                <label class="" for="">CNPJ:
                    <div class="input-block">
                        <i class="fa-regular fa-id-card icon-green"></i>
                        <input class="input input-size" type="text" id="cnpjOng" name="cnpjOng"
                            value="<?= $row['cd_cnpj'] ?? '' ?>" readonly>
                    </div>
                </label>
            </div>
            <div class="user-info-block">
                <label class="" for="">Celular:
                    <div class="input-block required">
                        <i class="fa-solid fa-phone icon-green"></i>
                        <input class="input input-size" type="number" id="celularOng" name="celularOng"
                            value="<?= $row['cd_celular_ong'] ?? '' ?>" readonly>
                    </div>
                </label>
            </div>
            <div class="user-info-block">
                <label for="">Sua missão:
                    <div class="input-block">
                        <i class="fa-solid fa-bullhorn icon-green"></i>
                        <input class="input input-size" type="text" id="missaoOng" name="missaoOng"
                            value="<?= $row['ds_missao'] ?? '' ?>" readonly>
                    </div>
                </label>
            </div>
            <div class="user-info-block">
                <label class="" for="">Email:
                    <div class="input-block">
                        <i class="fa-regular fa-envelope icon-green"></i>
                        <input class="input input-size" type="text" id="emailOng" name="emailOng"
                            value="<?= $row['ds_email'] ?? '' ?>" readonly>
                    </div>
                </label>
            </div>
            <!-- <div class="user-info-block">
                <label for="">Redefinir Senha:
                    <div class="input-block">
                        <i class="fa-solid fa-lock"></i>
                        <input class="input" name="senha" type="text" value="<?= $ong['senha'] ?>" readonly>
                        <i class="fa-regular fa-eye-slash icon-green"></i>
                    </div>
                </label>
            </div> -->
            <button type="submit" class="btn btn-color">Excluir ONG</button>
        </form>
    </div>
</div>
</body>
<script src="<?= baseUrl('/assets/js/cadastroEtapas.js') ?>"></script>
