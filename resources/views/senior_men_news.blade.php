<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Basic -->
    <meta charset="utf-8" />
    <title>Ferwafa</title>
    <meta content="Ferwafa" name="description" />
    <!-- Mobile Metas -->
    <meta content="width=device-width, initial-scale=1, shrink-to-fit=no" name="viewport" />
    <link href="./static/CACHE/css/output.718a7af03b3d.css" media="screen" rel="stylesheet" type="text/css" />
    <link href="./static/img/federation/ferwafa.png" rel="shortcut icon" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />

    <script src="http://127.0.0.1:35729/livereload.js"></script>
</head>

<body>
    <div id="layout">
        @include('header')
        <div class="section-title big-title" style="background: url(../static/img/background/footballnew.jpg)">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <h1 class="banner-title-main">Senior Men National Team News</h1>
                    </div>
                    <div class="col-md-4">
                        <div class="breadcrumbs">
                            <ul>
                                <li><a href="/">Home</a></li>
                                <li>News</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <section class="content-info">
            <!-- Content Central -->
            <div class="container padding-top recent-news">
                <div class="row container-news">
                    <div class="col-lg-12 col-lg12">
                        <div class="panel-box">
                            <div class="titles">
                                <h4>Senior Men National Team News</h4>
                            </div>
                        </div>
                    </div>
                    <!-- content Column Left -->
                    @foreach ($result as $news)
                        <div class="col-lg-4 col-xl-4">
                            <div class="single-home-news">
                                <div class="news-img">
                                    <img src="{{ route('news.images.show', $news['image_url']) }}">
                                </div>
                                <div class="news-information">
                                    <h5>
                                        <a href="{{ route('single.news', $news['id']) }}">{{ $news['title'] }}</a>
                                    </h5>
                                    <span class="data-info">{{ date('jS M Y', strtotime($news['created_at'])) }}</span>
                                    <p>
                                        {{ $news['caption'] }}
                                    </p>
                                    <a href="{{ route('single.news', $news['id']) }}">Read More [+]</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
        @include('footer')
    </div>
</body>
