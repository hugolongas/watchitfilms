@extends('admin.layouts.admin', ['body_class' => 'miembros index'])
@section('head')
<link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
@endsection
@section('content')
<div class="container">
        <h2>Miembros</h2>
        <div class="col-sm-2">
                <a class="btn btn-outline-info" role="button" href="{{route('admin.miembros.create')}}"><i class="fa fa-plus-alt"></i>Crear</a>
            </div>
        <table id="table-miembros" class="table table-bordered data-table">    
            <thead>    
                <tr>    
                    <th>Nº</th>    
                    <th>Nombre</th>                        
                    <th>Email</th>                        
                    <th>Telefono</th>
                    <th>Cargos</th>
                    <th>LinkedIn</th>
                    <th>Avatar</th>
                    <th>Editar</th>
                    <th>Eliminar</th>
                </tr>    
            </thead>    
            <tbody>    
            </tbody>
            <tfoot>    
                <tr>
                    <th>Nº</th>    
                    <th>Nombre</th>                        
                    <th>Email</th>                        
                    <th>Telefono</th>
                    <th>Cargos</th>
                    <th>LinkedIn</th>
                    <th>Avatar</th>
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
            var table = $('#table-miembros').DataTable({      
              processing: true,      
              serverSide: true,      
              ajax: "{{ route('admin.miembros.index') }}",      
              columns: [      
                  {data: 'id', name: 'id'},      
                  {data: 'nombre', name: 'nombre'},
                  {data: 'email', name: 'email'},
                  {data: 'telefono', name: 'telefono'},
                  {data: 'cargos', name:'cargos'},
                  {data: 'linkedin', name:'linkedin'},
                  {data: null},
                  {data: 'edit', name: 'edit', orderable: false, searchable: false},
                  {data: null, defaultContent: '<button class="btn btn-secondary" accion="eliminar">Eliminar</button>'}  
              ],
              columnDefs: [                                                 
                    {
                        targets: [6],
                        render: function(data)
                        {
                            var img = data['avatar'];
                            var src = '{{asset('storage/avatar')}}/'+img;
                            return '<img class="img-fluid" style="width: 100px;" src="'+src+'"></img>';
                        }
                    }
                ]
            });
                        
            $('#table-miembros tbody').on('click', 'button', function (ev) {
                var data = table.row($(this).parents('tr')).data();
                var accion = $(this).attr("accion");
                switch (accion)
                {
                    case "eliminar":
                    {	var Nombre = data['nombre'];
                        if(confirm('Seguro que quieres eliminar a '+Nombre)){
                            $.ajaxSetup({
                                headers:
                                { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
                            });
                            var id = data["id"];
                            var url = '{{ route("admin.miembros.delete", "id") }}';
                            url = url.replace('id', id);
                            $.ajax({
                                url: url,
                                type: 'POST',
                                success: function () {
                                    $('#table-miembros').DataTable().ajax.reload();
                                    var alert="<div id='custom-alert' class='alert alert-danger'>Miembro eliminado</div>";
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