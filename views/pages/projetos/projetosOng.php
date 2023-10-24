<?php
    include_once('../../includes/head.php');

    if (isset($_SESSION['email'])) {
        try {
            include_once(includeURL('/config/database.php'));
            $email = $_SESSION['email'];

            $sql = "SELECT * FROM tb_ong WHERE ds_email = :email";
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
        if (isset($_GET['projeto_sucesso']) && $_GET['projeto_sucesso'] == 'true') {
            echo '<script src="../../../assets/js/alerts.js"></script>';
            echo '<script>alertProjetoCadastrado();</script>';
        }
        ?>

    </body>

    <section class="projects">
        <div class="dark-purple-block">
            <div class="btn-project">Projetos</div>
            <a href="<?= baseUrl('/views/pages/eventos/eventosOng.php') ?>" class="link-projects-style">
                <div class="btn-event">Eventos</div>
            </a>
        </div>
        <div class="filter-block">
            <i class="fa-solid fa-sliders filter-icon"></i>
            <div class="ong-project">
                <span class="ong-project-span">Meus projetos</span>
                <i class="fa-solid fa-toggle-on filter-icon"></i>
            </div>
        </div>
        <div class="projects-cards-block">
            <?php
            try {
                $selectProjetos = $conn->prepare("SELECT tb_projeto.*, tb_ong.nm_ong AS nome_ong
                                                FROM tb_projeto
                                                JOIN tb_ong ON tb_projeto.cd_ong = tb_ong.cd_ong");
                $selectProjetos->execute();

                while ($rowProjeto = $selectProjetos->fetch()) {
                    $imagem = $rowProjeto['nm_imagem'];
                    $titulo = $rowProjeto['nm_titulo_projeto'];
                    $ong = $rowProjeto['nome_ong'];
                    $endereco = $rowProjeto['ds_endereco'];
                    $data = $rowProjeto['dt_projeto'];
                    $descricao = $rowProjeto['ds_projeto'];
            ?>
                    <div class="project-card">
                        <div class="project-img-block">
                            <?php

                            try {
                                $imagePath = baseUrl($rowProjeto['nm_imagem']);
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
                                <span class="name-span margin"><?= $rowProjeto['ds_endereco'] ?></span>
                            </div>
                            <div class="info">
                                <i class="fa-solid fa-calendar-days icon-project"></i>
                                <span class="name-span margin"><?= date("d-m-Y", strtotime($rowProjeto['dt_projeto'])) ?></span>
                            </div>
                        </div>
                        <button class="btn-project-card" onclick="openModal()">Participar</button>
                    </div>
            <?php
                }
            } catch (PDOException $e) {
                echo "Erro ao listar projetos: " . $e->getMessage();
            }
            ?>
            <div class="project-card project-card-effect" onclick="openSecondModal()">
                <div class="card-title-add">Adicionar projeto</div>
                <i class="fa-solid fa-plus icon-add-project"></i>
            </div>
        </div>
    </section>

    <div class="modal-window" id="modalWindow">
            <div class="modal-card-projects">
                    <div class="project-img-block">
                        <img class="project-img" src="<?= baseUrl('/assets/img/foto-teste.webp') ?>" alt="">
                    </div>
                    <div class="modal-title-block-project">
                        <div class="modal-title-project">Recolher lixo</div>
                        <div class="line"></div>
                    </div>
                    <div class="modal-title-block-project">
                        <div class="modal-title-project">Descrição</div>
                    </div>
                    <div class="textarea-project">
                        <textarea name="" id="" cols="45" rows="5" readonly>Unindo esforços para preservar nossas praias, este projeto visa reunir voluntários dedicados a remover resíduos e lixo das áreas costeiras, restaurando a beleza natural de nossas praias e protegendo a vida marinha.</textarea>
                    </div>
                    <div class="modal-title-block-project">
                        <div class "modal-title-project">Requisitos</div>
                    </div>
                    <div class="modal-project-info">
                        <div class="info">
                            <i class="fa-solid fa-people-group icon-project icon-modal-color"></i>
                            <span class="name-span">Formiguinhas</span>
                        </div>
                        <div class="info">
                            <i class="fa-solid fa-location-dot icon-project icon-modal-color"></i>
                            <span class="name-span margin">Caiçara</span>
                        </div>
                        <div class="info">
                            <i class="fa-solid fa-calendar-days icon-project icon-modal-color"></i>
                            <span class="name-span margin">13/09/2023</span>
                        </div>
                    </div>

                    <button class="btn-modal" id="close">Participar</button>
            </div>
        </form>
    </div>

    <div class="modal-window" id="SecondModalWindow">
        <form class="form" action=<?= baseUrl('/services/controllers/ongs/projetos/adicionarProjeto.php') ?> enctype="multipart/form-data" method="POST">
            <input type="hidden" name="id" value="<?= $row['cd_ong'] ?>">
            <input type="hidden" name="nomeProjeto" value="Limpar a praia">
            <div class="modal-card-projects">
                <div class="modal-title-block-project">
                    <div class="modal-title-project">Adicionar projeto</div>
                    <div class="line"></div>
                </div>
                <div class="project-img-add-modal">
                    <div class="modal-title-project">Imagem</div>
                    <input class="input-img" name="imagemProjeto" type="file" accept="image/*">
                </div>
                <div class="modal-title-block-project">
                    <div class="modal-title-project">Descrição</div>
                </div>
                <div class="textarea-project">
                    <textarea name="descricaoProjeto" id="" cols="45" rows="5"></textarea>
                </div>
                <div class="modal-title-block-project">
                    <div class="modal-title-project">Detalhes Importantes</div>
                </div>
                <div class="modal-project-info">
                    <div class="info-modal-req">
                        <i class="fa-solid fa-people-group icon-project icon-modal-color"></i>
                        <input type="text" class="input-requitos" value="<?= $row['nm_ong'] ?>" readonly>
                    </div>
                    <div class="info-modal-req ajust">
                        <i class="fa-solid fa-location-dot icon-project icon-modal-color"></i>
                        <input type="text" class="input-requitos" placeholder="Localização" name="enderecoProjeto">
                    </div>
                    <div class="info-modal-req ajust">
                        <i class="fa-solid fa-calendar-days icon-project icon-modal-color"></i>
                        <input type="date" class="input-requitos" placeholder="Data do projeto" name="dataProjeto">
                    </div>
                </div>
                <button type="submit" class="btn-modal" id="close">Adicionar</button>
            </div>
        </form>
    </div>

    <script src="<?= baseUrl('/assets/js/modal.js') ?>"></script>

    <?php
    include_once('../../includes/footer.php')
    ?>
