@extends('layouts.master')
@section('title',config('app.name', 'Laravel').' - Sobre Nosotros')
@section('body_class', 'weare')
@section('css')
@endsection
@section('navbar')
@include('navbar.weare')
@endsection
@section('content')
<section id="weare" class="sceneElement" data-viewport="-1">
    <div class="row">
        <div class="col-12 col-md-6">
            <div class="weare-text">
                <h2>SOMOS <span id="sequence-text">CREATIVOS_</span></h2>
                <span id="weare-info">
                    <p>
                        Creamos contenido estratégico y creativo para marcas valientes. La vida nos juntó en este proyecto que llamamos WATCHIT FILMS.
                        Nos juntamos con la idea de crear una productora donde poder ofrecer un servicio a aquellas marcas que piensen como nosotros.
                    </p>
                    <p>
                        Nos encanta el cine y la ficción es lo nuestro. Por eso creamos este proyecto, para poder colaborar con personas como nosotros.
                    </p>
                    <p>
                        Como productora audiovisual te queremos preguntar: ¿cómo consigues llegar a tus clientes y que tu marca se vea y se entienda?
                    </p> 
                </span>
            </div>            
        </div>
        <div class="col-12 col-md-6">
           <div class="row">
               @foreach ($miembros as $m)
               <div id="member_{{$m->id}}" class="member col-12 col-md-6">
                <a href="{{$m->linkedin}}" data-target="0" class="linkedin-url" target="_blank">
                    <img class="img-fluid" src="{{ asset('img/linkedin.png') }}" alt="linkedin"/>
                </a>
                <div class="img-container">                                        
                    <img class="img-fluid img-member" src="{{asset('storage/avatar')}}/{{$m->avatar}}" />
                </div>
                    <div class="member-info">
                        <span class="member-name">{{$m->nombre}}</span>
                        @if($m->cargos()->count()>0)
                        <span class="member-position">{{$m->cargos()->first()->cargo}}</span>
                        @endif
                    </div>
                </div>                   
               @endforeach               
           </div>
        </div>
    </div>
</section>
@endsection

@section('js')
@stop 