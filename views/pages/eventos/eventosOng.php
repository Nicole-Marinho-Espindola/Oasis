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
    if (isset($_GET['evento_sucesso']) && $_GET['evento_sucesso'] == 'true') {
        echo '<script src="../../../assets/js/alerts.js"></script>';
        echo '<script>alertEventoCadastrado();</script>';
    }

    if (isset($_GET['editar_sucesso']) && $_GET['editar_sucesso'] == 'true') {
        echo '<script src="../../../assets/js/alerts.js"></script>';
        echo '<script>alertAlterar();</script>';
    }

    if (isset($_GET['excluir_sucesso']) && $_GET['excluir_sucesso'] == 'true') {
        echo '<script src="../../../assets/js/alerts.js"></script>';
        echo '<script>alertExcluir();</script>';
    }
    ?>

</body>

<section class="projects">
    <div class="dark-purple-block">
        <a href="<?= baseUrl('/views/pages/projetos/projetosOng.php')?>" class="link-projects-style">
            <div class="btn-project-event-page">Projetos</div>
        </a>
        <a href="<?= baseUrl('/views/pages/eventos/eventosOng.php')?>" class="link-projects-style">
            <div class="btn-event-event-page">Eventos</div>
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
                $currentDate = date("Y-m-d"); // pega a data atual para nao exibir eventos que já tenham sido realizados

                $selecteventos = $conn->prepare("SELECT tb_evento.*, tb_ong.nm_ong AS nome_ong
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
                    $data = $rowEvento['dt_evento'];
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
                                <span class="name-span margin"><?= date("d-m-Y", strtotime($data)) ?></span>
                            </div>
                        </div>
                        <button class="btn-project-card" data-id="<?= $id ?>" data-imagem="<?= $imagem ?>" data-titulo="<?= $titulo ?>" data-ong="<?= $ong ?>" data-descricao="<?= $descricao ?>" data-dia="<?= $data ?>" data-endereco="<?= $endereco ?>" onclick="openModal(this)">Visualizar</button>
                    </div>
            <?php
                }
            } catch (PDOException $e) {
                echo "Erro ao listar eventos: " . $e->getMessage();
            }
            ?>
            <div class="project-card project-card-effect" onclick="openSecondModal()">
                <div class="card-title-add">Adicionar evento</div>
                <i class="fa-solid fa-plus icon-add-project"></i>
            </div>
        </div>
    </section>

    <!-- visualizar -->
    <div class="modal-window" id="modalWindow">
            <input type="hidden" name="id" id="id" value="">
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
                    <div class="small-blocks-section">
                        <div class="green-small-block" onclick="openEditModal()"><i class="fa-regular fa-pen-to-square"></i></div>
                        <div class="green-small-block"><i class="fa-regular fa-eye"></i></div>
                        <div class="green-small-block"><a id="deleteLinkEvento"><i class="fa-solid fa-trash"></i></a></div>
                    </div>
                </div>
    </div>

    <!-- adicionar evento -->
    <div class="modal-window" id="SecondModalWindow">
        <form class="form" action="<?= baseUrl('/services/controllers/ongs/eventos/adicionarEvento.php') ?>" enctype="multipart/form-data" method="POST">
            <input type="hidden" name="id" value="<?= $row['cd_ong'] ?>">
            <div class="modal-card-projects">
                <div class="modal-title-block-project">
                    <div class="info-modal-req">
                        <input type="text" class="input-requisitos" name="nomeEvento" placeholder="Titulo do evento">
                    </div>
                </div>
                <div class="project-img-add-modal">
                    <div class="modal-title-project">Imagem</div>
                    <input class="input-img" type="file" name="imagemEvento">
                </div>
                <div class="modal-title-block-project">
                    <div class="modal-title-project">Descrição</div>
                </div>
                <div class="textarea-project">
                    <textarea name="descricaoEvento" id="" cols="45" rows="5"></textarea>
                </div>
                <div class="modal-title-block-project">
                    <div class="modal-title-project">Requisitos</div>
                </div>
                <div class="modal-title-block-project">
                    <div class="modal-title-project">Detalhes Importantes</div>
                </div>
                <div class="modal-project-info">
                    <div class="info-modal-req">
                        <i class="fa-solid fa-people-group icon-project icon-modal-color"></i>
                        <input type="text" class="input-requisitos" value="<?= $row['nm_ong'] ?>" readonly>
                    </div>
                    <div class="info-modal-req ajust">
                        <i class="fa-solid fa-location-dot icon-project icon-modal-color"></i>
                        <input type="text" class="input-requisitos" placeholder="Localização" name="enderecoEvento">
                    </div>
                    <div class="info-modal-req ajust">
                        <i class="fa-solid fa-calendar-days icon-project icon-modal-color"></i>
                        <input type="date" class="input-requisitos" placeholder="Data do evento" name="dataEvento">
                    </div>
                </div>
                <button type="submit" class="btn-modal" id="close">Adicionar</button>
            </div>
        </form>
    </div>

    <!-- editar evento -->
    <div class="modal-window" id="EditModalWindow">
        <form class="form" action="<?= baseUrl('/services/controllers/ongs/eventos/editarEvento.php') ?>" enctype="multipart/form-data"
        method="POST" onsubmit="return validateForm()">
            <input type="hidden" name="id" value="<?= $id ?>">
            <div class="modal-card-projects">
                <div class="modal-title-block-project">
                    <div class="info-modal-req">
                        <input type="text" class="input-requisitos" id="nomeEvento" name="nomeEvento" value="<?= $titulo ?>">
                    </div>
                </div>
                <div class="project-img-add-modal">
                    <div class="modal-title-project">Imagem</div>
                    <input class="input-img" type="file"  name="imagemEvento" id="imagemEvento">
                </div>
                <div class="modal-title-block-project">
                    <div class="modal-title-project">Descrição</div>
                </div>
                <div class="textarea-project">
                <textarea name="descricaoEvento" id="descricaoEvento" cols="45" rows="5"><?= $descricao ?></textarea>
                </div>
                <div class="modal-title-block-project">
                    <div class="modal-title-project">Requisitos</div>
                </div>
                <div class="modal-title-block-project">
                    <div class="modal-title-project">Detalhes Importantes</div>
                </div>
                <div class="modal-project-info">
                    <div class="info-modal-req">
                        <i class="fa-solid fa-people-group icon-project icon-modal-color"></i>
                        <input type="text" class="input-requisitos" value="<?= $row['nm_ong'] ?>" readonly>
                    </div>
                    <div class="info-modal-req ajust">
                        <i class="fa-solid fa-location-dot icon-project icon-modal-color"></i>
                        <input type="text" class="input-requisitos" value="<?= $endereco ?>" 
                        id="enderecoEvento" name="enderecoEvento">
                    </div>
                    <div class="info-modal-req ajust">
                        <i class="fa-solid fa-calendar-days icon-project icon-modal-color"></i>
                        <input type="date" class="input-requisitos" value="<?= $data ?>"
                        id="dataEvento" name="dataEvento">
                    </div>
                </div>
                <button type="submit" class="btn-modal" id="close">Editar</button>
            </div>
        </form>
    </div>

<script src="<?= baseUrl('/assets/js/modalProjetos.js') ?>"></script>

<?php
    include_once('../../includes/footer.php')
?>