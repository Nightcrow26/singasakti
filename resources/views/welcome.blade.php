<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <title>SINGASAKTI</title>
    <link href="{{ url('') }}/logo/x.png" rel="icon">

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('') }}landing/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">


    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="{{ asset('') }}landing/assets/css/fontawesome.css">
    <link rel="stylesheet" href="{{ asset('') }}landing/assets/css/templatemo-onix-digital.css">
    <link rel="stylesheet" href="{{ asset('') }}landing/assets/css/animated.css">
    <link rel="stylesheet" href="{{ asset('') }}landing/assets/css/owl.css">
    <!--

TemplateMo 565 Onix Digital

https://templatemo.com/tm-565-onix-digital

-->
    <style>
        #chartdiv {
            width: 100%;
            height: 500px;
        }

        #chartdiv2 {
            width: 100%;
            height: 500px;
        }

        @media (max-width: 768px) {
            .tulisan1 {
                font-size: 12vw !important;
                margin-top: -25px !important;
                margin-top: -25px !important;
            }

            .main-banner .tulisan2 {
                font-size: 2vw !important;
                margin-top: -25px !important;

                /* Ubah ukuran font untuk tulisan2 menjadi 4vw */
            }

            .ban {
                margin-top: -125px !important;
                margin-left: -60px !important;

                /* Ubah ukuran font untuk tulisan2 menjadi 4vw */
            }

            .about-us {
                margin-top: -175px !important;

                /* Ubah ukuran font untuk tulisan2 menjadi 4vw */
            }
        }

        @media (max-width: 468px) {
            .tulisan1 {
                font-size: 7vw !important;
                margin-top: -25px !important;
                margin-top: -25px !important;
            }

            .main-banner .tulisan2 {
                font-size: 2vw !important;
                margin-top: -25px !important;

                /* Ubah ukuran font untuk tulisan2 menjadi 4vw */
            }

            .ban {
                margin-top: -125px !important;
                margin-left: -60px !important;

                /* Ubah ukuran font untuk tulisan2 menjadi 4vw */
            }

            .about-us {
                margin-top: -175px !important;

                /* Ubah ukuran font untuk tulisan2 menjadi 4vw */
            }
        }
    </style>
</head>

