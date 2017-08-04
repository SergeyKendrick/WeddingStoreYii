addEventListener("load", function() { 
    setTimeout(hideURLbar, 0); 
}, false); 

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


    $(".tab ul").click(function(){
        $(".tab .single-bottom").hide();
        $(this).parent().find('div.single-bottom').slideToggle(300);
    })
    
});

$(window).load(function(){
    $( "#slider-range" ).slider({
        range: true,
        min: 0,
        max: 100000,
        values: [ 0, 100000 ],
        slide: function( event, ui ) {  
            $( "#amount" ).val( "$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] );
            
        }
    });
    
    $( "#amount" ).val( "$" + $( "#slider-range" ).slider( "values", 0 ) + " - $" + $( "#slider-range" ).slider( "values", 1 ) );

});

