<footer class="fw-footer">
    <div class="fw-footer-top">
        <div class="fw-footer-wrap">
            <div class="fw-footer-grid">
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
                        <a href="https://www.facebook.com/RwandaFA/" target="_blank" rel="noopener" title="Facebook"><i class="fab fa-facebook-f"></i></a>
                        <a href="https://twitter.com/FERWAFA" target="_blank" rel="noopener" title="Twitter"><i class="fab fa-twitter"></i></a>
                        <a href="https://www.instagram.com/ferwafa/" target="_blank" rel="noopener" title="Instagram"><i class="fab fa-instagram"></i></a>
                        <a href="https://www.youtube.com/@ferwafatv761" target="_blank" rel="noopener" title="YouTube"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>

                <div class="fw-footer-col">
                    <h4>Quick Links</h4>
                    <ul class="fw-footer-links">
                        <li><a href="{{ route('all.news') }}">News</a></li>
                        <li><a href="{{ route('gallery.images') }}">Gallery</a></li>
                        <li><a href="{{ route('seniorMen.news') }}">National Teams</a></li>
                        <li><a href="{{ route('grassroots.news') }}">Development</a></li>
                        <li><a href="{{ route('jobs.page.show') }}">Career</a></li>
                        <li><a href="{{ route('document.page.show') }}">Documents</a></li>
                        <li><a href="{{ route('whistleblowers') }}">Whistleblowers</a></li>
                    </ul>
                </div>

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
                            <a href="https://www.facebook.com/RwandaFA/" target="_blank" rel="noopener">facebook.com/RwandaFA</a>
                        </div>
                        <div class="fw-footer-contact-item">
                            <i class="fab fa-twitter"></i>
                            <a href="https://twitter.com/FERWAFA" target="_blank" rel="noopener">@FERWAFA</a>
                        </div>
                    </div>
                </div>

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
