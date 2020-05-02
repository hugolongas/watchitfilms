@extends('admin.layouts.admin', ['body_class' => 'articulo adjuntos'])
@section('css')
<link rel="stylesheet" type="text/css"
href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css" />
<meta name="csrf-token" content="{{ csrf_token() }}">
<style>
.fileList{
    width: 100%;
    min-height: 50px;
	border: 1px solid black;
	border-radius: 5px;
	list-style-type: none;
	margin: 0;
	padding: 10px;
	overflow: hidden;
	margin-top: 10px;
	margin-bottom: 10px;
 }
 .fileList li{
    float: left;
	margin: 2px;
	padding: 2px;
	width: 250px;
	height: 250px;
 }
 .fileList .element-content{
    position:relative;		
	background-color: #E3E3E3;								
	cursor: pointer;
	border: 1px solid gray;	
 }
.fileList .highlight{
    border:1px solid red;
    font-weight:bold;
    font-size:45px;
    background-color:lightblue;
    position:relative;

}
</style>
@stop

@section('content')
<div class="options-menu">
    <a href="{{ route('admin.article.index')}}" ><i class="fa fa-angle-left"></i> Volver</a>
</div>
<div class='row' style='margin-top:40px'>
    <div class='col-md-12'>
        <h2>Reordenar Articulos (Solamente activos)</h2>        
    </div>
        <div style='padding:30px'>
            <div class='row'>
                <div class='col-12'>
                    <ul id='fileList' class='fileList'>
                        @foreach($articulos as $a)
                        <li id="art_{{$a->id}}" item-id="{{$a->id}}" class="element-content article-item">
                            <div>{{$a->titulo}}</div>
                            <img src="{{ asset('storage/articles/'.$a->thumbnail)}}" class="img-fluid img-element" />
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div>
                <button type="button" class="btn btn-primary" id="reorder-articles">
                    Reordenar artículo
                </button>
            </div>
        </div>
@endsection

@push('scripts')
@endpush
@section('js')    
<script>
$(document).ready(function () {
    pos=0;
    advise = false;
    $( "#fileList" ).sortable({
        placeholder: "highlight",
        start: function (event, ui) {            
            ui.item.toggleClass("highlight");
            pos = ui.item.index();
        },
        stop: function (event, ui) {
            ui.item.toggleClass("highlight");        
            if(pos!=ui.item.index() && !advise)
            {
                var alert="<div id='custom-alert' class='alert alert-danger'>Se ha modificado el orden de los elementos. Recuerda guardar los cambios antes de salir</div>";
                $("#main").prepend(alert);
                advise = true;
            }
        }
    });
    $( "#fileList" ).disableSelection();

    //Modal
    $("#reorder-articles").click(function(){
        items = $(".article-item");
        articlesList  = new Array();
        if(items.length>0){
            items.each(function(position,element){
                itemID = element.getAttribute("item-id");
                itemPos = position+1;
                console.log("ELEMENT "+position);
                console.log("elementPos -> " + itemPos);
                console.log("elementID -> " + itemID);
                console.log("\n\r");
                var article = {
                    id: itemID,
                    position:itemPos
                };
                articlesList.push(article);
            });
            $.ajaxSetup({
                headers:{ 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
            });
            $.ajax({
                url:"{{route('admin.article.saveReorder') }}",
                method:"POST",
                data: {articles:articlesList},
                dataType:'JSON',
                success:function(data)
                {
                    var route = '{{route('admin.article.index')}}';
                    window.location.replace(route);
                }
            })
        }
    });
});
</script>
@stop