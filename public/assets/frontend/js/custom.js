(function($){
    if (parseInt($(window).width()) < 700) {
        $("#news-scroll").mCustomScrollbar({
            axis:"x", // horizontal scrollbar s
             setLeft:"0px"
        });
    }else {
        $("#news-scroll").mCustomScrollbar({
            axis:"y", // horizontal scrollbar s
             setTop:"10px"
        });
        
    };
    
})(jQuery);

// Hide arrow
var pageArrows=$;
    pageArrows(window).scroll(function(){
        if(pageArrows(window).scrollTop() >=800){
            pageArrows('.prev-arrow').hide();
            pageArrows('.next-arrow').hide();
        } else {
            pageArrows('.prev-arrow').show();
            pageArrows('.next-arrow').show();
        }
    });

