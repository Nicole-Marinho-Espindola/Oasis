<?php
function includeURL($path = '')
{
    return sprintf(
        "%s/%s/%s",
        $_SERVER['DOCUMENT_ROOT'],
        'Oasis',
        $path
    );
}

include_once(includeURL('/services/helpers.php'));

?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/4719b1c3ae.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="<?= baseUrl('/assets/css/global.css') ?>">
    <link rel="stylesheet" href="<?= baseUrl('/assets/css/navbar.css') ?>">
    <link rel="stylesheet" href="<?= baseUrl('/assets/css/perfil.css') ?>">
    <link rel="stylesheet" href="<?= baseUrl('/assets/css/form.css') ?>">
    <link rel="stylesheet" href="<?= baseUrl('/assets/css/modal.css') ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.27/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.27/dist/sweetalert2.all.min.js"></script>
    <title>Perfil Ong | Oásis</title>
</head>

<?php
include_once(includeURL('views\includes\navPefil.php'));

$row = [];

if (isset($_SESSION['email'])) {

    include_once(includeURL('config/database.php'));

    $email = $_SESSION['email'];

    $sql = "SELECT * FROM tb_ong WHERE ds_email = :email";
    $query = $conn->prepare($sql);
    $query->bindParam(":email", $email);
    $query->execute();
    $row = $query->fetch(PDO::FETCH_ASSOC);
}
?>

