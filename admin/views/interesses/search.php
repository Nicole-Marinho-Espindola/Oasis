<?php
    include_once('../../config/database.php');

    if (isset($_POST['search'])) {
        $searchTerm = '%' . $_POST['search'] . '%';

        try {
            $select = $conn->prepare('SELECT * FROM tb_interesse WHERE ds_interesse LIKE :searchTerm');
            $select->bindParam(':searchTerm', $searchTerm, PDO::PARAM_STR);
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
?>
