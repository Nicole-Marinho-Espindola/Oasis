<?php
    include_once('../includes/head.php');
    include_once('../../config/database.php');
    include_once('../../config/verificacao.php');
    include_once('search.php');
?>

    <div class="content">
        <div class="search-block">
        <input class="search" id="searchInputOng" type="text" placeholder="Pesquisar...">
            <button class="btn" id="searchButtonOng">Pesquisar</button>
            <a class="link-style-none" href="<?= baseUrl('views/ongs/cadastro.php') ?>">
                <button class="btn btn-color margin-5">Cadastrar</button>
            </a>
        </div>

    <table class="table">
        <thead>
            <th>ID</th>
            <th>Nome</th>
            <th>Razão Social</th>
            <th>CNPJ</th>
            <!-- <th>Situação</th> -->
            <th>Email</th>
            <th>Celular</th>
            <th></th>
            <th></th>
        </thead>
        <tbody id="searchResults">

            <?php
                if (isset($_GET['cadastro_sucesso']) && $_GET['cadastro_sucesso'] == 'true') {
                    echo "<script>alert('Cadastrado com sucesso.');</script>";
                } elseif (isset($_GET['email_repetido']) && $_GET['email_repetido'] == 'true') {
                    echo "<script>alert('Email já cadastrado.');</script>";
                }

                if (isset($_GET['editar_sucesso']) && $_GET['editar_sucesso'] == 'true') {
                    echo "<script>alert('Editado com sucesso.');</script>";
                }

                if (isset($_GET['excluir_sucesso']) && $_GET['excluir_sucesso'] == 'true') {
                    echo "<script>alert('Excluído com sucesso.');</script>";
                }

                $pagina_atual = filter_input(INPUT_GET, 'pagina', FILTER_SANITIZE_NUMBER_INT);
                $pagina = (!empty($pagina_atual)) ? $pagina_atual : 1;
                                
                // Setar a quantidade de itens por página
                $qnt_result_pg = 10; // Altere de acordo com o número de itens que deseja exibir por página
                                
                // Calcular o início da visualização
                $inicio = ($qnt_result_pg * $pagina) - $qnt_result_pg;
                
                try
                {
                    // Certifique-se de que a conexão PDO ($conn) esteja configurada corretamente antes deste trecho
                    $select = $conn->prepare('SELECT * FROM tb_ong LIMIT :inicio, :qnt_result_pg');
                    // Associe os valores aos marcadores de posição
                    $select->bindValue(':inicio', $inicio, PDO::PARAM_INT);
                    $select->bindValue(':qnt_result_pg', $qnt_result_pg, PDO::PARAM_INT);
                    $select->execute();

                    while ($row = $select->fetch())
                    {
            ?>
                        <tr class="row-table">
                            <td class="content-table"><?= $row['cd_ong'] ?></td>
                            <td class="content-table"><?= $row['nm_ong'] ?></td>
                            <td class="content-table"><?= $row['nm_razao'] ?></td>
                            <td class="content-table"><?= $row['cd_cnpj'] ?></td>
                            <td class="content-table"><?= $row['ds_email'] ?></td>
                            <td class="content-table"><?= $row['cd_celular_ong'] ?></td>
                            <!-- <td class="content-table"><?= $row['situacao'] ?></td>-->
                            <td><a href="editar.php?cd_ong=<?= $row['cd_ong'] ?>"><i class="fa-solid fa-pen-to-square" style="color: #1f512b;"></i></a></td>
                            <td><a href="excluir.php?cd_ong=<?= $row['cd_ong'] ?>"><i class="fa-solid fa-trash" style="color: #1f513b;"></i></a></td>
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

                // Paginação - Somar a quantidade de voluntários
                $selectCount = $conn->prepare("SELECT COUNT(cd_ong) AS num_result FROM tb_ong");
                $selectCount->execute();
                $row_pg = $selectCount->fetch(PDO::FETCH_ASSOC);

                // Quantidade de páginas
                $quantidade_pg = ceil($row_pg['num_result'] / $qnt_result_pg);

                $pag_ant = ($pagina_atual > 1) ? $pagina_atual - 1 : 1; // Página anterior
                echo "<li class='page-item'><a class='page-link' href='index.php?pagina=$pag_ant'>Anterior</a></li>";

                for ($pag = max(1, $pagina_atual - 2); $pag <= min($pagina_atual + 3, $quantidade_pg); $pag++) {
                    if ($pag == $pagina_atual) {
                        echo "<li class='page-item active'><a class='page-link'>$pag</a></li>";
                    } else {
                        echo "<li class='page-item'><a class='page-link' href='index.php?pagina=$pag'>$pag</a></li>";
                    }
                }

                $pag_dep = ($pagina_atual < $quantidade_pg) ? $pagina_atual + 1 : $quantidade_pg;
                echo "<li class='page-item'><a class='page-link' href='index.php?pagina=$pag_dep'>Próximo</a></li>";
            ?>
        </ul>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="<?= baseUrl('/assets/js/pesquisarAjax.js') ?>"></script>