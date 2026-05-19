@include('mainMenuBar', ['name' => 'Infromation'])

<div class="container-fulid no-padding contactus">
    <div class="section-padding"></div>
    <div class="container">
      <div class="row">
        <div class="contactus-info-block">
          <div class="col-md-4 col-sm-4 col-xs-4">
            <div class="contactinfo-box">
              <span class="icon icon-House"></span>
              <div class="infobox">
                <h3>Our Location</h3>
                <span>Remera next to Amahoro stadium.</span>
              </div>
            </div>
          </div>
          <div class="col-md-4 col-sm-4 col-xs-4">
            <div class="contactinfo-box">
              <span class="icon icon-Phone2"></span>
              <div class="infobox">
                <h3>Call Us On</h3>
                {{-- <a href="tel:+250 788 608 988" title="+250 788 608 988"
                  >+250 788 608 988</a
                > --}}
                <a href="tel:PO. Box:2000 Kigali-Rwanda" title="PO. Box:2000 Kigali-Rwanda"
                  >PO. Box:2000 Kigali-Rwanda</a
                >
              </div>
            </div>
          </div>
          <div class="col-md-4 col-sm-4 col-xs-4">
            <div class="contactinfo-box">
              <span class="icon icon-Mail"></span>
              <div class="infobox">
                <h3>Send a Message</h3>
                <a href="#" title="contact@ferwafa.rw,"
                  >ferwafa.info@ferwafa.rw,</a
                >
                <a href="#" title="ferwafa@yahoo.fr"
                  >ferwafa@yahoo.fr</a
                >
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="map">
      <div class="section-padding"></div>
    </div>
    <div class="container">
      <div class="row contact-form-section">
        <div class="col-md-5 col-sm-12">
          <div class="section-header">
            <h3>Leave A Message</h3>
            <span>Feel Free to Contact Us</span>
          </div>
          @if (session()->has('error'))
            <div class="alert alert-danger">
                {{ session()->get('error') }}
            </div>
          @endif

          @if (session()->has('message'))
                        <div class="alert alert-success">
                            {{ session()->get('message') }}
                        </div>
                        @endif
          <form method="POST" action="{{ route('post.send.info') }}" id="contact-form" class="contactus-form">
            @csrf
            <div class="col-md-6 col-sm-6 col-xs-12">
              <div class="form-group">
                <input
                  type="text"
                  name="name"
                  class="form-control"
                  id="name"
                  placeholder="Your Name*"
                  required=""
                />
                @error('name')
                    <div style="color: red;">
                        {{ $message }}
                    </div>
                @enderror
              </div>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <div class="form-group">
                <input
                  type="text"
                  name="contact-phone"
                  class="form-control"
                  id="input_phone"
                  placeholder="Phone"
                />
              </div>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <div class="form-group">
                <input
                  type="email"
                  name="email"
                  class="form-control"
                  id="email"
                  placeholder="Your E-mail"
                  required=""
                />
                @error('email')
                    <div style="color: red;">
                        {{ $message }}
                    </div>
                @enderror
              </div>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <div class="form-group">
                <input
                  type="text"
                  name="subject"
                  class="form-control"
                  id="subject"
                  placeholder="Subject"
                />
                @error('subject')
                    <div style="color: red;">
                        {{ $message }}
                    </div>
                @enderror
              </div>
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="form-group">
                <textarea
                  rows="10"
                  name="content"
                  class="form-control"
                  id="content"
                  placeholder="message"
                ></textarea>
                @error('content')
                    <div style="color: red;">
                        {{ $message }}
                    </div>
                @enderror
              </div>
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="form-group">
                <button id="btn_submit">Send Message</button>
                {{-- <input
                  type="submit"
                  value="Send Message"
                  id="btn_submit"
                  title="Send"
                  name="post"
                /> --}}
              </div>
            </div>
            <div id="alert-msg" class="alert-msg"></div>
          </form>
        </div>
        <div class="col-md-7 col-sm-12">
            <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3987.5040318930764!2d30.114316874739334!3d-1.951599998030699!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x19dca703a72ebd1f%3A0xe2a239a98d1f7d83!2sRwanda%20Football%20Federation!5e0!3m2!1sen!2srw!4v1690366633904!5m2!1sen!2srw"
            width="800" height="500" style="border:0; height: 500px"
            allowfullscreen="" loading="lazy"
            referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
      </div>
    </div>
    <div class="section-padding"></div>
  </div>

@include('footer')
