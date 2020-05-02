<div class="material_visu_main">
    <div class="gallery-slider">
        <div class="gallery-slider__images">
            <div>
                @foreach($article->adjuntos as $adj)
                <div class="item">
                    <div class="img-fill">
                        @if($adj->extension=='ytb')
                        <iframe class="vid_container" src="https://www.youtube.com/embed/{{$adj->url}}" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen ></iframe>
                        @else
                    <img class="img_container img-fluid {{$adj->imgOrientation()}}" src="{{ asset('storage/medios/'.$adj->url)}}" />
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
            <button class="prev-arrow slick-arrow">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1280 1792">
                    <path fill="#fff" d="M1171 301L640 832l531 531q19 19 19 45t-19 45l-166 166q-19 19-45 19t-45-19L173 877q-19-19-19-45t19-45L915 45q19-19 45-19t45 19l166 166q19 19 19 45t-19 45z" />
                </svg>
            </button>
            <button class="next-arrow slick-arrow">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1280 1792">
                    <path fill="#fff" d="M1107 877l-742 742q-19 19-45 19t-45-19l-166-166q-19-19-19-45t19-45l531-531-531-531q-19-19-19-45t19-45L275 45q19-19 45-19t45 19l742 742q19 19 19 45t-19 45z" />
                </svg>
            </button>
        </div>
        <div class="gallery-slider__thumbnails">
            <div>
                    @foreach($article->adjuntos as $adj)
                    <div class="item">
                        <div class="img-fill">
                                @if($adj->extension=='ytb')
                                    <img class="img-fluid" src="http://i3.ytimg.com/vi/{{$adj->url}}/hqdefault.jpg" />
                                @else
                                    <img class="img-fluid" src="{{ asset('storage/medios/thumb/'.$adj->url)}}" />
                            @endif
                        </div>
                    </div>					
                @endforeach
            </div>
            <button class="prev-arrow slick-arrow">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1280 1792">
                    <path fill="#fff" d="M1171 301L640 832l531 531q19 19 19 45t-19 45l-166 166q-19 19-45 19t-45-19L173 877q-19-19-19-45t19-45L915 45q19-19 45-19t45 19l166 166q19 19 19 45t-19 45z" />
                </svg>
            </button>
            <button class="next-arrow slick-arrow">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1280 1792">
                    <path fill="#fff" d="M1107 877l-742 742q-19 19-45 19t-45-19l-166-166q-19-19-19-45t19-45l531-531-531-531q-19-19-19-45t19-45L275 45q19-19 45-19t45 19l742 742q19 19 19 45t-19 45z" />
                </svg>
            </button>
        </div>
    </div>
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
<script>	
    /*variables*/
    var $imagesSlider = $(".gallery-slider .gallery-slider__images>div"),
    $thumbnailsSlider = $(".gallery-slider__thumbnails>div");

    /*sliders*/
    // images options
    $imagesSlider.slick({
        speed:300,
        slidesToShow:1,
        slidesToScroll:1,
        cssEase:'linear',
        fade:true,
        draggable:false,
        asNavFor:".gallery-slider__thumbnails>div",
        prevArrow:'.gallery-slider__images .prev-arrow',
        nextArrow:'.gallery-slider__images .next-arrow'
    });

    // thumbnails options
    $thumbnailsSlider.slick({
        speed:300,
        slidesToShow:5,
        slidesToScroll:1,
        cssEase:'linear',
        centerMode:true,
        draggable:false,
        focusOnSelect:true,
        asNavFor:".gallery-slider .gallery-slider__images>div",
        prevArrow:'.gallery-slider__thumbnails .prev-arrow',
        nextArrow:'.gallery-slider__thumbnails .next-arrow',
        responsive: [
        {
            breakpoint: 720,
            settings: {
                slidesToShow: 4,
                slidesToScroll: 4
            }
        },
        {
            breakpoint: 576,
            settings: {
                slidesToShow: 3,
                slidesToScroll: 3
            }
        },
        {
            breakpoint: 350,
            settings: {
                slidesToShow: 2,
                slidesToScroll: 2
            }
        }
        ]
    });
</script>