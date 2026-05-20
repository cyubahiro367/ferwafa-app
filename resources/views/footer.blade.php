<style>
    /* ── NEW FOOTER STYLES ── */
    .fw-footer { background: #133E8D; color: #fff; }

    .fw-footer-top { padding: 64px 0 40px; }
    .fw-footer-wrap { max-width: 1280px; margin: 0 auto; padding: 0 28px; }

    .fw-footer-grid {
        display: grid;
        grid-template-columns: 2fr 1fr 1fr 1.5fr;
        gap: 48px;
    }

    /* Brand column */
    .fw-footer-brand-logo {
        display: flex; align-items: center; gap: 12px; margin-bottom: 20px;
    }
    .fw-footer-logo-badge {
        width: 54px; height: 54px; border-radius: 50%;
        background: rgba(255,255,255,0.1);
        display: flex; align-items: center; justify-content: center;
        border: 2px solid #F5A800; overflow: hidden; flex-shrink: 0;
    }
    .fw-footer-logo-badge img { width: 100%; height: 100%; object-fit: cover; }
    .fw-footer-logo-title {
        font-family: 'Oswald', sans-serif; font-size: 22px; font-weight: 700;
        color: #fff; letter-spacing: 2px; line-height: 1;
    }
    .fw-footer-logo-sub { font-size: 11px; color: rgba(255,255,255,0.7); margin-top: 3px; }
    .fw-footer-desc {
        font-size: 13px; line-height: 1.75; color: #fff;
        margin-bottom: 24px;
    }
    .fw-footer-social { display: flex; gap: 10px; }
    .fw-footer-social a {
        width: 38px; height: 38px; border-radius: 50%;
        border: 1px solid rgba(255,255,255,0.2);
        display: flex; align-items: center; justify-content: center;
        color: rgba(255,255,255,0.75); font-size: 15px; text-decoration: none;
        transition: background .2s, color .2s, border-color .2s;
    }
    .fw-footer-social a:hover {
        background: #F5A800; color: #1a1a2e; border-color: #F5A800;
    }

    /* Column headings */
    .fw-footer-col h4 {
        font-family: 'Oswald', sans-serif; font-size: 13px; font-weight: 700;
        letter-spacing: 2px; text-transform: uppercase; color: #fff;
        margin-bottom: 20px; padding-bottom: 10px;
        border-bottom: 2px solid #F5A800; display: inline-block;
    }

    /* Quick links */
    .fw-footer-links { list-style: none; display: flex; flex-direction: column; gap: 10px; }
    .fw-footer-links li a {
        font-size: 13px; color: #fff; text-decoration: none;
        display: flex; align-items: center; gap: 8px; transition: color .2s;
    }
    .fw-footer-links li a::before { content: '›'; color: #F5A800; font-size: 16px; line-height: 1; }
    .fw-footer-links li a:hover { color: #F5A800; }

    /* Contact */
    .fw-footer-contact { display: flex; flex-direction: column; gap: 14px; }
    .fw-footer-contact-item {
        display: flex; align-items: flex-start; gap: 12px;
        font-size: 13px; color: #fff;
    }
    .fw-footer-contact-item i { color: #F5A800; margin-top: 2px; font-size: 14px; flex-shrink: 0; }
    .fw-footer-contact-item a { color: #fff; text-decoration: none; transition: color .2s; }
    .fw-footer-contact-item a:hover { color: #F5A800; }

    /* Newsletter */
    .fw-footer-newsletter-desc {
        font-size: 13px; color: #fff; line-height: 1.65; margin-bottom: 14px;
    }
    .fw-footer-newsletter-form { display: flex; }
    .fw-footer-newsletter-form input {
        flex: 1; padding: 11px 14px;
        background: rgba(255,255,255,0.1);
        border: 1px solid rgba(255,255,255,0.2); border-right: none;
        color: #fff; font-size: 13px; font-family: 'Barlow', sans-serif;
        border-radius: 4px 0 0 4px; outline: none;
    }
    .fw-footer-newsletter-form input::placeholder { color: rgba(255,255,255,0.4); }
    .fw-footer-newsletter-form button {
        background: #F5A800; color: #1a1a2e;
        border: none; padding: 0 20px;
        font-family: 'Oswald', sans-serif; font-size: 12px; font-weight: 700;
        letter-spacing: 1px; text-transform: uppercase;
        cursor: pointer; border-radius: 0 4px 4px 0; transition: background .2s;
        white-space: nowrap;
    }
    .fw-footer-newsletter-form button:hover { background: #C98500; }

    /* Divider */
    .fw-footer-divider {
        border: none; border-top: 1px solid rgba(255,255,255,0.12);
        margin: 0;
    }

    /* Bottom bar */
    .fw-footer-bottom { padding: 18px 0; }
    .fw-footer-bottom-inner {
        display: flex; justify-content: space-between; align-items: center;
        flex-wrap: wrap; gap: 12px;
    }
    .fw-footer-copy { font-size: 12px; color: #fff; }
    .fw-footer-bottom-links { display: flex; gap: 20px; flex-wrap: wrap; }
    .fw-footer-bottom-links a {
        font-size: 12px; color: #fff; text-decoration: none; transition: color .2s;
    }
    .fw-footer-bottom-links a:hover { color: #F5A800; }

    /* Responsive */
    @media (max-width: 1024px) {
        .fw-footer-grid { grid-template-columns: 1fr 1fr; gap: 36px; }
    }
    @media (max-width: 600px) {
        .fw-footer-grid { grid-template-columns: 1fr; gap: 28px; }
        .fw-footer-bottom-inner { flex-direction: column; align-items: flex-start; gap: 8px; }
    }
</style>

<footer class="fw-footer">
    <div class="fw-footer-top">
        <div class="fw-footer-wrap">
            <div class="fw-footer-grid">

                {{-- ── Brand ── --}}
                <div>
                    <div class="fw-footer-brand-logo">
                        <div class="fw-footer-logo-badge">
                            <img src="{{ asset('images/file.png') }}" alt="FERWAFA" />
                        </div>
                        <div>
                            <div class="fw-footer-logo-title">FERWAFA</div>
                            <div class="fw-footer-logo-sub">Rwanda Football Federation</div>
                        </div>
                    </div>
                    <p class="fw-footer-desc">
                        The Fédération Rwandaise de Football Association (FERWAFA) was established
                        in 1972 and became affiliated with CAF and FIFA in 1978. Guided by our motto
                        — <em>"Unity, Discipline, and Victory"</em> — we promote the development,
                        integrity, and excellence of football in Rwanda.
                    </p>
                    <div class="fw-footer-social">
                        <a href="https://www.facebook.com/RwandaFA/" target="_blank" title="Facebook">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="https://twitter.com/FERWAFA" target="_blank" title="Twitter">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="https://www.instagram.com/ferwafa/" target="_blank" title="Instagram">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="https://www.youtube.com/@ferwafatv761" target="_blank" title="YouTube">
                            <i class="fab fa-youtube"></i>
                        </a>
                    </div>
                </div>

                {{-- ── Quick Links ── --}}
                <div class="fw-footer-col">
                    <h4>Quick Links</h4>
                    <ul class="fw-footer-links">
                        <li><a href="{{ route('all.news') }}">News</a></li>
                        <li><a href="#">Competitions</a></li>
                        <li><a href="{{ route('seniorMen.news') }}">National Teams</a></li>
                        <li><a href="{{ route('grassroots.news') }}">Development</a></li>
                        <li><a href="{{ route('jobs.page.show') }}">Career</a></li>
                        <li><a href="{{ route('document.page.show') }}">Documents</a></li>
                        <li><a href="{{ route('whistleblowers') }}">Whistleblowers</a></li>
                    </ul>
                </div>

                {{-- ── Contact ── --}}
                <div class="fw-footer-col">
                    <h4>Reach Out</h4>
                    <div class="fw-footer-contact">
                        <div class="fw-footer-contact-item">
                            <i class="fas fa-map-marker-alt"></i>
                            <span>PO. Box 2000, Kigali, Rwanda</span>
                        </div>
                        <div class="fw-footer-contact-item">
                            <i class="fas fa-envelope"></i>
                            <a href="mailto:sgoffice@ferwafa.com">sgoffice@ferwafa.com</a>
                        </div>
                        <div class="fw-footer-contact-item">
                            <i class="fab fa-facebook"></i>
                            <a href="https://www.facebook.com/RwandaFA/" target="_blank">facebook.com/RwandaFA</a>
                        </div>
                        <div class="fw-footer-contact-item">
                            <i class="fab fa-twitter"></i>
                            <a href="https://twitter.com/FERWAFA" target="_blank">@FERWAFA</a>
                        </div>
                        <div class="fw-footer-contact-item">
                            <i class="fab fa-instagram"></i>
                            <a href="https://www.instagram.com/ferwafa/" target="_blank">@ferwafa</a>
                        </div>
                    </div>
                </div>

                {{-- ── Newsletter ── --}}
                <div class="fw-footer-col">
                    <h4>Newsletter</h4>
                    <p class="fw-footer-newsletter-desc">
                        Subscribe to receive the latest Rwanda football news, match results,
                        and updates directly to your inbox.
                    </p>
                    <div class="fw-footer-newsletter-form">
                        <input type="email" placeholder="Your email address" />
                        <button type="button">Subscribe</button>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <hr class="fw-footer-divider" />

    <div class="fw-footer-bottom">
        <div class="fw-footer-wrap">
            <div class="fw-footer-bottom-inner">
                <p class="fw-footer-copy">
                    Copyright &copy; <span id="fwFooterYear"></span> FERWAFA. All Rights Reserved.
                </p>
                <div class="fw-footer-bottom-links">
                    <a href="#">Privacy Policy</a>
                    <a href="#">Terms of Use</a>
                    <a href="{{ route('whistleblowers') }}">Whistleblowers</a>
                    <a href="{{ route('information') }}">Contact</a>
                </div>
            </div>
        </div>
    </div>
</footer>

<script>
    document.getElementById('fwFooterYear').textContent = new Date().getFullYear();
</script>

{{-- ── Site Scripts (keep your original order) ── --}}
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('libraries/lib.js') }}"></script>
<script src="{{ asset('libraries/jquery.countdown.min.js') }}"></script>
<script src="{{ asset('libraries/lightslider-master/lightslider.js') }}"></script>
<script src="{{ asset('js/functions.js') }}"></script>