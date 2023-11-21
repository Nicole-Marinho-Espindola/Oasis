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
    <link rel="stylesheet" href="<?= baseUrl('/assets/css/global.css') ?>">
    <link rel="stylesheet" href="<?= baseUrl('/assets/css/navbar.css') ?>">
    <link rel="stylesheet" href="<?= baseUrl('/assets/css/perfil.css') ?>">
    <link rel="stylesheet" href="<?= baseUrl('/assets/css/form.css') ?>">
    <link rel="stylesheet" href="<?= baseUrl('/assets/css/modal.css') ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.27/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.27/dist/sweetalert2.all.min.js"></script>
    <title>Perfil Voluntário | Oásis</title>
</head>

<?php

include_once(includeURL('views\includes\navPefil.php'));

$row = [];

if (isset($_SESSION['email'])) {
    include_once(includeURL('config/database.php'));

    $email = $_SESSION['email'];

    $sql = "SELECT
                    v.cd_voluntario,
                    v.nm_voluntario,
                    v.nm_sobrenome,
                    v.nm_imagem AS imagem_voluntario,
                    v.dt_nascimento,
                    v.ds_email,
                    i.nm_icone,
                    e.cd_interesse,
                    s.nm_situacao AS situacao
                FROM tb_voluntario v
                LEFT JOIN tb_escolha e ON v.cd_voluntario = e.cd_voluntario
                LEFT JOIN tb_interesse i ON e.cd_interesse = i.cd_interesse
                LEFT JOIN tb_situacao s ON v.cd_situacao = s.cd_situacao
                WHERE v.ds_email = :email";
    $query = $conn->prepare($sql);
    $query->bindParam(":email", $email);
    $query->execute();

    $iconesInteresse = [];
    $cdInteresses = [];

    while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
        $iconesInteresse[] = $row['nm_icone'];
        $cdInteresses[] = $row['cd_interesse'];
        $idVoluntario = $row['cd_voluntario'];
        $nomeVoluntario = $row['nm_voluntario'];
        $emailVoluntario = $row['ds_email'];
        $imagemVoluntario = $row['imagem_voluntario'];
    }
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
                    <div class="edit-profile-span">Editar perfil</div>
                </div>
            </div>
        </div>
        <div class="img-profile-block img-profile-volunt">
            <?php if (!empty($imagemVoluntario)) : ?>
                <img src="<?= baseUrl($imagemVoluntario) ?>" alt="Foto de perfil do usuário">
            <?php else : ?>
                <img src="<?= baseUrl('/assets/img/iconUser.jpg') ?>" alt="Foto de perfil do usuário">
            <?php endif; ?>
        </div>
        <div class="user-profile-info">
            <div class="text-profile-block">
                <?php if (!empty($nomeVoluntario)) : ?>
                    <h1 class="user-name" id="nomeVoluntario" name="nomeVoluntario"><?= $nomeVoluntario ?></h1>
                    <div class="line line-profile-config"></div>
                <?php endif; ?>
            </div>
            <div class="user-profile-int">
                <?php
                if (!empty($iconesInteresse)) {
                    foreach ($iconesInteresse as $iconeInteresse) {
                ?>
                        <div class="label-interesse">
                            <label class="label-content-int">
                                <div class="int-content">
                                    <img class="img-interesse" src="<?= baseUrl('/admin/' . $iconeInteresse) ?>" alt="">
                                </div>
                            </label>
                        </div>
                <?php
                    }
                }
                ?>
            </div>
        </div>
        <div class="user-story">
            <?php
            try {
                // Contagem de inscrições
                $countInscricoes = $conn->prepare("SELECT COUNT(cd_inscricao) AS total_inscricao
                                                            FROM tb_inscricao
                                                            WHERE cd_voluntario = :idVoluntario");
                $countInscricoes->bindParam(":idVoluntario", $idVoluntario);
                $countInscricoes->execute();
                $totalInscricoes = $countInscricoes->fetchColumn();
            ?>
                <div class="trajectory">
                    <div class="head-trajectory">
                        <h3 class="subtitle-profile">Minha trajetória</h3>
                        <div class="green-small-block">
                            <p><?= $totalInscricoes ?></p>
                        </div>
                    </div>

                    <div class="pjcts-block">
                        <?php
                        $selectImagensInscricoes = $conn->prepare("SELECT 
                                                                        CASE WHEN p.cd_projeto IS NOT NULL THEN p.nm_imagem ELSE e.nm_imagem END AS nm_imagem,
                                                                        CASE WHEN p.cd_projeto IS NOT NULL THEN 'projeto' ELSE 'evento' END AS tipo_inscricao
                                                                    FROM tb_inscricao ins
                                                                    LEFT JOIN tb_projeto p ON ins.cd_projeto = p.cd_projeto
                                                                    LEFT JOIN tb_evento e ON ins.cd_evento = e.cd_evento
                                                                    WHERE ins.cd_voluntario = :idVoluntario");
                        $selectImagensInscricoes->bindParam(":idVoluntario", $idVoluntario);
                        $selectImagensInscricoes->execute();

                        while ($rowImagemInscricao = $selectImagensInscricoes->fetch()) {
                            $tipoInscricao = $rowImagemInscricao['tipo_inscricao'];
                            $imagem = $rowImagemInscricao['nm_imagem'];

                            if ($tipoInscricao === 'projeto') {
                        ?>
                                <div class="pjcts" onclick="openSecondModal()">
                                    <img src="<?= baseUrl($imagem) ?>" alt="">
                                </div>
                            <?php
                            } elseif ($tipoInscricao === 'evento') {
                            ?>
                                <div class="pjcts" onclick="openSecondModal()">
                                    <img src="<?= baseUrl($imagem) ?>" alt="">
                                </div>
                        <?php
                            }
                        }
                        ?>
                    </div>
                </div>
            <?php
            } catch (PDOException $e) {
                echo "Erro ao listar projetos: " . $e->getMessage();
            }
            ?>
            <?php
            try {


                $currentDate = date("Y-m-d");

                // Contagem de inscrições atuais em projetos e eventos que não passaram da data atual
                $countInscricoesAtuais = $conn->prepare("SELECT COUNT(ins.cd_inscricao) AS total_inscricao
                                        FROM tb_inscricao ins
                                        LEFT JOIN tb_projeto p ON ins.cd_projeto = p.cd_projeto
                                        LEFT JOIN tb_evento e ON ins.cd_evento = e.cd_evento
                                        WHERE ins.cd_voluntario = :idVoluntario
                                        AND (p.dt_projeto >= :currentDate OR e.dt_evento >= :currentDate)");
                $countInscricoesAtuais->bindParam(":idVoluntario", $idVoluntario);
                $countInscricoesAtuais->bindParam(":currentDate", $currentDate);
                $countInscricoesAtuais->execute();
                $inscricoesAtuais = $countInscricoesAtuais->fetchColumn();
            ?>
                <div class="trajectory">
                    <div class="head-trajectory">
                        <h3 class="subtitle-profile">Minhas inscrições atuais</h3>
                        <div class="green-small-block">
                            <p><?= $inscricoesAtuais ?></p>
                        </div>
                    </div>

                    <div class="pjcts-block">
                        <?php
                        $selectImagensInscricoesAtuais = $conn->prepare("SELECT 
                                                                CASE WHEN p.nm_imagem IS NOT NULL THEN p.nm_imagem ELSE e.nm_imagem END AS nm_imagem
                                                            FROM tb_inscricao ins
                                                            LEFT JOIN tb_projeto p ON ins.cd_projeto = p.cd_projeto
                                                            LEFT JOIN tb_evento e ON ins.cd_evento = e.cd_evento
                                                            WHERE ins.cd_voluntario = :idVoluntario
                                                            AND (p.dt_projeto >= :currentDate OR e.dt_evento >= :currentDate)");
                        $selectImagensInscricoesAtuais->bindParam(":idVoluntario", $idVoluntario);
                        $selectImagensInscricoesAtuais->bindParam(":currentDate", $currentDate);
                        $selectImagensInscricoesAtuais->execute();

                        while ($rowImagemInscricao = $selectImagensInscricoesAtuais->fetch()) {
                        ?>
                            <div class="pjcts" onclick="openSecondModal()">
                                <img src="<?= baseUrl($rowImagemInscricao['nm_imagem']) ?>" alt="">
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            <?php
            } catch (PDOException $e) {
                echo "Erro ao listar projetos: " . $e->getMessage();
            }
            ?>
        </div>

    </div>

    <div class="modal-window" id="modalWindow">
        <form class="form" action=<?= baseUrl('/services/controllers/voluntarios/editarPerfil.php') ?> enctype="multipart/form-data" method="POST">
            <input type="hidden" name="idVoluntario" value="<?= $idVoluntario ?>">
            <div class="modal-card-profile">
                <div class="modal-title-block">
                    <div class="modal-title">Editar perfil</div>
                    <div class="line"></div>
                </div>
                <label class="img-block" tabindex="0">
                    <input class="input-profile-img" name="imagemVoluntario" type="file" accept="image/*">
                    <div class="img-text">
                        <?php if (!empty($imagemVoluntario)) : ?>
                            <img class="img-icon" src="<?= baseUrl($imagemVoluntario) ?>" alt="Foto de perfil do usuário" accept="image/*">
                        <?php else : ?>
                            <img class="img-icon" src="<?= baseUrl('/assets/img/iconUser.jpg') ?>" alt="Foto de perfil do usuário" accept="image/*">
                        <?php endif; ?>
                    </div>
                </label>
                <div class="modal-input-block-perfil">
                    <input id="nomeVoluntario" name="nomeVoluntario" type="text" class="modal-input" value="<?= $nomeVoluntario ?? '' ?>">
                    <i class="fa-regular fa-pen-to-square icon-input"></i>
                </div>
                <div class="modal-input-block-perfil">
                    <input id="emailVoluntario" name="emailVoluntario" type="text" class="modal-input" value="<?= $emailVoluntario ?? '' ?>">
                    <i class="fa-regular fa-pen-to-square icon-input"></i>
                </div>
                <button type="submit" class="btn-modal" id="close">Concluído</button>
            </div>
        </form>
    </div>

    <div class="modal-window" id="SecondModalWindow">
        <form action="<?= baseUrl('/services/controllers/voluntarios/projetos/participarProjeto.php') ?>" method="POST">
            <input type="hidden" name="idProjeto" id="id" value="">
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
        </form>
    </div>
</body>

<script src="<?= baseUrl('/assets/js/visualizarImagem.js') ?>"></script>
<script src="<?= baseUrl('/assets/js/modal.js') ?>"></script>

<?php
include_once(includeURL('views/includes/footer.php'));
?>