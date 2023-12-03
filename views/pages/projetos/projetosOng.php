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
                $currentDate = date("Y-m-d"); // pega a data atual para nao exibir projetos que já tenham sido realizados

                $selectProjetos = $conn->prepare("SELECT tb_projeto.*, tb_ong.nm_ong AS nome_ong, DATE_FORMAT(tb_projeto.dt_projeto, '%d/%m/%Y') AS data_formatada
                                                FROM tb_projeto
                                                JOIN tb_ong ON tb_projeto.cd_ong = tb_ong.cd_ong
                                                WHERE tb_projeto.dt_projeto >= :currentDate");
                $selectProjetos->bindParam(":currentDate", $currentDate);
                $selectProjetos->execute();

                while ($rowProjeto = $selectProjetos->fetch()) {
                    $id = $rowProjeto['cd_projeto'];
                    $imagem = $rowProjeto['nm_imagem'];
                    $titulo = $rowProjeto['nm_titulo_projeto'];
                    $ong = $rowProjeto['nome_ong'];
                    $endereco = $rowProjeto['ds_endereco'];
                    $data = $rowProjeto['data_formatada'];
                    $descricao = $rowProjeto['ds_projeto'];

            ?>
                    <div class="project-card">
                        <div class="project-img-block">
                            <img class="project-img" src="<?= baseUrl($imagem) ?>" alt="">
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
                        <button class="btn-project-card" data-id="<?= $id ?>" data-imagem="<?= $imagem ?>" data-titulo="<?= $titulo ?>" data-ong="<?= $ong ?>" data-descricao="<?= $descricao ?>" data-dia="<?= $data ?>" data-endereco="<?= $endereco ?>" onclick="openModal(this)">Visualizar</button>
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

    <!-- modal para visualizar informações -->
    <div class="modal-window" id="modalWindow">
        <input type="hidden" name="id" id="id" value="">
            <div class="modal-card-projects">
                <div class="project-img-block">
                    <img class="project-img" id="modalImagem" alt="Imagem do projeto">
                </div>
                <div class="modal-title-block-project">
                    <div class="modal-title-project" id="modalTitle"></div>
                    <div class="line"></div>
                </div>
                <div class="modal-title-block-project">
                    <div class="modal-title-project">Descrição</div>
                </div>
                <div class="textarea-project">
                    <textarea id="modalDescricao" cols="45" rows="5" readonly></textarea>
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
                    <div class="green-small-block" onclick="openViewModal()"><i class="fa-regular fa-eye"></i></div>
                    <div class="green-small-block"><a class="link-style-none" id="deleteLink"><i class="fa-solid fa-trash"></i></a></div>
                </div>
            </div>
    </div>

    <!-- Visualizar candidatos -->
    <div class="modal-window" id="viewModalWindow">
        <input type="hidden" name="id" id="id" value="">
            <div class="modal-card modal-card-view">
                <div class="card-view-title">
                    <img class="logo" src="<?= baseUrl('/assets/img/logo-oasis.png') ?>" alt="Logo da Oásis">
                    <h1 class="view-title">Voluntarios que desejam participar:</h1>
                </div>
                <div class="table-block">
                    <table class="table">
                            <thead>
                                <th>Voluntários</th>
                                <th></th>
                                <th></th>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Maíra</td>
                                    <td><i class="fa-regular fa-eye"></i></td>
                                    <td><i class="fa-solid fa-trash"></i></td>
                                </tr>
                                <tr>
                                    <td>Maíra</td>
                                    <td><i class="fa-regular fa-eye"></i></td>
                                    <td><i class="fa-solid fa-trash"></i></td>
                                </tr>
                                <tr>
                                    <td>Maíra</td>
                                    <td><i class="fa-regular fa-eye"></i></td>
                                    <td><i class="fa-solid fa-trash"></i></td>
                                </tr>
                                <tr>
                                    <td>Maíra</td>
                                    <td><i class="fa-regular fa-eye"></i></td>
                                    <td><i class="fa-solid fa-trash"></i></td>
                                </tr>
                                <tr>
                                    <td>Maíra</td>
                                    <td><i class="fa-regular fa-eye"></i></td>
                                    <td><i class="fa-solid fa-trash"></i></td>
                                </tr>
                                <tr>
                                    <td>Maíra</td>
                                    <td><i class="fa-regular fa-eye"></i></td>
                                    <td><i class="fa-solid fa-trash"></i></td>
                                </tr>
                                <tr>
                                    <td>Maíra</td>
                                    <td><i class="fa-regular fa-eye"></i></td>
                                    <td><i class="fa-solid fa-trash"></i></td>
                                </tr>
                                <tr>
                                    <td>Maíra</td>
                                    <td><i class="fa-regular fa-eye"></i></td>
                                    <td><i class="fa-solid fa-trash"></i></td>
                                </tr>
                                <tr>
                                    <td>Maíra</td>
                                    <td><i class="fa-regular fa-eye"></i></td>
                                    <td><i class="fa-solid fa-trash"></i></td>
                                </tr>
                            </tbody>
                    </table>
                </div>
                
            </div>
    </div>

    <!-- adicionar projeto -->
    <div class="modal-window" id="SecondModalWindow">
    <form class="form" action="<?= baseUrl('/services/controllers/ongs/projetos/adicionarProjeto.php') ?>" enctype="multipart/form-data"
        method="POST" onsubmit="return validateForm()">
            <input type="hidden" name="id" value="<?= $row['cd_ong'] ?>">
            <div class="modal-card-projects">
                <div class="modal-title-block-project">
                    <div class="info-modal-req">
                        <input type="text" class="input-requisitos" id="nomeProjeto" name="nomeProjeto" placeholder="Titulo do projeto">
                    </div>
                </div>
                <div class="project-img-add-modal">
                    <div class="modal-title-project">Imagem</div>
                    <input class="input-img" type="file" name="imagemProjeto" id="imagemProjeto">
                </div>
                <div class="modal-title-block-project">
                    <div class="modal-title-project">Descrição</div>
                </div>
                <div class="textarea-project">
                    <textarea name="descricaoProjeto" id="descricaoProjeto" cols="45" rows="5"></textarea>
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
                        <input type="text" class="input-requisitos" placeholder="Localização" 
                        id="enderecoProjeto" name="enderecoProjeto">
                    </div>
                    <div class="info-modal-req ajust">
                        <i class="fa-solid fa-calendar-days icon-project icon-modal-color"></i>
                        <input type="date" class="input-requisitos" placeholder="Data do projeto"
                        id="dataProjeto" name="dataProjeto">
                    </div>
                </div>
                <button type="submit" class="btn-modal" id="close">Adicionar</button>
            </div>
        </form>
    </div>

    <!-- editar projeto -->
    <div class="modal-window" id="EditModalWindow">
        <form class="form" action="<?= baseUrl('/services/controllers/ongs/projetos/editarProjeto.php') ?>" enctype="multipart/form-data"
        method="POST" onsubmit="return validateForm()">
            <input type="hidden" name="id" value="<?= $id ?>">
            <div class="modal-card-projects">
                <div class="modal-title-block-project">
                    <div class="info-modal-req">
                        <input type="text" class="input-requisitos" id="nomeProjeto" name="nomeProjeto" value="<?= $titulo ?>">
                    </div>
                </div>
                <div class="project-img-add-modal">
                    <div class="modal-title-project">Imagem</div>
                    <input class="input-img" type="file"  name="imagemProjeto" id="imagemProjeto">
                </div>
                <div class="modal-title-block-project">
                    <div class="modal-title-project">Descrição</div>
                </div>
                <div class="textarea-project">
                <textarea name="descricaoProjeto" id="descricaoProjeto" cols="45" rows="5"><?= $descricao ?></textarea>
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
                        id="enderecoProjeto" name="enderecoProjeto">
                    </div>
                    <div class="info-modal-req ajust">
                        <i class="fa-solid fa-calendar-days icon-project icon-modal-color"></i>
                        <input type="date" class="input-requisitos" value="<?= $data ?>"
                        id="dataProjeto" name="dataProjeto">
                    </div>
                </div>
                <button type="submit" class="btn-modal" id="close">Editar</button>
            </div>
        </form>
    </div>

<script src="<?= baseUrl('/assets/js/validateForm.js') ?>"></script>
<script src="<?= baseUrl('/assets/js/modalProjetos.js') ?>"></script>

<?php
    include_once('../../includes/footer.php')
?>