<body>

    <!-- ***** Preloader Start ***** -->
    <div id="js-preloader" class="js-preloader">
        <div class="preloader-inner">
            <span class="dot"></span>
            <div class="dots">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
    </div>
    <!-- ***** Preloader End ***** -->

    <!-- ***** Header Area Start ***** -->
    <header class="header-area header-sticky wow slideInDown" data-wow-duration="0.75s" data-wow-delay="0s">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav class="main-nav">
                        <!-- ***** Logo Start ***** -->
                        <a href="#" class="logo">
                            <img src="{{ asset('') }}/logo/xx.png" style="width: 200px;heght:10px">
                        </a>
                        <!-- ***** Logo End ***** -->
                        <!-- ***** Menu Start ***** -->
                        <ul class="nav">
                            <li class="scroll-to-section"><a href="#top" class="active">Home</a></li>
                            {{--  <li class="scroll-to-section"><a href="#services">Services</a></li>  --}}
                            <li class="scroll-to-section"><a href="#about">Statistik</a></li>
                            <li class="scroll-to-section"><a href="{{ url('') }}/login">login</a></li>
                            <li class="scroll-to-section"><a href="{{ url('') }}/login"></a></li>
                            {{--  <li class="scroll-to-section"><a href="#portfolio">Portfolio</a></li>  --}}
                            {{--  <li class="scroll-to-section"><a href="#video">Videos</a></li>  --}}
                            {{-- <li class="scroll-to-section"><a href="#contact">Indeks Nilai SKPD</a></li> --}}
                            {{-- <li class="scroll-to-section">
                                <div class="main-red-button-hover"><a href="{{ url('') }}/login">Login</a></div>
                            </li> --}}
                        </ul>
                        <a class='menu-trigger'>
                            <span>Menu</span>
                        </a>
                        <!-- ***** Menu End ***** -->
                    </nav>
                </div>
            </div>
        </div>
    </header>
    <!-- ***** Header Area End ***** -->

    <div class="main-banner" id="top">
        <div class="container ban">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-6 align-self-center">
                            <div class="owl-carousel owl-banner">
                                <div class="item header-text">
                                    <h2 style="font-size: 2vw"> <span>Selamat Datang Di,
                                        </span>
                                    </h2>
                                    <h2 class="tulisan1" style="font-size:  6vw"><em>SINGA</em><span>SAKTI</span></h2>
                                    <div class="col-lg-12">
                                        <div class="white-button">
                                            <h2 class="tulisan2 mt-4" style="font-size: 2vw;text-align:center"><em>
                                                    <span>&#8221;</span>Sistem Informasi Pengawasan
                                                    </span><em> Jasa Kontruksi Kabupaten Hulu Sungai
                                                        Tengah</em></em><span>&#8221;</span>
                                            </h2>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{--  <div id="services" class="our-services section">
            <div class="services-right-dec">
                <img src="{{ asset('') }}landing/assets/images/services-right-dec.png" alt="">
            </div>
            <div class="container">
                <div class="services-left-dec">
                    <img src="{{ asset('') }}landing/assets/images/services-left-dec.png" alt="">
                </div>
                <div class="row">
                    <div class="col-lg-6 offset-lg-3">
                        <div class="section-heading">
                            <h2>We <em>Provide</em> The Best Service With <span>Our Tools</span></h2>
                            <span>Our Services</span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="owl-carousel owl-services">
                            <div class="item">
                                <h4>Learn More about our Guidelines</h4>
                                <div class="icon"><img
                                        src="{{ asset('') }}landing/assets/images/service-icon-01.png"
                                        alt=""></div>
                                <p>Feel free to use this template for your business</p>
                            </div>
                            <div class="item">
                                <h4>Develop The Best Strategy for Business</h4>
                                <div class="icon"><img
                                        src="{{ asset('') }}landing/assets/images/service-icon-02.png"
                                        alt=""></div>
                                <p>Get to know more about the topic in details</p>
                            </div>
                            <div class="item">
                                <h4>UI / UX Design and Development</h4>
                                <div class="icon"><img
                                        src="{{ asset('') }}landing/assets/images/service-icon-03.png"
                                        alt=""></div>
                                <p>Get to know more about the topic in details</p>
                            </div>
                            <div class="item">
                                <h4>Discover &amp; Explore our SEO Tips</h4>
                                <div class="icon"><img
                                        src="{{ asset('') }}landing/assets/images/service-icon-04.png"
                                        alt=""></div>
                                <p>Feel free to use this template for your business</p>
                            </div>
                            <div class="item">
                                <h4>Optimizing your websites for Speed</h4>
                                <div class="icon"><img
                                        src="{{ asset('') }}landing/assets/images/service-icon-01.png"
                                        alt=""></div>
                                <p>Get to know more about the topic in details</p>
                            </div>
                            <div class="item">
                                <h4>See The Strategy In The Market</h4>
                                <div class="icon"><img
                                        src="{{ asset('') }}landing/assets/images/service-icon-02.png"
                                        alt=""></div>
                                <p>Get to know more about the topic in details</p>
                            </div>
                            <div class="item">
                                <h4>Best Content Ideas for your pages</h4>
                                <div class="icon"><img
                                        src="{{ asset('') }}landing/assets/images/service-icon-03.png"
                                        alt=""></div>
                                <p>Feel free to use this template for your business</p>
                            </div>
                            <div class="item">
                                <h4>Optimizing Speed for your web pages</h4>
                                <div class="icon"><img
                                        src="{{ asset('') }}landing/assets/images/service-icon-04.png"
                                        alt=""></div>
                                <p>Get to know more about the topic in details</p>
                            </div>
                            <div class="item">
                                <h4>Accessibility for mobile viewing</h4>
                                <div class="icon"><img
                                        src="{{ asset('') }}landing/assets/images/service-icon-01.png"
                                        alt=""></div>
                                <p>Get to know more about the topic in details</p>
                            </div>
                            <div class="item">
                                <h4>Content Ideas for your next project</h4>
                                <div class="icon"><img
                                        src="{{ asset('') }}landing/assets/images/service-icon-02.png"
                                        alt=""></div>
                                <p>Feel free to use this template for your business</p>
                            </div>
                            <div class="item">
                                <h4>UI &amp; UX Design &amp; Development</h4>
                                <div class="icon"><img
                                        src="{{ asset('') }}landing/assets/images/service-icon-03.png"
                                        alt=""></div>
                                <p>Get to know more about the topic in details</p>
                            </div>
                            <div class="item">
                                <h4>Discover the digital marketing trend</h4>
                                <div class="icon"><img
                                        src="{{ asset('') }}landing/assets/images/service-icon-04.png"
                                        alt=""></div>
                                <p>Get to know more about the topic in details</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>  --}}

    <div id="video" class="our-videos section">
        <div class="videos-left-dec">
            <img src="{{ asset('') }}landing/assets/images/videos-left-dec.png" alt="">
        </div>
        <div class="videos-right-dec">
            <img src="{{ asset('') }}landing/assets/images/videos-right-dec.png" alt="">
        </div>
        {{--  <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="naccs">
                            <div class="grid">
                                <div class="row">
                                    <div class="col-lg-8">
                                        <ul class="nacc">
                                            <li class="active">
                                                <div>
                                                    <div class="thumb">
                                                        <iframe width="100%" height="auto"
                                                            src="https://www.youtube.com/embed/JynGuQx4a1Y"
                                                            title="YouTube video player" frameborder="0"
                                                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                                            allowfullscreen></iframe>
                                                        <div class="overlay-effect">
                                                            <a href="#">
                                                                <h4>Project One</h4>
                                                            </a>
                                                            <span>SEO &amp; Marketing</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div>
                                                    <div class="thumb">
                                                        <iframe width="100%" height="auto"
                                                            src="https://www.youtube.com/embed/RdJBSFpcO4M"
                                                            title="YouTube video player" frameborder="0"
                                                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                                            allowfullscreen></iframe>
                                                        <div class="overlay-effect">
                                                            <a href="#">
                                                                <h4>Second Project</h4>
                                                            </a>
                                                            <span>Advertising &amp; Marketing</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div>
                                                    <div class="thumb">
                                                        <iframe width="100%" height="auto"
                                                            src="https://www.youtube.com/embed/ZlfAjbQiL78"
                                                            title="YouTube video player" frameborder="0"
                                                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                                            allowfullscreen></iframe>
                                                        <div class="overlay-effect">
                                                            <a href="#">
                                                                <h4>Project Three</h4>
                                                            </a>
                                                            <span>Digital &amp; Marketing</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div>
                                                    <div class="thumb">
                                                        <iframe width="100%" height="auto"
                                                            src="https://www.youtube.com/embed/mx1WseE7-0Y"
                                                            title="YouTube video player" frameborder="0"
                                                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                                            allowfullscreen></iframe>
                                                        <div class="overlay-effect">
                                                            <a href="#">
                                                                <h4>Fourth Project</h4>
                                                            </a>
                                                            <span>SEO &amp; Advertising</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="menu">
                                            <div class="active">
                                                <div class="thumb">
                                                    <img src="{{ asset('') }}landing/assets/images/video-thumb-01.png"
                                                        alt="">
                                                    <div class="inner-content">
                                                        <h4>Project One</h4>
                                                        <span>SEO &amp; Marketing</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div>
                                                <div class="thumb">
                                                    <img src="{{ asset('') }}landing/assets/images/video-thumb-02.png"
                                                        alt="">
                                                    <div class="inner-content">
                                                        <h4>Second Project</h4>
                                                        <span>Advertising &amp; Marketing</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div>
                                                <div class="thumb">
                                                    <img src="{{ asset('') }}landing/assets/images/video-thumb-03.png"
                                                        alt="Marketing">
                                                    <div class="inner-content">
                                                        <h4>Project Three</h4>
                                                        <span>Digital &amp; Marketing</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div>
                                                <div class="thumb">
                                                    <img src="{{ asset('') }}landing/assets/images/video-thumb-04.png"
                                                        alt="SEO Work">
                                                    <div class="inner-content">
                                                        <h4>Fourth Project</h4>
                                                        <span>SEO &amp; Advertising</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>  --}}
    </div>

    <div id="services" class="our-services section">
        <div class="services-right-dec">
            <img src="{{ asset('') }}landing/assets/images/services-right-dec.png" alt="">
        </div>
        <div class="container">
            <div class="services-left-dec">
                <img src="{{ asset('') }}landing/assets/images/services-left-dec.png" alt="">
            </div>
            <div class="row">
                <div class="col-lg-6 offset-lg-3">
                    <div class="section-heading">
                        <h2><em>FITUR</em> APLIKASI <span>SINGA SAKTI</span></h2>
                        <span>Singa Sakti</span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="owl-carousel owl-services">
                        <div class="item">
                            <h4>Pengawasan Rutin</h4>
                            <div class="icon"><img src="{{ asset('') }}landing/assets/images/service-icon-01.png"
                                    alt=""></div>

                        </div>
                        <div class="item">
                            <h4>Pengawasan Teknis</h4>
                            <div class="icon"><img src="{{ asset('') }}landing/assets/images/service-icon-02.png"
                                    alt=""></div>

                        </div>
                        <div class="item">
                            <h4>Pengawasan Insidental</h4>
                            <div class="icon"><img
                                    src="{{ asset('') }}landing/assets/images/service-icon-03.png"
                                    alt=""></div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="about" class="about-us section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12" style="text-align: center">
                    <div class="section-heading">
                        <h2><em>PERSENTASE </em><span>PENGAWASAN RUTIN</span></h2>
                    </div>
                </div>
            </div>
            <div class="row">
                {{-- <div class="col-lg-6 align-self-center">
                    <div class="left-image">
                        <div id="chart">
                        </div>
                    </div>
                </div> --}}
                <div class="col-lg-12">
                    <div class="section-heading">

                        {{-- <h2 style="font-size: 28px">Statistik <span style="font-size: 28px">Pekerjaan</span>
                        </h2> --}}
                        {{--  <div class="row">
                                <div class="col-lg-12 text-center">
                                    <div class="fact-item">
                                        <div class="count-area-content">
                                            <div class="count-digit">
                                                <h2 style="font-size: 78px"><em>3.5</em></h2>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>  --}}
                        <div class="card shadow-none bg-transparent border border-danger mt-5">
                            {{--  <div class="card-header text-center">  --}}

                            {{--  </div>  --}}
                            <div class="row">
                                <div class="col-sm-12 col-xs-12 col-md-3 col-lg-3">
                                    <div class="card-body text-center">
                                        <h5> Jumlah Pekerjaan </h5>
                                        <h1 style="font-size: 80px">{{ $total_pekerjaan ?? 0 }}</h1>

                                    </div>

                                </div>
                                <div class="col-sm-12 col-xs-12 col-md-3 col-lg-3">
                                    <div class="card-body text-center">
                                        <h5>Lengkap</h5>
                                        @php
                                            $totalRealisasiFisik = 0;
                                            $totalRealisasi = 0;
                                        @endphp

                                        {{-- @foreach ($realisasi as $a)
                                            @foreach ($a->realisasis as $c)
                                                @if ($loop->first)
                                                    @php
                                                        $totalRealisasiFisik += $c->realisasi_fisik ?? 0;
                                                        $totalRealisasi += $c->realisasi ?? 0;
                                                        $row = $a->count();
                                                        $persen = number_format(
                                                            $totalRealisasiFisik / $row,
                                                            0,
                                                            ',',
                                                            '.',
                                                        );
                                                    @endphp
                                                @endif
                                            @endforeach
                                        @endforeach --}}

                                        <h1 style="font-size: 80px">
                                            @if (isset($total_lengkap))
                                                {{ $total_lengkap }}
                                            @else
                                                0
                                            @endif
                                        </h1>
                                    </div>
                                </div>

                                <div class="col-sm-12 col-xs-12 col-md-3 col-lg-3">
                                    <div class="card-body text-center">
                                        <h5> Tidak Lengkap</h5>
                                        <h1 style="font-size: 80px">
                                            {{ number_format($total_tidak_lengkap, 0, ',', '.') ?? 0 }}
                                        </h1>
                                    </div>

                                </div>

                                <div class="col-sm-12 col-xs-12 col-md-3 col-lg-3">
                                    <div class="card-body text-center">
                                        @php
                                            $persen_pekerjaan =
                                                number_format(($total_lengkap / $total_pekerjaan) * 100, 0, ',', '.') ??
                                                0;
                                        @endphp
                                        <h5> Persentase (%)</h5>
                                        <h1 style="font-size: 80px">
                                            {{ number_format(($total_lengkap / $total_pekerjaan) * 100, 0, ',', '.') ?? 0 }}
                                        </h1>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="row">

                                <div class="col-12">
                                    <div id="chartdiv2"></div>
                                </div>


                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="about" class="about-us section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12" style="text-align: center">
                    <div class="section-heading">
                        <h2><em>STATISTIK </em><span>PEKERJAAN</span></h2>
                    </div>
                </div>
            </div>
            <div class="row">
                {{-- <div class="col-lg-6 align-self-center">
                    <div class="left-image">
                        <div id="chart">
                        </div>
                    </div>
                </div> --}}
                <div class="col-lg-12">
                    <div class="section-heading">

                        {{-- <h2 style="font-size: 28px">Statistik <span style="font-size: 28px">Pekerjaan</span>
                        </h2> --}}
                        {{--  <div class="row">
                                <div class="col-lg-12 text-center">
                                    <div class="fact-item">
                                        <div class="count-area-content">
                                            <div class="count-digit">
                                                <h2 style="font-size: 78px"><em>3.5</em></h2>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>  --}}
                        <div class="card shadow-none bg-transparent border border-danger mt-5">
                            {{--  <div class="card-header text-center">  --}}

                            {{--  </div>  --}}
                            <div class="row">
                                <div class="col-sm-12 col-xs-12 col-md-4 col-lg-4">
                                    <div class="card-body text-center">
                                        <h5> Jumlah Pekerjaan </h5>
                                        <h1 style="font-size: 80px">{{ $pekerjaan ?? 0 }}</h1>

                                    </div>

                                </div>
                                <div class="col-sm-12 col-xs-12 col-md-4 col-lg-4">
                                    <div class="card-body text-center">
                                        <h5>Persentase Realisasi Fisik (%)</h5>
                                        @php
                                            $totalRealisasiFisik = 0;
                                            $totalRealisasi = 0;
                                        @endphp

                                        @foreach ($realisasi as $a)
                                            @foreach ($a->realisasis as $c)
                                                @if ($loop->first)
                                                    @php
                                                        $totalRealisasiFisik += $c->realisasi_fisik ?? 0;
                                                        $totalRealisasi += $c->realisasi ?? 0;
                                                        $row = $a->count();
                                                        $persen = number_format(
                                                            $totalRealisasiFisik / $row,
                                                            0,
                                                            ',',
                                                            '.',
                                                        );
                                                    @endphp
                                                @endif
                                            @endforeach
                                        @endforeach

                                        <h1 style="font-size: 80px">
                                            @if (isset($persen))
                                                {{ $persen }}
                                            @else
                                                0
                                            @endif
                                        </h1>
                                    </div>
                                </div>

                                <div class="col-sm-12 col-xs-12 col-md-4 col-lg-4">
                                    <div class="card-body text-center">
                                        <h5> Total Realisasi Keuangan (Rp) </h5>
                                        <h1 style="font-size: 50px" class="mt-4">
                                            {{ number_format($totalRealisasi, 0, ',', '.') ?? 0 }}
                                        </h1>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="row">

                                <div class="col-12">
                                    <div id="chartdiv"></div>
                                </div>


                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="footer-dec">
        <img src="{{ asset('') }}landing/assets/images/footer-dec.png" alt="">
    </div>
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-12" style="margin-top: -100px">
                    <div class="copyright">
                        <p>Copyright © {{ date('Y') }} MONEVPRO.All Rights Reserved.
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </footer>


    <!-- Scripts -->
    <script src="{{ asset('') }}landing/vendor/jquery/jquery.min.js"></script>
    <script src="{{ asset('') }}landing/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('') }}landing/assets/js/owl-carousel.js"></script>
    <script src="{{ asset('') }}landing/assets/js/animation.js"></script>
    <script src="{{ asset('') }}landing/assets/js/imagesloaded.js"></script>
    <script src="{{ asset('') }}landing/assets/js/custom.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="https://cdn.amcharts.com/lib/5/index.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/xy.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/radar.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>

    <script>
        am5.ready(function() {

            // Create root element
            // https://www.amcharts.com/docs/v5/getting-started/#Root_element
            var root = am5.Root.new("chartdiv");


            // Set themes
            // https://www.amcharts.com/docs/v5/concepts/themes/
            root.setThemes([
                am5themes_Animated.new(root)
            ]);


            // Create chart
            // https://www.amcharts.com/docs/v5/charts/radar-chart/
            var chart = root.container.children.push(am5radar.RadarChart.new(root, {
                panX: false,
                panY: false,
                startAngle: 180,
                endAngle: 360,
                radius: am5.percent(90),
                layout: root.verticalLayout
            }));


            // Colors
            var colors = am5.ColorSet.new(root, {
                step: 2
            });


            // Measurement #1

            // Axis
            var color1 = colors.next();

            var axisRenderer1 = am5radar.AxisRendererCircular.new(root, {
                radius: -10,
                stroke: color1,
                strokeOpacity: 1,
                strokeWidth: 6,
                inside: true
            });

            axisRenderer1.grid.template.setAll({
                forceHidden: true
            });

            axisRenderer1.ticks.template.setAll({
                stroke: color1,
                visible: true,
                length: 10,
                strokeOpacity: 1,
                inside: true
            });

            axisRenderer1.labels.template.setAll({
                radius: 15,
                inside: true
            });

            var xAxis1 = chart.xAxes.push(am5xy.ValueAxis.new(root, {
                maxDeviation: 0,
                min: 0,
                max: 100,
                strictMinMax: true,
                renderer: axisRenderer1
            }));


            // Label
            var label1 = chart.seriesContainer.children.push(am5.Label.new(root, {
                fill: am5.color(0xffffff),
                x: 0,
                y: 5,
                width: 00,
                centerX: am5.percent(50),
                textAlign: "center",
                centerY: am5.percent(50),
                fontSize: "0em",
                text: "0",
                background: am5.RoundedRectangle.new(root, {
                    fill: color1
                })
            }));

            // Add clock hand
            var axisDataItem1 = xAxis1.makeDataItem({
                value: 0,
                fill: color1,
                name: "Realisasi Fisik  ({{ isset($persen) ? $persen : 0 }} %)"
            });

            var clockHand1 = am5radar.ClockHand.new(root, {
                pinRadius: 14,
                radius: am5.percent(98),
                bottomWidth: 10
            });

            clockHand1.pin.setAll({
                fill: color1
            });

            clockHand1.hand.setAll({
                fill: color1
            });

            var bullet1 = axisDataItem1.set("bullet", am5xy.AxisBullet.new(root, {
                sprite: clockHand1
            }));

            xAxis1.createAxisRange(axisDataItem1);

            axisDataItem1.get("grid").set("forceHidden", true);
            axisDataItem1.get("tick").set("forceHidden", true);


            // Measurement #2

            // Axis
            var color2 = colors.next();

            var axisRenderer2 = am5radar.AxisRendererCircular.new(root, {
                //innerRadius: -40,
                stroke: color2,
                strokeOpacity: 1,
                strokeWidth: 6
            });

            axisRenderer2.grid.template.setAll({
                forceHidden: true
            });

            axisRenderer2.ticks.template.setAll({
                stroke: color2,
                visible: true,
                length: 10,
                strokeOpacity: 1
            });

            axisRenderer2.labels.template.setAll({
                radius: 15
            });

            var xAxis2 = chart.xAxes.push(am5xy.ValueAxis.new(root, {
                maxDeviation: 0,
                min: 0,
                max: 100,
                strictMinMax: true,
                renderer: axisRenderer2
            }));


            // Label
            var label2 = chart.seriesContainer.children.push(am5.Label.new(root, {
                fill: am5.color(0xffffff),
                x: 0,
                y: 5,
                width: 00,
                centerX: am5.percent(50),
                textAlign: "center",
                centerY: am5.percent(50),
                fontSize: "0em",
                text: "0",
                background: am5.RoundedRectangle.new(root, {
                    fill: color2
                })
            }));


            // Add clock hand
            var axisDataItem2 = xAxis2.makeDataItem({
                value: 0,
                fill: color2,
                name: "Target"
            });

            var clockHand2 = am5radar.ClockHand.new(root, {
                pinRadius: 10,
                radius: am5.percent(98),
                bottomWidth: 10
            });

            clockHand2.pin.setAll({
                fill: color2
            });

            clockHand2.hand.setAll({
                fill: color2
            });

            var bullet2 = axisDataItem2.set("bullet", am5xy.AxisBullet.new(root, {
                sprite: clockHand2
            }));

            xAxis2.createAxisRange(axisDataItem2);

            axisDataItem2.get("grid").set("forceHidden", true);
            axisDataItem2.get("tick").set("forceHidden", true);


            // Legend
            var legend = chart.children.push(am5.Legend.new(root, {
                x: am5.p50,
                centerX: am5.p50
            }));
            legend.data.setAll([axisDataItem1, axisDataItem2])


            // Animate values
            setInterval(function() {
                var value1 = {{ isset($persen) ? $persen : 0 }};
                axisDataItem1.animate({
                    key: "value",
                    to: value1,
                    duration: 1000,
                    easing: am5.ease.out(am5.ease.cubic)
                });

                label1.set("text", value1);

                var value2 = 100;
                axisDataItem2.animate({
                    key: "value",
                    to: value2,
                    duration: 1000,
                    easing: am5.ease.out(am5.ease.cubic)
                });

                label2.set("text", value2);
            }, 1)

            // chart.bulletsContainer.set("mask", undefined);


            // // Create axis ranges bands
            // // https://www.amcharts.com/docs/v5/charts/radar-chart/gauge-charts/#Bands
            // var bandsData = [{
            // title: "Unsustainable",
            // color: "#ee1f25",
            // lowScore: -40,
            // highScore: -20
            // }, {
            // title: "Volatile",
            // color: "#f04922",
            // lowScore: -20,
            // highScore: 0
            // }, {
            // title: "Foundational",
            // color: "#fdae19",
            // lowScore: 0,
            // highScore: 20
            // }, {
            // title: "Developing",
            // color: "#f3eb0c",
            // lowScore: 20,
            // highScore: 40
            // }, {
            // title: "Maturing",
            // color: "#b0d136",
            // lowScore: 40,
            // highScore: 60
            // }, {
            // title: "Sustainable",
            // color: "#54b947",
            // lowScore: 60,
            // highScore: 80
            // }, {
            // title: "High Performing",
            // color: "#0f9747",
            // lowScore: 80,
            // highScore: 100
            // }];

            // am5.array.each(bandsData, function (data) {
            // var axisRange = xAxis.createAxisRange(xAxis.makeDataItem({}));

            // axisRange.setAll({
            // value: data.lowScore,
            // endValue: data.highScore
            // });

            // axisRange.get("axisFill").setAll({
            // visible: true,
            // fill: am5.color(data.color),
            // fillOpacity: 0.8
            // });

            // axisRange.get("label").setAll({
            // text: data.title,
            // inside: true,
            // radius: 15,
            // fontSize: "0.9em",
            // fill: root.interfaceColors.get("background")
            // });
            // });


            // Make stuff animate on load
            chart.appear(1000, 100);

        }); // end am5.ready()


        am5.ready(function() {

            // Create root element
            // https://www.amcharts.com/docs/v5/getting-started/#Root_element
            var root = am5.Root.new("chartdiv2");


            // Set themes
            // https://www.amcharts.com/docs/v5/concepts/themes/
            root.setThemes([
                am5themes_Animated.new(root)
            ]);


            // Create chart
            // https://www.amcharts.com/docs/v5/charts/radar-chart/
            var chart = root.container.children.push(am5radar.RadarChart.new(root, {
                panX: false,
                panY: false,
                startAngle: 180,
                endAngle: 360,
                radius: am5.percent(90),
                layout: root.verticalLayout
            }));


            // Colors
            var colors = am5.ColorSet.new(root, {
                step: 2
            });


            // Measurement #1

            // Axis
            var color1 = colors.next();

            var axisRenderer1 = am5radar.AxisRendererCircular.new(root, {
                radius: -10,
                stroke: color1,
                strokeOpacity: 1,
                strokeWidth: 6,
                inside: true
            });

            axisRenderer1.grid.template.setAll({
                forceHidden: true
            });

            axisRenderer1.ticks.template.setAll({
                stroke: color1,
                visible: true,
                length: 10,
                strokeOpacity: 1,
                inside: true
            });

            axisRenderer1.labels.template.setAll({
                radius: 15,
                inside: true
            });

            var xAxis1 = chart.xAxes.push(am5xy.ValueAxis.new(root, {
                maxDeviation: 0,
                min: 0,
                max: 100,
                strictMinMax: true,
                renderer: axisRenderer1
            }));


            // Label
            var label1 = chart.seriesContainer.children.push(am5.Label.new(root, {
                fill: am5.color(0xffffff),
                x: 0,
                y: 5,
                width: 00,
                centerX: am5.percent(50),
                textAlign: "center",
                centerY: am5.percent(50),
                fontSize: "0em",
                text: "0",
                background: am5.RoundedRectangle.new(root, {
                    fill: color1
                })
            }));

            // Add clock hand
            var axisDataItem1 = xAxis1.makeDataItem({
                value: 0,
                fill: color1,
                name: "Persentase Pengawasan Rutin  ({{ isset($persen_pekerjaan) ? $persen_pekerjaan : 0 }} %)"
            });

            var clockHand1 = am5radar.ClockHand.new(root, {
                pinRadius: 14,
                radius: am5.percent(98),
                bottomWidth: 10
            });

            clockHand1.pin.setAll({
                fill: color1
            });

            clockHand1.hand.setAll({
                fill: color1
            });

            var bullet1 = axisDataItem1.set("bullet", am5xy.AxisBullet.new(root, {
                sprite: clockHand1
            }));

            xAxis1.createAxisRange(axisDataItem1);

            axisDataItem1.get("grid").set("forceHidden", true);
            axisDataItem1.get("tick").set("forceHidden", true);


            // Measurement #2

            // Axis
            var color2 = colors.next();

            var axisRenderer2 = am5radar.AxisRendererCircular.new(root, {
                //innerRadius: -40,
                stroke: color2,
                strokeOpacity: 1,
                strokeWidth: 6
            });

            axisRenderer2.grid.template.setAll({
                forceHidden: true
            });

            axisRenderer2.ticks.template.setAll({
                stroke: color2,
                visible: true,
                length: 10,
                strokeOpacity: 1
            });

            axisRenderer2.labels.template.setAll({
                radius: 15
            });

            var xAxis2 = chart.xAxes.push(am5xy.ValueAxis.new(root, {
                maxDeviation: 0,
                min: 0,
                max: 100,
                strictMinMax: true,
                renderer: axisRenderer2
            }));


            // Label
            var label2 = chart.seriesContainer.children.push(am5.Label.new(root, {
                fill: am5.color(0xffffff),
                x: 0,
                y: 5,
                width: 00,
                centerX: am5.percent(50),
                textAlign: "center",
                centerY: am5.percent(50),
                fontSize: "0em",
                text: "0",
                background: am5.RoundedRectangle.new(root, {
                    fill: color2
                })
            }));


            // Add clock hand
            var axisDataItem2 = xAxis2.makeDataItem({
                value: 0,
                fill: color2,
                name: "Target"
            });

            var clockHand2 = am5radar.ClockHand.new(root, {
                pinRadius: 10,
                radius: am5.percent(98),
                bottomWidth: 10
            });

            clockHand2.pin.setAll({
                fill: color2
            });

            clockHand2.hand.setAll({
                fill: color2
            });

            var bullet2 = axisDataItem2.set("bullet", am5xy.AxisBullet.new(root, {
                sprite: clockHand2
            }));

            xAxis2.createAxisRange(axisDataItem2);

            axisDataItem2.get("grid").set("forceHidden", true);
            axisDataItem2.get("tick").set("forceHidden", true);


            // Legend
            var legend = chart.children.push(am5.Legend.new(root, {
                x: am5.p50,
                centerX: am5.p50
            }));
            legend.data.setAll([axisDataItem1, axisDataItem2])


            // Animate values
            setInterval(function() {
                var value1 = {{ isset($persen_pekerjaan) ? $persen_pekerjaan : 0 }};
                axisDataItem1.animate({
                    key: "value",
                    to: value1,
                    duration: 1000,
                    easing: am5.ease.out(am5.ease.cubic)
                });

                label1.set("text", value1);

                var value2 = 100;
                axisDataItem2.animate({
                    key: "value",
                    to: value2,
                    duration: 1000,
                    easing: am5.ease.out(am5.ease.cubic)
                });

                label2.set("text", value2);
            }, 1)

            // chart.bulletsContainer.set("mask", undefined);


            // // Create axis ranges bands
            // // https://www.amcharts.com/docs/v5/charts/radar-chart/gauge-charts/#Bands
            // var bandsData = [{
            // title: "Unsustainable",
            // color: "#ee1f25",
            // lowScore: -40,
            // highScore: -20
            // }, {
            // title: "Volatile",
            // color: "#f04922",
            // lowScore: -20,
            // highScore: 0
            // }, {
            // title: "Foundational",
            // color: "#fdae19",
            // lowScore: 0,
            // highScore: 20
            // }, {
            // title: "Developing",
            // color: "#f3eb0c",
            // lowScore: 20,
            // highScore: 40
            // }, {
            // title: "Maturing",
            // color: "#b0d136",
            // lowScore: 40,
            // highScore: 60
            // }, {
            // title: "Sustainable",
            // color: "#54b947",
            // lowScore: 60,
            // highScore: 80
            // }, {
            // title: "High Performing",
            // color: "#0f9747",
            // lowScore: 80,
            // highScore: 100
            // }];

            // am5.array.each(bandsData, function (data) {
            // var axisRange = xAxis.createAxisRange(xAxis.makeDataItem({}));

            // axisRange.setAll({
            // value: data.lowScore,
            // endValue: data.highScore
            // });

            // axisRange.get("axisFill").setAll({
            // visible: true,
            // fill: am5.color(data.color),
            // fillOpacity: 0.8
            // });

            // axisRange.get("label").setAll({
            // text: data.title,
            // inside: true,
            // radius: 15,
            // fontSize: "0.9em",
            // fill: root.interfaceColors.get("background")
            // });
            // });


            // Make stuff animate on load
            chart.appear(1000, 100);

        }); // end am5.ready()
    </script>
</body>

</html>
