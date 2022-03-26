$(document).ready(function() {

    $filterBtn = $(".filter-button");
    $filterClass = $(".filter");

    $filterBtn.click(function() {
        const value = $(this).attr("data-filter");
        
        if ($("body").hasClass("sample-packs") || $("body").hasClass("preset-banks") || $("body").hasClass("midi-packs")) 
        {
            if(value == "all") 
            {
                 $filterClass.show().velocity("transition.slideUpIn").addClass('wgt_show');
            } 
            else 
            {
                $filterClass.not('.'+value).hide().removeClass('wgt_show');
                $filterClass.filter('.'+value).velocity("transition.slideUpIn").addClass('wgt_show');
            //$filterClass.filter('.'+value).velocity("transition.slideUpIn").addClass('wgt_show');
            }
        }
        else
        {
            if(value == "all") 
            {
                $filterClass.show().velocity("transition.slideUpIn")
            } 
            else 
            {
                $filterClass.not('.'+value).hide();
                $filterClass.filter('.'+value).show().velocity("transition.slideUpIn");
            }    
        }
        
        
        if ($filterBtn.removeClass("active")) {
            $(this).removeClass("active");
        }
        $(this).addClass("active");
    });
})
