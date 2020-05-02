var texts = ['CREATIVOS_', 'AUDIOVISUALES_', 'CREADORES_', 'WATCHIT_'];    
$(document).ready(function () {  
  if ( document.URL.indexOf("nosotros")>-1 ) {    
    textSequence(0);
  }
  
});


function textSequence(i) {

  if (texts.length > i) {
      setTimeout(function() {
        document.getElementById("sequence-text").innerHTML = texts[i];
        if(texts[i]==texts[texts.length-1])
          {
            document.getElementById("sequence-text").setAttribute("style", "background-color: #f8ec22;");
          }
          else
          {
            document.getElementById("sequence-text").removeAttribute("style");
          }
          textSequence(++i);
      }, 1000); // 1 second (in milliseconds)

  } else if (texts.length == i) { // Loop
      textSequence(0);
  }

}