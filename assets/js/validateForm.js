function validateForm() {
    var nomeProjeto = document.getElementsByName('nomeProjeto')[0].value.trim();
    var descricaoProjeto = document.getElementsByName('descricaoProjeto')[0].value.trim();
    var imagemProjeto = document.getElementsByName('imagemProjeto')[0].value.trim();
    var enderecoProjeto = document.getElementsByName('enderecoProjeto')[0].value.trim();
    var dataProjeto = document.getElementsByName('dataProjeto')[0].value.trim();

    // Verificar se algum campo obrigatório está vazio
    if (!nomeProjeto || !descricaoProjeto || !imagemProjeto || !enderecoProjeto || !dataProjeto) {
        alert('Por favor, preencha todos os campos obrigatórios.');
        return false; // Impede o envio do formulário se algum campo estiver vazio
    }

    return true; // Permite o envio do formulário se todos os campos estiverem preenchidos
}