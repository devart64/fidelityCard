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

/**
 * fonction de gestion de la cohérence des checkbox de la carte de fidélité
 */
function coherenceCheckbox() {
    let nbPizza = $('.pizza:checked').length;
    console.log(nbPizza);
    let pizzaRestante = 10 - nbPizza;
    if (pizzaRestante === 0) {
        $('.pizza-gratuite').fadeIn();
        $('.commentaire-pizza').css('display', 'none');
    }else {
        $('.pizza-gratuite').css('display', 'none');
        $('.commentaire-pizza').fadeIn();
    }
    $(".nbPizzaRestante").text(pizzaRestante);
    if (nbPizza === 10) {
        $("#div-pizza-gratuite").fadeIn();
    } else {
        $("#div-pizza-gratuite").fadeOut();
    }
}

/**
 * gestion du formulaire de recherche
 */
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

$(document).on('click', '#modifier-info-client', function () {
   $("#form-upadate-info").fadeIn();
});

$(document).on('click', '#annuler-modif-info-client', function () {
    $("#form-upadate-info").fadeOut();
});

// gestion de la vérification de non dupliacation
$(document).on('keyup', '#your-email', throttle(function(){
    let emailAVerifier = $(this).val();
    verifDoublonMail(emailAVerifier);
}, 1000));

function verifDoublonMail(mail) {
    let url = $("#url-verif-mail").val();
    $.post(url, {mail:mail}, function (data) {
    // si false email existe deja en base de données
        if (data == "false") {
            $("#your-email").css('border', '1px solid red');
            $("#email-exist").fadeIn();
            $('.register').attr('disabled', 'disabled');
        } else {
            $("#your-email").css('border', '');
            $("#email-exist").fadeOut();
            $('.register').removeAttr('disabled');
        }
    })
}

/**
 * fonction de vérification de non existance d"un numéro de téléphone
 * @param telephoner
 */
function verifTelphone(telephoner) {

}
$(document).on('click', '.pizza-cadre', function () {
    let image = $(".image-template");
    if ($(this).children('.image-tampon').is(':visible') === false) {
        $(this).children('.image-tampon').fadeIn();
        $(this).children('.pizza').prop('checked', true);
    }  else {
        $(this).children('.image-tampon').fadeOut();
        $(this).children('.pizza').prop('checked', false);
    }
    let nbTampon = $('.pizza:checked').length;
    let idCarteDeFidelite = $("#carte_id").val();
    let url = $("#url-tampon").val();
    $.post(url, {nbTampon:nbTampon, idCarteDeFidelite:idCarteDeFidelite});
    coherenceCheckbox();
    coherenceCheckbox();
});

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
