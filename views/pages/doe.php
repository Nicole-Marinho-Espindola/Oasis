<?php
    include_once('../includes/head.php')
?>

<link rel="stylesheet" href="<?= baseUrl('/assets/css/doe.css')?>">

<section class="donate-main-block">
    <div class="main-title-block">
        <h1 class="purple-title">Faça parte da mudança agora</h1>
        <h2 class="title">Faça sua doação para a Oásis</h1>
    </div>
    <div class="dark-green-block">
        <img class="donate-img" src="<?= baseUrl('/assets/img/Taking care of the Earth-pana.png')?>" alt="">
        <span class="donate-span">Seja a gota que faz florescer o nosso Oásis de esperança e sustentabilidade.</span>
        <div class="donate-btn-block">
            <button class="purple-btn">Doe aqui</button>
            <button class="green-btn">Compartilhar</button>
        </div>
    </div>
    <div class="activity-block">
        <div class="activity-title-block">
            <h3 class="activity-title"><span class="bold-title">Pessoas que fizeram a diferença:</span> confira quem já ajudou.</h3>
            <div class="line"></div>
        </div>
        <div class="activity">
            <div class="activity-child">
                <div class="activity-child-content">
                    <i class="fa-solid fa-hand-holding-heart donate-icon"></i>
                    <div class="user-donate-config">
                        <h4 class="user-name">Nicole</h4>
                        <span class="purple-span-donate">Contribuiu</span>
                    </div>
                    <div class="user-donate-time">15 minutos</div>
                </div>
                <span class="tiny-line"></span>
            </div>
            <div class="activity-child">
                <div class="activity-child-content">
                    <i class="fa-regular fa-paper-plane donate-icon"></i>
                    <div class="user-donate-config">
                        <h4 class="user-name">Nicole</h4>
                        <span class="purple-span-donate">Contribuiu</span>
                    </div>
                    <div class="user-donate-time">15 minutos</div>
                </div>
                <span class="tiny-line"></span>
            </div>
            <div class="activity-child">
                <div class="activity-child-content">
                    <i class="fa-solid fa-hand-holding-dollar donate-icon"></i>
                    <div class="user-donate-config">
                        <h4 class="user-name">Nicole</h4>
                        <span class="purple-span-donate">Contribuiu</span>
                    </div>
                    <div class="user-donate-time">15 minutos</div>
                </div>
                <span class="tiny-line"></span>
            </div>
        </div>
    </div>
</section>

<?php
    include_once('../includes/footer.php')
?>