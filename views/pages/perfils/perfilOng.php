<?php

    function includeURL($path = '') {
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
    <link rel="stylesheet" href="<?= baseUrl('/assets/css/global.css')?>">
    <link rel="stylesheet" href="<?= baseUrl('/assets/css/navbar.css')?>">
    <link rel="stylesheet" href="<?= baseUrl('/assets/css/perfil.css')?>">
    <link rel="stylesheet" href="<?= baseUrl('/assets/css/form.css')?>">
    <link rel="stylesheet" href="<?= baseUrl('/assets/css/modal.css')?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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

        $conn = null;
    }
?>

<body>
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
                <?php else: ?>
                    <img src="<?= baseUrl('/assets/img/iconUser.jpg') ?>" alt="Foto de perfil do usuário">
                <?php endif; ?>
        </div>
        <div class="user-profile-info">
            <div class="text-profile-block">
                    <h1 class="user-name"><?= $row['nm_ong'] ?></h1>
                    <div class="line line-profile-config"></div>
            </div>
        </div>
        <div class="user-story">
            <div class="trajectory">
                <div class="head-trajectory">
                    <h3 class="subtitle-profile">Nossos projetos</h3>
                    <div class="green-small-block"><? $number ?></div>
                </div>
            </div>
            <div class="trajectory">
                <div class="head-trajectory">
                    <h3 class="subtitle-profile">Nossa missão</h3>
                </div>
                <div class="ong-missao-block">
                    <p class="ong-missao"><?= $row['ds_missao'] ?></p>
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
                    <!-- <div class="img-profile">
                        <?php if (!empty($imagemVoluntario)) : ?>
                            <img src="<?= baseUrl($imagemVoluntario) ?>" alt="Foto de perfil do usuário">
                        <?php else: ?>
                            <img src="<?= baseUrl('/assets/img/iconUser.jpg') ?>" alt="Foto de perfil do usuário">
                        <?php endif; ?>
                    </div> -->
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
        </div>

    <script src="<?= baseUrl('/assets/js/visualizarImagem.js') ?>"></script>
    <script src="<?= baseUrl('/assets/js/modal.js') ?>"></script>
</body>

<?php
    include_once(includeURL('views/includes/footer.php'))
?>