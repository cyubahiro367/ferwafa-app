<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Basic -->
    <meta charset="utf-8" />
    <title>Ferwafa</title>
    <meta content="Ferwafa" name="description" />
    <!-- Mobile Metas -->
    <meta content="width=device-width, initial-scale=1, shrink-to-fit=no"
        name="viewport" />
    <!-- Standard Favicon -->
    <link rel="icon" type="image/x-icon"
        href="{{ asset('images/favicon.ico') }}" />

    <!-- For iPhone 4 Retina display: -->
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{ asset('images/apple-icon-114x114.png') }}" />

    <!-- For iPad: -->
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{ asset('images/apple-icon-72x72.png') }}" />

    <!-- For iPhone: -->
    <link rel="apple-touch-icon-precomposed" href="{{ asset('images/apple-icon-57x57.png') }}" />

    <!-- Library - Bootstrap v3.3.5 -->
    <link rel="stylesheet" type="text/css" href="{{ asset('libraries/lib.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('libraries/Stroke-Gap-Icon/stroke-gap-icon.css') }}" />

    <!-- Custom - Common CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/plugins.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/navigation-menu.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('libraries/lightslider-master/lightslider.css') }}" />

    <!-- Custom - Theme CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('style.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/shortcode.css') }}" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    @include('menuBar')

    <!-- Slider Section -->
    <div id="slider-section" class="slider-section container-fluid no-padding">
        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner" role="listbox">
                @foreach ($topResults as $key => $topResult)
                    @if ($topResult['is_top'] == 1)
                        @if ($key === 0)
                            <div class="item active">
                            @else
                                <div class="item">
                        @endif
                        <img src="{{ route('news.images.show', $topResult['image_url']) }}" alt="slide1" style="width: 100vw; height: auto" />
                        <div class="carousel-caption">
                            <div class="container">
                                <div class="col-md-5 col-sm-6 col-xs-9 pull-right">
                                    <div class="slider-content-box">
                                        <div class="col-md-12 col-sm-12 col-xs-6 no-padding">
                                            <h3 class="slider-title">
                                                {{ $topResult['title'] }}
                                            </h3>
                                            <span>January 03-07</span>
                                            <p>
                                                {{ $topResult['caption'] }}
                                            </p>
                                        </div>
                                        <div class="col-md-12 col-sm-12 col-xs-6 no-padding">
                                            <a href="{{ route('single.news', $topResult['id']) }}" title="Register now">Read
                                                More</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
            </div>
            @endif
            @endforeach
        </div>
        <!-- Controls -->
        <div class="container">
            <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                <i class="fa fa-angle-left"></i>
            </a>
            <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                <i class="fa fa-angle-right"></i>
            </a>
        </div>
    </div>
    </div>
    <!-- Slider Section /- -->

    <!-- Latest News -->
    <div style="background-color: rgb(255, 255, 255);"
        class="container-fluid latest-blog latest-blog-section no-padding">
        <div class="section-padding"></div>
        <div class="container">
            <div class="section-header">
                <h3>Latest news</h3>
                <span>Recent Updates</span>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="row">
                            @foreach ($result as $news)
                                <div class="col-md-6 col-sm-12 col-xs-12">
                                    <article class="type-post">
                                        <div class="entry-cover">
                                            <a href="{{ route('single.news', $news['id']) }}"><img
                                                    src="{{ route('news.images.show', $news['image_url']) }}"
                                                    alt="blog" width="397" height="398" /></a>
                                        </div>
                                        <div class="entry-block">

                                            <div class="entry-meta">
                                                <div class="post-date">
                                                    <a href="#" title=""><i class="fa fa-calendar"
                                                            aria-hidden="true"></i><span>{{ date('jS M Y', strtotime($news['created_at'])) }}
                                                        </span></a>
                                                </div>
                                            </div>
                                            <div class="entry-title">
                                                <a href="{{ route('single.news', $news['id']) }}"
                                                    title="We know Flipper lives in a world full of wonder flying there under under the sea">
                                                    <h3>
                                                        <a href="{{ route('single.news', $news['id']) }}">
                                                            {{ $news['title'] }}
                                                        </a>
                                                    </h3>
                                                </a>
                                            </div>
                                            <div class="entry-content">
                                                <p>
                                                    {{ $news['caption'] }}
                                                </p>
                                            </div>
                                            <a href="{{ route('single.news', $news['id']) }}" class="learn-more"
                                                title="Learn More">Learn More</a>
                                        </div>
                                    </article>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <center>
                            <div class="howwecan-right">
                                <div class="tab-content">
                                    <div role="tabpanel" class="tab-pane fade in active" id="howwecan_3">
                                        <a href="{{ route('all.news') }}" title="Read More">Read More News</a>
                                    </div>
                                </div>
                            </div>
                        </center>
                    </div>
                </div>
            </div>
            <div class="section-padding"></div>
        </div>
        <!-- Latest News /- -->

        <!-- Testimonial Section -->
        <div style="background-color: rgb(232, 231, 231);" class="container-fluid testimonial-section no-padding">
            <div class="section-padding"></div>
            <div class="container">
                <div class="section-header">
                    <h3>Our Partener</h3>
                </div>
                <div class="testimonial-carousel">
                    <div class="testimonial-block row">
                        <div class="col-md-5 col-sm-5 col-xs-5 no-padding">
                            <div class="testimonial-carousel-left">
                                <div class="testimonial-box testimonial-left" style="height: 136px">
                                    <a href="https://www.minisports.gov.rw/" target="_blank">
                                        <img src="{{ asset('images/images.jpeg') }}" alt="testimonial1"
                                            style="width: 144px; height: 136px" />
                                    </a>
                                </div>
                                <div class="testimonial-box testimonial-left" style="height: 136px">
                                    <a href="https://www.cafonline.com/" target="_blank">
                                        <img src="../asset/images/pngtree-caf-football-logo-png-image_3643068.jpg"
                                            alt="testimonial1" style="width: 144px; height: 136px" />
                                    </a>
                                </div>
                                <div class="testimonial-box testimonial-left" style="height: 136px">
                                    <a href="https://olympicrwanda.org/" target="_blank">
                                        <img src="{{ asset('images/Logo Institu CNOSR sans fond.png') }}" alt="testimonial1"
                                            style="width: 144px; height: 136px" />
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2 col-sm-2 col-xs-2">
                            <div class="testimonial-blockquote-circle">
                                <span><i class="fa fa-quote-right" aria-hidden="true"></i></span>
                            </div>
                        </div>
                        <div class="col-md-5 col-sm-5 col-xs-5 no-padding">
                            <div class="testimonial-carousel-right">
                                <div class="testimonial-box testimonial-right" style="height: 136px">
                                    <a href="https://bralirwa.co.rw/" target="_blank">
                                        <img src="../asset/images/primus.jpg" alt="testimonial1"
                                            style="width: 144px; height: 136px" />
                                    </a>
                                </div>
                                <div class="testimonial-box testimonial-right" style="height: 136px">
                                    <a href="https://www.fifa.com/fifaplus/en" target="_blank">
                                        <img src="{{ asset('images/fifa.png') }}" alt="testimonial1"
                                            style="width: 144px; height: 136px" /></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="section-padding"></div>
        </div>
        @include('footer')
</body>

</html>
