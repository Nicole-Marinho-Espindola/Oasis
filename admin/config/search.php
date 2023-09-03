<?php

include_once('database.php');

if (isset($_POST['search']) && isset($_POST['contexto'])) {
    $searchTerm = $_POST['search'];
    $contexto = $_POST['contexto'];

    if ($contexto === 'ongs') {
        // Coloque aqui o código para a pesquisa de ONGs
    } elseif ($contexto === 'voluntarios') {

        try {
            $select = $conn->prepare("SELECT v.cd_voluntario, v.nm_voluntario, v.nm_sobrenome, 
            v.dt_nascimento, v.ds_email, GROUP_CONCAT(i.ds_interesse SEPARATOR ', ') AS interesses
            FROM tb_voluntario v
            LEFT JOIN tb_escolha e ON v.cd_voluntario = e.cd_voluntario
            LEFT JOIN tb_interesse i ON e.cd_interesse = i.cd_interesse
            WHERE v.nm_voluntario LIKE :searchTerm
            GROUP BY v.cd_voluntario");

            $select->bindValue(':searchTerm', '%' . $searchTerm . '%', PDO::PARAM_STR);
            $select->execute();

            $results = "";
            while ($row = $select->fetch()) {
                $results .= "<tr class='row-table'>
                                <td class='content-table'>{$row['cd_voluntario']}</td>
                                <td class='content-table'>{$row['nm_voluntario']}</td>
                                <td class='content-table'>{$row['nm_sobrenome']}</td>
                                <td class='content-table'>" . date("d-m-Y", strtotime($row['dt_nascimento'])) . "</td>
                                <td class='content-table'>{$row['ds_email']}</td>
                                <td class='content-table'>{$row['interesses']}</td>
                                <td><a href='editar.php?cd_voluntario={$row['cd_voluntario']}'><i class='fa-solid fa-pen-to-square' style='color: #1f512b;'></i></a></td>
                                <td><a href='excluir.php?cd_voluntario={$row['cd_voluntario']}'><i class='fa-solid fa-trash' style='color: #1f513b;'></i></a></td>
                            </tr>";
            }

            echo $results;
        } catch (PDOException $e) {
            echo "Erro durante a consulta: " . $e->getMessage();
        }

    } elseif ($contexto === 'interesses') {
        try {
            $select = $conn->prepare('SELECT * FROM tb_interesse');
            $select->execute();
    
            $results = "";
            while ($row = $select->fetch()) {
                $results .= "<tr class='row-table'>
                                <td class='content-table'>" . $row['ds_interesse'] . "</td>
                                <td><a href='editar.php?cd_interesse=" . $row['cd_interesse'] . "'><i class='fa-solid fa-pen-to-square' style='color: #1f512b;'></i></a></td>
                                <td><a href='excluir.php?cd_interesse=" . $row['cd_interesse'] . "'><i class='fa-solid fa-trash' style='color: #1f513b;'></i></a></td>
                            </tr>";
            }
    
            echo $results;
        } catch (PDOException $e) {
            echo "Erro durante a consulta: " . $e->getMessage();
        }
    }
    
    

}

?>
