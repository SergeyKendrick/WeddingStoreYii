addEventListener("load", function() { 
    setTimeout(hideURLbar, 0); 
}, false); 

$('.form-discount').css('display', 'none');

function hideURLbar() { 
    window.scrollTo(0,1); 
}

$(document).ready(function(){
    $(".memenu").memenu();
});


$(window).load(function() {			
    $("#flexiselDemo1").flexisel({
        visibleItems: 4,
        animationSpeed: 1000,
        autoPlay: true,
        autoPlaySpeed: 3000,    		
        pauseOnHover:true,
        enableResponsiveBreakpoints: true,
        responsiveBreakpoints: { 
            portrait: { 
                changePoint:480,
                visibleItems: 1
            }, 
            landscape: { 
                changePoint:640,
                visibleItems: 2
            },
            tablet: { 
                changePoint:768,
                visibleItems: 3
            }
        }
    });
});

$(window).load(function() {
  $('.flexslider').flexslider({
    animation: "slide",
    controlNav: "thumbnails"
  });
});

$(document).ready(function(){
    $(".tab .single-bottom").hide();
    $("#select-box").hide();

    $(".tab ul").click(function(){
        $(".tab .single-bottom").hide();
        $(this).parent().find('div.single-bottom').slideToggle(300);
    })
    
});

$(window).load(function(){
    if($.cookie("priceSlider")) {
        $("#select-box").show();
        $("#select-box span#value").text($.cookie("priceSlider"));
    }
    $( "#slider-range" ).slider({
        range: true,
        min: 0,
        max: 100000,
        values: [ 0, 100000 ],
        slide: function( event, ui ) {  
            $( "#amount" ).val( "$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] );
            var value = "$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ];
            $.cookie("priceSlider", value);
        }
        
    });
    $( "#amount" ).val( "$" + $( "#slider-range" ).slider( "values", 0 ) + " - $" + $( "#slider-range" ).slider( "values", 1 ) );

});

$('.fa-star').hover(function() {
    $(this).parent().prevAll().addClass('star-active'); 
}, function() {
    $(this).parent().prevAll().removeClass('star-active'); 
});

$(function () { 
    $('memenu skyblue a').each(function () {
        var location = window.location.href;
        var link = this.href; 
        if(location == link) {
            $(this).addClass('active');
        }
    });
});

$('button.submit-form').click(function() {
   if($('#pass').val() != $('#retypePass').val()) {
       
       setTimeout(passValid(), 3000);
       
       return false;
   } 
    
});

function passValid() {
    $('.field-pass .help-block-error, .field-pass .help-block-error, .field-retype-pass .help-block-error, .field-retype-pass .help-block-error' ).text('Введенные пароли не совпадают.');
   $('.help-block-error').css('color', 'red');
   $(".registration_left:first-child input[type='password']").css('border-color', 'red');
}

$('#getDiscount').click(function() {
   $('.form-discount').show('fast'); 
});

$(document).ready(function() {
    if($.cookie("checkboxCookie") == null) return;
    var chMap = $.cookie("checkboxCookie").split(',');
    for (var i in chMap) {
        $('#'+chMap[i]).prop("checked", true);
    }
    
});

$("input:checkbox").change(function() {
    var ch = [];
    $("input:checkbox").each(function() {
        var $el = $(this);
        if($el.prop("checked")) {
            ch.push($el.attr("id"));
        }
    });
    
    $.cookie("checkboxCookie", ch.join(','));
});

