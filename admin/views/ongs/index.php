<?php
    include_once('../includes/head.php');
    include_once('../../config/database.php');
?>

<div class="content">
    <div class="search-block">
        <input class="search" type="text" placeholder="Pesquisar...">
        <button class="btn">Pesquisar</button>
        <a class="link-style-none" href="<?= baseUrl('views/ongs/cadastro.php') ?>">
            <button class="btn btn-color margin-5">Cadastrar</button>
        </a>
    </div>
    <table class="table">
        <thead>
            <th>Id</th>
            <th>Nome</th>
            <th>Razão Social</th>
            <th>CNPJ</th>
            <!-- <th>Situação</th> -->
            <th>Email</th>
            <th>Celular</th>
            <th></th>
        </thead>
        <tbody>

            <?php

                if (isset($_GET['cadastro_sucesso']) && $_GET['cadastro_sucesso'] == 'true') {
                    echo "<script>alert('Cadastrado com sucesso.');</script>";
                } elseif (isset($_GET['email_repetido']) && $_GET['email_repetido'] == 'true') {
                    echo "<script>alert('Email já cadastrado.');</script>";
                }

                try
                {
                    $select = $conn->prepare('SELECT * FROM tb_ong');
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
                            <td><i class="fa-solid fa-trash" style="color: #1f513b;"></i></td>
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