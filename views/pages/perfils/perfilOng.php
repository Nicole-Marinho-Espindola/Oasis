<?php
function includeURL($path = '')
{
    return sprintf(
        "%s/%s/%s",
        $_SERVER['DOCUMENT_ROOT'],
        'Oasis',
        $path
    );
}

include_once(includeURL('/services/helpers.php'));

?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/4719b1c3ae.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="<?= baseUrl('/assets/css/global.css') ?>">
    <link rel="stylesheet" href="<?= baseUrl('/assets/css/navbar.css') ?>">
    <link rel="stylesheet" href="<?= baseUrl('/assets/css/perfil.css') ?>">
    <link rel="stylesheet" href="<?= baseUrl('/assets/css/form.css') ?>">
    <link rel="stylesheet" href="<?= baseUrl('/assets/css/modal.css') ?>">
    <link rel="stylesheet" href="<?= baseUrl('/assets/css/projeto.css') ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.27/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.27/dist/sweetalert2.all.min.js"></script>
    <title>Perfil Ong | Oásis</title>
</head>

<?php
include_once(includeURL('views\includes\navPefil.php'));

$row = [];

if (isset($_SESSION['email'])) {

    include_once(includeURL('config/database.php'));

    $email = $_SESSION['email'];

    $sql = "SELECT * FROM tb_ong WHERE ds_email = :email";
    $query = $conn->prepare($sql);
    $query->bindParam(":email", $email);
    $query->execute();
    $row = $query->fetch(PDO::FETCH_ASSOC);
}
?>

