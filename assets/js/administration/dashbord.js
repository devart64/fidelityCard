$(document).ready(function () {
    //coherenceCheckbox();
    $('.image-item-tampon').click();
})

$('.zone-cliquable').on('click', function () {
    var id = $(this).attr('data-id');
    console.log(id);

    // trouver pourtquoi le cliqueq ne foncitonne pas
    $('#btn-cache-'+id).click();
});
$("#menu-toggle").click(function(e) {
    e.preventDefault();
    $("#wrapper").toggleClass("toggled");
});
$(document).on('click', '.pizza', function () {
    // envoi de l'id du tampon a checked
    let image = $('#image-tampon-selected').val();

    let idTampon = $(this).attr('data-id');

    let idCarteDeFidelite = $("#carte_id").val();
    let isCocher = "";

    if ($('#checkbox-tampon-'+idTampon).is(':checked')) {
       isCocher = 1;
        $('.image-tampon-'+idTampon).css('display', 'inline-block').attr('src', '/images/'+image);
    } else {
        isCocher = 0;
        $('.image-tampon-'+idTampon).css('display', 'none');
        image = "";
    }
    let url = $("#url-tampon").val();
    //alert(idTampon);
  $.post(url, {idTampon:idTampon, idCarteDeFidelite:idCarteDeFidelite, isCocher:isCocher, image:image});
  coherenceCheckbox();
});

function gestioncheckbox(idtampon) {

}

$(document).on('change', '.image-item-tampon', function () {
   $("#image-utilisee").attr('src', '/images/'+$(this).attr('data-image') );
   $('#image-tampon-selected').val($(this).attr('data-image'));
   $(".dropdown-menu").css('display', 'none');
})

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
 * gestion de la checkbox pizza gratuite
 * et création de la carte  suivante.
 */
$(document).on('change', '#pizza-gratuite', function () {
    if ($("#pizza-gratuite").is(':checked')) {
        $('.pizza-gratuite').fadeOut();
        // archivage de  cette carte
        // création de la nouvelle
    } else {
        $('.pizza-gratuite').fadeIn();
    }
});

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

$(document).on('click', '#dropdownMenuButton', function () {
    if ($('.dropdown-menu').is(':visible') === false) {
        $('.dropdown-menu').show();
    } else {
        $('.dropdown-menu').fadeOut();
    }
});

$('.custom-file-input').on('change', function() {
    let fileName = $(this).val().split('\\').pop();
    $(this).next('.custom-file-label').addClass("selected").html(fileName);
});

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

$('.custom-file-input').on('change',function(){
    var fileName = document.getElementById("exampleInputFile").files[0].name;
    $(this).next('.form-control-file').addClass("selected").html(fileName);
});
console.log($('.pizza:checked').length);

/**
 * funciton  de vérification des doublons de mail
 * @param mail
 */
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
// a voir si il estv possible pour deu compte d'avoir len meme numéro
}
/*$(document).on('click', '.pizza-cadre', function () {
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
});*/

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


