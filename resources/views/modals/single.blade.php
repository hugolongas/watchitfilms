<div class="material_visu_main">
    @foreach($article->adjuntos as $adj)
    @if($adj->extension=='ytb')
    <iframe class="vid_container" src="https://www.youtube.com/embed/{{$adj->url}}" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen ></iframe>
    @else
    <img class="img_container img-fluid" src="{{ asset('storage/medios/'.$adjunto->url)}}" />
    @endif
    @endforeach
</div>

<div class="material_visu_footer row">
    <div class="col-12 col-md-8 material_visu_info">
        <div class="material_visu_title">
            {{$article->titulo}}
        </div>                                              
        <div class="material_visu_descripcion">
                {!!$article->descripcion!!}
        </div>
        <div class="material_visu_shared">
            <div class="material_visu_shared">
                <a id="shareWhatsapp" href="whatsapp://send?text={{$article->slug()}}">
                    <img class="img-responsive img-share" src="{{asset('img/share_wp.svg')}}" />
                </a>
                <a id="shareFacebook" href="http://www.facebook.com/sharer.php?u={{$article->slug()}}" onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600'); return false;">
                    <img class="img-responsive img-share" src="{{asset('img/share_fb.svg')}}" />
                </a>
                <a id="shareTwitter" href="https://twitter.com/intent/tweet?text={{$article->slug()}}" onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;">
                    <img class="img-responsive img-share" src="{{asset('img/share_tt.svg')}}">
                </a>
            </div>
        </div>                 
    </div>
    <div class="col-12 col-md-4 material_visu_credits">
        @if($article->hasCredits())
        <div class="title">Credits</div>
        @if($article->produccion!="")
        <div class="text">Producción: {{$article->produccion}}</div>
        @endif
        @if($article->direccion!="")
        <div class="text">Dirección: {{$article->direccion}}</div>
        @endif
        @if($article->post_produccion!="")
        <div class="text">Post-Producción: {{$article->post_produccion}}</div>
        @endif
        @if($article->fotografo!="")
        <div class="text">Fotógrafo: {{$article->fotografo}}</div>
        @endif
        @endif
    </div>
</div>