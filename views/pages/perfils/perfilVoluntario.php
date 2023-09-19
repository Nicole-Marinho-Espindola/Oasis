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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Plataforma | Oásis</title>
</head>

<?php
    include_once('../../includes/navPerfil.php');
?>

<body>
    <div class="profile-block">
        <div class="profile-purple-block">
            <div class="social-midia-block">
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
            <div class="edit-profile">
                <i class="fa-regular fa-pen-to-square social-midia-icon"></i>
                <span>Editar perfil</span>
            </div>
        </div>
        <img src="" alt="" class="profile-img">
        <div class="user-profile-info">
            <div class="text-profile-block">
                <h1 class="user-name">Maia Lilica Jade</h1>
                <div class="line"></div>
            </div>
            <div class="user-profile-int">
                <div class="label-interesse">
                    <label class="label-content-int">
                        <input type="checkbox" class="input-interesse">
                        <div class="int-content">
                            <img class="img-interesse" src="<?= baseUrl('/assets/img/futebol.png')?>" alt="">
                        </div>
                    </label>
                </div>
                <div class="label-interesse">
                    <label class="label-content-int">
                        <input type="checkbox" class="input-interesse">
                        <div class="int-content">
                            <img class="img-interesse" src="<?= baseUrl('/assets/img/flamingo.png')?>" alt="">
                        </div>
                    </label>
                </div>
                <div class="label-interesse">
                    <label class="label-content-int">
                        <input type="checkbox" class="input-interesse">
                        <div class="int-content">
                            <img class="img-interesse" src="<?= baseUrl('/assets/img/lavanda.png')?>" alt="">
                        </div>
                    </label>
                </div>
            </div>
        </div>
        <div class="user-story">
            <div class="trajectory">
                <h3 class="subtitle-profile">Minha trajetoria de projetos</h3>
                <div class="green-small-block"><? $number ?></div>
            </div>
            <div class="trajectory">
                <h3 class="subtitle-profile">Minhas incrições em projetos</h3>
                <div class="green-small-block"><? $number ?></div>
            </div>
        </div>
    </div>
</body>

<?php
    include_once('../../includes/footer.php')
?>