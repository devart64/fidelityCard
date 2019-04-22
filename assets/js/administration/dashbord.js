
$('.zone-cliquable').on('click', function () {
    var id = $(this).attr('data-id');
    console.log(id);
    $('#btn-cache-'+id).click();
});
$("#menu-toggle").click(function(e) {
    e.preventDefault();
    $("#wrapper").toggleClass("toggled");
});
