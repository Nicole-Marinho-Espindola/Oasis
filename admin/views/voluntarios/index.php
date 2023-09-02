<?php
    include_once('../includes/head.php');
    include_once('../../config/database.php');
?>

<div class="content">
    <div class="search-block">
        <input class="search" type="text" placeholder="Pesquisar...">
        <button class="btn">Pesquisar</button>
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
        <tbody class="body-table">

            <?php
            
                if (isset($_GET['cadastro_sucesso']) && $_GET['cadastro_sucesso'] == 'true') {
                    $mensagem = "Cadastrado com sucesso.";
                } elseif (isset($_GET['email_repetido']) && $_GET['email_repetido'] == 'true') {
                    $mensagem = "Email já cadastrado.";
                } elseif (isset($_GET['editar_sucesso']) && $_GET['editar_sucesso'] == 'true') {
                    $mensagem = "Editado com sucesso.";
                } elseif (isset($_GET['excluir_sucesso']) && $_GET['excluir_sucesso'] == 'true') {
                    $mensagem = "Excluído com sucesso.";
                }

                try
                {
                    $select = $conn->prepare('SELECT v.cd_voluntario, v.nm_voluntario, v.nm_sobrenome, 
                                            v.dt_nascimento, v.ds_email, GROUP_CONCAT(i.ds_interesse SEPARATOR \', \') AS interesses
                                            FROM tb_voluntario v
                                            LEFT JOIN tb_escolha e ON v.cd_voluntario = e.cd_voluntario
                                            LEFT JOIN tb_interesse i ON e.cd_interesse = i.cd_interesse
                                            GROUP BY v.cd_voluntario');
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