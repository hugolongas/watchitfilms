@extends('admin.layouts.admin', ['body_class' => 'cargos edit'])
@section('content')
<div class="options-menu">
        <a href="{{ route('admin.cargos.index')}}" ><i class="fa fa-angle-left"></i> Volver</a>
    </div>
<div class="row" style="margin-top:40px">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header text-center">
				Actualizar Cargo
			</div>
			<div class="card-body" style="padding:30px">
				<form enctype="multipart/form-data" method="post" action="{{route('admin.cargos.update',$cargo->id) }}" >
                    {{ method_field('PUT') }}
                    {{ csrf_field() }}
					<div class="row">
						<div class="col-md-6">					
							<div class="form-group">
								<label for="cargo">Cargo</label>
								<input type="text" name="cargo" id="categoria" class="form-control" value="{{ old('cargo',$cargo->cargo) }}" />
                                @if($errors->has('cargo'))
                                <span class="error-message">Hay que indicar un cargo</span>
                                @endif
							</div>							
							<div class="form-group">								
								<input class="btn btn-outline-primary" type="submit" value="Actualizar">
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection
