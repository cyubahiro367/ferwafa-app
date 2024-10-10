@include('mainMenuBar', ['name' => 'Gallery'])

<div class="container-fulid no-padding contactus">
    <div class="section-padding"></div>
    <div class="container">
        <div class="row">
            <div class="report-container" style="display: flex; gap: 12px">
                @foreach ($galleries as $gallery)
                    <div class="gallery">
                        <img alt="gallery" class="single-image-gallery"
                            src="{{ route('gallery.doc', $gallery['url']) }}" /><i aria-hidden="true"
                            class="view-image-gallery"></i>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="section-padding"></div>
</div>

@include('footer')
