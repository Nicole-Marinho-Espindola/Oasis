function openModal(button) {
    var titulo = button.getAttribute("data-titulo");
    var ong = button.getAttribute("data-ong");
    var descricao = button.getAttribute("data-descricao");
    var dia = button.getAttribute("data-dia");
    var endereco = button.getAttribute("data-endereco");
    var id = button.getAttribute("data-id");
    var imagem = button.getAttribute("data-imagem");

    const modal = document.getElementById('modalWindow');
    modal.classList.add('open');

    modal.addEventListener('click', (e) => {
        if (e.target.id == 'close' || e.target.id == 'modalWindow') {
            modal.classList.remove('open');
        }
    });

    // Recupere os atributos do botão clicado
    document.getElementById("modalTitle").innerText = titulo;
    document.getElementById("modalOng").innerText = ong;
    document.getElementById("modalDescricao").value = descricao;
    document.getElementById("modalDia").innerText = dia;
    document.getElementById("modalEndereco").innerText = endereco;
    document.getElementById("modalImagem").innerText = imagem;
    document.getElementById('id').value = id;
}


function openSecondModal(){
    const modal = document.getElementById('SecondModalWindow')
    modal.classList.add('open')

    modal.addEventListener('click', (e) => {
        if(e.target.id == 'close' || e.target.id == 'SecondModalWindow') // evento ocorre quando o alvo for o seguinte id
            modal.classList.remove('open')
    })
}