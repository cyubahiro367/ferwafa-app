<!DOCTYPE html>

<head>
    <!-- Basic -->
    <meta charset="utf-8" />
    <title>Ferwafa</title>
    <meta content="Ferwafa" name="description" />
    <!-- Mobile Metas -->
    <meta content="width=device-width, initial-scale=1, shrink-to-fit=no" name="viewport" />
</head>

<body>

    <footer class="footer-main container-fluid no-padding">
        <!-- Container -->
        <div class="container">
            <!-- Footer About -->
            <div class="footer-about">
                <div class="logo-block">
                    <img src="{{asset('asset/images/file.png')}}" alt="logo" width="150" height="150" />
                </div>
                <div class="footer-about-content">
                    <h3 class="block-title">About Ferwafa</h3>
                    <p>
                        Rwandese Federation of Association Football (FERWAFA) was founded in
                        1972 and became a FIFA and FIFA affiliate in 1978. From the above
                        setting, Ferwafa operates within the framework of the FIFA/CAF
                        regulations; holding itself to respect them and its members to
                        comply with its own statute and the directives/decisions from
                        FIFA/CAF. FERWAFA’s motto is “Unity, Discipline and Victory”,
                    </p>
                </div>
            </div>
            <!-- Footer About /- -->

            <div class="row">
                <!-- Quick Links Widget -->
                <aside class="col-md-4 col-sm-6 col-xs-6 widget widget_quick_links">
                    <h3 class="block-title">Quick links</h3>
                    <ul>
                        <li><a title="News" href="#">News</a></li>
                        <li><a title="Events" href="#">Events</a></li>
                        <li><a title="Career" href="#">Career</a></li>
                        <li>
                            <a title="Contact us" href="#">Contact us</a>
                        </li>
                    </ul>
                </aside>
                <!-- Quick Links Widget /- -->

                <!-- ContactUs Widget -->
                <aside class="col-md-4 col-sm-6 col-xs-6 widget widget_contactus">
                    <h3 class="block-title">REACH OUT</h3>
                    <div class="contactinfo-box">
                        <div class="contactinfo-box">
                            <i class="fa fa-phone"></i>
                            <p>
                                <a title="+250 788 608 988" href="tel:+250 788 608 988">+250 788 608 988</a>
                            </p>
                        </div>
                        <div class="contactinfo-box">
                            <i class="fa fa-location-arrow"></i>
                            <p>
                                <a title="PO. Box:2000 Kigali-Rwanda" href="tel:PO. Box:2000 Kigali-Rwanda">PO. Box:2000
                                    Kigali-Rwanda</a>
                            </p>
                        </div>
                        <div class="contactinfo-box">
                            <i class="fa fa-envelope"></i>
                            <p style="margin-left: 25px">
                                <a href="mailto:ferwafa@yahoo.fr" title="ferwafa@yahoo.fr">ferwafa@yahoo.fr</a>
                            </p>
                        </div>
                </aside>
                <!-- ContactUs Widget /- -->

                <!-- NewsLetter Widget -->
                <aside class="col-md-4 col-sm-12 col-xs-12 widget widget_newsletter">
                    <h3 class="block-title">News Letter</h3>
                    <p>You can enter your E mail to subscribe to our website, so as to receive the latest news.</p>
                    <div class="input-group">
                        <input type="text" placeholder="Enter Address" class="form-control" />
                        <span class="input-group-btn">
                            <button type="button" title="Subscribe" class="btn">Go</button>
                        </span>
                    </div>
                    <ul style="display: flex; justify-content:center; align-items:center; gap: 24px">
                        <li>
                            <a title="Facebook" data-toggle="tooltip" href="https://www.facebook.com/RwandaFA/"><i
                                    class="fa fa-facebook"></i></a>
                        </li>
                        <li>
                            <a title="Twitter" data-toggle="tooltip" href="https://twitter.com/FERWAFA"><i
                                    class="fa fa-twitter"></i></a>
                        </li>
                        <li>
                            <a title="Instagram" data-toggle="tooltip" href="https://www.instagram.com/ferwafa/"><i
                                    class="fa fa-instagram"></i></a>
                        </li>
                        <li>
                            <a title="Youtube" data-toggle="tooltip" href="https://www.youtube.com/@ferwafatv761"><i
                                    class="fa fa-youtube"></i></a>
                        </li>
                    </ul>
                </aside>
                <!-- NewsLetter Widget /- -->
            </div>
        </div>
        <!-- Container /- -->

        <!-- Container -->
        <div class="container">
            <div class="footer-menu" style="display:flex; justify-content:center; align-atimes: center">
                <!-- Copyrights -->
                <div class="copyrights ow-pull-left">
                    <p>Copyright &copy; <span id="currentYear"></span> FERWAFA. All rights Reserved</p>
                </div>
                <!-- Copyrights /- -->
            </div>
            <!-- Footer Menu /- -->
        </div>
        <!-- Container /- -->
    </footer>

    <script>
        document.getElementById("currentYear").textContent =
            new Date().getFullYear();
    </script>

    <script src="{{ asset('js/jquery.min.js') }}"></script>

    <!-- Library - Js -->
    <script src="{{ asset('libraries/lib.js') }}"></script>
    <!-- Bootstrap JS File v3.3.5 -->
    <script src="{{ asset('libraries/jquery.countdown.min.js') }}"></script>

    <script src="{{ asset('libraries/lightslider-master/lightslider.js') }}"></script>
    <!-- Library - Google Map API -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCn3Z6i1AYolP3Y2SGis5qhbhRwmxxo1wU"></script>
    <script src="{{ asset('js/functions.js') }}"></script>
</body>
