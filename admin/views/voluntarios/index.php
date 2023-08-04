<?php
    include_once('../includes/navbar.php');
    include_once('../../assets/mocks/voluntarios.php');
?>

<div class="content">
    <div class="search-block">
        <input class="search" type="text" placeholder="Pesquisar...">
        <button class="btn">Pesquisar</button>
        <button class="btn btn-color margin-5">Cadastrar</button>
    </div>
    <table class="table">
        <thead class="header-table">
            <tr class="row-table">
                <th class="h-table">ID</th>
                <th class="h-table">Nome</th>
                <th class="h-table">Idade</th>
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
                </tr>
            <?php
                }
            ?>
        </tbody>
    </table>
</div>

