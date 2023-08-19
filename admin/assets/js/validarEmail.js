function validarEmail(email) {
    var padraoEmail = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
    var mensagemDiv = document.getElementById('mensagem');

    if (padraoEmail.test(email)) {
        mensagemDiv.textContent = "O email é válido.";
    } else {
        mensagemDiv.textContent = "O email não é válido.";
    }
}