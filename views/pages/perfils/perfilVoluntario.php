<?php

    function includeURL($path = ''){
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
        <link rel="stylesheet" href="<?= baseUrl('/assets/css/global.css') ?>">
        <link rel="stylesheet" href="<?= baseUrl('/assets/css/navbar.css') ?>">
        <link rel="stylesheet" href="<?= baseUrl('/assets/css/perfil.css') ?>">
        <link rel="stylesheet" href="<?= baseUrl('/assets/css/form.css') ?>">
        <link rel="stylesheet" href="<?= baseUrl('/assets/css/modal.css') ?>">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.27/dist/sweetalert2.min.css">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.27/dist/sweetalert2.all.min.js"></script>
        <title>Perfil Voluntário | Oásis</title>
    </head>

    <?php

    include_once(includeURL('views\includes\navPefil.php'));

    $row = [];

    if (isset($_SESSION['email'])) {
        include_once(includeURL('config/database.php'));

        $email = $_SESSION['email'];

        $sql = "SELECT
                            v.cd_voluntario,
                            v.nm_voluntario,
                            v.nm_sobrenome,
                            v.nm_imagem,
                            v.dt_nascimento,
                            v.ds_email,
                            i.nm_icone,
                            e.cd_interesse,
                            s.nm_situacao AS situacao
                        FROM tb_voluntario v
                        LEFT JOIN tb_escolha e ON v.cd_voluntario = e.cd_voluntario
                        LEFT JOIN tb_interesse i ON e.cd_interesse = i.cd_interesse
                        LEFT JOIN tb_situacao s ON v.cd_situacao = s.cd_situacao
                        WHERE v.ds_email = :email";

        $query = $conn->prepare($sql);
        $query->bindParam(":email", $email);
        $query->execute();

        $iconesInteresse = [];
        $cdInteresses = [];

        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $iconesInteresse[] = $row['nm_icone'];
            $cdInteresses[] = $row['cd_interesse'];
            $idVoluntario = $row['cd_voluntario'];
            $nomeVoluntario = $row['nm_voluntario'];
            $emailVoluntario = $row['ds_email'];
            $imagemVoluntario = $row['nm_imagem'];
        }

        $conn = null;
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
                        <div class="edit-profile-span">Editar perfil</div>
                    </div>
                </div>
            </div>
            <div class="img-profile-block">
                <?php if (!empty($imagemVoluntario)) : ?>
                    <img src="<?= baseUrl($imagemVoluntario) ?>" alt="Foto de perfil do usuário">
                <?php else: ?>
                    <img src="<?= baseUrl('/assets/img/iconUser.jpg') ?>" alt="Foto de perfil do usuário">
                <?php endif; ?>
            </div>
            <div class="user-profile-info">
                <div class="text-profile-block">
                    <?php if (!empty($nomeVoluntario)) : ?>
                        <h1 class="user-name" id="nomeVoluntario" name="nomeVoluntario"><?= $nomeVoluntario ?></h1>
                        <div class="line line-profile-config"></div>
                    <?php endif; ?>
                </div>
                <div class="user-profile-int">
                    <?php
                    if (!empty($iconesInteresse)) {
                        foreach ($iconesInteresse as $iconeInteresse) {
                    ?>
                            <div class="label-interesse">
                                <label class="label-content-int">
                                    <div class="int-content">
                                        <img class="img-interesse" src="<?= baseUrl('/admin/' . $iconeInteresse) ?>" alt="">
                                    </div>
                                </label>
                            </div>
                    <?php
                        }
                    }
                    ?>
                </div>
            </div>
            <div class="user-story">
                <div class="trajectory">
                    <div class="head-trajectory">
                        <h3 class="subtitle-profile">Minha trajetoria de projetos</h3>
                        <div class="green-small-block"></div>
                    </div>
                    <div class="pjcts-block">
                        <div class="pjcts">
                            <img src="<?= baseUrl('/assets/img/foto-teste.webp') ?>" alt="">
                        </div>
                        <div class="pjcts">
                            <img src="<?= baseUrl('/assets/img/foto-teste.webp') ?>" alt="">
                        </div>
                        <div class="pjcts">
                            <img src="<?= baseUrl('/assets/img/foto-teste.webp') ?>" alt="">
                        </div>
                        <div class="pjcts">
                            <img src="<?= baseUrl('/assets/img/foto-teste.webp') ?>" alt="">
                        </div>
                    </div>
                    </div>
                </div>
                <div class="trajectory">
                    <div class="head-trajectory">
                        <h3 class="subtitle-profile">Minhas incrições em projetos</h3>
                        <div class="green-small-block"></div>
                    </div>
                    <div class="pjcts-block">
                        <div class="pjcts">
                            <img src="<?= baseUrl('/assets/img/foto-teste.webp') ?>" alt="">
                        </div>
                        <div class="pjcts">
                            <img src="<?= baseUrl('/assets/img/foto-teste.webp') ?>" alt="">
                        </div>
                        <div class="pjcts">
                            <img src="<?= baseUrl('/assets/img/foto-teste.webp') ?>" alt="">
                        </div>
                        <div class="pjcts">
                            <img src="<?= baseUrl('/assets/img/foto-teste.webp') ?>" alt="">
                        </div>
                        <div class="pjcts">
                            <img src="<?= baseUrl('/assets/img/foto-teste.webp') ?>" alt="">
                        </div>
                        <div class="pjcts">
                            <img src="<?= baseUrl('/assets/img/foto-teste.webp') ?>" alt="">
                        </div>
                        <div class="pjcts">
                            <img src="<?= baseUrl('/assets/img/foto-teste.webp') ?>" alt="">
                        </div>
                        <div class="pjcts">
                            <img src="<?= baseUrl('/assets/img/foto-teste.webp') ?>" alt="">
                        </div>
                        <div class="pjcts">
                            <img src="<?= baseUrl('/assets/img/foto-teste.webp') ?>" alt="">
                        </div>
                        <div class="pjcts">
                            <img src="<?= baseUrl('/assets/img/foto-teste.webp') ?>" alt="">
                        </div>
                        <div class="pjcts">
                            <img src="<?= baseUrl('/assets/img/foto-teste.webp') ?>" alt="">
                        </div>
                        <div class="pjcts">
                            <img src="<?= baseUrl('/assets/img/foto-teste.webp') ?>" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal-window" id="modalWindow">
            <form class="form" action=<?= baseUrl('/services/controllers/voluntarios/editarPerfil.php') ?> enctype="multipart/form-data" method="POST">
                <input type="hidden" name="idVoluntario" value="<?= $idVoluntario ?>">
                <div class="modal-card-profile">
                    <div class="modal-title-block">
                        <div class="modal-title">Editar perfil</div>
                        <div class="line"></div>
                    </div>
                    <label class="img-block" tabindex="0">
                        <input class="input-profile-img" name="imagemVoluntario" type="file" accept="image/*">
                        <div class="img-text">
                            <?php if (!empty($imagemVoluntario)) : ?>
                                <img class="img-icon" src="<?= baseUrl($imagemVoluntario) ?>" alt="Foto de perfil do usuário" accept="image/*">
                            <?php else: ?>
                                <img class="img-icon" src="<?= baseUrl('/assets/img/iconUser.jpg') ?>" alt="Foto de perfil do usuário" accept="image/*">
                            <?php endif; ?>
                        </div>
                    </label>
                    <div class="modal-input-block-perfil">
                        <input id="nomeVoluntario" name="nomeVoluntario" type="text" class="modal-input" value="<?= $nomeVoluntario ?? '' ?>">
                        <i class="fa-regular fa-pen-to-square icon-input"></i>
                    </div>
                    <div class="modal-input-block-perfil">
                        <input id="emailVoluntario" name="emailVoluntario" type="text" class="modal-input" value="<?= $emailVoluntario ?? '' ?>">
                        <i class="fa-regular fa-pen-to-square icon-input"></i>
                    </div>
                    <button type="submit" class="btn-modal" id="close">Concluído</button>
                </div>
            </form>
        </div>
    </body>

    <script src="<?= baseUrl('/assets/js/visualizarImagem.js') ?>"></script>
    <script src="<?= baseUrl('/assets/js/modal.js') ?>"></script>

    <?php
    include_once(includeURL('views/includes/footer.php'));
    ?>