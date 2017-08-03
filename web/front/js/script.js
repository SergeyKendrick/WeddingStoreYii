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
    $(".tab1 .single-bottom").hide();
    $(".tab2 .single-bottom").hide();
    $(".tab3 .single-bottom").hide();
    $(".tab4 .single-bottom").hide();
    $(".tab5 .single-bottom").hide();

    $(".tab1 ul").click(function(){
        $(".tab1 .single-bottom").slideToggle(300);
        $(".tab2 .single-bottom").hide();
        $(".tab3 .single-bottom").hide();
        $(".tab4 .single-bottom").hide();
        $(".tab5 .single-bottom").hide();
    })
    $(".tab2 ul").click(function(){
        $(".tab2 .single-bottom").slideToggle(300);
        $(".tab1 .single-bottom").hide();
        $(".tab3 .single-bottom").hide();
        $(".tab4 .single-bottom").hide();
        $(".tab5 .single-bottom").hide();
    })
    $(".tab3 ul").click(function(){
        $(".tab3 .single-bottom").slideToggle(300);
        $(".tab4 .single-bottom").hide();
        $(".tab5 .single-bottom").hide();
        $(".tab2 .single-bottom").hide();
        $(".tab1 .single-bottom").hide();
    })
    $(".tab4 ul").click(function(){
        $(".tab4 .single-bottom").slideToggle(300);
        $(".tab5 .single-bottom").hide();
        $(".tab3 .single-bottom").hide();
        $(".tab2 .single-bottom").hide();
        $(".tab1 .single-bottom").hide();
    })	
    $(".tab5 ul").click(function(){
        $(".tab5 .single-bottom").slideToggle(300);
        $(".tab4 .single-bottom").hide();
        $(".tab3 .single-bottom").hide();
        $(".tab2 .single-bottom").hide();
        $(".tab1 .single-bottom").hide();
    })	
});

