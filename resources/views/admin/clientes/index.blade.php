@extends('admin.layouts.admin', ['body_class' => 'clientes index'])
@section('head')
<link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
@endsection
@section('content')
<div class="container">
        <h2>Categorias</h2>
        <div class="col-sm-2">
                <a class="btn btn-outline-info" role="button" href="{{route('admin.clientes.create')}}"><i class="fa fa-plus-alt"></i>Crear</a>
            </div>
        <table id="table-clientes" class="table table-bordered data-table">    
            <thead>    
                <tr>    
                    <th>Nº</th>    
                    <th>Cliente</th>                        
                    <th>Enlace</th>                        
                    <th>Logo</th>                        
                    <th>Editar</th>
                    <th>Eliminar</th>
                </tr>    
            </thead>    
            <tbody>    
            </tbody>
            <tfoot>    
                <tr>    
                    <th>Nº</th>    
                    <th>Cliente</th>                        
                    <th>Enlace</th>                        
                    <th>Logo</th>                        
                    <th>Editar</th>
                    <th>Eliminar</th>
                </tr>    
            </tfoot>    
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
            var table = $('#table-clientes').DataTable({      
              processing: true,      
              serverSide: true,      
              ajax: "{{ route('admin.clientes.index') }}",      
              columns: [      
                  {data: 'id', name: 'id'},      
                  {data: 'nombre_empresa', name: 'nombre_empresa'},
                  {data: 'url', name:'url'},
                  {data: null},
                  {data: 'edit', name: 'edit', orderable: false, searchable: false},
                  {data: null, defaultContent: '<button class="btn btn-secondary" accion="eliminar">Eliminar</button>'}  
              ],
              columnDefs: [                  
                    {
                        targets: [2],
                        render: function(data)
                        {
                            var url = data;
                            return '<a href="'+url+'" target="_blank">'+url+'</a>';
                        }
                    },
                    {
                        targets: [3],
                        render: function(data)
                        {
                            var img = data['logo'];
                            var src = '{{asset('storage/clientes')}}/'+img;
                            return '<img class="img-fluid" style="width: 100px;" src="'+src+'"></img>';
                        }
                    }
                ]
            });
                        
            $('#table-clientes tbody').on('click', 'button', function (ev) {
                var data = table.row($(this).parents('tr')).data();
                var accion = $(this).attr("accion");
                switch (accion)
                {
                    case "eliminar":
                    {	var cliente = data['nombre_empresa'];
                        if(confirm('Seguro que quieres eliminar al cliente '+cliente)){
                            $.ajaxSetup({
                                headers:
                                { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
                            });
                            var id = data["id"];
                            var url = '{{ route("admin.clientes.delete", "id") }}';
                            url = url.replace('id', id);
                            $.ajax({
                                url: url,
                                type: 'POST',
                                success: function () {
                                    $('#table-clientes').DataTable().ajax.reload();
                                    var alert="<div id='custom-alert' class='alert alert-danger'>Cliente eliminado</div>";
                                    $("#main").prepend(alert);
                                    setTimeout(function(){
                                        $('#custom-alert').remove();
                                    }, 5000);
                                }
                            });
                        }
                    break;
                    }
                }
            });
        });      
      </script>
    @endpush