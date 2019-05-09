$(document).ready(function () {
    coherenceCheckbox();
})
$('.zone-cliquable').on('click', function () {
    var id = $(this).attr('data-id');
    console.log(id);
    $('#btn-cache-'+id).click();
});
$("#menu-toggle").click(function(e) {
    e.preventDefault();
    $("#wrapper").toggleClass("toggled");
});
$(document).on('change', '.pizza', function () {
    let nbTampon = $('.pizza:checked').length;
    let idCarteDeFidelite = $("#carte_id").val();
    let url = $("#url-tampon").val();
    $.post(url, {nbTampon:nbTampon, idCarteDeFidelite:idCarteDeFidelite});
  coherenceCheckbox();
});
function coherenceCheckbox() {
    let nbPizza = $('.pizza:checked').length;
    let pizzaRestante = 10 - nbPizza;
    if (pizzaRestante === 0) {
        $('.pizza-gratuite').fadeIn();
        $('.commentaire-pizza').css('display', 'none');
    }else {
        $('.pizza-gratuite').css('display', 'none');
        $('.commentaire-pizza').fadeIn();
    }
    $(".nbPizzaRestante").text(pizzaRestante);
}

$(document).on('keyup', '#input-recherche', throttle(function () {
    console.log($(this).val());
    var texteArechercher = $(this).val();
    if (texteArechercher !== "") {
        let url = $(this).attr('data-url');
        $.post(url, {texteArechercher:texteArechercher}, function (data) {
            $('.clients-list').css('display', 'none');
            $('.liste-client-loader').css('display', 'block');
            $('.liste-client-loader').html(data);
        });
    } else {
        $('.liste-client-loader').css('display', 'none');
        $('.clients-list').css('display', 'block');
    }

}));

//Méthode utilitaire permettant de retarder l'execution d'un évènement
function throttle(f, delay) {
    var timer = null;
    return function () {
        var context = this, args = arguments;
        clearTimeout(timer);
        timer = window.setTimeout(function () {
                f.apply(context, args);
            },
            delay || 500);
    };
}
