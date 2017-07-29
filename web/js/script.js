
$('div.imgProductBox img').bind('click', function() {
    var img = $(this).attr('src');
    $('div.popup img').attr('src', img);
    $('.popup-box').show();
});

$('div.popup-box').on('click', function() {
   $(this).hide(); 
});