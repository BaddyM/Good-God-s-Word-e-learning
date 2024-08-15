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
    <div class="">
        <div class="row justify-content-between align-items-center p-1" style="background: rgb(16, 113, 248);">
            <div class="col-md-1 text-center"><img src="{{ asset("images/logo.png") }}" class="img-fluid rounded-3" style="width: 50px; height:50px;" alt=""></div>
            <div class="col-md-10"><p class="mb-0 text-center h3 py-3 text-uppercase text-white fw-bold">{{ $brand_name}}</p></div>
            <div class="col-md-1"></div>
        </div>
        <div class="container-fluid w-75 m-auto my-2">
            <div class="card border-0 rounded-0 shadow-sm">
                <div class="card-body">
                    <div class="mb-3">
                        <p>Welcome to our <strong><i>e-learning</i></strong> platform where we have a number of <strong>Tutors</strong> and <strong>resources</strong> to help you through the learning process. <br> All you need to do is enroll for each level and have access to all the resources and materials from our experiences tutors.</p>
                    </div>
                    <div>
                        <form action="{{ route('login') }}" method="get">
                            <div class="col-md-4 mb-2">
                                <label class="form-label h6 fw-bold">Login As</label>
                                <select class="form-select rounded-0" required>
                                    <option value="">Login As</option>
                                    <option value="student">Student</option>
                                    <option value="tutor">Tutor</option>
                                </select>
                            </div>
                            <button class="submit-btn" type="submit">Select</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
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
    @stack("scripts")
</body>
</html>