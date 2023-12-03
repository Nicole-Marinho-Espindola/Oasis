<?php
    include_once('../includes/head.php');
    include_once('../../config/database.php');
    $_SESSION['email'] = $email;
    
?>

<head>
    <link rel="stylesheet" href="<?= baseUrl('/assets/css/doe.css') ?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.27/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.27/dist/sweetalert2.all.min.js"></script>
</head>

<body>
    <?php
        if (isset($_GET['compartilhar_sucesso']) && $_GET['compartilhar_sucesso'] == 'true') {
            echo '<script src="../../assets/js/alerts.js"></script>';
            echo '<script>alertCompartilhamento();</script>';
        }
    ?>
</body>

<section class="donate-main-block">
    <div class="main-title-block">
        <h1 class="purple-title">Faça parte da mudança agora!</h1>
        <h2 class="title">Contribua para a Oásis e compartilhe seu apoio.</h1>
    </div>
    <div class="dark-green-block">
        <img class="donate-img" src="<?= baseUrl('/assets/img/Taking care of the Earth-pana.png') ?>" alt="">
        <span class="donate-span">Seja a gota que faz florescer o nosso Oásis de esperança e sustentabilidade.</span>
        <div class="donate-btn-block">
            <button class="purple-btn" onclick="openModal()">Doe aqui</button>
            <button class="green-btn">
                <input type="hidden" value="https://www.instagram.com/oasisparatodos/" id="myInput" readonly>
                <a onclick="copyToClipboard()" href="<?= baseUrl('/services/controllers/voluntarios/compartilhamento_action.php?email=' . $email) ?>">Compartilhar</a>
            </button>
        </div>
    </div>
    <div class="activity-block">
        <div class="activity-title-block">
            <h3 class="activity-title"><span class="bold-title">Pessoas que fizeram a diferença:</span> confira quem já ajudou.</h3>
            <div class="line"></div>
        </div>
        <div class="activity">

            <?php
            try {
                $select = $conn->prepare("SELECT
                                            v.nm_voluntario AS nome,
                                            d.dt_doacao AS data,
                                            'Contribuiu' AS acao
                                        FROM tb_voluntario v
                                        JOIN tb_doacao d ON v.cd_voluntario = d.cd_voluntario

                                        UNION ALL

                                        SELECT
                                            v.nm_voluntario AS nome,
                                            c.hr_compartilhamento AS data,
                                            'Compartilhou' AS acao
                                        FROM tb_voluntario v
                                        JOIN tb_compartilhamento c ON v.cd_voluntario = c.cd_voluntario

                                        ORDER BY data DESC
                                        LIMIT 5;
                                        ");
                $select->execute();

                while ($row = $select->fetch()) {

                    //pra deixar icones aleatorios bonitinhos
                    $icones = [
                        'fa-solid fa-hand-holding-heart',
                        'fa-regular fa-paper-plane',
                        'fa-regular fa-heart',
                        'fa-clover',
                        'fa-seedling',
                        'fa-tree',
                        'fa-leaf',
                        'fa-cannabis',
                        'fa-cloud-sun',
                        'fa-recycle',
                        'fa-spa',
                        'fa-rainbow',
                        'fa-hands-holding',
                        'fa-handshake-angle',
                    ];

                    $iconeAleatorio = $icones[array_rand($icones)];

                    // calcular a diferença de tempo
                    date_default_timezone_set('America/Sao_Paulo');
                    $dataAtual = new DateTime();
                    $dataAcao = new DateTime($row['data']);
                    $intervalo = $dataAtual->diff($dataAcao);
                    
                    $tempoFormatado = '';
                    
                    if ($intervalo->days > 0) {
                        $tempoFormatado = $intervalo->days . ($intervalo->days == 1 ? ' dia atrás' : ' dias atrás');
                    } elseif ($intervalo->h > 0) {
                        $tempoFormatado = $intervalo->h . ($intervalo->h == 1 ? ' hora atrás' : ' horas atrás');
                    } elseif ($intervalo->i > 0) {
                        $tempoFormatado = $intervalo->i . ($intervalo->i == 1 ? ' minuto atrás' : ' minutos atrás');
                    } else {
                        $tempoFormatado = 'Agora mesmo';
                    }
                    
            ?>
                    <div class="activity-child">
                        <div class="activity-child-content">
                            <div class="donate-content-config">
                                <i class="fa-solid <?= $iconeAleatorio ?> donate-icon"></i>
                                <div class="user-donate-config">
                                    <h4 class="user-name"><?= $row['nome'] ?></h4>
                                    <span class="purple-span-donate"><?= $row['acao'] ?></span>
                                </div>
                            </div>
                            <div class="user-donate-time"><?= $tempoFormatado ?></div>
                        </div>
                        <span class="tiny-line"></span>
                    </div>
            <?php
                }
            } catch (PDOException $e) {
                echo "Erro no banco de dados: " . $e->getMessage();
            }
            ?>
        </div>
    </div>
</section>

<div class="modal-window" id="modalWindow">
    <div class="modal-card">
        <div class="modal-title-block">
            <div class="modal-title">Copiar chave pix</div>
            <div class="line" ></div>
            <div class="modal-subtitle">Copie o codigo pix para doar para o nosso oásis</div>
        </div>
        <div class="modal-input-block">55847868856
            <input type="text" class="modal-input" readonly> 
            <i class="fa-regular fa-copy modal-input-icon"></i>
        </div>
        <button class="btn-modal" id="close">Concluido</button>
    </div>
</div>

<script src="../../assets/js/copiarCompartilhamento.js"></script>
<script src="../../assets/js/modal.js"></script>

<?php
    include_once('../includes/footer.php')
?>