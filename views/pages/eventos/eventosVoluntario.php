<?php
    include_once('../../includes/head.php');

    if (isset($_SESSION['email'])) {
        try {
            include_once(includeURL('/config/database.php'));
            $email = $_SESSION['email'];

            $sql = "SELECT * FROM tb_voluntario WHERE ds_email = :email";
            $query = $conn->prepare($sql);
            $query->bindParam(":email", $email);
            $query->execute();

            $row = $query->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Erro na consulta: " . $e->getMessage();
        }
    }

?>

<head>
    <link rel="stylesheet" href="<?= baseUrl('/assets/css/projeto.css') ?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.27/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.27/dist/sweetalert2.all.min.js"></script>
</head>

<body>

    <?php
        if (isset($_GET['inscricao_sucesso']) && $_GET['inscricao_sucesso'] == 'true') {
            echo '<script src="../../../assets/js/alerts.js"></script>';
            echo '<script>alertInscricao();</script>';
        }
    ?>
    <?php
    if (isset($_GET['inscricao_sucesso']) && $_GET['inscricao_sucesso'] == 'false') {
        echo '<script src="../../../assets/js/alerts.js"></script>';
        echo '<script>alertInscricaoFailed();</script>';
    }
    ?>

</body>

<section class="projects">
    <div class="dark-purple-block">
        <a href="<?= baseUrl('/views/pages/projetos/projetosVoluntario.php')?>" class="link-projects-style">
            <div class="btn-project-event-page">Projetos</div>
        </a>
        <a href="<?= baseUrl('/views/pages/eventos/eventosVoluntario.php')?>" class="link-projects-style">
            <div class="btn-event-event-page">Eventos</div>
        </a>
    </div>
    <div class="filter-block">
            <i class="fa-solid fa-sliders filter-icon"></i>
        </div>
        <div class="projects-cards-block">
        <?php
            try {
                $currentDate = date("Y-m-d"); // pega a data atual para nao exibir eventos que já tenham sido realizados

                $selecteventos = $conn->prepare("SELECT tb_evento.*, tb_ong.nm_ong AS nome_ong, DATE_FORMAT(tb_evento.dt_evento, '%d/%m/%Y') AS data_formatada
                                                    FROM tb_evento
                                                    JOIN tb_ong ON tb_evento.cd_ong = tb_ong.cd_ong
                                                    WHERE tb_evento.dt_evento >= :currentDate");
                $selecteventos->bindParam(":currentDate", $currentDate);
                $selecteventos->execute();

                while ($rowEvento = $selecteventos->fetch()) {
                    $id = $rowEvento['cd_evento'];
                    $imagem = $rowEvento['nm_imagem'];
                    $titulo = $rowEvento['nm_titulo_evento'];
                    $ong = $rowEvento['nome_ong'];
                    $endereco = $rowEvento['ds_endereco'];
                    $data = $rowEvento['data_formatada'];
                    $descricao = $rowEvento['ds_evento'];

            ?>
                    <div class="project-card">
                        <div class="project-img-block">
                            <?php
                            try {
                                $imagePath = baseUrl($rowEvento['nm_imagem']);
                            } catch (Exception $ex) {
                                $imagePath = '';
                            }
                            ?>
                            <img class="project-img" src="<?= $imagePath ?>" alt="">
                        </div>
                        <div class="card-title-block">
                            <div class="card-title"><?= $titulo ?></div>
                            <div class="line"></div>
                        </div>
                        <div class="project-info">
                            <div class="info">
                                <i class="fa-solid fa-people-group icon-project"></i>
                                <span class="name-span"><?= $ong ?></span>
                            </div>
                            <div class="info">
                                <i class="fa-solid fa-location-dot icon-project"></i>
                                <span class="name-span margin"><?= $endereco ?></span>
                            </div>
                            <div class="info">
                                <i class="fa-solid fa-calendar-days icon-project"></i>
                                <span class="name-span margin"><?= $data ?></span>
                            </div>
                        </div>
                        <button class="btn-project-card" data-id="<?= $id ?>" data-imagem="<?= $imagem ?>" data-titulo="<?= $titulo ?>" data-ong="<?= $ong ?>" data-descricao="<?= $descricao ?>" data-dia="<?= $data ?>" data-endereco="<?= $endereco ?>" onclick="openModal(this)">Participar</button>
                    </div>
            <?php
                }
            } catch (PDOException $e) {
                echo "Erro ao listar eventos: " . $e->getMessage();
            }
            ?>
        </div>
    </section>

    <!-- aparece ao clicar em participar -->
    <div class="modal-window" id="modalWindow">
    <form action="<?= baseUrl('/services/controllers/voluntarios/eventos/participarEvento.php') ?>" method="POST">
            <input type="hidden" name="idEvento" id="id" value="">
            <input type="hidden" name="idVoluntario" value="<?= $row['cd_voluntario'] ?>">
                <div class="modal-card-projects">
                    <div class="project-img-block">
                        <img class="project-img" id="modalImagem" src="<?= baseUrl($imagem) ?>" alt="">
                    </div>
                    <div class="modal-title-block-project">
                        <div class="modal-title-project" id="modalTitle"></div>
                        <div class="line"></div>
                    </div>
                    <div class="modal-title-block-project">
                        <div class="modal-title-project">Descrição</div>
                    </div>
                    <div class="textarea-project">
                        <textarea name="" id="modalDescricao" cols="45" rows="5" readonly></textarea>
                    </div>
                    <div class="modal-title-block-project">
                        <div class="modal-title-project">Informações adicionais</div>
                    </div>
                    <div class="modal-project-info">
                        <div class="info">
                            <i class="fa-solid fa-people-group icon-project icon-modal-color"></i>
                            <span class="name-span" id="modalOng"></span>
                        </div>
                        <div class="info">
                            <i class="fa-solid fa-location-dot icon-project icon-modal-color"></i>
                            <span class="name-span margin" id="modalEndereco"></span>
                        </div>
                        <div class="info">
                            <i class="fa-solid fa-calendar-days icon-project icon-modal-color"></i>
                            <span class="name-span margin" id="modalDia"></span>
                        </div>
                    </div>
                    <button type="submit" class="btn-modal" id="close">Participar</button>
                </div>
    </div>

<script src="<?= baseUrl('/assets/js/modalProjetos.js') ?>"></script>

<?php
    include_once('../../includes/footer.php')
?>