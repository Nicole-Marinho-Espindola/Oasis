    <?php
        include_once('../../includes/head.php')
    ?>

    <link rel="stylesheet" href="<?= baseUrl('/assets/css/projeto.css')?>">

    <section class="projects">
        <div class="dark-purple-block">
            <div class="btn-project">Projetos</div>
            <a href="<?= baseUrl('/views/pages/eventos/eventosOng.php')?>" class="link-projects-style">
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
                <button class="btn-project-card" onclick="openModal()">Participar</button>
            </div>
            <div class="project-card project-card-effect" onclick="openSecondModal()">
                <div class="card-title-add">Adicionar projeto</div>
                <i class="fa-solid fa-plus icon-add-project"></i>
            </div>
        </div>
    </section>

    <div class="modal-window" id="modalWindow">
    <form class="form" action=<?= baseUrl('/services/controllers/ongs/projetos/editarPerfil.php') ?> enctype="multipart/form-data" method="POST">
        <div class="modal-card-projects">
            <div class="project-img-block">
                <img class="project-img" src="<?= baseUrl('/assets/img/foto-teste.webp')?>" alt="">
            </div>
            <div class="modal-title-block-project">
                <div class="modal-title-project">Recolher lixo</div>
                <div class="line"></div>
            </div>
            <div class="modal-title-block-project">
                <div class="modal-title-project">Descrição</div>
            </div>
            <div class="textarea-project">
                <textarea name="" id="" cols="45" rows="5" readonly>Unindo esforços para preservar nossas praias, este projeto visa reunir voluntários dedicados a remover resíduos e lixo das áreas costeiras, restaurando a beleza natural de nossas praias e protegendo a vida marinha.</textarea>
            </div>   
            <div class="modal-title-block-project">
                <div class="modal-title-project">Requisitos</div>
            </div>
            <div class="modal-project-info">
                <div class="info">
                    <i class="fa-solid fa-people-group icon-project icon-modal-color"></i>
                    <span class="name-span">Formiguinhas</span>
                </div>
                <div class="info">
                    <i class="fa-solid fa-location-dot icon-project icon-modal-color"></i>
                    <span class="name-span margin">Caiçara</span>
                </div>
                <div class="info">
                    <i class="fa-solid fa-calendar-days icon-project icon-modal-color"></i>
                    <span class="name-span margin">13/09/2023</span>
                </div>
            </div>

            <button class="btn-modal" id="close">Participar</button>
        </div>
    </div>

    <div class="modal-window" id="SecondModalWindow">
        <div class="modal-card-projects">
            <div class="modal-title-block-project">
                <div class="modal-title-project">Adicionar projeto</div>
                <div class="line"></div>
            </div>
            <div class="project-img-add-modal">
                <div class="modal-title-project">Imagem</div>
                <input class="input-img" type="file">
            </div>
            <div class="modal-title-block-project">
                <div class="modal-title-project">Descrição</div>
            </div>
            <div class="textarea-project">
                <textarea name="" id="" cols="45" rows="5"></textarea>
            </div>   
            <div class="modal-title-block-project">
                <div class="modal-title-project">Requisitos</div>
            </div>
            <div class="modal-project-info">
                <div class="info-modal-req">
                    <i class="fa-solid fa-people-group icon-project icon-modal-color"></i>
                    <input type="text" class="input-requitos" value="" placeholder="Nome do grupo">
                </div>
                <div class="info-modal-req ajust">
                    <i class="fa-solid fa-location-dot icon-project icon-modal-color"></i>
                    <input type="text" class="input-requitos" placeholder="Localização">
                </div>
                <div class="info-modal-req ajust">
                    <i class="fa-solid fa-calendar-days icon-project icon-modal-color"></i>
                    <input type="text" class="input-requitos" placeholder="Data do projeto">
                </div>
            </div>
            <button class="btn-modal" id="close">Adicionar</button>
        </div>
    </div>

    <script src="<?= baseUrl('/assets/js/modal.js')?>"></script>

    <?php
        include_once('../../includes/footer.php')
    ?>