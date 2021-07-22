<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
    <link rel="stylesheet" href="{{asset('font-awesome-4.7.0/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('slick/slick.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('slick/slick-theme.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('css/datepicker.css')}}"/>
    <link rel="stylesheet" href="{{asset('css/tooplate-style.css')}}">
</head>
<body>
    @yield('content')
    <script src="{{asset('js/app.js')}}"></script>
    <script src="{{asset('js/jquery-1.11.3.min.js')}}"></script>
    <script src="{{asset('js/popper.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/datepicker.min.js')}}"></script>
    <script src="{{asset('js/jquery.singlePageNav.min.js')}}"></script>
    <script src="{{asset('slick/slick.min.js')}}"></script>

    <script>

        /* Google map
        ------------------------------------------------*/
        var map = '';
        var center;

        function initialize() {
            var mapOptions = {
                zoom: 16,
                center: new google.maps.LatLng(13.7567928,100.5653741),
                scrollwheel: false
            };

            map = new google.maps.Map(document.getElementById('google-map'),  mapOptions);

            google.maps.event.addDomListener(map, 'idle', function() {
              calculateCenter();
          });

            google.maps.event.addDomListener(window, 'resize', function() {
              map.setCenter(center);
          });
        }

        function calculateCenter() {
            center = map.getCenter();
        }

        function loadGoogleMap(){
            var script = document.createElement('script');
            script.type = 'text/javascript';
            script.src = 'https://maps.googleapis.com/maps/api/js?key=AIzaSyDVWt4rJfibfsEDvcuaChUaZRS5NXey1Cs&v=3.exp&sensor=false&' + 'callback=initialize';
            document.body.appendChild(script);
        }

        function setCarousel() {

            if ($('.tm-article-carousel').hasClass('slick-initialized')) {
                $('.tm-article-carousel').slick('destroy');
            }

            if($(window).width() < 438){
                // Slick carousel
                $('.tm-article-carousel').slick({
                    infinite: false,
                    dots: true,
                    slidesToShow: 1,
                    slidesToScroll: 1
                });
            }
            else {
             $('.tm-article-carousel').slick({
                    infinite: false,
                    dots: true,
                    slidesToShow: 2,
                    slidesToScroll: 1
                });
            }
        }

        function setPageNav(){
            if($(window).width() > 991) {
                $('#tm-top-bar').singlePageNav({
                    currentClass:'active',
                    offset: 79
                });
            }
            else {
                $('#tm-top-bar').singlePageNav({
                    currentClass:'active',
                    offset: 65
                });
            }
        }

        function togglePlayPause() {
            vid = $('.tmVideo').get(0);

            if(vid.paused) {
                vid.play();
                $('.tm-btn-play').hide();
                $('.tm-btn-pause').show();
            }
            else {
                vid.pause();
                $('.tm-btn-play').show();
                $('.tm-btn-pause').hide();
            }
        }

        $(document).ready(function(){

            $(window).on("scroll", function() {
                if($(window).scrollTop() > 100) {
                    $(".tm-top-bar").addClass("active");
                } else {
                    //remove the background property so it comes transparent again (defined in your css)
                   $(".tm-top-bar").removeClass("active");
                }
            });

            // Google Map
            loadGoogleMap();

            // Date Picker
            const pickerCheckIn = datepicker('#inputCheckIn');
            const pickerCheckOut = datepicker('#inputCheckOut');

            // Slick carousel
            setCarousel();
            setPageNav();

            $(window).resize(function() {
              setCarousel();
              setPageNav();
            });

            // Close navbar after clicked
            $('.nav-link').click(function(){
                $('#mainNav').removeClass('show');
            });

            // Control video
            $('.tm-btn-play').click(function() {
                togglePlayPause();
            });

            $('.tm-btn-pause').click(function() {
                togglePlayPause();
            });

            // Update the current year in copyright
            $('.tm-current-year').text(new Date().getFullYear());
        });

    </script>
</body>
</html>