<body>

    <?php
    if (isset($_GET['editar_sucesso']) && $_GET['editar_sucesso'] == 'true') {
        echo '<script src="../../../assets/js/alerts.js"></script>';
        echo '<script>alertAlterar();</script>';
    }
    ?>

    <div class="profile-block">
        <div class="profile-purple-block">
            <div class="social-midia-profile-block">
                <div class="social-midia">
                    <i class="fa-brands fa-instagram social-midia-icon"></i>
                </div>
                <div class="social-midia">
                    <i class="fa-brands fa-twitter social-midia-icon"></i>
                </div>
                <div class="social-midia">
                    <i class="fa-brands fa-facebook-f social-midia-icon"></i>
                </div>
            </div>
            <div onclick="openModal()" class="edit-profile-position">
                <div class="edit-profile">
                    <i class="fa-regular fa-pen-to-square social-midia-icon"></i>
                    <span class="edit-profile-span">Editar perfil</span>
                </div>
            </div>
        </div>
        <div class="img-profile-block-ong">
            <?php if (!empty($row['nm_imagem'])) : ?>
                <img src="<?= baseUrl($row['nm_imagem']) ?>" alt="Foto de perfil do usuário">
            <?php else : ?>
                <img src="<?= baseUrl('/assets/img/iconUser.jpg') ?>" alt="Foto de perfil do usuário">
            <?php endif; ?>
        </div>
        <div class="user-profile-info">
            <div class="text-profile-block">
                <h1 class="user-name"><?= $row['nm_ong'] ?></h1>
                <div class="line line-profile-config"></div>
            </div>
            <div class="ong-missao-block">
                <p class="ong-missao"><?= $row['ds_missao'] ?></p>
            </div>
        </div>
        <div class="user-story">
            <?php
            try {
                $selectIniciativas = $conn->prepare("SELECT 
                                        tb_projeto.*, 
                                        tb_ong.nm_ong AS nome_ong, 
                                        tb_projeto.nm_imagem AS imagem_projeto, 
                                        tb_evento.nm_imagem AS imagem_evento
                                    FROM tb_projeto
                                    JOIN tb_ong ON tb_projeto.cd_ong = tb_ong.cd_ong
                                    LEFT JOIN tb_evento ON tb_projeto.cd_ong = tb_evento.cd_ong
                                    WHERE tb_projeto.cd_ong = :ong");

                $selectIniciativas->bindParam(":ong", $row['cd_ong']);
                $selectIniciativas->execute();

                //cont das iniciativas
                $countProjetosEventos = $conn->prepare("SELECT 
                (SELECT COUNT(*) FROM tb_projeto WHERE cd_ong = :ong) + 
                (SELECT COUNT(*) FROM tb_evento JOIN tb_projeto ON tb_evento.cd_ong = tb_projeto.cd_ong WHERE tb_projeto.cd_ong = :ong) AS total_projetos_eventos");

                $countProjetosEventos->bindParam(":ong", $row['cd_ong']);
                $countProjetosEventos->execute();
                $total = $countProjetosEventos->fetchColumn();


            ?>
                <div class="trajectory trajectory-ong">
                    <div class="head-trajectory">
                        <h3 class="subtitle-profile">Nossas iniciativas</h3>
                        <div class="green-small-block">
                            <p><?= $total ?></p>
                        </div>
                    </div>

                    <div class="pjcts-block">
                        <?php
                        while ($rowIniciativa = $selectIniciativas->fetch()) {
                            if (isset($rowIniciativa['imagem_projeto'])) {
                        ?>
                                <div class="pjcts">
                                    <img src="<?= baseUrl($rowIniciativa['imagem_projeto']) ?>" alt="Imagem Projeto">
                                </div>
                            <?php
                            }
                            if (isset($rowIniciativa['imagem_evento'])) {
                            ?>
                                <div class="pjcts">
                                    <img src="<?= baseUrl($rowIniciativa['imagem_evento']) ?>" alt="Imagem Evento">
                                </div>
                        <?php
                            }
                        }
                        ?>

                    </div>
                </div>
            <?php
            } catch (PDOException $e) {
                echo "Erro ao listar projetos: " . $e->getMessage();
            }
            ?>
        </div>
    </div>
    </div>

    <div class="modal-window" id="modalWindow">
        <form class="form" action=<?= baseUrl('/services/controllers/Ongs/editarPerfil.php') ?> enctype="multipart/form-data" method="POST">
            <input type="hidden" name="id" value="<?= $row['cd_ong'] ?>">
            <div class="modal-card-profile">
                <div class="modal-title-block">
                    <div class="modal-title">Editar perfil</div>
                    <div class="line"></div>
                </div>
                <label class="img-block" tabindex="0">
                    <input class="input-profile-img" name="imagemOng" type="file" accept="image/*">
                    <div class="img-text">
                        <?php if (!empty($row['nm_imagem'])) : ?>
                            <img class="img-icon" src="<?= baseUrl($row['nm_imagem']) ?>" alt="Foto de perfil do usuário" accept="image/*">
                        <?php else : ?>
                            <img class="img-icon" src="<?= baseUrl('/assets/img/iconUser.jpg') ?>" alt="Foto de perfil do usuário" accept="image/*">
                        <?php endif; ?>
                    </div>
                </label>
                <div class="modal-input-block-perfil">
                    <input id="nomeOng" name="nomeOng" type="text" class="modal-input" value="<?= $row['nm_ong'] ?>">
                    <i class="fa-regular fa-pen-to-square icon-input"></i>
                </div>
                <div class="modal-input-block-perfil">
                    <input id="emailOng" name="emailOng" type="text" class="modal-input" value="<?= $row['ds_email'] ?>">
                    <i class="fa-regular fa-pen-to-square icon-input"></i>
                </div>
                <div class="modal-input-block-perfil">
                    <input id="missaoOng" name="missaoOng" type="text" class="modal-input" value="<?= $row['ds_missao'] ?>">
                    <i class="fa-regular fa-pen-to-square icon-input"></i>
                </div>
                <button type="submit" class="btn-modal" id="close">Concluído</button>
            </div>
    </div>

    <script src="<?= baseUrl('/assets/js/visualizarImagem.js') ?>"></script>
    <script src="<?= baseUrl('/assets/js/modal.js') ?>"></script>
</body>

<?php
include_once(includeURL('views/includes/footer.php'))
?>