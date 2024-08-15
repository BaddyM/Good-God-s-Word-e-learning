@php
    $brand_name = "Good God's Word Ministries International";
    $motto = "Deepen your understanding of the bible with $brand_name";
@endphp
<!DOCTYPE html>
<html lang="en">

<head>
    <style>
        .title{
            background: rgb(210, 210, 210);
            font-weight: bold;
            color: white;
            padding: 5px;
            font-size: 16px;
            text-transform: uppercase;
        }
        .btn{
            padding: 5px 20px;
            background: rgb(108, 108, 254);
            color: white !important;
            text-decoration: none;
        }
    </style>
</head>

<body>
    <div>
        <p class="title">Verify Your email</p>
        <p>{{ $mailMessage }}</p>
        <p>Click this <a class='btn' href="{{ $verifyLink }}">Link</a> to verify your Email.</p>
        <p style="font-weight:bold;">{{ $brand_name }} Team!</p>
    </div>

    <div class="bg-light p-3 text-center mt-4">
        <p class="mb-0"><i class="bi bi-c-circle"></i> {{ $brand_name }} Copyright {{ date('Y', strtotime(now())) }}</p>
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
    <script></script>
    @stack('scripts')
</body>

</html>
