<?php
    include_once('./views/includes/head.php')
?>


<link rel="stylesheet" href="./assets/css/home.css">

<section class="join-us">
    <div class="join-us-text-block">
        <h1 class="join-us-title">Junte-se ao nosso Oásis e faça a diferença!</h1>
        <p class="join-us-text">
            Encontre oportunidades de voluntariado e ajude a transformar o mundo ao seu redor. Seja bem-vindo(a) ao Oásis para Todos.
        </p>

        <button class="btn-purple"><a href="<?= baseUrl('/views/forms/voluntarios/cadastro.php')?>">Fazer parte</a></button>
    </div>
    <div class="join-us-img-block">
        <img class="join-us-img" src="./assets/img/Taking care of the Earth-amico.png" alt="">
    </div>
</section>
<section class="green-block-explain" data-anime="top">
    <div class="green-title-block">
        <img src="./assets/img/logo-oasis-verde.png" alt="" class="green-block-img">
        <span class="green-block-title">Imagine um Oásis....</span>
    </div>
    <p class="green-block-text">
    A Oásis é uma comunidade de voluntários dedicados a preservar e restaurar a natureza. Junte-se a nós para fazer a diferença e ajudar a criar um mundo mais verde e sustentável.
    </p>
</section>
<section class="timeline" data-anime="left">
    <div class="timeline-title-block">
        <h1 class="timeline-title">Como funciona?</h1>
        <div class="line"></div>
    </div>
    <section class="timeline-section">
        <div class="timeline-items">
            <div class="timeline-item">
                <div class="timeline-dot"></div>
                <div class="timeline-card-title icon-position"><i class="fa-solid fa-paste icon-timeline"></i>Cadastro Descomplicado</div>
                <div class="timeline-content">
                    <p>Faça parte da comunidade Oásis e comece rapidamente sua jornada de voluntariado
                        com um processo de inscrição fácil e intuitivo.
                    </p>
                </div>
            </div>
            <div class="timeline-item">
                <div class="timeline-dot"></div>
                <div class="timeline-card-title align-right">Conexão Direta<i class="fa-solid fa-handshake-angle icon-timeline"></i></div>
                <div class="timeline-content">
                    <p>Se conecte diretamente com organizações e voluntários que compartilham sua paixão pelo meio ambiente. </p>
                </div>
            </div>
            <div class="timeline-item">
                <div class="timeline-dot"></div>
                <div class="timeline-card-title icon-position"><i class="fa-solid fa-users-viewfinder icon-timeline"></i>Descubra Oportunidades Únicas</div>
                <div class="timeline-content">
                    <p>Explore oportunidades de voluntariado que refletem seus interesses e causas.
                        Na Oásis, a descoberta de projetos significativos está ao seu alcance.</p>
                </div>
            </div>
            <div class="timeline-item">
                <div class="timeline-dot"></div>
                <div class="timeline-card-title align-right">Inovação social<i class="fa-regular fa-lightbulb icon-timeline"></i></div>
                <div class="timeline-content">
                    <p>Seja parte da inovação social. Na Oásis, estamos redefinindo o voluntariado ambiental,
                        incentivando novas formas de agir em prol do meio ambiente.</p>
                </div>
            </div>
            <div class="timeline-item">
                <div class="timeline-dot"></div>
                <div class="timeline-card-title icon-position"><i class="fa-regular fa-heart icon-timeline"></i>Simplicidade com Propósito</div>
                <div class="timeline-content">
                    <p>A simplicidade da Oásis esconde um propósito grandioso. Facilitamos para você se envolver
                        em ações que impactam positivamente o meio ambiente.</p>
                </div>
            </div>
        </div>
    </section>
</section>
    <section class="our-partners">
        <div class="partners-block active-display" data-anime="right">
            <div class="our-partners-text-block">
                <div class="our-partners-title-block">
                    <h1 class="our-partners-title">Conheça algumas ONG’S parceiras</h1>
                    <div class="line"></div>
                </div>
                <div class="our-partners-description">
                    <h1 class="description-title">Formiguinhas da Praia</h1>
                    <p class="description-text">
                    O Grupo Formiguinhas, de Praia Grande, SP, é uma equipe voluntária dedicada ao bem-estar e
                    à sustentabilidade na comunidade. Realizam caminhadas que promovem o exercício físico e se 
                    destacam pela limpeza das praias, mostrando seu amor pelo ambiente.
                    </p>
                </div>
            </div>
            <div class="partners-card-block">
                <div class="partners-card-empty">
                </div>
                <div class="partners-card">
                    <h3 class="partners-name">Formiguinhas da Praia</h3>
                    <img class="partners-img" src="./assets/img/formiguinhas.jpg" alt="">
                    <button class="btn-partners-card"><a href="https://www.instagram.com/formiguinhasdapraia/" target="_blank">Saiba mais</a></button>
                </div>
                <div class="btn-block">
                    <button class="btn-back btn btn-details"><i class="fa-solid fa-arrow-left"></i></button>
                    <button class="btn btn-details" onclick="passarCard()"><i class="fa-solid fa-arrow-right"></i></button>
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
                    Sereia Azul é uma bióloga e educadora ambiental que, vestida de sereia, cativa crianças, 
                    transmitindo conhecimentos encantadores e inspirando amor pelos oceanos.
                    </p>
                </div>
            </div>
            <div class="partners-card-block">
                <div class="partners-card-empty">
                </div>
                <div class="partners-card">
                    <h3 class="partners-name">Sereia Azul</h3>
                    <img class="partners-img" src="./assets/img/sereia-azul.png" alt="">
                    <button class="btn-partners-card"><a href="https://www.instagram.com/asereiaazul/" target="_blank">Saiba mais</a></button>
                </div>
                <div class="btn-block">
                    <button class="btn-back btn btn-details" onclick="voltarCard()"><i class="fa-solid fa-arrow-left"></i></button>
                </div>
                
            </div>
        </div>
    </section>

    <?php
        include_once('./views/includes/footer.php')
    ?>
    <script src="./assets/js/passarCard.js"></script>