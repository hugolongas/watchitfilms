@extends('layouts.master')
@section('title',config('app.name', 'Laravel'))
@section('body_class', 'home')
@section('navbar')
@include('navbar.home')
@endsection
@section('content')
<section id="cover" class="sceneElement" data-viewport="0">
    <div id="cover-container">        
        <div id="cover-center">            
            <img src="{{asset('storage/general/background.gif')}}" class="img-fluid cover-img">
            <div class="cover-text">
                    <p>
                    Precisamente lo que imagine para tu marca,<br>
                    podria serlo, incluso aún más.
                    </p>
                </div>                
        </div>
        <a href="#projects" class="arrow-down">
        <i class="fas fa-arrow-down"></i>
        </a>
    </div>
</section>
<section id="projects" class="section">
    <div class="project-menu">
        <ul>
            <li class="project-type active" id="material">Todos</li>
            @foreach ($categorias as $c)                 
            @if($c->articles()->count()>0)
            <li class="project-type" id="{{ $c->categoria }}">{{ $c->categoria }}</li>
            @endif
            @endforeach
        </ul>
    </div>
    <div class="project-container">
        @foreach ($articles as $a)
        <article id="material_{{$a->id}}" class="col-12 col-md-4 material {{$a->categoria->categoria}}">
            <img class="material-image img-fluid" src="{{asset('storage/articles')}}/{{$a->id}}/{{$a->thumbnail}}">
            <div class="material-informacion">
                <div class="material-titulo">
                    {{ $a->titulo }}
                </div>
                <div class="material-desc">
                        {!! str_limit($a->descripcion, $limit = 100, $end = '...') !!}
                    
                </div>
            </div>
        </article>
        @endforeach
    </div>
</section>
<section id="clients" class="section">
    <div id="client-container">
        <div id="client-text" class="col-12 col-md-5">
            <h3>Marcas watchit con las que hemos trabajado my a gustito</h3>
            <p>Tu eliges... Podemos tener un apasionado e intenso romance esporádico o puntual o labrarnos una relación de confianza plena, amor por los detalles y crecimiento mutuo.</p>
        </div>
        <div id="client-brands" class="col-12 col-md-7">
            <div id="brands-container">
                @foreach ($clientes as $c)
                <a href="{{$c->url}}" target="_blank" class="client-item">
                    <img src="{{asset('storage/clientes')}}/{{$c->logo}}" class="img-fluid">
                </a>                
                @endforeach
            </div>
        </div>
        
<script>
        $(document).ready(function () {                
        $clientGallery = $("#brands-container");        
        $clientGallery.slick({
            cssEase:'linear',
            slidesToShow: 4,
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 5000,
            prevArrow:'',
            nextArrow:'',
            centerMode: true,
            variableWidth: true,
            infinite: true,
            responsive: [
            {
                breakpoint: 720,
                settings: {
                    slidesToShow: 4,
                    slidesToScroll: 4
                }
            },
            {
                breakpoint: 576,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 3
                }
            },
            {
                breakpoint: 350,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2
                }
            }
            ]
        });
        });
        </script>
    </div>
</section>
<section id="footer" class="section">
    <div class="footer-text">
        Precisamente lo que imagine para tu marca, podría serlo, incluso más.
    </div>
    <div class="footer-rrss">
        <a class="rrss-items" href="https://www.youtube.com/channel/UCqoYKhGeL-YNxHZD_rs43ZA" target="_blank"><img src="{{asset('img/yt_blue.svg')}}" alt="youtube"/></a>
        <a class="rrss-items" href="https://www.facebook.com/watchitfilms" target="_blank"><img src="{{asset('img/fb_blue.svg')}}" alt="youtube"/></a>
        <a class="rrss-items" href="https://www.instagram.com/watchitfilms/" target="_blank"><img src="{{asset('img/insta_blue.svg')}}" alt="youtube"/></a>
    </div>
</section>

<div id="material_visu" class="visualizador">
    <div class="header"><span id="material_visu_close">&times;</span>
    </div>
    <div id="material_visu_container">        
    </div>
</div>
@stop 