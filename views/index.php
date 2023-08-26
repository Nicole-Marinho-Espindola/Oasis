<?php
    include_once('./includes/head.php')
?>

<link rel="stylesheet" href="./../assets/css/home.css">

<section class="join-us">
    <div class="join-us-text-block">
        <h1 class="join-us-title">Junte-se ao nosso Oásis e faça a diferença!</h1>
        <p class="join-us-text">
            Encontre oportunidades de voluntariado e ajude a transformar o mundo ao seu redor. Seja bem-vindo(a) ao Oásis para Todos.
        </p>

        <button class="btn-purple">Fazer parte</button>
    </div>
    <div class="join-us-img-block">
        <img class="join-us-img" src="./../assets/img/Taking care of the Earth-amico.png" alt="">
    </div>
</section>
<section class="green-block-explain">
    <div class="green-title-block">
        <img src="../assets/img/logo-oasis-verde.png" alt="" class="green-block-img">
        <span class="green-block-title">Imagine um Oásis....</span>
    </div>
    <p class="green-block-text">
    A Oásis é uma comunidade de voluntários dedicados a preservar e restaurar a natureza. Junte-se a nós para fazer a diferença e ajudar a criar um mundo mais verde e sustentável.
    </p>
</section>
<section class="timeline">
    <div class="timeline-title-block">
        <h1 class="timeline-title">Como funciona?</h1>
        <div class="line"></div>
    </div>
    <section class="timeline-section">
        <div class="timeline-items">
            <div class="timeline-item">
                <div class="timeline-dot"></div>
                <div class="timeline-card-title"><i class="fa-solid fa-paste icon-timeline"></i>Inscrições simples </div>
                <div class="timeline-content">
                    <p>Comece rapidamente sua jornada de voluntariado com um processo de inscrição fácil e intuitivo.</p>
                </div>
            </div>
            <div class="timeline-item">
                <div class="timeline-dot"></div>
                <div class="timeline-card-title align-right">Conexão direta<i class="fa-solid fa-handshake-angle icon-timeline"></i></div>
                <div class="timeline-content">
                    <p>Comece rapidamente sua jornada de voluntariado com um processo de inscrição fácil e intuitivo.</p>
                </div>
            </div>
            <div class="timeline-item">
                <div class="timeline-dot"></div>
                <div class="timeline-card-title"><i class="fa-solid fa-users-viewfinder icon-timeline"></i>Explorar oportunidades</div>
                <div class="timeline-content">
                    <p>Comece rapidamente sua jornada de voluntariado com um processo de inscrição fácil e intuitivo.</p>
                </div>
            </div>
            <div class="timeline-item">
                <div class="timeline-dot"></div>
                <div class="timeline-card-title align-right">Inovação social<i class="fa-regular fa-lightbulb icon-timeline"></i></div>
                <div class="timeline-content">
                    <p>Comece rapidamente sua jornada de voluntariado com um processo de inscrição fácil e intuitivo.</p>
                </div>
            </div>
            <div class="timeline-item">
                <div class="timeline-dot"></div>
                <div class="timeline-card-title"><i class="fa-regular fa-heart icon-timeline"></i>Inscrições simples</div>
                <div class="timeline-content">
                    <p>Comece rapidamente sua jornada de voluntariado com um processo de inscrição fácil e intuitivo.</p>
                </div>
            </div>
        </div>
    </section>
</section>
    <section class="our-partners">
        <div class="partners-block active-display">
            <div class="our-partners-text-block">
                <div class="our-partners-title-block">
                    <h1 class="our-partners-title">Conheça algumas ONG’S parceiras</h1>
                    <div class="line"></div>
                </div>
                <div class="our-partners-description">
                    <h1 class="description-title">Formiguinhas</h1>
                    <p class="description-text">
                    Esta ONG tem como objetivo combater a fome e promover a inclusão social por meio de projetos que proporcionam alimentação, educação..
                    </p>
                </div>
            </div>
            <div class="partners-card-block">
                <div class="partners-card">
                <!-- <img src="" alt="">
                    <h3 class="partners-name">Formiguinhas da praia</h3>
                    <button class="btn">Saiba mais</button> -->
                </div>
                <div class="btn-block">
                    <button class="btn-back btn"><i class="fa-solid fa-arrow-left"></i></button>
                    <button class="btn"><i class="fa-solid fa-arrow-right"></i></button>
                </div>
            </div>
        </div>
        <div class="partners-block">
            <div class="our-partners-text-block">
                <div class="our-partners-title-block">
                    <h1 class="our-partners-title">Conheça algumas ONG’S parceiras</h1>
                    <div class="line"></div>
                </div>
                <div class="our-partners-description">
                    <h1 class="description-title">Sereia Azul</h1>
                    <p class="description-text">
                    Esta ONG tem como objetivo combater a fome e promover a inclusão social por meio de projetos que proporcionam alimentação, educação..
                    </p>
                </div>
            </div>
            <div class="partners-card-block">
                <div class="partners-card">
                <!-- <img src="" alt="">
                    <h3 class="partners-name">Formiguinhas da praia</h3>
                    <button class="btn">Saiba mais</button> -->
                </div>
                <div class="btn-block">
                    <button class="btn-back btn"><i class="fa-solid fa-arrow-left"></i></button>
                    <button class="btn" onclick="passarEtapa()"><i class="fa-solid fa-arrow-right"></i></button>
                </div>
            </div>
        </div>
    </section>

    <script src="./../assets/js/passarCard.js"></script>