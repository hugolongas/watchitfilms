$(document).ready(function () {
    $('#main').on('click','.arrow-down',function () {
        var hashindex = $(this).attr("href").indexOf('#');
        var hreflen = $(this).attr("href").length;
        var anchortag = $(this).attr("href").substr(hashindex, hreflen);
        $('html, #wapper').animate({
            scrollTop: $(anchortag).offset().top-20
        }, 700);
        return false;
    });

    $('#main').on('click','.project-type',function(){
        event.preventDefault();
        $(".material").hide(300);
        id = $(this)[0].id;
        $("."+id).show(300);
        $(".project-type").removeClass("active");
        $(this).addClass("active");
    });

    $('#main').on('mouseenter',".material-image",function () {
        if ($(window).width() > 500) {
            $(this).next().show();
        }
    });

    $('#main').on('mouseleave',".material-informacion",function () {
        if ($(window).width() > 500)
            $(this).hide();
    });

    $('#main').on('click',".material",function () {
        if(!$('body').hasClass('no-scroll'))   {
            id = $(this)[0].id.replace("material_", "");
            $("body").addClass('no-scroll');
            $(".home #projects .project-menu ul").addClass('no-scroll');
            $("#material_visu").show();
			$.ajax({
				url: '/modal/'+id,				
				type: 'get',
				success: function (response) {                    
                    $("#material_visu_container").append(response);                    
                    $("#material_visu").show();
				}
			});
        }
    });

    $('#main').on('click',"#material_visu_close",function () {                        
        $("#material_visu").hide();
        $("#material_visu_container").empty();
        $("body").removeClass('no-scroll');
        $(".home #projects .project-menu ul").removeClass('no-scroll');
});
});