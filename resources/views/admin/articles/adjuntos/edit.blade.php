@extends('admin.layouts.admin', ['body_class' => 'articulo adjuntos'])
@section('css')
<link rel="stylesheet" type="text/css"
href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css" />
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" />
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/select/1.3.0/css/select.dataTables.min.css " />
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
 .fileList .element-content .img-delete {
    position: absolute;
	width: 50px;
	height: 50px;
	bottom: 5px;
	right: 0px;
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
<div class="row">
    <div class="col-12">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#inputFilesModal">
            Cargar Medio
        </button>
        <ul id="fileList" class="fileList">
            @foreach($adjuntos as $adjunto)            
            @if($adjunto->extension=="ytb")
            <li id="imgCont_{{$adjunto->id}}" item-id="{{$adjunto->id}}" 
            item-url="{{$adjunto->url}}" item-medioid="{{$adjunto->medio_id}}"
            item-extension="{{$adjunto->extension}}"
                class="element-content gallery-item">
                    <img src="http://i3.ytimg.com/vi/{{$adjunto->url}}/hqdefault.jpg" class="img-fluid"  />                    
                    <div id="delete_{{$adjunto->id}}" class="img-delete">
                        <img src="{{ asset('img/admin/delete.png')}}" class="img-fluid"/>
                    </div>
                </li>      
            @else
                <li id="imgCont_{{$adjunto->id}}" item-id="{{$adjunto->id}}" item-url="{{$adjunto->url}}" item-medioid="{{$adjunto->medio_id}}" item-extension="{{$adjunto->extension}}"  class="element-content gallery-item">
                    <img src="{{ asset('storage/medios/thumb/'.$adjunto->url)}}" class="img-fluid img-element" />                    
                    <div id="delete_{{$adjunto->id}}" class="img-delete">
                        <img src="{{ asset('img/admin/delete.png')}}" class="img-fluid" />
                    </div>
                </li>      
            @endif
            @endforeach
        </ul>
    </div>
</div>
<div>
    <button type="button" class="btn btn-primary" id="updateGallery">
        Actualizar Galeria
    </button>
    </div>
<div class="modal fade" id="inputFilesModal" tabindex="-1" role="dialog" aria-labelledby="inputFilesModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="inputFilesModalLabel">Cargar imagenes</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <ul class="nav nav-tabs" id="medioTabs">
                    <li class="nav-item">
                        <a id="nav-medios" class="nav-link active" data-toggle="tab" href="#medios">Medios</a>
                    </li>
                    <li class="nav-item">
                        <a id="nav-video" class="nav-link" data-toggle="tab" href="#video">Nuevo Video</a>
                    </li>
                    <li class="nav-item">
                        <a id="nav-imagen" class="nav-link" data-toggle="tab" href="#imagen">Nueva Imagen</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div id="medios" class="tab-pane fade show active">
                        <h3>Medios</h3>
                        <table class="table table-bordered" id="medios-table" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>id</th>                                        
                                        <th>Medio</th>                                        
                                    </tr>
                                </thead>
                            </table>
                    </div>
                    <div id="video" class="tab-pane fade">
                        <h3>Video</h3>
                        <div>
                            <form method="post" id="video_form">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <input type="text" name="video_url" id="video_url" />
                                    <input type="submit" name="upload" id="upload" class="btn btn-primary" value="Upload">
                                </div>
                            </form>
                        </div>
                    </div>
                    <div id="imagen" class="tab-pane fade">
                        <div class="container">
                            <h3 align="center">Upload Image in Laravel using Ajax</h3>
                            <br />
                            <div class="alert" id="message" style="display: none"></div>
                            <form method="post" id="image_form" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <table class="table">
                                        <tr>
                                            <td width="40%" align="right"><label>Select File for Upload</label></td>
                                            <td width="30"><input type="file" name="select_file[]" id="select_file" multiple="multiple"/></td>
                                            <td width="30%" align="left"><input type="submit" name="upload" id="upload" class="btn btn-primary" value="Upload"></td>
                                        </tr>
                                        <tr>
                                            <td width="40%" align="right"></td>
                                            <td width="30"><span class="text-muted">jpg, png, gif</span></td>
                                            <td width="30%" align="left"></td>
                                        </tr>
                                    </table>
                                </div>
                            </form>
                            <br />
                            <span id="uploaded_image"></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">                
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.16/datatables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js "></script>
<script type="text/javascript" src="https://cdn.datatables.net/select/1.3.0/js/dataTables.select.min.js"></script>
@endpush
@section('js')    
<script>
$(document).ready(function () {
    $( "#fileList" ).sortable({
        placeholder: "highlight",
        start: function (event, ui) {
            ui.item.toggleClass("highlight");
        },
        stop: function (event, ui) {
            ui.item.toggleClass("highlight");
        }
    });
    $( "#fileList" ).disableSelection();

    //Modal
    tableMedios = null; 
        $('#inputFilesModal').on('show.bs.modal', function (event) {
            if(tableMedios!=null)
            {
                tableMedios.destroy();
            }
            tableMedios = $('#medios-table').DataTable({                
                processing: true,
                serverSide: false,                                       
                order: [[ 1, 'asc' ]],
                ajax: '{{route('medio.data')}}',
                scrollX: true,
                columns: [
                    { data: 'id'},
                    { data: null}                    
                ],
			columnDefs: [           
            {
				targets: [1],
				render: function(data)
				{
					var url = data['url'];
                    var ext = data['extension'];
                    var src = "";
                    if(ext!="ytb")
                    {
                        src = '{{asset('storage/medios')}}/'+url;
                    }
                    else
                    {
                        src = 'http://i3.ytimg.com/vi/'+url+'/hqdefault.jpg';
                    }
					
					return '<img class="img-fluid" style="width: 170px;margin: 0px auto;display: block;" src="'+src+'"></img>';
				}
			}
			]
            });
        });

        $('#medios-table').on('click','tr',function(){
            var data = tableMedios.row(this).data();
            var totalElements = $('#fileList').children().length;
            var medio = data;
            var src = "";
            if(medio.extension=="ytb")
            {
                src="http://i3.ytimg.com/vi/"+medio.url+"/hqdefault.jpg";
            }
            else
            {
                src="{{Storage::url("medios/thumb/")}}"+medio.url;
            }            
            var elementLi = '<li id="imgCont_'+(totalElements+1)+'" item-id="0" item-url="'+medio.url+'" item-medioid="'+medio.id+'" item-extension="'+medio.extension+'" class="element-content gallery-item">'+
                        '<img src="'+src+'"  class="img-fluid img-element" />'+                        
                        '<div id="delete_'+(totalElements+1)+'" class="img-delete">'+
                            '<img src="{{ asset("img/admin/delete.png")}}" class="img-fluid" />'+
                        '</div>'+
                    '</li>';
                    $('#fileList').append(elementLi); // display success response from the PHP script
                    $('#inputFilesModal').modal('hide');
        });

    $("#updateGallery").click(function(){
        items = $(".gallery-item");
        adjuntosList  = new Array();
        if(items.length>0){

            items.each(function(position,element){
            elementID = element.getAttribute("item-id");
            elementUrl = element.getAttribute("item-url");
            elementPos = position+1;
            elementMedioId = element.getAttribute("item-medioid");
            //elemntDescription = element.querySelectorAll('.item-descripcion')[0].innerHTML;
            elemntDescription = "";
            elementExtension = element.getAttribute("item-extension");
            console.log("ELEMENT "+position);
            console.log("elementPos -> " + elementPos);
            console.log("elementID -> " + elementID);
            console.log("elementUrl -> " + elementUrl);
            console.log("elementMedioId -> " + elementMedioId);
            console.log("elemntDescription -> " + elemntDescription);            
            console.log("elementExtension -> " + elementExtension);            
            console.log("\n\r");
            var adjunto = {
                id: elementID,
                medio_id: elementMedioId,
                url: elementUrl,
                description: elemntDescription,
                position: elementPos,
                extension: elementExtension
            };
            adjuntosList.push(adjunto);               
        });        
        
        $.ajaxSetup({
            headers:{ 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
            });
        $.ajax({
            url:"{{route('admin.adjuntos.update',$id) }}",
            method:"POST",
            data: {id:{{$id}}, adjuntos:adjuntosList},
            dataType:'JSON',
            success:function(data)
            {
                var route = '{{route('admin.article.index')}}';
                window.location.replace(route);
            }
        })
        }
    });     

    $('#image_form').on('submit', function(event){
        event.preventDefault();
        $.ajax({
            url:"{{ route('medio.uploadImage') }}",
            method:"POST",
            data:new FormData(this),
            dataType:'JSON',
            contentType: false,
            cache: false,
            processData: false,
            success:function(data)
            {
                var totalElements = $('#fileList').children().length;
                var medios = data;                
                for(var i = 0; i < medios.length; i++)
                {
                    medio = medios[i];
                    var elementLi = '<li id="imgCont_'+(totalElements+i+1)+'" item-id="0" item-url="'+medio.url+'" item-medioid="'+medio.id+'" item-extension="'+medio.extension+'" class="element-content gallery-item">'+
                        '<img src="{{Storage::url("medios/thumb/")}}'+medio.url+'" class="img-fluid img-element" />'+                        
                        '<div id="delete_'+(totalElements+1)+'" class="img-delete">'+
                            '<img src="{{ asset("img/admin/delete.png")}}" class="img-fluid" />'+
                        '</div>'+
                    '</li>';
                    $('#fileList').append(elementLi); // display success response from the PHP script
                    $('#inputFilesModal').modal('hide');
                }
            }
        })
    });

    $('#video_form').on('submit', function(event){
        event.preventDefault();
        $.ajax({
            url:"{{ route('medio.uploadVideo') }}",
            method:"POST",
            data:new FormData(this),
            dataType:'JSON',
            contentType: false,
            cache: false,
            processData: false,
            success:function(data)
            {
                var totalElements = $('#fileList').children().length;
                var medio = data;                                
                    var elementLi = '<li id="imgCont_'+(totalElements+1)+'" item-id="0" item-url="'+medio.url+'" item-medioid="'+medio.id+'" item-extension="'+medio.extension+'" class="element-content gallery-item">'+
                        '<img src="http://i3.ytimg.com/vi/'+medio.url+'/hqdefault.jpg" class="img-fluid img-element" />'+                        
                        '<div id="delete_'+(totalElements+1)+'" class="img-delete">'+
                            '<img src="{{ asset("img/admin/delete.png")}}" class="img-fluid" />'+
                        '</div>'+
                    '</li>';
                    $('#fileList').append(elementLi); // display success response from the PHP script
                    $('#inputFilesModal').modal('hide');
                
            }
        })
    });

    $('#inputFilesModal').on('hidden.bs.modal', function (e) {
        $('#image_form').trigger("reset");
        $('#video_form').trigger("reset");
        $('#medioTabs li:first-child a').tab('show');
        $(".nav-tabs .nav-link").removeClass("active");
        $('#nav-medios').addClass("active");
    });

    $("#fileList").on("click",".img-delete",function(){
        var elemID = $(this)[0].id.replace("delete_","");                
        $('#fileList').find("#imgCont_"+elemID).remove();
        
    });
});
</script>
@stop