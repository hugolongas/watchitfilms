@extends('admin.layouts.admin', ['body_class' => 'articulos index'])
@section('css')
<link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('content')
<div>
        <h2>Articulos</h2>
        <div class="col-sm-2">
                <a class="btn btn-outline-info" role="button" href="{{route('admin.article.create')}}"><i class="fa fa-plus-alt"></i>Crear</a>
                <a class="btn btn-outline-info" role="button" href="{{route('admin.article.reorder')}}"><i class="fa fa-plus-alt"></i>Reordenar</a>
            </div>
        <table id="article-table" class="table table-bordered data-table">    
            <thead>    
                <tr>    
                    <th>No</th>    
                    <th>Position</th>    
                    <th>Titulo</th>    
                    <th>Categoria</th>    
                    <th>Url</th>    
                    <th>Activo</th>
                    <th>Thumbnail</th>
                    <th>Descripcion</th>
                    <th width="100px">Editar</th>
                    <th width="100px">Añadir Adjuntos</th>
                    <th width="100px">Ver</th>
                    <th width="100px">Publicar</th>
                    <th width="100px">Eliminar</th>
                </tr>    
            </thead>    
            <tbody>    
            </tbody>    
        </table>    
    </div>
    @endsection
    @section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    @endsection
    @push('scripts')
    <script type="text/javascript">
        $(function () {
            var table = $('#article-table').DataTable({  
              order:[[ 1, "asc" ]],    
              processing: true,      
              serverSide: true,      
              ajax: "{{ route('admin.article.index') }}",      
              columns: [      
                  {data: 'id', name: 'id'},      
                  {data: 'position', name: 'position'},
                  {data: 'titulo', name: 'titulo'},     
                  {data: 'categoria', name: 'categoria'},
                  {data:null},    
                  {data:'activo',name:'activo'},  
                  {data: null, ordenable:false,searchable:false},
                  {data:'descripcion',name:'descripcion'},  
                  {data: 'edit', name: 'edit', orderable: false, searchable: false},      
                  {data: 'adj', name: 'adj', orderable: false, searchable: false},      
                  {data: 'view', name: 'view', orderable: false, searchable: false},      
                  {data: null, orderable: false, searchable: false}, 
                  {data: null, defaultContent: '<button class="btn btn-secondary" accion="eliminar">Eliminar</button>'}                 
              ],
			columnDefs: [
			{
				targets: [0],
				visible: false,
				searchable: false
			},
            {
                targets: [4],
				render: function(data)
				{
					var url = data['url'];
                    var slug = data['slug'];
                    return '<a href="'+slug+'" target="_blank">'+url+'</a>';
				}
            },
            {
				targets: [6],
				render: function(data)
				{
					var img = data['thumbnail'];
                    var id = data['id'];
					var src = '{{asset('storage/articles')}}/'+img;
					return '<img class="img-fluid" style="width: 100px;" src="'+src+'"></img>';
				}
			},
            
            {
				targets: [7],
				render: function(data)
				{
                    return data;
				}
			},
			{
				targets: [11],
				render: function(data){
					var activo = data['activo'];
					var id = data['id'];
					if(activo==1)
					{
						return '<button class="btn btn-danger" accion="activar">Despublicar</button>';
					}
					else
					{
						return '<button class="btn btn-success" accion="activar">Publicar</button>';
					}
				}
			}
			]              
            });
                        
            $('#article-table tbody').on('click', 'button', function (ev) {
                var data = table.row($(this).parents('tr')).data();
                var accion = $(this).attr("accion");
                switch (accion)
                {
                    case "eliminar":
                    {	
                        if(confirm('Seguro que deseas eliminar el artículo')){
                            $.ajaxSetup({
                                headers:
                                { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
                            });
                            var id = data["id"];
                            var url = '{{ route("admin.article.delete", "id") }}';
                            url = url.replace('id', id);
                            $.ajax({
                                url: url,
                                type: 'POST',
                                success: function () {
                                    $('#article-table').DataTable().ajax.reload();
                                    var alert="<div id='custom-alert' class='alert alert-danger'>Artículo eliminado</div>";
                                    $("#main").prepend(alert);
                                    setTimeout(function(){
                                        $('#custom-alert').remove();
                                    }, 5000);
                                }
                            });
                        }
                    break;
                    }                    
                    case "activar":
                    {	
			            $.ajaxSetup({
				            headers:{ 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
                        });
                        var id = data["id"];
                        var url = '{{ route("admin.article.activate", "id") }}';
                        url = url.replace('id', id);
                        $.ajax({					
                            url: url,
                            type: 'POST',
                            success: function (resp) {
                                if(resp == 1){
                                    alert="<div id='custom-alert' class='alert alert-success'>Artículo activado</div>";
                                }
                                else
                                {
                                    alert="<div id='custom-alert' class='alert alert-danger'>Artículo desactivado</div>";
                                    
                                }
                                $("#main").prepend(alert);
                                $('#article-table').DataTable().ajax.reload();
                                setTimeout(function(){$('#custom-alert').remove();}, 5000);                                
                            }
                        });
                    break;
                    }
                }
            });
        });
      
      </script>
    @endpush