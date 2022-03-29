<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Kana's Kitchen</title>
    @include('layouts.partials.head')
</head>
<body>
    <header class="header-blue" style="color: #222222;background: var(--light);border-style: none;opacity: 1;">
        <nav class="navbar navbar-dark navbar-expand-md navigation-clean-search" style="color: #222222;">
            <div class="container-fluid">
            <a class="navbar-brand" href=""><img src="{{ asset('kanas.png') }}" style="height: 54px;">Kana's Kitchen</a>
            <button data-toggle="collapse" data-target="#navcol-1" class="navbar-toggler" style="background: #bebebe;border-color: rgba(0,0,0,0);"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navcol-1">
                    <ul class="navbar-nav">
                        <li class="nav-item"><a class="nav-link" href="/dashboard" style="border-color: rgb(34,34,34);color: rgb(34,34,34);">Toko</a></li>
                        <!-- <li class="nav-item dropdown"><a class="dropdown-toggle nav-link" aria-expanded="false" data-toggle="dropdown" href="#" style="color: rgb(34,34,34);">Dropdown </a>
                            <div class="dropdown-menu"><a class="dropdown-item" href="#">First Item</a><a class="dropdown-item" href="#">Second Item</a><a class="dropdown-item" href="#">Third Item</a></div>
                        </li> -->
                    </ul>
                    <form class="form-inline mr-auto" target="_self">
                        <div class="form-group mb-0" style="border-style: hidden;border-color: rgb(0,0,0);"><label for="search-field"><i class="fa fa-search"></i></label><input class="form-control search-field" type="search" id="search-field" name="search"></div>
                    </form>
                    <span class="navbar-text">@if (Route::has('login'))
                        <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                            @auth
                                <a href="{{ url('/dashboard') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Dashboard</a>
                            @else
                                <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Log in</a>
                            @endauth
                        </div>
                    @endif
                    </span>
                </div>
            </div>
        </nav>
        <div class="container hero">
            <div class="row">
                <div class="col-12 col-lg-6 col-xl-5 offset-xl-1" style="color: rgb(34, 34, 34);">
                    <h1 style="color: #222222;">Kana's Kitchen</h1>
                    <p style="color: rgb(34,34,34);">Mauris egestas tellus non ex condimentum, ac ullamcorper sapien dictum. Nam consequat neque quis sapien viverra convallis. In non tempus lorem. </p><button class="btn btn-light btn-lg action-button" type="button">Learn More</button>
                </div>
                <div class="col-md-5 col-lg-5 offset-lg-1 offset-xl-0 d-none d-lg-block phone-holder" style="text-align: center;">
                    <div class="phone-mockup"></div><img src="{{ asset('kanas.png') }}" style="width: 300px;margin: 0px;padding: 0px;transform: perspective(0px);">
                </div>
            </div>
        </div>
    </header>
    <section class="article-list">
        <div class="container">
            <div class="intro">
                <h2 class="text-center">Latest Articles</h2>
                <p class="text-center">Nunc luctus in metus eget fringilla. Aliquam sed justo ligula. Vestibulum nibh erat, pellentesque ut laoreet vitae. </p>
            </div>
            <div class="row articles">
                <div class="col-sm-6 col-md-4 item"><a href="#"><img class="img-fluid" src="assets/img/desk.jpg"></a>
                    <h3 class="name">Article Title</h3>
                    <p class="description">Aenean tortor est, vulputate quis leo in, vehicula rhoncus lacus. Praesent aliquam in tellus eu gravida. Aliquam varius finibus est, interdum justo suscipit id.</p><a class="action" href="#"><i class="fa fa-arrow-circle-right"></i></a>
                </div>
                <div class="col-sm-6 col-md-4 item"><a href="#"><img class="img-fluid" src="assets/img/building.jpg"></a>
                    <h3 class="name">Article Title</h3>
                    <p class="description">Aenean tortor est, vulputate quis leo in, vehicula rhoncus lacus. Praesent aliquam in tellus eu gravida. Aliquam varius finibus est, interdum justo suscipit id.</p><a class="action" href="#"><i class="fa fa-arrow-circle-right"></i></a>
                </div>
                <div class="col-sm-6 col-md-4 item"><a href="#"><img class="img-fluid" src="assets/img/loft.jpg"></a>
                    <h3 class="name">Article Title</h3>
                    <p class="description">Aenean tortor est, vulputate quis leo in, vehicula rhoncus lacus. Praesent aliquam in tellus eu gravida. Aliquam varius finibus est, interdum justo suscipit id.</p><a class="action" href="#"><i class="fa fa-arrow-circle-right"></i></a>
                </div>
                <div class="col-sm-6 col-md-4 item"><a href="#"><img class="img-fluid" src="assets/img/loft.jpg"></a>
                    <h3 class="name">Article Title</h3>
                    <p class="description">Aenean tortor est, vulputate quis leo in, vehicula rhoncus lacus. Praesent aliquam in tellus eu gravida. Aliquam varius finibus est, interdum justo suscipit id.</p><a class="action" href="#"><i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>
    </section>
    <section class="map-clean">
        <div class="container">
            <div class="intro">
                <h2 class="text-center">Location </h2>
                <p class="text-center">Nunc luctus in metus eget fringilla. Aliquam sed justo ligula. Vestibulum nibh erat, pellentesque ut laoreet vitae. </p>
            </div>
        </div><iframe allowfullscreen="" frameborder="0" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d498.61224539976513!2d116.873813!3d-1.230687!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xc71ea819008d7979!2sKana&#39;s%20Kitchen%20JL%20CENDANA%20WIKA%2C%20CENDANA%201%20CC1%2012%2FA!5e0!3m2!1sid!2sus!4v1622538278218!5m2!1sid!2sus;zoom=15" width="100%" height="450"></iframe>
    </section>
    <footer class="footer-clean">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-sm-4 col-md-3 item">
                    <h3>Services</h3>
                    <ul>
                        <li><a href="#">Web design</a></li>
                        <li><a href="#">Development</a></li>
                        <li><a href="#">Hosting</a></li>
                    </ul>
                </div>
                <div class="col-sm-4 col-md-3 item">
                    <h3>About</h3>
                    <ul>
                        <li><a href="#">Company</a></li>
                        <li><a href="#">Team</a></li>
                        <li><a href="#">Legacy</a></li>
                    </ul>
                </div>
                <div class="col-sm-4 col-md-3 item">
                    <h3>Careers</h3>
                    <ul>
                        <li><a href="#">Job openings</a></li>
                        <li><a href="#">Employee success</a></li>
                        <li><a href="#">Benefits</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 item social"><a href="#"><i class="icon ion-social-facebook"></i></a><a href="#"><i class="icon ion-social-twitter"></i></a><a href="#"><i class="icon ion-social-snapchat"></i></a><a href="#"><i class="icon ion-social-instagram"></i></a>
                    <p class="copyright">Kana's Kitchen © 2017</p>
                </div>
            </div>
        </div>
    </footer>
    @include('layouts.partials.javascript')
</body>
</html>
