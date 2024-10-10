@include('mainMenuBar', ['name' => 'News'])

<div
      class="container-fluid eventlist blog blogpost upcoming-event latest-blog no-padding"
    >
      <div class="section-padding"></div>
      <div class="container">
        <div class="row " style="display: flex; justify-content: center">
          <div class="col-md-19 col-sm-19 content-area">
            <article class="type-post">
              <div class="entry-cover">
                <img
                  src="{{ route('news.images.show', $url[0]['url']) }}"
                  alt="blog-post"
                  width="810"
                  height="376"
                />
              </div>
              <div class="entry-block">
            
                <div class="entry-title">
                  <h3>
                    {{ $result['title'] }}
                  </h3>
                </div>
                <div class="entry-content">
                    {!! $result['description'] !!}
                </div>
              </div>
            </article>
          </div>
        </div>
      </div>
      <div class="section-padding"></div>
    </div>

@include('footer')
