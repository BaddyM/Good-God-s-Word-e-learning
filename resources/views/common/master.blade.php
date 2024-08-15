@php
    $brand_name = "Good God's Word Ministries International";
    $motto = "Deepen your understanding of the bible with $brand_name";
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield("title")</title>
    <link rel="shortcut icon" href="jubra_logo.png" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('css/aos.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    <link rel="stylesheet" href="{{ asset('css/datatable.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/flatpickr.css') }}">
    <link rel="stylesheet" href="{{ asset('css/fontawesome/css/all.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap-icons/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('css/swiper-bundle.css') }}">
    <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">
    <link rel="stylesheet" href="{{ asset('css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('css/toasttui.css') }}">
</head>
<body>
    <div class="body_container">
        <div class="nav-bar">
            <div class="text-end close-menu">
                <button class="btn border-0"><i class="fa fa-x h1 text-white"></i></button>
            </div>
            <div class="text-center">
                <i class="bi bi-person-fill text-white" style="font-size: 100px;"></i>
                <p class="h4 text-white mb-0 fw-bold">User: <span>Arnold</span></p>
            </div>
            <ul>
                <a href="{{ route('home') }}"><li><i class="bi bi-house-fill"></i> Home</li></a>
                <a href="{{ route('courses') }}"><li><i class="bi bi-book-half"></i> Courses</li></a>
                <a href="{{ route('password.index') }}"><li><i class="bi bi-key-fill"></i> Password</li></a>
                <a href="{{ route('profile.index') }}"><li><i class="bi bi-person-fill"></i> My Profile</li></a>
                <form action="" method="post">
                    @csrf
                    <button class="btn rounded-4 bg-gradient fw-bold btn-warning">Logout <i class="bi bi-lock"></i></button>
                </form>
            </ul>
        </div>
        <div class="body-section">
            <div class="bg-gradient">
                <div></div>
                <p class="mb-0 text-center">
                    {{ $brand_name }}
                </p>
                <div class="d-flex align-items-center">
                    <button class="menu">
                        <div></div>
                        <div></div>
                        <div></div>
                        <div></div>
                    </button>
                </div>
            </div>
            <div class="bg-light p-2 fst-italic mt-3">
                <marquee behavior="" direction="">
                    "{{ $motto }}"
                </marquee>
            </div>
            <div>@yield("body")</div>            
        </div>
        @include("common.alert")
    </div>
    
    <div class="bg-light p-3 text-center mt-4">
        <p class="mb-0"><i class="bi bi-c-circle"></i> Copyright {{ date("Y", strtotime(now())) }}</p>
    </div>

    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.js') }}"></script>
    <script src="{{ asset('js/chart.js') }}"></script>
    <script src="{{ asset('js/datatable.min.js') }}"></script>
    <script src="{{ asset('js/aos.js') }}"></script>
    <script src="{{ asset('js/flatpickr.js') }}"></script>
    <script src="{{ asset('js/purecounter_vanilla.js') }}"></script>
    <script src="{{ asset('js/swiper-bundle.js') }}"></script>
    <script src="{{ asset('js/toasttui.js') }}"></script>
    <script>
        $(document).ready(function(){
            $(".menu").on("click",function(e){
                e.preventDefault();
                $(".nav-bar").addClass("is_open");
            });

            $(".close-menu").on("click",function(e){
                e.preventDefault();
                $(".nav-bar").removeClass("is_open");
            });
        })
    </script>
    @stack("scripts")
</body>
</html>