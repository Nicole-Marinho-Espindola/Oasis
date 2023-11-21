function closeAllModals() {
    const modals = document.querySelectorAll(".modal-window");
    modals.forEach((modal) => {
        if (modal.classList.contains("open")) {
            modal.classList.remove("open");
        }
    });
}

function openSecondModal() {
    closeAllModals();

    const modal = document.getElementById("SecondModalWindow");
    modal.classList.add("open");

    modal.addEventListener("click", (e) => {
        if (
            e.target.id === "SecondModalWindow" &&
            !e.target.closest(".small-blocks-section")
        ) {
            modal.classList.remove("open");
        }
    });
}

function openEditModal() {
    closeAllModals();

    const modal = document.getElementById("EditModalWindow");
    modal.classList.add("open");

    modal.addEventListener("click", (e) => {
        const isInsideModalContent = e.target.closest(".modal-card-projects");
        const isActionButton = e.target.closest(".small-blocks-section");

        // Fecha a modal somente se o clique for fora dos elementos da modal ou nos botões de ação
        if (!isInsideModalContent && !isActionButton) {
            modal.classList.remove("open");
        }
    });
}

function openModal(button) {
    closeAllModals();

    var titulo = button.getAttribute("data-titulo");
    var ong = button.getAttribute("data-ong");
    var descricao = button.getAttribute("data-descricao");
    var dia = button.getAttribute("data-dia");
    var endereco = button.getAttribute("data-endereco");
    var id = button.getAttribute("data-id");
    var imagem = button.getAttribute("data-imagem");

    var base = "../../../";
    var caminhoCompleto = base + imagem;

    const modal = document.getElementById("modalWindow");
    modal.classList.add("open");

    modal.addEventListener("click", (e) => {
        if (e.target.id == "close" || e.target.id == "modalWindow") {
            modal.classList.remove("open");
        }
    });

    document.getElementById("modalTitle").innerText = titulo;
    document.getElementById("modalOng").innerText = ong;
    document.getElementById("modalDescricao").value = descricao;
    document.getElementById("modalDia").innerText = dia;
    document.getElementById("modalEndereco").innerText = endereco;
    document.getElementById("modalImagem").setAttribute("src", caminhoCompleto);
    document.getElementById("id").value = id;

    var deleteLink = document.getElementById("deleteLink");
    if (deleteLink) {
        var deleteUrlProjeto =
            "../../../services/controllers/ongs/projetos/excluirProjeto.php?cd_projeto=";
        var updatedUrl = deleteUrlProjeto + id;
        deleteLink.setAttribute("href", updatedUrl);
    }

    var deleteLinkEvento = document.getElementById("deleteLinkEvento");
    if (deleteLinkEvento) {
        var deleteUrlEvento =
            "../../../services/controllers/ongs/eventos/excluirEvento.php?cd_evento=";
        var updatedUrlEvento = deleteUrlEvento + id;
        deleteLinkEvento.setAttribute("href", updatedUrlEvento);
    }
}
