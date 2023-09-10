$(document).ready(function () {

    function pesquisar(tipo) {

        var searchTerm = $('#searchInput' + tipo).val();
        var searchButton = $('#searchButton' + tipo);
        var searchResults = $('#searchResults');

        $.ajax({
            url: '../../views/' + tipo + 's' + '/search.php',
            method: 'POST',
            data: { search: searchTerm },
            success: function (response) {
                console.log(response); // Adicione esta linha
                searchResults.html(response);
            },
            beforeSend: function () {
            },
            complete: function () {
                // Após a conclusão da solicitação (seja sucesso ou erro),
                // redefina o texto do botão para "Pesquisar"
                searchButton.text("Pesquisar");
            }
        });
    }

     // interesses
    $('#searchInputInteresse').on('input', function () {
        pesquisar('Interesse');
    });

    $('#searchButtonInteresse').click(function () {
        pesquisar('Interesse');
    });

    // voluntários
    $('#searchInputVoluntario').on('input', function () {
        pesquisar('Voluntario');
    });

    $('#searchButtonVoluntario').click(function () {
        pesquisar('Voluntario');
    });

    // ONGs
    $('#searchInputOng').on('input', function () {
        pesquisar('Ong');
    });

    $('#searchButtonOng').click(function () {
        pesquisar('Ong');
    });
});