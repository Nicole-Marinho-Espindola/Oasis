<?php
    include_once('../../includes/head.php')
?>

<link rel="stylesheet" href="<?= baseUrl('/assets/css/projeto.css')?>">

<section class="projects">
    <div class="dark-purple-block">
        <div class="btn-project">Projetos</div>
        <div class="btn-event">Eventos</div>
    </div>
    <div class="filter-block">
        <i class="fa-solid fa-sliders filter-icon"></i>
    </div>
    <div class="projects-cards-block">
        <div class="project-card">
            <div class="project-img-block">
                <img class="project-img" src="<?= baseUrl('/assets/img/foto-teste.webp')?>" alt="">
            </div>
            <div class="card-title-block">
                <div class="card-title">Recolher lixo da praia</div>
                <div class="line"></div>
            </div>
            <div class="project-info">
                <div class="info">
                    <i class="fa-solid fa-people-group icon-project"></i>
                    <span class="name-span">Formiguinhas</span>
                </div>
                <div class="info">
                    <i class="fa-solid fa-location-dot icon-project"></i>
                    <span class="name-span margin">Caiçara</span>
                </div>
                <div class="info">
                    <i class="fa-solid fa-calendar-days icon-project"></i>
                    <span class="name-span margin">13/09/2023</span>
                </div>
            </div>
            <button class="btn-project-card">Participar</button>
        </div>
    </div>
</section>

<?php
    include_once('../../includes/footer.php')
?>