
$(document).ready(function () {
    $('#searchInputVoluntario').on('input', function () {
        pesquisarVoluntario(); // Chama a função para realizar a pesquisa quando o usuário digita
    });

    $('#searchButtonVoluntario').click(function () {
        pesquisarVoluntario(); // Chama a função para realizar a pesquisa quando o botão é clicado
    });

});

function pesquisarVoluntario() {
    var searchTerm = $('#searchInputVoluntario').val();
    var searchButtonVoluntario = $('#searchButtonVoluntario'); // Referência ao botão de pesquisa

    $.ajax({
        url: '../../views/voluntarios/search.php',
        method: 'POST',
        data: { search: searchTerm },
        success: function (response) {
            $('#searchResults').html(response);
        },
        beforeSend: function () {
            // Antes de enviar a solicitação, você pode fazer algo aqui, se necessário
        },
        complete: function () {
            // Após a conclusão da solicitação (seja sucesso ou erro),
            // redefina o texto do botão para "Pesquisar"
            searchButtonVoluntario.text("Pesquisar");
        }
    });
}

// separando interesse

$(document).ready(function () {
    $('#searchInputInteresse').on('input', function () {
        pesquisarInteresse(); // Chama a função para realizar a pesquisa quando o usuário digita
    });

    $('#searchButtonInteresse').click(function () {
        pesquisarInteresse(); // Chama a função para realizar a pesquisa quando o botão é clicado
    });

});

function pesquisarInteresse() {
    var searchTerm = $('#searchInputInteresse').val();
    var searchButtonInteresse = $('#searchButtonInteresse'); // Referência ao botão de pesquisa

    $.ajax({
        url: '../../views/interesses/search.php',
        method: 'POST',
        data: { search: searchTerm },
        success: function (response) {
            $('#searchResults').html(response);
        },
        beforeSend: function () {
            // Antes de enviar a solicitação, você pode fazer algo aqui, se necessário
        },
        complete: function () {
            // Após a conclusão da solicitação (seja sucesso ou erro),
            // redefina o texto do botão para "Pesquisar"
            searchButtonInteresse.text("Pesquisar");
        }
    });
}

// separando ong

$(document).ready(function () {
    $('#searchInputOng').on('input', function () {
        pesquisarOng(); // Chama a função para realizar a pesquisa quando o usuário digita
    });

    $('#searchButtonOng').click(function () {
        pesquisarOng(); // Chama a função para realizar a pesquisa quando o botão é clicado
    });

});

function pesquisarOng() {
    var searchTerm = $('#searchInputOng').val();
    var searchButtonOng = $('#searchButtonOng'); // Referência ao botão de pesquisa

    $.ajax({
        url: '../../views/ongs/search.php', // Alterado para pesquisar Ong
        method: 'POST',
        data: { search: searchTerm },
        success: function (response) {
            $('#searchResults').html(response); // Alterado para #searchResultsOng
        },
        beforeSend: function () {
            // Antes de enviar a solicitação, você pode fazer algo aqui, se necessário
        },
        complete: function () {
            // Após a conclusão da solicitação (seja sucesso ou erro),
            // redefina o texto do botão para "Pesquisar"
            searchButtonOng.text("Pesquisar"); // Alterado para searchButtonOng
        }
    });
}
