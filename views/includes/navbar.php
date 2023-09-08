
<body>
    <nav class="navbar">
        <div class="logo-block">
            <a href="javascript:void(0);">
                <i class="fa-solid fa-bars icon" ></i>
            </a>
            <img class="logo" src="<?= baseUrl('/assets/img/logo-oasis.png') ?>" alt="Logo da Oásis">
            <span class="logo-nome">Oásis</span>
        </div>
        <ul class="nav-ul">
            <a href="<?= baseUrl('/views/index.php') ?>" class="nav-bar-link-style"><li class="nav-li">Home</li></a>
            <a href="<?= baseUrl('/views/pages/sobreNos.php') ?>" class="nav-bar-link-style"><li class="nav-li">Sobre nós</li></a>
            <a href="<?= baseUrl('/views/pages/projetos.php') ?>" class="nav-bar-link-style"><li class="nav-li">Projetos</li></a>
        </ul>
        <div class="sign-up-block">
            <a class="link-style-none sign-in" href="<?= baseUrl('/views/forms/login.php') ?>">Entrar</a>
            <button class="btn"><a class="link-style-none" href="<?= baseUrl('/views/forms/cadastro.php') ?>">Cadastro</a></button>
        </div>
    </nav>
    <aside class="barra-lateral" >
        <ul class="menuLateral">
            <li class="list-style">
                <i class="fa-solid fa-house icon-color"></i>
                <a class="link-style" href="">Home</a>
            </li>
            <li class="list-style">
                <i class="fa-solid fa-circle-info icon-color"></i>
                <a class="link-style" href="">Sobre nós</a>
            </li>
            <li class="list-style">
                <i class="fa-solid fa-users icon-color"></i>
                <a class="link-style" href="">Sou uma ONG</a>
            </li>
            <li class="list-style">
                <i class="fa-solid fa-user icon-color"></i>
                <a href=""class="link-style">Perfil</a>
            </li>
            <li class="list-style">
                <i class="fa-solid fa-hand-holding-heart icon-color"></i>
                <a href="" class="link-style">Doação</a>
            </li>
        </ul>
    </aside>

    <script src="<?= baseUrl('/assets/js/menuHamburguer.js') ?>"></script>
