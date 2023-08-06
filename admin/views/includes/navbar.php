<!DOCTYPE html>
<html lang="en">
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
            </ul>
            <li class="list-style">
                <i class="fa-solid fa-user-group" style="color: #ffffff;"></i>
                <a class="link-style" data-bs-toggle="collapse" href="#multiCollapseExample2" role="button" aria-expanded="false" aria-controls="multiCollapseExample1">
                    ONG
                </a>
            </li>
            <ul class="collapse multi-collapse" id="multiCollapseExample2">
                <li class="list-style"><a class="sub-list" href="../ongs/index.php">Lista de ongs</a></li>
                <li class="list-style"><a class="sub-list" href="../ongs/situacaoOng.php">Situação da ong</a></li>
            </ul>
            <li class="list-style">
                <i class="fa-solid fa-list" style="color: #ffffff;"></i>
                <a href="../interesse.php" class="link-style">Interesses</a>
            </li>
            <div class="btn-block">
                <button class="btn"><i class="fa-solid fa-right-from-bracket" style="color: #ffffff;"></i><span class="margin-5">Sair</span></button>
            </div>
        </ul>
    </aside>
