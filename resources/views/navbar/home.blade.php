<nav id="navbar" class="navbar fixed-top navbar-expand-lg">        
    <div class="navbar-brand abs">
        <a href="{{'/'}}" style="color:#777" data-target="0">
            <img class="brand-logo" src="{{ asset('img/logo.png') }}" alt="Logo"/>
        </a>
        <div class="rrss-mov">
                <a class="rrss-mov-item" target="_blank" href="https://www.youtube.com/channel/UCqoYKhGeL-YNxHZD_rs43ZA"><img class="img-fluid" src="{{asset('img/yt_black.svg')}}" alt="youtube"/></a>
                <a class="rrss-mov-item" target="_blank" href="https://www.facebook.com/watchitfilms"><img class="img-fluid" src="{{asset('img/fb_black.svg')}}" alt="facebook"/></a>
                <a class="rrss-mov-item" target="_blank" href="https://www.instagram.com/watchitfilms/"><img class="img-fluid" src="{{asset('img/insta_black.svg')}}" alt="instagram"/></a>
        </div>
    </div>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsingNavbar">
        <i class="fas fa-bars"></i>
    </button>
    <div class="navbar-collapse collapse" id="collapsingNavbar">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
            <a class="nav-link" data-target="-1" href="{{route('weare')}}"><i class="fas fa-arrow-left"></i>SOBRE NOSOTROS</a>
            </li>
        </ul>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item rrss">
                <a class="nav-link rrss-item" target="_blank" href="https://www.youtube.com/channel/UCqoYKhGeL-YNxHZD_rs43ZA"><img class="img-fluid" src="{{asset('img/yt.svg')}}" alt="youtube"/></a>
                <a class="nav-link rrss-item" target="_blank" href="https://www.facebook.com/watchitfilms"><img class="img-fluid" src="{{asset('img/fb.svg')}}" alt="facebook"/></a>
                <a class="nav-link rrss-item" target="_blank" href="https://www.instagram.com/watchitfilms/"><img class="img-fluid" src="{{asset('img/insta.svg')}}" alt="instagram"/></a>
            </li>   
            <li class="nav-item">
                <a class="nav-link" href="/blog" target="_blank">BLOG</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-target="1" href="{{route('contact')}}">CONTACTO<i class="fas fa-arrow-right"></i></a>
            </li>
        </ul>
    </div>
</nav>