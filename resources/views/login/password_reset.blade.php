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
    <title>Forgot Password</title>
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
    <link rel="shortcut icon" href="{{ asset('images/logo.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('css/toasttui.css') }}">
</head>

<body>
    <div class="" style="background: rgb(16, 113, 248);">
        <p class="mb-0 text-center text-white fw-bold h4 py-2">Reset Password</p>
    </div>

    <div class="login_container">
        <div class="card border-0 rounded-0 shadow-sm">
            <div class="card-body">
                <form id="reset_password_form" method="post">
                    @csrf
                    <input type="hidden" name="email" value="{{ $data->email }}">
                    <div class="mb-2">
                        <label class="fw-bold h6">New Password <i style="color:red;">*</i></label>
                        <input type="password" name="password" class="form-control rounded-2" placeholder="Enter New Password"
                            required>
                    </div>
                    <button class="submit-btn mb-2" type="submit">
                        <span class="spinner-border spinner-border-sm d-none" id="spinner" role="status"
                            aria-hidden="true"></span>
                        Confirm</button>
                    <div class="mb-2 login_or">
                        <div></div>
                        <div>
                            <p class="mb-0">or</p>
                        </div>
                        <div></div>
                    </div>
                    <div class="row login_links">
                        <div class="col-md-6 mb-2"><a href="{{ route('login') }}">Login</a></div>
                        <div class="col-md-6 mb-2"><a href="{{ route('register') }}">Register</a></div>
                    </div>
                </form>
            </div>
        </div>
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
        $("#reset_password_form").on("submit", function(e) {
            e.preventDefault();
            $("#spinner").removeClass("d-none");
            $("button").prop("disabled", true);
            $.ajax({
                type: "POST",
                url: "{{ route('user.reset.password') }}",
                data: new FormData(this),
                processData: false,
                contentType: false,
                cache: false,
                success: function(response) {
                    console.log(response);
                    $("#spinner").addClass("d-none");
                    $("button").prop("disabled", false);                    
                    if (response.status != 200) {
                        $("#alert_modal").modal("show");
                        $("#alert_body").text(response.message);
                        setTimeout(() => {
                            $("#alert_modal").modal("hide");
                        }, 2000);
                    }else{
                        location.replace(response.link);
                        $("#alert_modal").modal("show");
                        $("#alert_body").text(response.message);
                        setTimeout(() => {
                            $("#alert_modal").modal("hide");
                        }, 2000);
                    }
                },
                error: function() {
                    $("#spinner").addClass("d-none");
                    $("button").prop("disabled", false);
                    $("#alert_modal").modal("show");
                    $("#alert_body").text("Failed, Try Again!");
                    setTimeout(() => {
                        $("#alert_modal").modal("hide");
                    }, 2000);
                }
            });
        });
    </script>
    @stack('scripts')
</body>

</html>
