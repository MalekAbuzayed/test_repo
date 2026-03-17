@extends('user.layouts.app')

@section('content')
    <div class="contact-page-shell">
        <header class="contact-page-header">
            <div class="contact-page-header__inner">
                <nav class="contact-page-breadcrumb" aria-label="Breadcrumb">
                    <a href="{{ route('index') }}">Home</a>
                    <span>/</span>
                    <span>Contact</span>
                </nav>

                <h1 class="contact-page-title">Get in <em>Touch</em></h1>
                <p class="contact-page-subtitle">
                    We are here to help. Reach out to our team for product enquiries, technical support, or partnership
                    opportunities.
                </p>
            </div>
        </header>

        <section class="contact-info-section">
            <div class="contact-page-container">
                <div class="contact-info-grid">
                    <article class="contact-info-card reveal">
                        <div class="contact-info-card__icon" aria-hidden="true">
                            <svg viewBox="0 0 24 24" fill="none" stroke-width="1.75" stroke-linecap="round"
                                stroke-linejoin="round">
                                <path d="M21 10c0 7-9 13-9 13S3 17 3 10a9 9 0 0118 0z" />
                                <circle cx="12" cy="10" r="3" />
                            </svg>
                        </div>
                        <div class="contact-info-card__content">
                            <span class="contact-info-card__label">Our Address</span>
                            <h2 class="contact-info-card__title">Jordan Office</h2>
                            <p class="contact-info-card__body">
                                Wasfi Al-Tall St.<br>
                                Al-Faysaliya Complex<br>
                                3 floor, office 301
                            </p>
                        </div>
                        <a class="contact-info-card__action"
                            href="https://www.google.com/maps/search/?api=1&query=Magic%20Energy%20%26%20Power%20Systems%20MEPCO"
                            target="_blank" rel="noopener">
                            Get Directions
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path d="M5 12h14M12 5l7 7-7 7" />
                            </svg>
                        </a>
                    </article>

                    <article class="contact-info-card reveal reveal-d1">
                        <div class="contact-info-card__icon" aria-hidden="true">
                            <svg viewBox="0 0 24 24" fill="none" stroke-width="1.75" stroke-linecap="round"
                                stroke-linejoin="round">
                                <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z" />
                                <polyline points="22,6 12,13 2,6" />
                            </svg>
                        </div>
                        <div class="contact-info-card__content">
                            <span class="contact-info-card__label">Email Us</span>
                            <h2 class="contact-info-card__title">Send a Message</h2>
                            <p class="contact-info-card__body">
                                General enquiries:<br>
                                <a href="mailto:info@energymagic.net">info@energymagic.net</a><br><br>
                                Support:<br>
                                <a href="mailto:info@energymagic.net">info@energymagic.net</a>
                            </p>
                        </div>
                        <a class="contact-info-card__action" href="mailto:info@energymagic.net">
                            Send Email
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path d="M5 12h14M12 5l7 7-7 7" />
                            </svg>
                        </a>
                    </article>

                    <article class="contact-info-card reveal reveal-d2">
                        <div class="contact-info-card__icon" aria-hidden="true">
                            <svg viewBox="0 0 24 24" fill="none" stroke-width="1.75" stroke-linecap="round"
                                stroke-linejoin="round">
                                <path
                                    d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013 6.07 2 2 0 014.11 4h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L8.09 11a16 16 0 006.29 6.29l.62-1.24a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 16.92z" />
                            </svg>
                        </div>
                        <div class="contact-info-card__content">
                            <span class="contact-info-card__label">Call Us</span>
                            <h2 class="contact-info-card__title">Speak to Our Team</h2>
                            <p class="contact-info-card__body">
                                Main line:<br>
                                <a href="tel:+96264163824">+ 06 4163824</a><br><br>
                                Mobile:<br>
                                <a href="tel:+962796564266">+962-796564266</a><br><br>
                                Sun-Thu: 9AM - 6PM
                            </p>
                        </div>
                        <a class="contact-info-card__action" href="tel:+96264163824">
                            Call Now
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path d="M5 12h14M12 5l7 7-7 7" />
                            </svg>
                        </a>
                    </article>
                </div>
            </div>
        </section>

        <section class="contact-map-section">
            <div class="contact-page-container">
                <div class="contact-section-heading reveal">
                    <span class="contact-section-heading__tag">Find Us</span>
                    <h2 class="contact-section-heading__title">Our Location</h2>
                </div>

                <div class="reveal">
                    <div class="contact-map-frame">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d11058.673513265241!2d35.876419951560756!3d31.985239966858547!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x151ca1699539b3d7%3A0xe7476a0d707100bd!2sMagic%20Energy%20%26%20Power%20Systems%20MEPCO!5e0!3m2!1sen!2sjo!4v1771823738368!5m2!1sen!2sjo"
                            allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"
                            title="Magic Energy and Power Systems location"></iframe>

                        <div class="contact-map-pin">
                            <div class="contact-map-pin__name">Jordan Office</div>
                            <div class="contact-map-pin__address">
                                Wasfi Al-Tall St.<br>
                                Al-Faysaliya Complex<br>
                                3 floor, office 301
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="contact-form-section" id="contact-form-section">
            <div class="contact-page-container">
                <div class="contact-form-layout">
                    <div class="contact-form-intro reveal">
                        <span class="contact-section-heading__tag">Get in Touch</span>
                        <h2 class="contact-section-heading__title contact-form-intro__title">Send Us a Message</h2>
                        <p class="contact-form-intro__text">
                            Whether you are looking for product information, technical guidance, or after-sales support,
                            our team typically responds as soon as possible during business hours.
                        </p>

                        <div class="contact-form-hours">
                            <div class="contact-form-hours__title">Business Hours</div>
                            <div class="contact-form-hours__row">
                                <span>Sunday - Thursday</span>
                                <span>9:00 AM - 6:00 PM</span>
                            </div>
                            <div class="contact-form-hours__row">
                                <span>Friday - Saturday</span>
                                <span>Closed</span>
                            </div>
                            <div class="contact-form-hours__row">
                                <span>Timezone</span>
                                <span>Jordan Time (UTC +3)</span>
                            </div>
                            <div class="contact-form-hours__row">
                                <span>Quick Answers</span>
                                <span><a href="{{ route('faq') }}">Visit FAQ</a></span>
                            </div>
                        </div>
                    </div>

                    <div class="contact-form-pane reveal reveal-d1">
                        <div class="contact-form-success" id="formSuccess" role="alert" aria-live="polite">
                            <strong>Message sent.</strong> Thank you for reaching out. Our team will get back to you soon.
                        </div>

                        <form class="contact-form" id="contactForm" novalidate>
                            <div class="contact-form__row">
                                <div class="contact-field">
                                    <label for="firstName">First Name <span class="req">*</span></label>
                                    <input type="text" id="firstName" name="first_name" placeholder="John" required>
                                    <p class="contact-field__error">Please enter your first name.</p>
                                </div>

                                <div class="contact-field">
                                    <label for="lastName">Last Name <span class="req">*</span></label>
                                    <input type="text" id="lastName" name="last_name" placeholder="Doe" required>
                                    <p class="contact-field__error">Please enter your last name.</p>
                                </div>
                            </div>

                            <div class="contact-form__row">
                                <div class="contact-field">
                                    <label for="email">Email Address <span class="req">*</span></label>
                                    <input type="email" id="email" name="email" placeholder="john@example.com"
                                        required>
                                    <p class="contact-field__error">Please enter a valid email address.</p>
                                </div>

                                <div class="contact-field">
                                    <label for="phone">Phone Number</label>
                                    <input type="tel" id="phone" name="phone" placeholder="+962 79 123 4567">
                                </div>
                            </div>

                            <div class="contact-field">
                                <label for="company">Company / Organisation</label>
                                <input type="text" id="company" name="company" placeholder="Your company name">
                            </div>

                            <div class="contact-field">
                                <label for="subject">Subject <span class="req">*</span></label>
                                <select id="subject" name="subject" required>
                                    <option value="" selected disabled>Select a topic...</option>
                                    <option value="general">General Inquiry</option>
                                    <option value="support">Technical Support</option>
                                    <option value="sales">Sales & Pricing</option>
                                    <option value="after-sales">Warranty & After-Sales</option>
                                    <option value="training">Training & Certification</option>
                                    <option value="other">Other</option>
                                </select>
                                <p class="contact-field__error">Please select a subject.</p>
                            </div>

                            <div class="contact-field">
                                <label for="message">Message <span class="req">*</span></label>
                                <textarea id="message" name="message" rows="6" placeholder="Tell us how we can help..." required></textarea>
                                <p class="contact-field__error">Please enter your message.</p>
                            </div>

                            <div class="contact-form__footer">
                                <p class="contact-form__note">
                                    Need fast help? Review our <a href="{{ route('faq') }}">FAQ page</a> for common
                                    questions.
                                </p>

                                <button type="submit" class="contact-submit-btn" id="submitBtn">
                                    <span class="contact-submit-btn__text" id="submitBtnText">Send Message</span>
                                    <span class="contact-submit-btn__loading d-none"
                                        id="submitBtnLoading">Sending...</span>
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                        <line x1="22" y1="2" x2="11" y2="13" />
                                        <polygon points="22 2 15 22 11 13 2 9 22 2" />
                                    </svg>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('contact_script')
    <script>
        (() => {
            const form = document.getElementById('contactForm');
            const successBox = document.getElementById('formSuccess');
            const submitBtn = document.getElementById('submitBtn');
            const submitBtnText = document.getElementById('submitBtnText');
            const submitBtnLoading = document.getElementById('submitBtnLoading');
            const revealItems = document.querySelectorAll('.contact-page-shell .reveal');

            if (revealItems.length && 'IntersectionObserver' in window) {
                const observer = new IntersectionObserver((entries) => {
                    entries.forEach((entry) => {
                        if (!entry.isIntersecting) {
                            return;
                        }

                        entry.target.classList.add('visible');
                        observer.unobserve(entry.target);
                    });
                }, {
                    threshold: 0.1,
                    rootMargin: '-30px'
                });

                revealItems.forEach((item) => observer.observe(item));
            } else {
                revealItems.forEach((item) => item.classList.add('visible'));
            }

            if (!form) {
                return;
            }

            const fields = Array.from(form.querySelectorAll('input, select, textarea'));

            function validateField(field) {
                const fieldWrap = field.closest('.contact-field');

                if (!fieldWrap) {
                    return true;
                }

                const isValid = field.checkValidity();
                fieldWrap.classList.toggle('is-invalid', !isValid);

                return isValid;
            }

            fields.forEach((field) => {
                field.addEventListener('blur', () => validateField(field));
                field.addEventListener('input', () => {
                    if (field.closest('.contact-field')?.classList.contains('is-invalid')) {
                        validateField(field);
                    }
                });
                field.addEventListener('change', () => validateField(field));
            });

            form.addEventListener('submit', (event) => {
                event.preventDefault();

                successBox.classList.remove('show');

                const isFormValid = fields.every((field) => validateField(field));

                if (!isFormValid) {
                    const firstInvalidField = form.querySelector(
                        '.contact-field.is-invalid input, .contact-field.is-invalid select, .contact-field.is-invalid textarea'
                    );
                    firstInvalidField?.focus();
                    return;
                }

                submitBtn.disabled = true;
                submitBtnText.classList.add('d-none');
                submitBtnLoading.classList.remove('d-none');

                window.setTimeout(() => {
                    form.reset();
                    form.querySelectorAll('.contact-field').forEach((fieldWrap) => fieldWrap.classList
                        .remove('is-invalid'));
                    submitBtn.disabled = false;
                    submitBtnText.classList.remove('d-none');
                    submitBtnLoading.classList.add('d-none');
                    successBox.classList.add('show');
                    successBox.scrollIntoView({
                        behavior: 'smooth',
                        block: 'nearest'
                    });
                }, 900);
            });
        })();
    </script>
@endsection

@section('contact_style')
    <style>
        .contact-page-shell {
            --contact-red: #c8102e;
            --contact-red-dark: #a00c24;
            --contact-black: #111111;
            --contact-light: #f5f5f3;
            --contact-gray: #6b6b6b;
            --contact-white: #ffffff;
            --contact-border: #ebebeb;
            background: var(--contact-light);
            color: var(--contact-black);
            overflow-x: hidden;
        }

        .contact-page-shell *,
        .contact-page-shell *::before,
        .contact-page-shell *::after {
            box-sizing: border-box;
        }

        .contact-page-container {
            width: min(1280px, calc(100% - 48px));
            margin: 0 auto;
        }

        .contact-page-header {
            background: var(--contact-black);
            padding: 6rem 0;
            position: relative;
            overflow: hidden;
        }

        .contact-page-header::before {
            content: 'CONTACT';
            position: absolute;
            right: -1rem;
            top: 50%;
            transform: translateY(-50%);
            font-size: clamp(5rem, 13vw, 11rem);
            font-weight: 800;
            line-height: 1;
            letter-spacing: 0.08em;
            color: rgba(255, 255, 255, 0.04);
            pointer-events: none;
            user-select: none;
            white-space: nowrap;
        }

        .contact-page-header__inner {
            width: min(1280px, calc(100% - 48px));
            margin: 0 auto;
            position: relative;
            z-index: 1;
        }

        .contact-page-breadcrumb {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 1rem;
            font-size: 0.75rem;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: rgba(255, 255, 255, 0.45);
        }

        .contact-page-breadcrumb a {
            color: rgba(255, 255, 255, 0.45);
            text-decoration: none;
            transition: color 0.2s ease;
        }

        .contact-page-breadcrumb a:hover {
            color: var(--contact-red);
        }

        .contact-page-title {
            margin: 0;
            color: var(--contact-white);
            font-size: clamp(2.5rem, 5vw, 4rem);
            line-height: 1;
            letter-spacing: 0.04em;
            text-transform: uppercase;
        }

        .contact-page-title em {
            color: var(--contact-red);
            font-style: normal;
        }

        .contact-page-subtitle {
            margin: 0.75rem 0 0;
            max-width: 560px;
            color: rgba(255, 255, 255, 0.6);
            font-size: 0.95rem;
            line-height: 1.8;
        }

        .contact-info-section,
        .contact-map-section,
        .contact-form-section {
            padding: 5rem 0;
        }

        .contact-info-section,
        .contact-form-section {
            background: var(--contact-white);
        }

        .contact-map-section {
            background: var(--contact-light);
        }

        .contact-info-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 1.5rem;
        }

        .contact-info-card {
            display: flex;
            flex-direction: column;
            gap: 1.25rem;
            min-height: 100%;
            padding: 2.25rem 2rem;
            background: var(--contact-light);
            border: 1px solid var(--contact-border);
            border-top: 3px solid var(--contact-red);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .contact-info-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.08);
        }

        .contact-info-card__icon {
            width: 44px;
            height: 44px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: var(--contact-black);
            color: var(--contact-white);
        }

        .contact-info-card__icon svg {
            width: 20px;
            height: 20px;
            stroke: currentColor;
        }

        .contact-info-card__label,
        .contact-section-heading__tag,
        .contact-form-hours__title,
        .contact-field label {
            display: block;
            font-size: 0.7rem;
            font-weight: 700;
            letter-spacing: 0.2em;
            text-transform: uppercase;
        }

        .contact-info-card__label,
        .contact-section-heading__tag {
            color: var(--contact-red);
            margin-bottom: 0.5rem;
        }

        .contact-info-card__title,
        .contact-section-heading__title {
            margin: 0;
            color: var(--contact-black);
            font-size: clamp(1.6rem, 3vw, 2.5rem);
            line-height: 1.2;
        }

        .contact-info-card__title {
            font-size: 1.1rem;
            margin-bottom: 0.35rem;
        }

        .contact-info-card__body,
        .contact-form-intro__text,
        .contact-form__note {
            color: var(--contact-gray);
            font-size: 0.92rem;
            line-height: 1.8;
        }

        .contact-info-card__body {
            margin: 0;
        }

        .contact-info-card__body a,
        .contact-form-hours__row a,
        .contact-form__note a {
            color: inherit;
            text-decoration: none;
            transition: color 0.2s ease;
        }

        .contact-info-card__body a:hover,
        .contact-form-hours__row a:hover,
        .contact-form__note a:hover {
            color: var(--contact-red);
        }

        .contact-info-card__action {
            display: inline-flex;
            align-items: center;
            gap: 0.45rem;
            margin-top: auto;
            color: var(--contact-red);
            font-size: 0.82rem;
            font-weight: 700;
            letter-spacing: 0.05em;
            text-decoration: none;
            transition: gap 0.2s ease;
        }

        .contact-info-card__action:hover {
            gap: 0.7rem;
        }

        .contact-info-card__action svg {
            width: 14px;
            height: 14px;
        }

        .contact-section-heading {
            margin-bottom: 2.5rem;
        }

        .contact-map-frame {
            position: relative;
            width: 100%;
            height: 480px;
            overflow: hidden;
            border: 1px solid var(--contact-border);
            background: #e8e8e4;
        }

        .contact-map-frame iframe {
            width: 100%;
            height: 100%;
            border: 0;
            display: block;
            filter: grayscale(20%) contrast(1.05);
        }

        .contact-map-pin {
            position: absolute;
            top: 1.5rem;
            left: 1.5rem;
            z-index: 1;
            max-width: 240px;
            padding: 1rem 1.25rem;
            background: var(--contact-white);
            border-left: 3px solid var(--contact-red);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.12);
        }

        .contact-map-pin__name {
            margin-bottom: 0.4rem;
            color: var(--contact-red);
            font-size: 0.7rem;
            font-weight: 700;
            letter-spacing: 0.2em;
            text-transform: uppercase;
        }

        .contact-map-pin__address {
            color: var(--contact-black);
            font-size: 0.85rem;
            line-height: 1.7;
        }

        .contact-form-section {
            padding-bottom: 6rem;
        }

        .contact-form-layout {
            display: grid;
            grid-template-columns: minmax(0, 1fr) minmax(0, 1.55fr);
            gap: 5rem;
            align-items: start;
        }

        .contact-form-intro__title {
            margin-bottom: 1.25rem;
        }

        .contact-form-intro__text {
            margin: 0 0 2rem;
        }

        .contact-form-hours {
            padding-top: 1.5rem;
            border-top: 1px solid var(--contact-border);
        }

        .contact-form-hours__title {
            margin-bottom: 0.875rem;
            color: var(--contact-black);
        }

        .contact-form-hours__row {
            display: flex;
            justify-content: space-between;
            gap: 1rem;
            padding: 0.45rem 0;
            border-bottom: 1px solid var(--contact-border);
            color: var(--contact-black);
            font-size: 0.88rem;
        }

        .contact-form-hours__row:last-child {
            border-bottom: 0;
        }

        .contact-form-hours__row span:last-child {
            color: var(--contact-gray);
        }

        .contact-form-pane {
            min-width: 0;
        }

        .contact-form-success {
            display: none;
            margin-bottom: 1.25rem;
            padding: 1.25rem 1.5rem;
            background: var(--contact-light);
            border: 1px solid var(--contact-border);
            border-left: 3px solid var(--contact-red);
            color: var(--contact-black);
            font-size: 0.92rem;
            line-height: 1.7;
        }

        .contact-form-success.show {
            display: block;
        }

        .contact-form-success strong {
            color: var(--contact-red);
        }

        .contact-form {
            display: flex;
            flex-direction: column;
            gap: 1.25rem;
        }

        .contact-form__row {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 1.25rem;
        }

        .contact-field {
            display: flex;
            flex-direction: column;
            gap: 0.4rem;
        }

        .contact-field label {
            color: var(--contact-black);
        }

        .contact-field .req {
            color: var(--contact-red);
        }

        .contact-field input,
        .contact-field select,
        .contact-field textarea {
            width: 100%;
            padding: 0.85rem 1rem;
            border: 1.5px solid var(--contact-border);
            background: var(--contact-light);
            color: var(--contact-black);
            font: inherit;
            outline: none;
            transition: border-color 0.2s ease, background 0.2s ease;
            appearance: none;
        }

        .contact-field input::placeholder,
        .contact-field textarea::placeholder {
            color: #b8b8b8;
        }

        .contact-field select {
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='10' height='6' viewBox='0 0 10 6'%3E%3Cpath d='M0 0l5 6 5-6z' fill='%236B6B6B'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 1rem center;
            cursor: pointer;
        }

        .contact-field textarea {
            min-height: 150px;
            resize: vertical;
            line-height: 1.6;
        }

        .contact-field input:focus,
        .contact-field select:focus,
        .contact-field textarea:focus {
            border-color: var(--contact-red);
            background: var(--contact-white);
        }

        .contact-field.is-invalid input,
        .contact-field.is-invalid select,
        .contact-field.is-invalid textarea {
            border-color: var(--contact-red);
            background: #fff7f8;
        }

        .contact-field__error {
            display: none;
            margin: 0;
            color: var(--contact-red);
            font-size: 0.78rem;
        }

        .contact-field.is-invalid .contact-field__error {
            display: block;
        }

        .contact-form__footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
            flex-wrap: wrap;
            padding-top: 0.5rem;
        }

        .contact-form__note {
            margin: 0;
            max-width: 420px;
        }

        .contact-submit-btn {
            display: inline-flex;
            align-items: center;
            gap: 0.65rem;
            border: 0;
            padding: 0.95rem 2.5rem;
            background: var(--contact-red);
            color: var(--contact-white);
            font: inherit;
            font-size: 0.86rem;
            font-weight: 700;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            cursor: pointer;
            transition: background 0.2s ease, transform 0.2s ease;
        }

        .contact-submit-btn:hover {
            background: var(--contact-red-dark);
            transform: translateY(-1px);
        }

        .contact-submit-btn:disabled {
            opacity: 0.7;
            cursor: wait;
            transform: none;
        }

        .contact-submit-btn svg {
            width: 16px;
            height: 16px;
        }

        .d-none {
            display: none !important;
        }

        .reveal {
            opacity: 0;
            transform: translateY(24px);
            transition: opacity 0.6s ease, transform 0.6s ease;
        }

        .reveal.visible {
            opacity: 1;
            transform: translateY(0);
        }

        .reveal-d1 {
            transition-delay: 0.1s;
        }

        .reveal-d2 {
            transition-delay: 0.2s;
        }

        @media (max-width: 991.98px) {

            .contact-info-grid,
            .contact-form-layout {
                grid-template-columns: 1fr;
            }

            .contact-form-layout {
                gap: 3rem;
            }
        }

        @media (max-width: 767.98px) {

            .contact-page-container,
            .contact-page-header__inner {
                width: min(100% - 32px, 1280px);
            }

            .contact-page-header {
                padding: 5.5rem 0;
            }

            .contact-info-section,
            .contact-map-section,
            .contact-form-section {
                padding: 4rem 0;
            }

            .contact-form__row {
                grid-template-columns: 1fr;
            }

            .contact-map-frame {
                height: 340px;
            }

            .contact-map-pin {
                display: none;
            }
        }
    </style>
@endsection
