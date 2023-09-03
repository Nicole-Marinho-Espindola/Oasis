<?php
    include_once('../includes/head.php');
    include_once('../../config/database.php');
    include_once('../../config/verificacao.php');
    include_once('search.php');
?>

    <div class="content">
        <div class="search-block">
        <input class="search" id="searchInputInteresse" type="text" placeholder="Pesquisar...">
            <button class="btn" id="searchButtonInteresse">Pesquisar</button>
            <a class="link-style-none" href="<?= baseUrl('views/interesses/cadastro.php') ?>">
                <button class="btn btn-color margin-5">Cadastrar</button>
            </a>
        </div>

    <table class="table">
        <thead>
            <th>Interesses Cadastrados</th>
            <th></th>
            <th></th>
        </thead>
        <tbody id="searchResults">

            <?php
                if (isset($_GET['cadastro_sucesso']) && $_GET['cadastro_sucesso'] == 'true') {
                    echo "<script>alert('Cadastrado com sucesso.');</script>";
                } 

                if (isset($_GET['editar_sucesso']) && $_GET['editar_sucesso'] == 'true') {
                    echo "<script>alert('Editado com sucesso.');</script>";
                }

                if (isset($_GET['excluir_sucesso']) && $_GET['excluir_sucesso'] == 'true') {
                    echo "<script>alert('Excluído com sucesso.');</script>";
                }

                try
                {
                    $select = $conn->prepare('SELECT * FROM tb_interesse');
                    $select->execute();

                    while ($row = $select->fetch())
                    {
            ?>
                        <tr class="row-table">
                            <td class="content-table"><?= $row['ds_interesse'] ?></td>
                            <td><a href="editar.php?cd_interesse=<?= $row['cd_interesse'] ?>"><i class="fa-solid fa-pen-to-square" style="color: #1f512b;"></i></a></td>
                            <td><a href="excluir.php?cd_interesse=<?= $row['cd_interesse'] ?>"><i class="fa-solid fa-trash" style="color: #1f513b;"></i></a></td>
                        </tr>
            <?php

                    }
                } catch (PDOException $e) {
                    echo "Erro ao consultar: " . $e->getMessage();
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="<?= baseUrl('/assets/js/pesquisarAjax.js') ?>"></script>