@extends('admin.layouts.admin', ['body_class' => 'miembros crear'])
@section('content')
<div class="options-menu">
        <a href="{{ route('admin.miembros.index')}}" ><i class="fa fa-angle-left"></i> Volver</a>
    </div>
<div class="row" style="margin-top:40px">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header text-center">
				Crear Miembro
			</div>
			<div class="card-body" style="padding:30px">
				<form enctype="multipart/form-data" method="post" action="{{action('MiembroController@Store')}}">
					{{ csrf_field() }}
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label for="nombre">Nombre</label>
								<input type="text" class="form-control" id="nombre" name="nombre" value="{{ old('nombre') }}"
								  placeholder="Nombre...">
							</div>
							<div class="form-group">
								<label for="email">Email</label>
								<input type="text" class="form-control" id="email" name="email" value="{{ old('email') }}"
								  placeholder="Email...">
							</div>
							<div class="form-group">
								<label for="telefono">Teléfono</label>
								<input type="text" class="form-control" id="telefono" name="telefono" value="{{ old('telefono') }}"
								  placeholder="Teléfono...">
							</div>
							<div class="form-group">
								<label for="linkedin">LinkedIn</label>
								<input type="text" class="form-control" id="linkedin" name="linkedin" value="{{ old('linkedin') }}"
								  placeholder="LinkedIn...">
							</div>
						</div>
						<div class="col-sm-6" >
							<div class="form-group">
								<label for="avatar">Avatar</label>
								<input  name="avatar" type="file" id="avatar" onchange="readURL(this)" class="form-control" />
								<img id="img" src="{{ asset('img/logo.png') }}" alt="" style="width: 200px;"/>
								@if($errors->has('avatar'))
										<span class="error-message">Debes seleccionar una imagen</span>
									@endif
							</div>
						</div>
					</div>
					<hr/>
					<div class="row">
						<div class="col-sm-12 col-md-12 col-lg-12">
							<div class="form-group">
								<label for="categorias">Cargos:</label>                 
								<div class="row">
									@foreach ($cargos as $c)
									<div class="col-sm-4 col-md-4 col-xl-4">
										<div class="checkbox">
											<label>
												<input type="checkbox" id="cargo_{{$c->id}}" class="checkbox_cargo"
												 value="{{$c->id}}" name="cargo[]" />{{$c->cargo}}
											</label>
										</div>										
									</div>
									@endforeach
								</div>
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
