@php
    $isHomePage = request()->routeIs('index');
    $homeUrl = route('index');
    $aboutHref = $isHomePage ? '#about' : route('about');
    $productsHref = $isHomePage ? '#products' : route('products');
    $newsHref = $isHomePage ? '#news' : $homeUrl . '#news';
    $contactHref = $isHomePage ? '#contact' : route('contact_us');
@endphp

<footer class="site-footer" id="contact">
    <div class="container">
        <div class="footer-grid">
            <div>
                <a class="footer-logo" href="{{ route('index') }}">TRISS</a>
                <p class="footer-desc">
                    The exclusive GoodWe partner for the Middle East, delivering premium inverter solutions,
                    technical guidance, and long-term service for residential and commercial solar projects.
                </p>
                <div class="social-links" aria-label="Social links">
                    <a href="#" aria-label="LinkedIn">in</a>
                    <a href="#" aria-label="X">x</a>
                    <a href="#" aria-label="Instagram">ig</a>
                </div>
            </div>

            <div>
                <h4 class="footer-heading">Company</h4>
                <ul class="footer-links-list">
                    <li><a href="{{ $aboutHref }}">About Us</a></li>
                    <li><a href="{{ $newsHref }}">Latest News</a></li>
                    <li><a href="{{ route('download.center') }}">Download Center</a></li>
                    <li><a href="{{ route('faq') }}">FAQ</a></li>
                </ul>
            </div>

            <div>
                <h4 class="footer-heading">Solutions</h4>
                <ul class="footer-links-list">
                    <li><a href="{{ $productsHref }}">Residential Inverters</a></li>
                    <li><a href="{{ route('products') }}">Commercial and Industrial</a></li>
                    <li><a href="{{ route('products') }}">Utility Scale</a></li>
                    <li><a href="{{ route('products') }}">Energy Storage</a></li>
                </ul>
            </div>

            <div>
                <h4 class="footer-heading">Contact</h4>
                <div class="contact-item">
                    <span class="contact-icon">+</span>
                    <a href="tel:+96264163824">06 4163824</a>
                </div>
                <div class="contact-item">
                    <span class="contact-icon">+</span>
                    <a href="tel:+962796564266">+962-796564266</a>
                </div>
                <div class="contact-item">
                    <span class="contact-icon">@</span>
                    <a href="mailto:info@energymagic.net">info@energymagic.net</a>
                </div>
                <div class="contact-item">
                    <span class="contact-icon">#</span>
                    <span>Wasfi Al-Tall St., Al-Faysaliya Complex, 3rd floor, office 301</span>
                </div>
                <a class="footer-contact-link" href="{{ $contactHref }}">Contact our team</a>
            </div>
        </div>

        <div class="footer-bottom">
            <p>&copy; {{ now()->year }} Triss. All rights reserved.</p>
            <div class="footer-legal">
                <a href="#">Privacy Policy</a>
                <a href="#">Terms of Service</a>
            </div>
        </div>
    </div>
</footer>
