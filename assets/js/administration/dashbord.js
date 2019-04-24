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