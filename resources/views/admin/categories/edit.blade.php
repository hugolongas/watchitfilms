@extends('admin.layouts.admin', ['body_class' => 'categorias crear'])
@section('content')
<div class="options-menu">
        <a href="{{ route('admin.categories.index')}}" ><i class="fa fa-angle-left"></i> Volver</a>
    </div>
<div class="row" style="margin-top:40px">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header text-center">
				Actualizar Categoria
			</div>
			<div class="card-body" style="padding:30px">
				<form enctype="multipart/form-data" method="post" action="{{route('admin.categories.update',$categoria->id) }}" >
                    {{ method_field('PUT') }}
                    {{ csrf_field() }}
					<div class="row">
						<div class="col-md-6">					
							<div class="form-group">
								<label for="categoria">Categoria</label>
								<input type="text" name="categoria" id="categoria" class="form-control" value="{{ old('categoria',$categoria->categoria) }}" />
                                @if($errors->has('categoria'))
                                <span class="error-message">Hay que indicar una categoria</span>
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
