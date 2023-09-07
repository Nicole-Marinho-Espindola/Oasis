<?php
    include_once('../../views/includes/head.php');
    include_once('../../config/database.php');
    include_once('../../config/verificacao.php');

    // Verifica se o ID da interesse foi fornecido
    if (isset($_GET['cd_interesse'])) {
        $id = filter_input(INPUT_GET, 'cd_interesse');
    
        try {
            $select = $conn->prepare("SELECT * FROM tb_interesse WHERE cd_interesse = :id");
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
        echo "Não foi possível pegar o ID do interesse.";
        exit();
    }
?>

    <div class="content">
        <div class="form-block">
            <div class="form-title">
                <h1 class="title">Editar interesse!</h1>
                <div class="line"></div>
            </div>
            <form class="form" action=<?= baseUrl('services/CRUD/interesse/editar_action.php') ?> method="POST" id="form">
                <input type="hidden" name="idInteresse" value="<?= $row['cd_interesse']?>">
                <div class="section active">
                    <div class="user-info-block">
                        <label class="" for="">Interesse:
                            <div class="input-block">
                                <i class="fa-solid fa-user icon-green"></i>
                                <input class="input input-size icon-green" type="text"
                                        value="<?= $row['ds_interesse']?>" name="interesse">
                            </div>
                        </label>
                    </div>
                    <button type="submit" class="btn btn-color" onclick="alertAlterar()">Enviar</button>
                </div>
            </form>
        </div> 
    </div>
</body>
<script src="<?= baseUrl('/assets/js/cadastroEtapas.js') ?>"></script>