<!DOCTYPE html>
<html lang="en">
<body>
    <nav class="navbar">
        <div class="logo-block">
            <a href="javascript:void(0);">
                <i class="fa-solid fa-bars icon" ></i>
            </a>
            
            <a class="logo-block-title" href="<?= baseUrl('views/home-admin.php') ?>">
                <img class="logo" src="<?= baseUrl('/assets/img/logo-oasis.png') ?>" alt="Logo da Oásis">
                <span class="logo-nome">Oásis</span>
            </a>

        </div>
        <!-- <div class="perfil">
            <img class="foto-perfil" src="../../assets/img/foto-perfil.jpeg" alt="Foto de perfil admin">
        </div> -->
    </nav>
    <aside class="barra-lateral" >
        <ul class="menuLateral">
            <li class="list-style">
                <i class="fa-solid fa-house" style="color: #ffffff;"></i>
                <a class="link-style" href="<?= baseUrl('views/home-admin.php') ?>">Home</a>
            </li>
            <li class="list-style">
                <i class="fa-solid fa-user" style="color: #ffffff;"></i>
                <a class="link-style" data-bs-toggle="collapse" href="#multiCollapseExample1" role="button" aria-expanded="false" aria-controls="multiCollapseExample1">
                    Voluntário
                </a>
            </li>
            <ul class="collapse multi-collapse" id="multiCollapseExample1">
                <li class="list-style"><a class="sub-list" href="<?= baseUrl('views/voluntarios/index.php') ?>">Lista de voluntários</a></li>
            </ul>
            <li class="list-style">
                <i class="fa-solid fa-user-group" style="color: #ffffff;"></i>
                <a class="link-style" data-bs-toggle="collapse" href="#multiCollapseExample2" role="button" aria-expanded="false" aria-controls="multiCollapseExample1">
                    ONG
                </a>
            </li>
            <ul class="collapse multi-collapse" id="multiCollapseExample2">
                <li class="list-style"><a class="sub-list" href="<?= baseUrl('views/ongs/index.php') ?>">Lista de ongs</a></li>
            </ul>
            <li class="list-style">
                <i class="fa-solid fa-list" style="color: #ffffff;"></i>
                <a href="<?= baseUrl('views/interesses/index.php') ?>" class="link-style">Interesses</a>
            </li>
            <div class="btn-block">
                <a href="<?= baseUrl('config/logout.php') ?>" class="btn">
                    <i class="fa-solid fa-right-from-bracket" style="color: #ffffff;"></i>
                    <span class="margin-5">Sair</span>
                </a>
            </div>
        </ul>
    </aside>

    <script src="<?= baseUrl('/assets/js/menuHamburguer.js') ?>"></script>
