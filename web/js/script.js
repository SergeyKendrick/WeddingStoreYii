
$('div.imgProductBox img').bind('click', function() {
    var img = $(this).attr('src');
    $('div.popup img').attr('src', img);
    $('.popup-box').show();
});

$('div.popup-box').on('click', function() {
   $(this).hide(); 
});

$('ul.nav li:first-child').on('click', function() {
    $('p.category').show();
    $('p.global-category').hide();
});

$('ul.nav li:nth-child(2)').on('click', function() {
    $('p.category').hide();
    $('p.global-category').show();
});

$(document).ready(function() {
    var ckeditor1 = CKEDITOR.replace('article-content');
    AjexFileManager.init({
        returnTo: 'ckeditor',
        editor: ckeditor1,
    }); 
});

