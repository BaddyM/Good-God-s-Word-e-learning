<!DOCTYPE html>
<html>

<head>
    <!-- Basic -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!-- Site Metas -->
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <link rel="shortcut icon" href="{{ asset('images/logo.png') }}?v=3" type="image/x-icon">
    <title>@yield('title')</title>

    <!-- bootstrap core css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.css') }}" />

    <!-- fonts style -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <!--owl slider stylesheet -->
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
    <!-- nice select -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/css/nice-select.min.css"
        integrity="sha256-mLBIhmBvigTFWPSCtvdu6a76T+3Xyt+K571hupeFLg4=" crossorigin="anonymous" />
    <!-- font awesome style -->
    <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet" />

    <!-- Custom styles for this template -->
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet" />
    <!-- responsive style -->
    <link href="{{ asset('css/responsive.css') }}" rel="stylesheet" />
</head>

<body>

    <div class="hero_area">
        <div class="hero_bg_box">
            <img src="images/IMG-20241130-WA0006.jpg" alt="">
        </div>
        <!-- header section strats -->
        <header class="header_section">
            <div class="header_top">
                <div class="container-fluid header_top_container">

                    <div class="contact_nav">
                        <a href="">
                            <i class="fa fa-map-marker" aria-hidden="true"></i>
                            <span>
                                Gayaza - Kanyanya
                            </span>
                        </a>
                        <a href="">
                            <i class="fa fa-phone" aria-hidden="true"></i>
                            <span>
                                Call : +256754654641 or +256781831552
                            </span>
                        </a>
                        <a href="">
                            <i class="fa fa-envelope" aria-hidden="true"></i>
                            <span>
                                support@ggwministries.com
                            </span>
                        </a>
                    </div>
                    <div class="social_box">
                        <a href="">
                            <i class="fa fa-facebook" aria-hidden="true"></i>
                        </a>
                        <a href="">
                            <i class="fa fa-twitter" aria-hidden="true"></i>
                        </a>
                        <a href="">
                            <i class="fa fa-linkedin" aria-hidden="true"></i>
                        </a>
                        <a href="">
                            <i class="fa fa-instagram" aria-hidden="true"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="header_bottom">
                <div class="container-fluid">
                    <nav class="navbar navbar-expand-lg custom_nav-container ">
                        <a class="navbar-brand " href="{{ route('home.index') }}"> GGW Ministries </a>

                        <button class="navbar-toggler" type="button" data-toggle="collapse"
                            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="Toggle navigation">
                            <span class=""> </span>
                        </button>

                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav  ">
                                <li class="nav-item ">
                                    <a class="nav-link" href="{{ route('home.index') }}">Home </a>
                                </li>
                                <li class="nav-item active">
                                    <a class="nav-link" href="{{ route('about.index') }}"> About <span
                                            class="sr-only">(current)</span></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('courses.website.index') }}">Courses</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('team.index') }}"> Team </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('contact.index') }}">Contact Us</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">
                                        <i class="fa fa-user" aria-hidden="true"></i>
                                        <span>
                                            Login
                                        </span>
                                    </a>
                                </li>
                                <form class="form-inline justify-content-center d-none">
                                    <button class="btn  my-2 my-sm-0 nav_search-btn" type="submit">
                                        <i class="fa fa-search" aria-hidden="true"></i>
                                    </button>
                                </form>
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
        </header>
        <!-- end header section -->
    </div>

    @include('common.alert')

    @yield('body')

    <!-- info section -->
    <section class="info_section ">
        <div class="container">
            <div class="info_top">
                <div class="row">
                    <div class="col-md-3 ">
                        <a class="navbar-brand" href="{{ route('home.index') }}">
                            GGW Ministries
                        </a>
                    </div>
                    <div class="col-md-5 ">
                        <div class="info_contact">
                            <a href="">
                                <i class="fa fa-map-marker" aria-hidden="true"></i>
                                <span>
                                    Gayaza - Kanyanya
                                </span>
                            </a>
                            <a href="">
                                <i class="fa fa-phone" aria-hidden="true"></i>
                                <span>
                                    Call : +256754654641 or +256781831552
                                </span>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-4 ">
                        <div class="social_box">
                            <a href="">
                                <i class="fa fa-facebook" aria-hidden="true"></i>
                            </a>
                            <a href="">
                                <i class="fa fa-twitter" aria-hidden="true"></i>
                            </a>
                            <a href="">
                                <i class="fa fa-linkedin" aria-hidden="true"></i>
                            </a>
                            <a href="">
                                <i class="fa fa-instagram" aria-hidden="true"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="info_bottom">
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="info_detail">
                            <p>
                                GGW is a Christian ministry with a global vision of revealing Christ Jesus to all
                                people; for salvation, transformation, equipment of the saints for the work of the
                                ministry and other divine activities.
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="info_form">
                            <h5>
                                NEWSLETTER
                            </h5>
                            <form id="news_letter_form">
                                <input type="email" id="news_letter_email" placeholder="Enter Your Email" />
                                <button class="btn btn-outline-warning rounded-0 px-4 fw-bold bg-gradient"
                                    type="submit">
                                    Subscribe
                                </button>
                            </form>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="info_detail">
                            <h5>
                                Courses
                            </h5>
                            <p>
                                All our courses after completion come with a certificate of successful completion.
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-6">
                        <div class="">
                            <h5>
                                Useful links
                            </h5>
                            <ul class="info_menu">
                                <li>
                                    <a href="{{ route('home.index') }}">
                                        Home
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('about.index') }}">
                                        About
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('courses.website.index') }}">
                                        Courses
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route("team.index") }}">
                                        Team
                                    </a>
                                </li>
                                <li class="mb-0">
                                    <a href="{{ route("contact.index") }}">
                                        Contact Us
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- footer section -->
    <footer class="footer_section">
        <div class="container">
            <p>
                &copy; <span id="displayYear"></span> All Rights Reserved By <strong>Good God's Word
                    Ministries</strong>
            </p>
        </div>
    </footer>
    <!-- footer section -->

    <!-- jQery -->
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <!-- popper js -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <!-- bootstrap js -->
    <script src="{{ asset('js/bootstrap.js') }}"></script>
    <!-- owl slider -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <!-- nice select -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/js/jquery.nice-select.min.js"
        integrity="sha256-Zr3vByTlMGQhvMfgkQ5BtWRSKBGa2QlspKYJnkjZTmo=" crossorigin="anonymous"></script>
    <!-- custom js -->
    <script src="{{ asset('js/custom.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $("#news_letter_form").on("submit", function(e) {
                e.preventDefault();
                var news_letter_email = $("#news_letter_email").val();
                if (news_letter_email.length > 0) {
                    $("#alert_modal").modal("show");
                    $("#alert_body").text("Email received successfully");
                    setTimeout(() => {
                        $("#alert_modal").modal("hide");
                        $(this)[0].reset();
                    }, 2000);
                }
            });

            $("#contact_form").on("submit",function(e){
                e.preventDefault();
                var contact_email = $("#contact_email").val();
                var contact_msg = $("#contact_msg").val();
                if (contact_email.length > 0 && contact_msg.length > 0) {
                    $("#alert_modal").modal("show");
                    $("#alert_body").text("Message sent successfully");
                    setTimeout(() => {
                        $("#alert_modal").modal("hide");
                        $(this)[0].reset();
                    }, 2000);
                }
            });
        });
    </script>
    <!-- End Google Map -->
    @stack('scripts')
</body>

</html>
