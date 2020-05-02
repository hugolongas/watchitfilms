@extends('layouts.master')
@section('title',config('app.name', 'Laravel').' - '.$categoria->categoria)
@section('body_class', 'category')
@section('navbar')
@include('navbar.home')
@endsection
@section('content')
<section id="category">
    <ul id="breadcrumb">
        <li><a href="{{'/'}}">Home</a></li>
        <li><a href="{{$categoria->slug()}}">{{$categoria->categoria}}</a></li>        
    </ul>
    <div class="cat_title">
        {{$categoria->categoria}}
    </div>
    <div class="article_container">
        @foreach ($articles as $a)        
        <article id="material_{{$a->id}}" class="col-12 col-md-4 material">
            <a href="{{$a->slug()}}">
            <img class="material-image img-fluid" src="{{asset('storage/articles')}}/{{$a->thumbnail}}">
            <div class="material-informacion">
                <div class="material-titulo">
                    {{ $a->titulo }}
                </div>
                <div class="material-desc">
                    {!! str_limit($a->descripcion, $limit = 100, $end = '...') !!}
                </div>
            </div>
        </a>
        </article>        
        @endforeach
    </div>
</section>
@stop 