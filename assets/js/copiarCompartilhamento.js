function copyToClipboard() {
    // Seleciona o elemento de input
    var inputElement = document.getElementById("myInput");

    // Seleciona o texto dentro do elemento de input
    inputElement.select();

    try {
        // Copia o texto para a área de transferência usando a API Clipboard
        navigator.clipboard.writeText(inputElement.value)
            .then(function() {
                alert('Texto copiado!');
            })
            .catch(function(err) {
                console.error('Erro ao copiar o texto: ', err);
            });
    } catch (err) {
        console.error('Erro ao copiar o texto: ', err);
    }
}