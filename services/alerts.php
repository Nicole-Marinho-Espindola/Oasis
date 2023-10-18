
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.27/dist/sweetalert2.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.27/dist/sweetalert2.all.min.js"></script>
    <script src="../../assets\js\alertSweet.js"></script>

    <script>

        <?php

            if (isset($_GET['compartilhar_sucesso']) && $_GET['compartilhar_sucesso'] == 'true') {
                echo "AlertCompartilhamento();";
            }
            
        ?>

    </script>

</html>