    <!-- JQuery Library -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <!-- <script src="https://code.jquery.com/jquery-2.2.0.min.js" type="text/javascript"></script> -->

    <!-- Fancy Box -->
    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>

    <!-- Slick Slider JS -->
    <script src="{{ asset('style_files/frontend/js/slick.js') }}" type="text/javascript" charset="utf-8"></script>
    {{-- <script src="{{asset('style_files/frontend/js/lightSlider.min.js') }}"></script> --}}


    {{-- Animate On Scroll Library --}}
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/js/all.min.js"></script>

    <script src="{{ asset('style_files/frontend/js/three.min.js') }}"></script>

    {{-- bootstrap --}}
    <script src="{{ asset('front_end_style/js/bootstrap.min.js') }}"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"
        integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script> -->

    {{-- fancy box --}}
    <script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>

    <script src="{{ asset('style_files/frontend/js/main.js') }}" type="text/javascript"></script>


    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>


    {{--

    @vite('resources/js/app.js') --}}

    {{-- <link rel="stylesheet" href="{{ asset('style_files/frontend/sass/main.scss') }}"> --}}

    {{--
    @vite([('resources/js/app.js')]) --}}

    {{-- <script type="module" src="http://localhost:3000/@vite/client"></script>
    <script type="module" src="http://localhost:3000/resources/js/app.js"></script> --}}


    <script>
        $('[data-fancybox]').fancybox({
            // Options will go here
            buttons: [
                'close'
            ],
            wheel: false,
            transitionEffect: "slide",
            // thumbs          : false,
            // hash            : false,
            loop: true,
            // keyboard        : true,
            toolbar: false,
            // animationEffect : false,
            // arrows          : true,
            clickContent: false
        });
    </script>
    </body>

    </html>
