
function formatDate(date) {
    const options = { day: 'numeric', month: 'numeric', year: 'numeric' };
    return date.toLocaleDateString('pt-BR', options);
}


function openModal(data) {
    const modal = document.getElementById('modalWindow');
    modal.classList.add('open');

    modal.addEventListener('click', (e) => {
        if (e.target.id == 'close' || e.target.id == 'modalWindow') {
            modal.classList.remove('open');
        }
    });

    document.getElementById('modalDia').innerText = formatDate(new Date(data));
}


function openSecondModal(element) {
    const modal = document.getElementById("SecondModalWindow");
    modal.classList.add("open");

    const modalTitle = document.getElementById("modalTitle");
    const modalOng = document.getElementById("modalOng");
    const modalDescricao = document.getElementById("modalDescricao");
    const modalDia = document.getElementById("modalDia");
    const modalEndereco = document.getElementById("modalEndereco");
    const modalImagem = document.getElementById("modalImagem");

    // Preencher os dados do modal com os atributos data-* do elemento clicado
    modalTitle.innerText = element.getAttribute("data-titulo");
    modalOng.innerText = element.getAttribute("data-ong");
    modalDescricao.innerText = element.getAttribute("data-descricao");
    modalDia.innerText = element.getAttribute("data-dia");
    modalEndereco.innerText = element.getAttribute("data-endereco");

    // Define o src da imagem usando o caminho fornecido
    const base = "../../../";
    const caminhoCompleto = base + element.getAttribute("data-imagem");
    modalImagem.setAttribute("src", caminhoCompleto);

    modal.addEventListener("click", (e) => {
        if (e.target.id === "SecondModalWindow" && !e.target.closest(".modal-card-projects")) {
            modal.classList.remove("open");
        }
    });
}