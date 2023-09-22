
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
            <a href="<?= baseUrl('/index.php') ?>" class="nav-bar-link-style"><li class="nav-li">Home</li></a>
            <a href="<?= baseUrl('/views/pages/sobreNos.php') ?>" class="nav-bar-link-style"><li class="nav-li">Sobre nós</li></a>
            <a href="<?= baseUrl('/views/pages/projetos.php') ?>" class="nav-bar-link-style"><li class="nav-li">Projetos</li></a>
        </ul>

        <?php if(isset($_SESSION['email'])) { ?>

            <div class="sign-up-block">
                <a class="link-style-none sign-in">Olá, <?php echo $row['nome_usuario']; ?></a>
            </div>

        <?php } else{ ?>

            <div class="sign-up-block">
                <a class="link-style-none sign-in" href="<?= baseUrl('/views/forms/voluntarios/login.php') ?>">Entrar</a>
                <button class="btn"><a class="link-style-none" href="<?= baseUrl('/views/forms/voluntarios/cadastro.php') ?>">Cadastro</a></button>
            </div>

        <?php } ?>

    </nav>
    <aside class="barra-lateral" >
        <ul class="menuLateral">
            <li class="list-style">
                <i class="fa-solid fa-house icon-color"></i>
                <a class="link-style" href="<?= baseUrl('/index.php') ?>">Home</a>
            </li>
            <li class="list-style">
                <i class="fa-solid fa-circle-info icon-color"></i>
                <a class="link-style" href="<?= baseUrl('/views/pages/sobreNos.php') ?>">Sobre nós</a>
            </li>
            <li class="list-style">
                <i class="fa-solid fa-users icon-color"></i>
                <a class="link-style" href="">Sou uma ONG</a>
            </li>
            <li class="list-style">
                <i class="fa-solid fa-user icon-color"></i>
                <a href="" class="link-style">Perfil</a>
            </li>
            <li class="list-style">
                <i class="fa-solid fa-hand-holding-heart icon-color"></i>
                <a href="" class="link-style">Doação</a>
            </li>
            <div class="btn-block">
                <a href="<?= baseUrl('/services/controllers/auth/logout.php') ?>" class="btn">
                    <i class="fa-solid fa-right-from-bracket" style="color: #ffffff;"></i>
                    <span class="margin-5">Sair</span>
                </a>
            </div>
        </ul>
    </aside>

    <script src="<?= baseUrl('/assets/js/menuHamburguer.js') ?>"></script>