<body>

    <?php
    if (isset($_GET['editar_sucesso']) && $_GET['editar_sucesso'] == 'true') {
        echo '<script src="../../../assets/js/alerts.js"></script>';
        echo '<script>alertAlterar();</script>';
    }
    ?>

    <div class="profile-block">
        <div class="profile-purple-block">
            <div class="social-midia-profile-block">
                <div class="social-midia">
                    <i class="fa-brands fa-instagram social-midia-icon"></i>
                </div>
                <div class="social-midia">
                    <i class="fa-brands fa-twitter social-midia-icon"></i>
                </div>
                <div class="social-midia">
                    <i class="fa-brands fa-facebook-f social-midia-icon"></i>
                </div>
            </div>
            <div onclick="openModal()" class="edit-profile-position">
                <div class="edit-profile">
                    <i class="fa-regular fa-pen-to-square social-midia-icon"></i>
                    <span class="edit-profile-span">Editar perfil</span>
                </div>
            </div>
        </div>
        <div class="img-profile-block-ong">
            <?php if (!empty($row['nm_imagem'])) : ?>
                <img src="<?= baseUrl($row['nm_imagem']) ?>" alt="Foto de perfil do usuário">
            <?php else : ?>
                <img src="<?= baseUrl('/assets/img/iconUser.jpg') ?>" alt="Foto de perfil do usuário">
            <?php endif; ?>
        </div>
        <div class="user-profile-info">
            <div class="text-profile-block">
                <h1 class="user-name"><?= $row['nm_ong'] ?></h1>
                <div class="line line-profile-config"></div>
            </div>
            <div class="ong-missao-block">
                <p class="ong-missao"><?= $row['ds_missao'] ?></p>
            </div>
        </div>
        <div class="user-story">
            <div class="trajectory trajectory-ong">
                <div class="head-trajectory">
                    <h3 class="subtitle-profile">Nossas iniciativas</h3>
                    <div class="green-small-block">
                        <?php
                        try {
                            $countProjetos = $conn->prepare("SELECT COUNT(*) FROM tb_projeto WHERE cd_ong = :ong");
                            $countProjetos->bindParam(":ong", $row['cd_ong']);
                            $countProjetos->execute();
                            $totalProjetos = $countProjetos->fetchColumn();

                            $countEventos = $conn->prepare("SELECT COUNT(*) FROM tb_evento WHERE cd_ong = :ong");
                            $countEventos->bindParam(":ong", $row['cd_ong']);
                            $countEventos->execute();
                            $totalEventos = $countEventos->fetchColumn();

                            $total = $totalProjetos + $totalEventos;
                        ?>
                            <p><?= $total ?></p>
                        <?php
                        } catch (PDOException $e) {
                            echo "Erro ao listar projetos: " . $e->getMessage();
                        }
                        ?>
                    </div>
                </div>

                <div class="pjcts-block">
                    <?php
                    // Consulta para os projetos
                    $selectProjetos = $conn->prepare("SELECT tb_projeto.*, tb_projeto.nm_imagem AS imagem_projeto, DATE_FORMAT(tb_projeto.dt_projeto, '%d/%m/%Y') AS data_formatada FROM tb_projeto WHERE tb_projeto.cd_ong = :ong");
                    $selectProjetos->bindParam(":ong", $row['cd_ong']);
                    $selectProjetos->execute();

                    // pegar as informações dos projetos
                    while ($rowProjeto = $selectProjetos->fetch()) {
                        $id = $rowProjeto['cd_projeto'];
                        $titulo = $rowProjeto['nm_titulo_projeto'];
                        $ong = $row['nm_ong'];
                        $endereco = $rowProjeto['ds_endereco'];
                        $data = $rowProjeto['data_formatada'];
                        $descricao = $rowProjeto['ds_projeto'];
                        $imagem = $rowProjeto['imagem_projeto'];

                        if (isset($rowProjeto['imagem_projeto'])) {
                    ?>
                    
                        <div class="pjcts" data-id="<?= $id ?>" data-imagem="<?= $imagem ?>" data-titulo="<?= $titulo ?>" data-ong="<?= $ong ?>" data-descricao="<?= $descricao ?>" data-dia="<?= $data ?>" data-endereco="<?= $endereco ?>" onclick="openSecondModal(this)">
                            <img src="<?= baseUrl($imagem) ?>" alt="Imagem Projeto">
                        </div>

                        <?php
                        }
                    }

                    // Consulta para informações eventos
                    $selectEventos = $conn->prepare("SELECT tb_evento.*, tb_evento.nm_imagem AS imagem_evento, DATE_FORMAT(tb_evento.dt_evento, '%d/%m/%Y') AS data_formatada FROM tb_evento WHERE tb_evento.cd_ong = :ong");
                    $selectEventos->bindParam(":ong", $row['cd_ong']);
                    $selectEventos->execute();

                    // Exibir informações dos eventos
                    while ($rowEvento = $selectEventos->fetch()) {
                        $id = $rowEvento['cd_evento'];
                        $imagem = $rowEvento['imagem_evento'];
                        $titulo = $rowEvento['nm_titulo_evento'];
                        $ong = $row['nm_ong'];
                        $endereco = $rowEvento['ds_endereco'];
                        $data = $rowEvento['data_formatada'];
                        $descricao = $rowEvento['ds_evento'];
    
                        if (isset($rowEvento['imagem_evento'])) {
                        ?>
                            <div class="pjcts" data-id="<?= $id ?>" data-imagem="<?= $imagem ?>" data-titulo="<?= $titulo ?>" data-ong="<?= $ong ?>" data-descricao="<?= $descricao ?>" data-dia="<?= $data ?>" data-endereco="<?= $endereco ?>" onclick="openSecondModal(this)">
                                <img src="<?= baseUrl($rowEvento['imagem_evento']) ?>" alt="Imagem Projeto">
                            </div>
                    <?php
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>

    <!-- exibir as informações do projeto -->
    <div class="modal-window" id="SecondModalWindow">
        <input type="hidden" name="idProjeto" id="id" value="">
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
                <textarea name="" id="modalDescricao" cols="100" rows="5" readonly></textarea>
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
        </div>
    </div>

    <!-- edição de informações -->
    <div class="modal-window" id="modalWindow">
        <form class="form" action=<?= baseUrl('/services/controllers/Ongs/editarPerfil.php') ?> enctype="multipart/form-data" method="POST">
            <input type="hidden" name="id" value="<?= $row['cd_ong'] ?>">
            <div class="modal-card-profile">
                <div class="modal-title-block">
                    <div class="modal-title">Editar perfil</div>
                    <div class="line"></div>
                </div>
                <label class="img-block" tabindex="0">
                    <input class="input-profile-img" name="imagemOng" type="file" accept="image/*">
                    <div class="img-text">
                        <?php if (!empty($row['nm_imagem'])) : ?>
                            <img class="img-icon" src="<?= baseUrl($row['nm_imagem']) ?>" alt="Foto de perfil do usuário" accept="image/*">
                        <?php else : ?>
                            <img class="img-icon" src="<?= baseUrl('/assets/img/iconUser.jpg') ?>" alt="Foto de perfil do usuário" accept="image/*">
                        <?php endif; ?>
                    </div>
                </label>
                <div class="modal-input-block-perfil">
                    <input id="nomeOng" name="nomeOng" type="text" class="modal-input" value="<?= $row['nm_ong'] ?>">
                    <i class="fa-regular fa-pen-to-square icon-input"></i>
                </div>
                <div class="modal-input-block-perfil">
                    <input id="emailOng" name="emailOng" type="text" class="modal-input" value="<?= $row['ds_email'] ?>">
                    <i class="fa-regular fa-pen-to-square icon-input"></i>
                </div>
                <div class="modal-input-block-perfil">
                    <input id="missaoOng" name="missaoOng" type="text" class="modal-input" value="<?= $row['ds_missao'] ?>">
                    <i class="fa-regular fa-pen-to-square icon-input"></i>
                </div>
                <button type="submit" class="btn-modal" id="close">Concluído</button>
            </div>
    </div>

    <script src="<?= baseUrl('/assets/js/visualizarImagem.js') ?>"></script>
    <script src="<?= baseUrl('/assets/js/modal.js') ?>"></script>
</body>

<?php
include_once(includeURL('views/includes/footer.php'))
?>