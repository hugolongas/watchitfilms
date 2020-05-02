@extends('admin.layouts.admin', ['body_class' => 'cargos index'])
@section('head')
<link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
@endsection
@section('content')
<div class="container">
        <h2>Cargos</h2>
        <div class="col-sm-2">
                <a class="btn btn-outline-info" role="button" href="{{route('admin.cargos.create')}}"><i class="fa fa-plus-alt"></i>Crear</a>
            </div>
        <table id="table-cargos" class="table table-bordered data-table">    
            <thead>    
                <tr>    
                    <th>Nº</th>    
                    <th>Cargo</th>                        
                    <th>Editar</th>
                    <th>Eliminar</th>
                </tr>    
            </thead>    
            <tbody>    
            </tbody>   
            <tfoot>    
                <tr>    
                    <th>Nº</th>    
                    <th>Cargo</th>                        
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
            var table = $('.data-table').DataTable({      
              processing: true,      
              serverSide: true,      
              ajax: "{{ route('admin.cargos.index') }}",      
              columns: [      
                  {data: 'id', name: 'id'},      
                  {data: 'cargo', name: 'cargo'},                        
                  {data: 'edit', name: 'edit', orderable: false, searchable: false},
                  {data: null, defaultContent: '<button class="btn btn-secondary" accion="eliminar">Eliminar</button>'}     
              ]
            });
            $('#table-cargos tbody').on('click', 'button', function (ev) {
                var data = table.row($(this).parents('tr')).data();
                var accion = $(this).attr("accion");
                switch (accion)
                {
                    case "eliminar":
                    {	var cargo = data['cargo'];
                        if(confirm('Seguro que quieres eliminar el cargo '+cargo)){
                            $.ajaxSetup({
                                headers:
                                { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
                            });
                            var id = data["id"];
                            var url = '{{ route("admin.cargos.delete", "id") }}';
                            url = url.replace('id', id);
                            $.ajax({
                                url: url,
                                type: 'POST',
                                success: function () {
                                    $('#table-cargos').DataTable().ajax.reload();
                                    var alert="<div id='custom-alert' class='alert alert-danger'>Cargo eliminada</div>";
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