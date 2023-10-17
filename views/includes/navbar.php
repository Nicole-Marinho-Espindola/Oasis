<body>
    <nav class="navbar">
        <div class="logo-block">
            <a href="javascript:void(0);">
                <i class="fa-solid fa-bars icon"></i>
            </a>
            <a class="logo-block-title" href="<?= baseUrl('/index.php') ?>">
                <img class="logo" src="<?= baseUrl('/assets/img/logo-oasis.png') ?>" alt="Logo da Oásis">
                <span class="logo-nome">Oásis</span>
            </a>
        </div>
        <ul class="nav-ul">
            <a href="<?= baseUrl('/index.php') ?>" class="nav-bar-link-style"><li class="nav-li">Home</li></a>
            <a href="<?= baseUrl('/views/pages/sobreNos.php') ?>" class="nav-bar-link-style"><li class="nav-li">Sobre nós</li></a>
            <a href="<?= baseUrl('/views/pages/projetos/projetosOng.php') ?>" class="nav-bar-link-style"><li class="nav-li">Projetos</li></a>
        </ul>

        <?php if(isset($_SESSION['email'])): ?>
            <div class="sign-up-block">
                <a class="link-style-none sign-in-on">Olá, <?= $row['nome_usuario'] ?></a>
                <?php if ($_SESSION['tipo_usuario'] === 'voluntario'): ?>
                    <a href="<?= baseUrl('/views/pages/perfils/perfilVoluntario.php') ?>"><i class="fa-regular fa-user user"></i></a>
                <?php elseif ($_SESSION['tipo_usuario'] === 'ong'): ?>
                    <a href="<?= baseUrl('/views/pages/perfils/perfilOng.php') ?>"><i class="fa-regular fa-user user"></i></a>
                <?php endif; ?>
            </div>
        <?php else: ?>
            <div class="sign-up-block">
                <a class="link-style-none sign-in" href="<?= baseUrl('/views/forms/voluntarios/login.php') ?>">Entrar</a>
                <button class="btn"><a class="link-style-none" href="<?= baseUrl('/views/forms/voluntarios/cadastro.php') ?>">Cadastro</a></button>
            </div>
        <?php endif; ?>
    </nav>

    <aside class="barra-lateral">
        <ul class="menuLateral">
            <li class="list-style">
                <i class="fa-solid fa-house icon-color"></i>
                <a class="link-style" href="<?= baseUrl('/index.php') ?>">Home</a>
            </li>
            <li class="list-style">
                <i class="fa-solid fa-circle-info icon-color"></i>
                <a class="link-style" href="<?= baseUrl('/views/pages/sobreNos.php') ?>">Sobre nós</a>
            </li>

            <?php if(empty($_SESSION['email']) || (isset($_SESSION['tipo_usuario']) && $_SESSION['tipo_usuario'] === 'ong')): ?>
                <li class="list-style">
                    <i class="fa-solid fa-users icon-color"></i>
                    <a class="link-style" href="<?= baseUrl('/views/forms/ongs/cadastro.php') ?>">Sou uma ONG</a>
                </li>
            <?php endif; ?>

            <?php if(isset($_SESSION['email'])): ?>
                <li class="list-style">
                    <i class="fa-solid fa-user icon-color"></i>
                    <?php if ($_SESSION['tipo_usuario'] === 'voluntario'): ?>
                        <a href="<?= baseUrl('/views/pages/perfils/perfilVoluntario.php') ?>" class="link-style">Perfil</a>
                    <?php elseif ($_SESSION['tipo_usuario'] === 'ong'): ?>
                        <a href="<?= baseUrl('/views/pages/perfils/perfilOng.php') ?>" class="link-style">Perfil</a>
                    <?php endif; ?>
                </li>
            <?php endif; ?>
            
            <?php if(isset($_SESSION['email'])): ?>
                <?php if ($_SESSION['tipo_usuario'] === 'voluntario'): ?>
                    <li class="list-style">
                        <i class="fa-solid fa-hand-holding-heart icon-color"></i>
                        <a href="<?= baseUrl('/views/pages/doe.php') ?>" class="link-style">Doação</a>
                    </li>
                <?php endif; ?>
            <?php endif; ?>

            <?php if(isset($_SESSION['email'])): ?>
                <div class="nav-bar-btn-block">
                    <a href="<?= baseUrl('/services/controllers/auth/logout.php') ?>" class="btn">
                        <i class="fa-solid fa-right-from-bracket" style="color: #ffffff;"></i>
                        <span class="margin-5">Sair</span>
                    </a>
                </div>
            <?php endif; ?>
            
        </ul>
    </aside>

    <script src="<?= baseUrl('/assets/js/menuHamburguer.js') ?>"></script>
</body>
