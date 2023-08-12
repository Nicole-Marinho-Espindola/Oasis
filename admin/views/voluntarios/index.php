<?php
    include_once('../includes/head.php');
    include_once('../../assets/mocks/voluntarios.php');
?>

<div class="content">
    <div class="search-block">
        <input class="search" type="text" placeholder="Pesquisar...">
        <button class="btn">Pesquisar</button>
        <a class="link-style-none" href=<?= baseUrl('views/voluntarios/cadastro.php')?>>
            <button class="btn btn-color margin-5">Cadastrar</button>
        </a>
    </div>
    <table class="table">
        <thead class="header-table">
            <tr class="row-table">
                <th class="h-table">ID</th>
                <th class="h-table">Nome</th>
                <th class="h-table">Idade</th>
                <th>Situação</th>
                <th></th>
            </tr>
        </thead>
        <tbody class="body-table">
            <?php
                foreach($voluntarios as $voluntario) 
                {
            ?>
                <tr class="row-table">
                    <td class="content-table"><?= $voluntario['id'] ?></td>
                    <td class="content-table"><?= $voluntario['nome'] ?></td>
                    <td class="content-table"><?= $voluntario['idade'] ?></td>  
                    <td class="content-table"><?= $voluntario['situacao'] ?></td>  
                    <a href=<?= baseUrl('views/voluntarios/editar.php?id='.$voluntario['id'])?>><i class="fa-solid fa-pen-to-square" style="color: #1f512b;"></i></a>
                    <td><i class="fa-solid fa-trash" style="color: #1f513b;"></i></td>
                </tr>
            <?php
                }
            ?>
        </tbody>
    </table>
    <div class="page-nav" aria-label="Page navigation example">
        <ul class="pagination justify-content-center">
            <li class="page-item disabled">
            <a class="page-link">Anterior</a>
            </li>
            <li class="page-item"><a class="page-link" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item">
            <a class="page-link" href="#">Próximo</a>
            </li>
        </ul>
    </div>
</div>

