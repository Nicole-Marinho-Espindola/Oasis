<?php
    include_once('../includes/head.php');
    include_once('../../config/database.php');
    include_once('../../config/verificacao.php');
    include_once('search.php');
?>

    <div class="content">
        <div class="search-block">
        <input class="search" id="searchInputVoluntario" type="text" placeholder="Pesquisar...">
        <button class="btn" id="searchButtonVoluntario">Pesquisar</button>
            <a class="link-style-none" href="<?= baseUrl('views/voluntarios/cadastro.php') ?>">
                <button class="btn btn-color margin-5">Cadastrar</button>
            </a>
        </div>


    <table class="table">
        <thead class="header-table">
            <tr class="row-table">
                <th class="h-table">ID</th>
                <th class="h-table">Nome</th>
                <th class="h-table">Sobrenome</th>
                <th class="h-table">Data de Nascimento</th>
                <th class="h-table">Email</th>
                <th class="h-table">Interesses</th>
                <!-- <th class="h-table">Situação</th> -->
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody class="body-table" id="searchResults">

        <script src="<?= baseUrl('/assets/js/alertSweet.js') ?>"></script>

        <script>

            <?php
            if (isset($_GET['cadastro_sucesso']) && $_GET['cadastro_sucesso'] == 'true') {
                echo "alert();";
            } elseif (isset($_GET['email_repetido']) && $_GET['email_repetido'] == 'true') {
                echo "alertEmail();";
            }

            if (isset($_GET['editar_sucesso']) && $_GET['editar_sucesso'] == 'true') {
                echo "alertAlterar();";
            }

            if (isset($_GET['excluir_sucesso']) && $_GET['excluir_sucesso'] == 'true') {
                echo "alertExcluir();";
            }
            ?>

        </script>

            <?php

                $pagina_atual = filter_input(INPUT_GET, 'pagina', FILTER_SANITIZE_NUMBER_INT);
                $pagina = (!empty($pagina_atual)) ? $pagina_atual : 1;
                
                $qnt_result_pg = 10; // Alterar de acordo com o número de itens que deseja exibir por página
                
                // Calcular o início da visualização
                $inicio = ($qnt_result_pg * $pagina) - $qnt_result_pg;
                
                try
                {
                    $select = $conn->prepare('SELECT v.cd_voluntario, v.nm_voluntario, v.nm_sobrenome, 
                                            v.dt_nascimento, v.ds_email, GROUP_CONCAT(i.ds_interesse SEPARATOR \', \') AS interesses
                                            FROM tb_voluntario v
                                            LEFT JOIN tb_escolha e ON v.cd_voluntario = e.cd_voluntario
                                            LEFT JOIN tb_interesse i ON e.cd_interesse = i.cd_interesse
                                            GROUP BY v.cd_voluntario
                                            LIMIT :inicio, :qnt_result_pg');
                    $select->bindValue(':inicio', $inicio, PDO::PARAM_INT);
                    $select->bindValue(':qnt_result_pg', $qnt_result_pg, PDO::PARAM_INT);
                
                    $select->execute();
                
                    while ($row = $select->fetch())
                    {
            ?>
                        <tr class="row-table">
                            <td class="content-table"><?= $row['cd_voluntario'] ?></td>
                            <td class="content-table"><?= $row['nm_voluntario'] ?></td>
                            <td class="content-table"><?= $row['nm_sobrenome'] ?></td>
                            <td class="content-table"><?= date("d-m-Y", strtotime($row['dt_nascimento'])) ?></td>
                            <td class="content-table"><?= $row['ds_email'] ?></td>
                            <td class="content-table"><?= $row['interesses'] ?></td>
                            <!-- <td class="content-table"><?= $row['situacao'] ?></td>-->
                            <td><a href="editar.php?cd_voluntario=<?= $row['cd_voluntario'] ?>"><i class="fa-solid fa-pen-to-square" style="color: #1f512b;"></i></a></td>
                            <td><a href="excluir.php?cd_voluntario=<?= $row['cd_voluntario'] ?>"><i class="fa-solid fa-trash" style="color: #1f513b;"></i></a></td>
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

        <?php

            // Definir o valor padrão da página atual como 1
            $pagina_atual = (isset($_GET['pagina'])) ? filter_input(INPUT_GET, 'pagina', FILTER_SANITIZE_NUMBER_INT) : 1;

            // Paginação - Somar a quantidade de voluntários
            $selectCount = $conn->prepare("SELECT COUNT(cd_voluntario) AS num_result FROM tb_voluntario");
            $selectCount->execute();
            $row_pg = $selectCount->fetch(PDO::FETCH_ASSOC);

            // Quantidade de páginas
            $quantidade_pg = ceil($row_pg['num_result'] / $qnt_result_pg);

            $pag_ant = ($pagina_atual > 1) ? $pagina_atual - 1 : 1; // Página anterior
            echo "<li class='page-item'><a class='page-link' href='index.php?pagina=$pag_ant'>Anterior</a></li>";

            for ($pag = 1; $pag <= $quantidade_pg; $pag++) {
                if ($pag == $pagina_atual) {
                    echo "<li class='page-item active'><a class='page-link'>$pag</a></li>";
                } else {
                    echo "<li class='page-item'><a class='page-link' href='index.php?pagina=$pag'>$pag</a></li>";
                }
            }

            $pag_dep = ($pagina_atual < $quantidade_pg) ? $pagina_atual + 1 : $pagina_atual; // Próxima página
            echo "<li class='page-item'><a class='page-link' href='index.php?pagina=$pag_dep'>Próximo</a></li>";

        ?>

        </ul>
    </div>

</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="<?= baseUrl('/assets/js/searchAjax.js') ?>"></script>