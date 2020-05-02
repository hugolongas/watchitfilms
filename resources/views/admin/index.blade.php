@extends('admin.layouts.admin', ['body_class' => 'home'])
@section('css')

@stop
@section('js')
@stop
@section('content')
Home - Portada
<section class="gif-portada">
    <h3>Gif de portada</h3>
    <form enctype="multipart/form-data" id="formuploadajax" method="post">
        <div>
            {{ csrf_field() }}
            <input  type="file" id="gif_file" name="gif_file"  class="form-control" onchange="readURL(this)" />
            <div>
                <img id="img" src="{{ asset('img/logo.png') }}" alt="" style="width: 150px"/>
            </div>
            <input type="submit" value="Subir archivos" class="btn btn-primary"/>
        </div>
    </form>
    <div id="mensaje"></div>
    <div class="content">
        <ul>
        @foreach($files as $file)
        <li style="display: inline-block;float: left;margin: 5px;">
            <img src="/storage/{{$file}}" />
        </li>
        @endforeach
        </ul>
    </div>
</section>
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
    
    $("#formuploadajax").on("submit", function(e){
            e.preventDefault();
            var f = $(this);
            var formData = new FormData(document.getElementById("formuploadajax"));
            $.ajax({
                url: "{{route('medio.portada') }}",
                type: "post",
                dataType: "html",
                data: formData,
                cache: false,
                contentType: false,
	     processData: false
            })
            .done(function(res){
                location.reload();
            });
        });
</script>
@endpush
