$(document).ready(function () {
    var divCible = $('#divload'),
        url = divCible.attr('data-url-liste-client');
    $.post(url, function (data) {
        divCible.html(data);
    });
});

$(document).on('click', '#nouvau-client', function () {
    var divCible = $('#divload'),
        url = divCible.attr('data-url-ajout-client');
    $.post(url, function (data) {
        divCible.html(data);
    });
});

$(document).on('click', '.bouton-profil', function () {
    let url = $(this).attr('data-url');
    var divCible = $('#divload');
    $.post(url, function (data) {
        divCible.html(data);
    });
});
