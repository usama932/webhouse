$(document).ready(function(){
    $('#nav-bar').click(function(){
        $('.nav-div').css('top','0px')
    })
    $('#btn-close').click(function(){
        $('.nav-div').css('top','-5000px')
    })


    $('.btn-work-tab').click(function(){
        $('.work-tab-active').removeClass('work-tab-active')
        $(this).addClass('work-tab-active')
        var filter= $(this).attr('work-filter')
        if(filter=='all'){
            $('.col-md-4').show(400)
        }
        else{
         $('.col-md-4').not('.'+filter).hide(200);
          $('.col-md-4').filter('.'+filter).show(400);
        }
    })
    $('.btn-work-tab-p').click(function(){
        $('.work-tab-active').removeClass('work-tab-active')
        $(this).addClass('work-tab-active')
   
    })
});




     

