<nav id="navbar" class="navbar fixed-top navbar-expand-lg">        
        <div class="navbar-brand abs">
            <a href="{{'/'}}" style="color:#777" data-target="0">
                <img class="brand-logo" src="{{ asset('img/logo.png') }}" alt="Logo"/>
            </a>
        </div>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsingNavbar">
            <i class="fas fa-bars"></i>
        </button>
        <div class="navbar-collapse collapse" id="collapsingNavbar">
            <ul class="navbar-nav mr-auto">
                    <li class="nav-item rrss">
                            <a class="nav-link rrss-items" target="_blank" href="https://www.youtube.com/channel/UCqoYKhGeL-YNxHZD_rs43ZA"><img src="{{asset('img/yt.svg')}}" alt="youtube"/></a>
                            <a class="nav-link rrss-items" target="_blank" href="https://www.facebook.com/watchitfilms"><img src="{{asset('img/fb.svg')}}" alt="youtube"/></a>
                            <a class="nav-link rrss-items" target="_blank" href="https://www.instagram.com/watchitfilms/"><img src="{{asset('img/insta.svg')}}" alt="youtube"/></a>
                        </li>                   
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a data-dest="home" class="nav-link" href="/" data-target="0">HOME</a>
                </li>
                <li class="nav-item">
                    <a data-dest="ext" class="nav-link" href="/blog" target="_blank">BLOG</a>
                </li>
                <li class="nav-item">
                    <a data-dest="contact" class="nav-link" data-target="1" href="{{route('contact')}}">CONTACTO<i class="fas fa-arrow-right"></i></a>
                </li>
            </ul>
        </div>
    </nav>