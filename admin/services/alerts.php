
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.27/dist/sweetalert2.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.27/dist/sweetalert2.all.min.js"></script>
    <script src="../../assets/js/alertSweet.js"></script>

    <script>

        <?php

            if (isset($_GET['acesso_negado']) && $_GET['acesso_negado'] == 'true') {
                echo "alertAcesso();";
            }
            if (isset($_GET['sair_sucesso']) && $_GET['sair_sucesso'] == 'true') {
                echo "alertLogout();";
            }
            if (isset($_GET['login_errado']) && $_GET['login_errado'] == 'true') {
                echo "alertLogin();";
            }
            if (isset($_GET['sessao_expirada']) && $_GET['sessao_expirada'] == 'true') {
                echo "alertSessao();";
            }

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

</html>