@extends('admin.layouts.admin', ['body_class' => 'clientes crear'])
@section('content')
<div class="options-menu">
        <a href="{{ route('admin.clientes.index')}}" ><i class="fa fa-angle-left"></i> Volver</a>
    </div>
<div class="row" style="margin-top:40px">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header text-center">
				Crear Cliente
			</div>
			<div class="card-body" style="padding:30px">
				<form enctype="multipart/form-data" method="post" action="{{action('ClienteController@Store')}}">
					{{ csrf_field() }}
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label for="nombre_empresa">Cliente</label>
								<input type="text" class="form-control" id="nombre_empresa" name="nombre_empresa" value="{{ old('nombre_empresa') }}"  placeholder="cliente...">
							</div>
							<div class="form-group">
								<label for="url">Enlace</label>
								<input type="text" class="form-control" id="url" name="url" value="{{ old('url') }}"  placeholder="https://....">
							</div>
						</div>
						<div class="col-sm-6" >
							<div class="form-group">
								<label for="logo">Logo</label>
								<input  name="logo" type="file" id="logo" onchange="readURL(this)" class="form-control" />
								<img id="img" src="{{ asset('img/logo.png') }}" alt="" style="width: 100px;"/>
								@if($errors->has('logo'))
										<span class="error-message">Debes seleccionar una imagen</span>
									@endif
							</div>
						</div>
					</div>					
                    <div class="form-group">								
                        <input class="btn btn-outline-primary" type="submit" value="Crear">
                    </div>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection
@push('scripts')
<script type="text/javascript">
	function readURL(input) {
		var url = input.value;
		var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
		if (input.files && input.files[0]&& (ext == "gif" || ext == "png" || ext == "jpeg" || ext == "jpg")) {
			var reader = new FileReader();

			reader.onload = function (e) {
				$('#img').attr('src', e.target.result);
			}

			reader.readAsDataURL(input.files[0]);
		}else{
			$('#img').attr('{{ asset('img/logo.png') }}');
		}
	}
</script>
@endpush
