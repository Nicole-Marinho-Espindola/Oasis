<?php
    include_once('./includes/head.php');
    include_once('./../assets/mocks/interesse.php');
?>

<div class="content">
    <div class="search-block">
        <input class="search" type="text" placeholder="Pesquisar...">
        <button class="btn">Pesquisar</button>
        <button class="btn btn-color margin-5">Cadastrar</button>
    </div>
    <table class="table">
        <thead>
            <th>Interesses Cadastrados</th>
            <th></th>
            <th></th>
        </thead>
        <tbody>
            <?php
                foreach($interesses as $interesse) 
                {
            ?>
                <tr class="row-table">
                    <td class="content-table"><?= $interesse['interesse'] ?></td>
                    <td><i class="fa-solid fa-pen-to-square" style="color: #1f512b;"></i></td>
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