// Serve literalmente para impedir que o usuário selecione mais que 3 interesses.

document.addEventListener('DOMContentLoaded', function () {
    var interesses = document.querySelectorAll('input[name="interesses[]"]');

    interesses.forEach(function (interesse) {
        interesse.addEventListener('change', function () {
            var selecionados = document.querySelectorAll('input[name="interesses[]"]:checked');
            var maximo = 3;

            if (selecionados.length > maximo) {
                alert('Você só pode selecionar até ' + maximo + ' interesses.'); 
                this.checked = false; // Desmarca a última caixa marcada
            }
        });
    });
});