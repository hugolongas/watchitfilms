var isMobile = {
  Android: function() {
      return navigator.userAgent.match(/Android/i);
  },
  BlackBerry: function() {
      return navigator.userAgent.match(/BlackBerry/i);
  },
  iOS: function() {
      return navigator.userAgent.match(/iPhone|iPad|iPod/i);
  },
  Opera: function() {
      return navigator.userAgent.match(/Opera Mini/i);
  },
  Windows: function() {
      return navigator.userAgent.match(/IEMobile/i) || navigator.userAgent.match(/WPDesktop/i);
  },
  any: function() {
      return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());
  }
};
var container;
$(document).ready(function () {    
  container = $("#content");
  window.onscroll = function() {scrollFunction()};    
      
	$("#accepto_cookie").on("click",function(){
		$.cookie("accepto_cookie","true");
		location.reload();
	});
	$("#no_cookie").on("click",function(){
		$("#cookie-container").hide();
	});
});

function scrollFunction() {  
    if(container.hasClass('home'))
    {
      if(document.body.scrollTop > window.innerHeight/2 || document.documentElement.scrollTop > window.innerHeight/2)
      {
        $("#content").addClass("bhChange");
        $("#navbar").addClass("sticky");
      }
      else{    
        $("#content").removeClass("bhChange");
        $("#navbar").removeClass("sticky");    
      }
    }  
} 