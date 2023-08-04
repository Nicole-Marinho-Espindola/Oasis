<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/4719b1c3ae.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../../assets/css/global.css">
    <link rel="stylesheet" href="../../assets/css/navbar.css">
    <link rel="stylesheet" href="../../assets/css/voluntarios/index.css">
    <link rel="stylesheet" href="../../assets/css/voluntarios/nivel-acesso.css">
    <link rel="stylesheet" href="../../assets/css/voluntarios/situacao-voluntario.css">
    <title>Admin</title>
</head>
<body>
    <nav class="navbar">
        <img class="logo" src="" alt="Logo da Oásis">
        <div class="perfil">
            <img class="foto-perfil" src="../../assets/img/foto-perfil.jpeg" alt="Foto de perfil admin">
        </div>
    </nav>
    <aside class="barra-lateral">
        <ul class="menu-lateral">
            <li class="list-style">
                <i class="fa-solid fa-house" style="color: #ffffff;"></i>
                <a class="link-style" href="">Home</a>
            </li>
            <li class="list-style">
                <i class="fa-solid fa-user" style="color: #ffffff;"></i>
                <a class="link-style" data-bs-toggle="collapse" href="#multiCollapseExample1" role="button" aria-expanded="false" aria-controls="multiCollapseExample1">
                    Voluntário
                </a>
            </li>
            <ul class="collapse multi-collapse" id="multiCollapseExample1">
                <li class="list-style"><a class="sub-list" href="../voluntarios/index.php">Lista de voluntários</a></li>
                <li class="list-style"><a class="sub-list" href="../voluntarios/situacaoVoluntario.php">Situação do voluntário</a></li>
                <li class="list-style"><a class="sub-list" href="../voluntarios/nivelAcesso.php">Nivel de acesso</a></li>
            </ul>
            <li class="list-style">
                <i class="fa-solid fa-user-group" style="color: #ffffff;"></i>
                <a class="link-style" data-bs-toggle="collapse" href="#multiCollapseExample2" role="button" aria-expanded="false" aria-controls="multiCollapseExample1">
                    ONG
                </a>
            </li>
            <ul class="collapse multi-collapse" id="multiCollapseExample2">
                <li class="list-style"><a class="sub-list" href="">Lista de ongs</a></li>
                <li class="list-style"><a class="sub-list" href="">Situação da ong</a></li>
                <li class="list-style"><a class="sub-list" href="">Nivel de acesso</a></li>
            </ul>
            <li class="list-style">
                <i class="fa-solid fa-list" style="color: #ffffff;"></i>
                <a class="link-style" data-bs-toggle="collapse" data-bs-target="#multiCollapseExample3" role="button" aria-expanded="false" aria-controls="multiCollapseExample2">
                  Interesses
                </a>
            </li>
            <ul class="collapse multi-collapse" id="multiCollapseExample3">
                <li class="list-style"><a class="sub-list" href="">Interesses cadastrados</a></li>
                <li class="list-style"><a class="sub-list" href="">Interesses config</a></li>
            </ul>
            <div class="btn-block">
                <button class="btn"><i class="fa-solid fa-right-from-bracket" style="color: #ffffff;"></i><span class="margin-5">Sair</span></button>
            </div>
        </ul>
    </aside>
