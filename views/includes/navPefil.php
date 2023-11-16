<?php
    include_once(includeURL('/services/helpers.php'));
    include_once(includeURL('/config/autenticacao.php'));
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/4719b1c3ae.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="<?= baseUrl('/assets/css/global.css')?>">
    <link rel="stylesheet" href="<?= baseUrl('/assets/css/navbar.css')?>">
    <link rel="stylesheet" href="<?= baseUrl('/assets/css/perfil.css')?>">
    
    <title>Perfil voluntario | Oásis</title>
</head>

<nav class="nav-perfil">
    <div class="back-block">
        <a href="<?= baseUrl('/index.php') ?>" class="back-green-btn">
            <i class="fa-solid fa-chevron-left"></i>
        </a>
    </div>
    <div class="logo-block">
        <img class="logo" src="<?= baseUrl('/assets/img/logo-oasis.png') ?>" alt="Logo da Oásis">
        <span class="logo-nome">Oásis</span>
    </div>
    <div class="btn-block">
        <a href="<?= baseUrl('/services/controllers/auth/logout.php') ?>" class="purple-small-btn link-style-none logout-link">Sair</a>
    </div>
    <script src="<?= baseUrl('/assets/js/alerts.js') ?>"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const logoutLinks = document.querySelectorAll('.logout-link');
            if (logoutLinks) {
                logoutLinks.forEach(logoutLink => {
                    logoutLink.addEventListener('click', function (e) {
                        e.preventDefault(); // Impede o comportamento padrão do link

                        Swal.fire({
                        title: '<span style="font-size: 25px;">Tem certeza de que deseja sair?</span>',
                        icon: 'question',
                        // iconHtml: '<i class="fa-solid fa-circle-exclamation" style="color: purple";></i>',
                        showCancelButton: true,
                        confirmButtonColor: '#586D48',
                        cancelButtonColor: '#a173bdc9',
                        confirmButtonText: 'Sair',
                        cancelButtonText: 'Cancelar',
                        customClass: {
                            confirmButton: 'custom-confirm-btn-class',
                            cancelButton: 'custom-cancel-btn-class'
                        },
                        background: '#fff'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            alertLogout();
                            setTimeout(() => {
                                window.location.href = e.target.href;
                            });
                        }
                    });
                });
            });
        }
        });
    </script>
</nav>