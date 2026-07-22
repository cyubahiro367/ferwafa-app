@include('mainMenuBar', ['name' => 'about'])


<div>
    <!-- Team Section -->
    <div class="container-fluid no-padding team-section">
        <div class="section-padding"></div>
        <div class="section-header">
            <h3>Meet our great {{ $title }} Members</h3>
            <span>{{ $title }}</span>
        </div>
        <ul id="team-carousel">
            @foreach ($committee as $value)
                @if (is_null($value['url']))
                    <li data-thumb="{{ asset('../asset/images/default-pic.png') }}">
                        <div class="col-md-6 no-padding larg-thumb">
                            <img src="{{ asset('../asset/images/default-pic.png') }}" style="width: 400px; height: auto;"
                                alt="team1" />
                @else
                    <li data-thumb="{{ route('comitte.doc', $value['id']) }}">
                        <div class="col-md-6 no-padding larg-thumb">
                            <img src="{{ route('comitte.doc', $value['id']) }}" style="width: 400px; height: auto;"
                                alt="team1" />
                @endif
                </div>
                <div class="container">
                    <div class="col-md-6 no-padding">
                        <div class="team-content">
                            <h3>{{ $value['name'] }}</h3>
                            <a href="#" title="Public Speaker">{{ $value['position'] }}</a>
                            <p>
                                
                            </p>
                            <ul>
                                <li class="fb">
                                    <a title="Facebook" href="#"><i class="fa fa-facebook"></i></a>
                                </li>
                                <li class="twt">
                                    <a title="Twitter" href="#"><i class="fa fa-twitter"></i></a>
                                </li>
                                <li class="gp">
                                    <a title="GooglePlus" href="#"><i class="fa fa-google-plus"></i></a>
                                </li>
                                <li class="lnk">
                                    <a title="LinkedIn" href="#"><i class="fa fa-linkedin"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                </li>
            @endforeach
        </ul>
    </div>
    <!-- Team Section /- -->
    <div class="container">
        <div class="row contact-form-section">
            <div class="col-md-12 col-sm-12">
                <div class="section-header">
                    <h3>Brief | Case</h3>
                    <span>Brief | Case</span>
                </div>
                <form method="POST" action="{{ route('independent.message') }}" enctype="multipart/form-data"
                    id="contact-form" class="contactus-form">
                    @csrf
                    <input type="hidden" name="committeeCategoryID" class="form-control" id="name"
                        value="{{ $committeeCategoryID }}" required="" />
                    @error('name')
                        <div style="color: red;">
                            {{ $message }}
                        </div>
                    @enderror

                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group">
                            <input type="text" name="name" class="form-control" id="name"
                                placeholder="Your Name*" required="" />
                            @error('name')
                                <div style="color: red;">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group">
                            <input type="text" name="phone" class="form-control" id="input_phone"
                                placeholder="Phone" />
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group">
                            <input type="email" name="email" class="form-control" id="email"
                                placeholder="Your E-mail" required="" />
                            @error('email')
                                <div style="color: red;">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group">
                            <input type="text" name="subject" class="form-control" id="subject"
                                placeholder="Subject" />
                            @error('subject')
                                <div style="color: red;">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <textarea rows="10" name="message" class="form-control" id="message" placeholder="message"></textarea>
                            <p style="color: red" id="wordCount">0/300 words</p>
                            @error('message')
                                <div style="color: red;">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <label class="col-form-label text-md-right col-12 col-md-12 col-lg-12">add supporting
                            document</label>
                        <div class="form-group">
                            <input type="file" name="reportFile" class="form-control">
                            @error('reportFile')
                                <div style="color: red;">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                        <div class="col-sm-12 col-md-7">
                            <button class="sendMessage">Send Message</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Footer Main -->
</div>

<script>
    const textarea = document.getElementById('message');
    const wordCountDisplay = document.getElementById('wordCount');
    const maxWords = 300;

    textarea.addEventListener('input', () => {
        const words = textarea.value.trim().split(/\s+/);
        const wordCount = words.filter(word => word).length;

        if (wordCount > maxWords) {
            // Allow editing but prevent new words from being added
            const trimmedText = words.slice(0, maxWords).join(' ');
            textarea.value = trimmedText;
            wordCountDisplay.textContent = `${maxWords}/${maxWords} words - Word limit reached`;
        } else {
            wordCountDisplay.textContent = `${wordCount}/${maxWords} words`;
        }
    });
</script>
@include('footer')
