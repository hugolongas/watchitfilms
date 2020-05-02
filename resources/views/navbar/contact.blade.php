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
                <li class="nav-item">
                <a class="nav-link" data-dest="weare" href="{{route('weare')}}" data-target="-1"><i class="fas fa-arrow-left"></i>SOBRE NOSOTROS</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-dest="home" href="/" data-target="0">HOME</a>
                </li>   
                <li class="nav-item">
                    <a class="nav-link" data-dest="ext" href="/blog" target="_blank">BLOG</a>
                </li>
            </ul>
        </div>
    </nav>