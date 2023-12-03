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

    if (isset($_GET['id'])) {
        $idFromGet = $_GET['id'];
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
                    WHERE v.cd_voluntario = :id";
        $query = $conn->prepare($sql);
        $query->bindParam(":id", $idFromGet);
    } else {
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
    }

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
            <?php
            // Verifica se o ID do voluntário logado é o mesmo do perfil atual
            if (isset($_SESSION['idVoluntario']) && $_SESSION['idVoluntario'] === $idVoluntario) {
                // Se sim, exibe o botão de editar perfil
            ?>
                <div onclick="openModal()" class="edit-profile-position">
                    <div class="edit-profile">
                        <i class="fa-regular fa-pen-to-square social-midia-icon"></i>
                        <div class="edit-profile-span">Editar perfil</div>
                    </div>
                </div>
            <?php
            }
            ?>
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
                        // Consulta para os projetos
                        $selectProjetos = $conn->prepare("SELECT 
                                        p.cd_projeto,
                                        p.nm_titulo_projeto,
                                        p.ds_endereco,
                                        DATE_FORMAT(p.dt_projeto, '%d/%m/%Y') AS data_formatada_projeto,
                                        p.ds_projeto AS descricao_projeto,
                                        p.nm_imagem AS imagem_projeto,
                                        ong.nm_ong AS ong_nome
                                    FROM tb_inscricao ins
                                    LEFT JOIN tb_projeto p ON ins.cd_projeto = p.cd_projeto
                                    LEFT JOIN tb_ong ong ON p.cd_ong = ong.cd_ong
                                    WHERE ins.cd_voluntario = :idVoluntario");
                        $selectProjetos->bindParam(":idVoluntario", $idVoluntario);
                        $selectProjetos->execute();

                        while ($rowProjeto = $selectProjetos->fetch()) {
                            // Obter dados do projeto e da ONG associada
                            $idProjeto = $rowProjeto['cd_projeto'];
                            $tituloProjeto = $rowProjeto['nm_titulo_projeto'];
                            $descricaoProjeto = $rowProjeto['descricao_projeto'];
                            $imagemProjeto = $rowProjeto['imagem_projeto'];
                            $ongProjeto = $rowProjeto['ong_nome'];
                            $enderecoProjeto = $rowProjeto['ds_endereco'];

                            if (isset($rowProjeto['imagem_projeto'])) {
                        ?>
                                <div class="pjcts" data-id="<?= $idProjeto ?>" data-imagem="<?= $imagemProjeto ?>" data-titulo="<?= $tituloProjeto ?>" data-ong="<?= $ongProjeto ?>" data-descricao="<?= $descricaoProjeto ?>" data-dia="<?= $dataProjeto ?>" data-endereco="<?= $enderecoProjeto ?>" onclick="openSecondModal(this)">
                                    <img src="<?= baseUrl($imagemProjeto) ?>" alt="Imagem Projeto">
                                </div>
                        <?php
                            }
                        }
                        ?>

                        <?php
                        // Consulta para os eventos
                        $selectEventos = $conn->prepare("SELECT 
                                        e.cd_evento,
                                        e.nm_titulo_evento,
                                        e.ds_endereco AS endereco_evento,
                                        DATE_FORMAT(e.dt_evento, '%d/%m/%Y') AS data_formatada_evento,
                                        e.ds_evento AS descricao_evento,
                                        e.nm_imagem AS imagem_evento,
                                        ong.nm_ong AS ong_nome
                                    FROM tb_inscricao ins
                                    LEFT JOIN tb_evento e ON ins.cd_evento = e.cd_evento
                                    LEFT JOIN tb_ong ong ON e.cd_ong = ong.cd_ong
                                    WHERE ins.cd_voluntario = :idVoluntario");
                        $selectEventos->bindParam(":idVoluntario", $idVoluntario);
                        $selectEventos->execute();

                        while ($rowEvento = $selectEventos->fetch()) {
                            // Obter dados do evento e da ONG associada
                            $idEvento = $rowEvento['cd_evento'];
                            $tituloEvento = $rowEvento['nm_titulo_evento'];
                            $descricaoEvento = $rowEvento['descricao_evento'];
                            $imagemEvento = $rowEvento['imagem_evento'];
                            $ongEvento = $rowEvento['ong_nome'];
                            $enderecoEvento = $rowEvento['endereco_evento'];
                            $diaEvento = $rowEvento['data_formatada_evento'];

                            if (isset($rowEvento['imagem_evento'])) {
                        ?>
                                <div class="pjcts" data-id="<?= $idEvento ?>" data-imagem="<?= $imagemEvento ?>" data-titulo="<?= $tituloEvento ?>" data-ong="<?= $ongEvento ?>" data-descricao="<?= $descricaoEvento ?>" data-dia="<?= $dataEvento ?>" data-endereco="<?= $enderecoEvento ?>" onclick="openSecondModal(this)">
                                    <img src="<?= baseUrl($imagemEvento) ?>" alt="Imagem Evento">
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
                        // Consulta para os projetos
                        $selectProjetos = $conn->prepare("SELECT 
                                        p.cd_projeto,
                                        p.nm_titulo_projeto,
                                        p.ds_endereco,
                                        DATE_FORMAT(p.dt_projeto, '%d/%m/%Y') AS data_formatada_projeto,
                                        p.ds_projeto AS descricao_projeto,
                                        p.nm_imagem AS imagem_projeto,
                                        ong.nm_ong AS ong_nome
                                    FROM tb_inscricao ins
                                    LEFT JOIN tb_projeto p ON ins.cd_projeto = p.cd_projeto
                                    LEFT JOIN tb_ong ong ON p.cd_ong = ong.cd_ong
                                    WHERE ins.cd_voluntario = :idVoluntario
                                    AND p.dt_projeto >= :currentDate");
                        $selectProjetos->bindParam(":idVoluntario", $idVoluntario);
                        $selectProjetos->bindParam(":currentDate", $currentDate);
                        $selectProjetos->execute();

                        while ($rowProjeto = $selectProjetos->fetch()) {
                            // Obter dados do projeto e da ONG associada
                            $idProjeto = $rowProjeto['cd_projeto'];
                            $tituloProjeto = $rowProjeto['nm_titulo_projeto'];
                            $descricaoProjeto = $rowProjeto['descricao_projeto'];
                            $imagemProjeto = $rowProjeto['imagem_projeto'];
                            $ongProjeto = $rowProjeto['ong_nome'];

                            if (isset($rowProjeto['imagem_projeto'])) {
                        ?>
                                <div class="pjcts" data-id="<?= $idProjeto ?>" data-imagem="<?= $imagemProjeto ?>" data-titulo="<?= $tituloProjeto ?>" data-ong="<?= $ongProjeto ?>" data-descricao="<?= $descricaoProjeto ?>" data-dia="<?= $dataProjeto ?>" data-endereco="<?= $enderecoProjeto ?>" onclick="openSecondModal(this)">
                                    <img src="<?= baseUrl($imagemProjeto) ?>" alt="Imagem Projeto">
                                </div>
                        <?php
                            }
                        }
                        ?>

                        <?php
                        // Consulta para os eventos
                        $selectEventos = $conn->prepare("SELECT 
                                        e.cd_evento,
                                        e.nm_titulo_evento,
                                        e.ds_endereco AS endereco_evento,
                                        DATE_FORMAT(e.dt_evento, '%d/%m/%Y') AS data_formatada_evento,
                                        e.ds_evento AS descricao_evento,
                                        e.nm_imagem AS imagem_evento,
                                        ong.nm_ong AS ong_nome
                                    FROM tb_inscricao ins
                                    LEFT JOIN tb_evento e ON ins.cd_evento = e.cd_evento
                                    LEFT JOIN tb_ong ong ON e.cd_ong = ong.cd_ong
                                    WHERE ins.cd_voluntario = :idVoluntario
                                    AND e.dt_evento >= :currentDate");
                        $selectEventos->bindParam(":idVoluntario", $idVoluntario);
                        $selectEventos->bindParam(":currentDate", $currentDate);
                        $selectEventos->execute();

                        while ($rowEvento = $selectEventos->fetch()) {
                            // Obter dados do evento e da ONG associada
                            $idEvento = $rowEvento['cd_evento'];
                            $tituloEvento = $rowEvento['nm_titulo_evento'];
                            $descricaoEvento = $rowEvento['descricao_evento'];
                            $imagemEvento = $rowEvento['imagem_evento'];
                            $ongEvento = $rowEvento['ong_nome'];

                            if (isset($rowEvento['imagem_evento'])) {
                        ?>
                                <div class="pjcts" data-id="<?= $idEvento ?>" data-imagem="<?= $imagemEvento ?>" data-titulo="<?= $tituloEvento ?>" data-ong="<?= $ongEvento ?>" data-descricao="<?= $descricaoEvento ?>" data-dia="<?= $dataEvento ?>" data-endereco="<?= $enderecoEvento ?>" onclick="openSecondModal(this)">
                                    <img src="<?= baseUrl($imagemEvento) ?>" alt="Imagem Evento">
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
        </div>

    </div>

    <!-- editar informações -->
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

    <!-- exibir as informações do projeto -->
    <div class="modal-window" id="SecondModalWindow">
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

</body>

<script src="<?= baseUrl('/assets/js/visualizarImagem.js') ?>"></script>
<script src="<?= baseUrl('/assets/js/modal.js') ?>"></script>

<?php
include_once(includeURL('views/includes/footer.php'));
?>