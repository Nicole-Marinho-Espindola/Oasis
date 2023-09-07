$(document).ready(function () {
    // Defina a função genérica de pesquisa
    function pesquisar(tipo) {
        var searchTerm = $('#searchInput' + tipo).val();
        var searchButton = $('#searchButton' + tipo);
        var searchResults = $('#searchResults' + tipo);

        $.ajax({
            url: '../../views/' + tipo + '/search.php',
            method: 'POST',
            data: { search: searchTerm },
            success: function (response) {
                searchResults.html(response);
            },
            beforeSend: function () {
                // Antes de enviar a solicitação, você pode fazer algo aqui, se necessário
            },
            complete: function () {
                // Após a conclusão da solicitação (seja sucesso ou erro),
                // redefina o texto do botão para "Pesquisar"
                searchButton.text("Pesquisar");
            }
        });
    }

    // voluntários
    $('#searchInputVoluntario').on('input', function () {
        pesquisar('voluntarios');
    });

    $('#searchButtonVoluntario').click(function () {
        pesquisar('voluntarios');
    });

    // interesses
    $('#searchInputInteresse').on('input', function () {
        pesquisar('interesses');
    });

    $('#searchButtonInteresse').click(function () {
        pesquisar('interesses');
    });

    // ONGs
    $('#searchInputOng').on('input', function () {
        pesquisar('ongs');
    });

    $('#searchButtonOng').click(function () {
        pesquisar('ongs');
    });
});