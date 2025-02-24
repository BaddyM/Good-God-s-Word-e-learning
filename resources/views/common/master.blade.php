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
    <title>@yield('title')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="shortcut icon" href="{{ asset('images/logo.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('css/aos.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    <link rel="stylesheet" href="{{ asset('css/datatable.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/flatpickr.css') }}">
    <link rel="stylesheet" href="{{ asset('css/fontawesome/css/all.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap-icons/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">
    <link rel="stylesheet" href="{{ asset('css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('css/toasttui.css') }}">
    <link href="{{ asset('css/video-js.css') }}" rel="stylesheet" />
</head>

<body>
    @if (Auth::user()->is_student == 1)
        <div class="body_container">
            <div class="nav-bar">
                <div class="text-end close-menu">
                    <button class="btn border-0"><i class="fa fa-x h1 text-white"></i></button>
                </div>
                <div class="text-center">
                    <i class="bi bi-person-fill text-white" style="font-size: 100px;"></i>
                    <p class="h4 text-white mb-0 fw-bold"><span>{{ Auth::user()->lname." ".Auth::user()->fname }}</span></p>
                    <hr style="color:white;" class="my-3">
                </div>
                <ul>
                    <a href="{{ route('home') }}">
                        <li><i class="bi bi-house-fill"></i> Home</li>
                    </a>
                    <a href="{{ route('courses') }}">
                        <li><i class="bi bi-book-half"></i> Courses</li>
                    </a>
                    <a href="{{ route('password.index') }}">
                        <li><i class="bi bi-key-fill"></i> Password</li>
                    </a>
                    <a href="{{ route('profile.index') }}">
                        <li><i class="bi bi-person-fill"></i> My Profile</li>
                    </a>
                    <form action="{{ route('logout') }}" method="post">
                        @csrf
                        <button class="btn rounded-4 bg-gradient fw-bold btn-warning">Logout <i
                                class="bi bi-lock"></i></button>
                    </form>
                </ul>
            </div>
            <div class="body-section">
                <div class="bg-gradient shadow">
                    <div></div>
                    <p class="mb-0 text-center">
                        {{ $brand_name }}
                    </p>
                    <div class="email_container">
                        <div><a href="{{ route('messages.index') }}" class="nav-link"><i class="bi bi-envelope"></i></a></div>
                        <div class="rounded-5 justify-content-center align-items-center" id="email_counter"></div>
                    </div>
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
                <div>@yield('body')</div>
            </div>
            @include('common.alert')
        </div>{{-- Student Dashboard --}}

    @elseif(Auth::user()->is_tutor == 1)
        <div class="body_container">
            <div class="nav-bar">
                <div class="text-end close-menu">
                    <button class="btn border-0"><i class="fa fa-x h1 text-white"></i></button>
                </div>
                <div class="text-center">
                    <i class="bi bi-person-fill text-white" style="font-size: 100px;"></i>
                    <p class="h4 text-white mb-0 fw-bold"><span>{{ Auth::user()->lname." ".Auth::user()->fname }}</span></p>
                    <hr style="color:white;" class="my-3">
                </div>
                <ul>
                    <a href="{{ route('home') }}">
                        <li><i class="bi bi-house-fill"></i> Home</li>
                    </a>
                    <a href="{{ route('tutor.course') }}">
                        <li><i class="bi bi-book-half"></i> Courses</li>
                    </a>
                    <a href="{{ route('password.index') }}">
                        <li><i class="bi bi-key-fill"></i> Password</li>
                    </a>
                    <a href="{{ route('profile.index') }}">
                        <li><i class="bi bi-person-fill"></i> My Profile</li>
                    </a>
                    <form action="{{ route('logout') }}" method="post">
                        @csrf
                        <button class="btn rounded-4 bg-gradient fw-bold btn-warning">Logout <i
                                class="bi bi-lock"></i></button>
                    </form>
                </ul>
            </div>
            <div class="body-section">
                <div class="bg-gradient">
                    <div></div>
                    <p class="mb-0 text-center">
                        {{ $brand_name }}
                    </p>
                    <div class="email_container">
                        <div><a href="{{ route('messages.index') }}" class="nav-link"><i class="bi bi-envelope"></i></a></div>
                        <div class="rounded-5 justify-content-center align-items-center" id="email_counter"></div>
                    </div>
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
                <div>@yield('body')</div>
            </div>
            @include('common.alert')
        </div>{{-- Tutor Dashboard --}}        
    @elseif(Auth::user()->is_admin == 1)
    <div class="body_container">
        <div class="nav-bar">
            <div class="text-end close-menu">
                <button class="btn border-0"><i class="fa fa-x h1 text-white"></i></button>
            </div>
            <div class="text-center">
                <i class="bi bi-person-fill text-white" style="font-size: 100px;"></i>
                <p class="h4 text-white mb-0 fw-bold"><span>{{ Auth::user()->lname." ".Auth::user()->fname }}</span></p>
                <hr style="color:white;" class="my-3">
            </div>
            <ul>
                <a href="{{ route('home') }}">
                    <li><i class="bi bi-house-fill"></i> Home</li>
                </a>
                <a href="{{ route('tutor.course') }}">
                    <li><i class="bi bi-book-half"></i> Courses</li>
                </a>
                <a href="{{ route('levels.index') }}">
                    <li><i class="fa fa-signal"></i> Levels</li>
                </a>
                <a href="{{ route('accounts.list') }}">
                    <li><i class="bi bi-people-fill"></i> Accounts</li>
                </a>
                <a href="{{ route('enrollment') }}">
                    <li><i class="bi bi-arrow-repeat"></i> Enrollment</li>
                </a>
                <a href="{{ route('password.index') }}">
                    <li><i class="bi bi-key-fill"></i> Password</li>
                </a>
                <a href="{{ route('profile.index') }}">
                    <li><i class="bi bi-person-fill"></i> My Profile</li>
                </a>
                <form action="{{ route('logout') }}" method="post">
                    @csrf
                    <button class="btn rounded-4 bg-gradient fw-bold btn-warning">Logout <i
                            class="bi bi-lock"></i></button>
                </form>
            </ul>
        </div>
        <div class="body-section">
            <div class="bg-gradient">
                <div></div>
                <p class="mb-0 text-center">
                    {{ $brand_name }}
                </p>
                <div class="email_container">
                    <div><a href="{{ route('messages.index') }}" class="nav-link"><i class="bi bi-envelope"></i></a></div>
                    <div class="rounded-5 justify-content-center align-items-center"><p class="m-0" id="email_counter"></p></div>
                </div>
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
            <div>@yield('body')</div>
        </div>
        @include('common.alert')
    </div>{{-- Tutor Dashboard --}}
    @else
        <div class="alert w-100 alert-danger p-1">
            Invalid Login
        </div>
    @endif

    <div class="bg-light p-3 text-center mt-4">
        <p class="mb-0"><i class="bi bi-c-circle"></i> Copyright {{ date('Y', strtotime(now())) }}</p>
    </div>

    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.js') }}"></script>
    <script src="{{ asset('js/chart.js') }}"></script>
    <script src="{{ asset('js/datatable.min.js') }}"></script>
    <script src="{{ asset('js/aos.js') }}"></script>
    <script src="{{ asset('js/flatpickr.js') }}"></script>
    <script src="{{ asset('js/purecounter_vanilla.js') }}"></script>
    <script src="{{ asset('js/toasttui.js') }}"></script>
    <script>
        $(document).ready(function() {
            $(".menu").on("click", function(e) {
                e.preventDefault();
                $(".nav-bar").addClass("is_open");
            });

            $(".close-menu").on("click", function(e) {
                e.preventDefault();
                $(".nav-bar").removeClass("is_open");
            });

            fetch('{{ route("email.counter") }}')
            .then((res) => res.json())
            .then((data) => $("#email_counter").text(data.email_counter))
        })
    </script>
    @stack('scripts')
</body>

</html>
