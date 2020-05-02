<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
  <meta name="_token" content="{{ csrf_token() }}">
  @yield('meta')
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
  <link href="https://fonts.googleapis.com/css?family=PT+Mono&display=swap" rel="stylesheet"> 
  <link rel="stylesheet" type="text/css" href="/css/slick.css"/>
  <link rel="stylesheet" type="text/css" href="/css/slick-theme.css"/>
  <link rel="stylesheet" href="/css/main.css">
  <link rel="stylesheet" href="/css/home.css">
  <link rel="stylesheet" href="/css/contact.css">
  <link rel="stylesheet" href="/css/weare.css">
  <link rel="stylesheet" href="/css/article.css">
  <link rel="stylesheet" href="/css/category.css">
  <link rel="stylesheet" href="/css/visualizador.css">

  <!--ICONS -->
  <link rel="apple-touch-icon" sizes="57x57" href="/apple-icon-57x57.png">
  <link rel="apple-touch-icon" sizes="60x60" href="/apple-icon-60x60.png">
  <link rel="apple-touch-icon" sizes="72x72" href="/apple-icon-72x72.png">
  <link rel="apple-touch-icon" sizes="76x76" href="/apple-icon-76x76.png">
  <link rel="apple-touch-icon" sizes="114x114" href="/apple-icon-114x114.png">
  <link rel="apple-touch-icon" sizes="120x120" href="/apple-icon-120x120.png">
  <link rel="apple-touch-icon" sizes="144x144" href="/apple-icon-144x144.png">
  <link rel="apple-touch-icon" sizes="152x152" href="/apple-icon-152x152.png">
  <link rel="apple-touch-icon" sizes="180x180" href="/apple-icon-180x180.png">
  <link rel="icon" type="image/png" sizes="192x192"  href="/android-icon-192x192.png">
  <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="96x96" href="/favicon-96x96.png">
  <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
  <link rel="manifest" href="/manifest.json">
  <meta name="msapplication-TileColor" content="#ffffff">
  <meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
  <meta name="theme-color" content="#ffffff">

  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.js"></script>
  <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
  <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
  <script src="/js/main.js"></script>
  <script src="/js/contact.js"></script>
  <script src="/js/home.js"></script>
  <script src="/js/weare.js"></script>
  <script src="/js/jquery.smoothState.js"></script>
  <script src="/js/smoothInit.js"></script>  
  <script type="text/javascript" src="js/jquery.cookies.js"></script>
  <script src="/js/slick.js"></script>
  <title>@yield('title')</title>
  <?php if (isset($_COOKIE["accepto_cookie"])){ ?>
  <!-- Google Analytics -->
<script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
    
    ga('create', 'UA-112825959-1', 'auto');
    ga('send', 'pageview');
    </script>
    <!-- End Google Analytics -->
    <?php   }?>
</head>
<body>  
<main id="main" class="warpper">
  <div id="content" class="@yield('body_class',"")">
    @yield('navbar')
    @yield('content')
  </div>
</main> 
<?php if (!isset($_COOKIE["accepto_cookie"])){ ?>
  <div id="cookie-container" class="row">
    <div class="cookie col-sm-9 col-md-7">
                 Utilizamos cookies propias y de terceros para obtener datos estadísticos de la navegación de nuestros usuarios y mejorar nuestros servicios. Si acepta, consideramos que acepta su uso. Puede cambiar la configuración u obtener más información <a class="politica_cookies" href="{{route('politica-cookie')}}" target="_blank">aquí</a>.
             </div>
             <div class="cookie-buttons col-sm-3 col-md-5">
                 <button id="accepto_cookie" class="btn btn-outline-dark">Acceptar Cookies</button>
                 <button id="no_cookie" class="btn btn-outline-dark">Denegar Cookies</button>
             </div>
         </div>
     <?php   }?>
</body>
</html>