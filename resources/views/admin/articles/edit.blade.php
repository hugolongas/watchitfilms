@extends('admin.layouts.admin', ['body_class' => 'socis create'])
@section('css')
@stop

@section('content')
<div class="options-menu">
    <a href="{{ route('admin.article.index')}}"><i class="fa fa-angle-left"></i> Volver</a>
</div>
<div class=" row " style="margin-top:40px ">
    <div class="col-md-12 ">
        <h2>Editar Articulo</h2>
        <div style="padding:30px ">
            <form enctype="multipart/form-data" action="{{route('admin.article.update',$article->id) }}" method="post">
                {{ method_field('PUT') }}
                {{ csrf_field() }}
                <div class="row ">
                    <div class="col-12">
                        Datos del articulo
                        <div class="row">
                            <div class="col-9">
                                <div class="form-row">
                                    <div class="form-group col-12">
                                        <label for="titulo">Titulo:</label>
                                        <input type="text" name="titulo" id="titulo" class="form-control" tabindex="1"
                                            value="{{ old('titulo',$article->titulo) }}" />
                                        @if($errors->has('titulo'))
                                        <span class="error-message">Hay que indicar un titulo</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-12">
                                        <label for="cliente">Cliente:</label>
                                        <input type="text" name="cliente" id="cliente" class="form-control" tabindex="2"
                                            value="{{ old('cliente',$article->cliente) }}" />
                                        @if($errors->has('cliente'))
                                        <span class="error-message">Hay que indicar un cliente</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-12">
                                        <label for="categoria">Categoria*:</label>
                                        <select id="categoria" name="categoria" class="form-control" tabindex="3">
                                                @foreach($categorias as $categoria)
                                                <option value="{{$categoria->id}}" @if (($loop->first && old("categoria")==null ) ||
                                                    old("categoria",$article->categoria_id)==$categoria->id) selected @endif
                                                    >{{$categoria->categoria}}</option>
                                                @endforeach
                                            </select>
                                        @if($errors->has('categoria'))
                                        <span class="error-message">Has d'indicar una categoria</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-3">
                                        <label for="direccion">Dirección:</label>
                                        <input type="text" name="direccion" id="direccion" class="form-control" tabindex="2"
                                            value="{{ old('direccion',$article->direccion) }}" />                                        
                                    </div>
                                    <div class="form-group col-3">
                                        <label for="produccion">Producción:</label>
                                        <input type="text" name="produccion" id="produccion" class="form-control" tabindex="2"
                                            value="{{ old('produccion',$article->produccion) }}" />
                                    </div>        
                                    <div class="form-group col-3">
                                        <label for="post_produccion">Post Producción:</label>
                                        <input type="text" name="post_produccion" id="post_produccion" class="form-control" tabindex="2"
                                            value="{{ old('post_produccion',$article->post_produccion) }}" />
                                    </div>        
                                    <div class="form-group col-3">
                                        <label for="fotografo">Fotografo:</label>
                                        <input type="text" name="fotografo" id="fotografo" class="form-control" tabindex="2"
                                            value="{{ old('fotografo',$article->fotografo) }}" />
                                    </div>        
                                </div>
                            </div>                        
                            <div class="col-3">                                
                                <div class="form-group">
                                        <input type="hidden" name="old_thumbnail" id="old_thumbnail" class="form-control"
                                        value="{{ old('old_thumbnail',$article->thumbnail) }}" />
                                    <label for="input_img">Imatge</label>
                                    
                                    <input  name="input_img" type="file" id="input_img" onchange="readURL(this)" class="form-control" tabindex="6" />
                                    <img id="img" src="{{asset('storage/articles').'/'.$article->id.'/'.$article->thumbnail}}" alt="" style="width: 300px;"/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <label for="descripcion">Descripció:</label>
                        <textarea name="descripcion" id="descripcion" class="form-control" tabindex="5" >{{old('descripcion',$article->descripcion)}}</textarea>
                    </div>
                </div>
                <div class="form-group text-center ">
                    <input type="submit" name="actualizar" class="btn btn-primary " style="padding:8px 100px;margin-top:25px;" value="Actualitzar y salir" tabindex="6" />
                    <input type="submit" name="actualizar_continuar" class="btn btn-primary " style="padding:8px 100px;margin-top:25px;" value="Actualitzar y continuar" tabindex="7" />
                </div>
            </form>
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
<script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
<script>
	CKEDITOR.replace('descripcion');
    CKEDITOR.editorConfig = function( config )
{
    // Define changes to default configuration here. For example:
    config.language = 'es';
    // config.uiColor = '#AADC6E';
    config.width = '100%';
};
</script>
@endpush
@section('js')
@stop