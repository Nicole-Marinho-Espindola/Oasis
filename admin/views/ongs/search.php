<?php
    include_once('../../config/database.php');

    if (isset($_POST['search'])) {
        $searchTerm = '%' . $_POST['search'] . '%'; // Modificado aqui

        try {
            $select = $conn->prepare('SELECT * FROM tb_ong WHERE nm_ong LIKE :searchTerm'); // Modificado aqui
            $select->bindParam(':searchTerm', $searchTerm, PDO::PARAM_STR); // Modificado aqui
            $select->execute();

            $results = "";
            while ($row = $select->fetch()) {
                $results .= "<tr class='row-table'>
                                <td class='content-table'>" . $row['cd_ong'] . "</td>
                                <td class='content-table'>" . $row['nm_ong'] . "</td>
                                <td class='content-table'>" . $row['nm_razao'] . "</td>
                                <td class='content-table'>" . $row['cd_cnpj'] . "</td>
                                <td class='content-table'>" . $row['ds_email'] . "</td>
                                <td class='content-table'>" . $row['cd_celular_ong'] . "</td>
                                <td><a href='editar.php?cd_ong=" . $row['cd_ong'] . "'><i class='fa-solid fa-pen-to-square' style='color: #1f512b;'></i></a></td>
                                <td><a href='excluir.php?cd_ong=" . $row['cd_ong'] . "'><i class='fa-solid fa-trash' style='color: #1f513b;'></i></a></td>
                            </tr>";
            }            

            echo $results;
        } catch (PDOException $e) {
            echo "Erro durante a consulta: " . $e->getMessage();
        }
    }
?>
