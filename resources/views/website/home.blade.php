@extends('common.website')

@section('title')
    Home
@endsection

@section('body')
    <!-- service section -->
    <section class="service_section layout_padding">
        <div class="container">
            <div class="heading_container heading_center ">
                <h2 class="">
                    Our Services
                </h2>
                <p class="col-lg-8 px-0">
                    At Good God's Word Ministries, We have a variety of services we offer to all our students and they can
                    enroll <strong>now</strong> for
                    any of the services stated below.
                </p>
            </div>
            @php
                $services = [
                    [
                        'image' => 'png-clipart-tailor-sewing-machines-logo-pattern-others-angle-text-thumbnail.png',
                        'title' => 'Tailoring',
                        'content' => 'We offer tailoring services to all students that would like to become
                        good in fashion.',
                    ],
                    [
                        'image' => 'videography.png',
                        'title' => 'Videography',
                        'content' => 'We offer Videography classes to all students that would like to become
                        good in Video editing, camera and graphics in general.',
                    ],
                    [
                        'image' => 'tools.png',
                        'title' => 'Carpentry',
                        'content' => 'We offer carperntry services to all students that would like to become
                        good in making furniture.',
                    ],
                    [
                        'image' => 'book.png',
                        'title' => 'Computer Literacy',
                        'content' => 'We offer Computer Literacy classes to all students that would like to become
                        good in General Computing.',
                    ],
                    [
                        'image' => 'dancing.png',
                        'title' => 'Music, Dance and Drama',
                        'content' => 'We offer Music, Dance and Drama classes to all students that would like to become
                        good in acting.',
                    ],
                ];
            @endphp
            <div class="service_container">
                <div class="carousel-wrap ">
                    <div class="service_owl-carousel owl-carousel">
                        @foreach ($services as $service)
                            <div class="item">
                                <div class="box ">
                                    <div class="img-box">
                                        <img src="{{ asset('images/'.$service["image"].'') }}" alt="" />
                                    </div>
                                    <div class="detail-box">
                                        <h5 class="text-capitalize">
                                            {{ $service["title"] }}
                                        </h5>
                                        <p class="">
                                            {{ $service["content"] }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="btn-box">
                <a href="{{ route("courses.website.index") }}">
                    Read More
                </a>
            </div>
        </div>
    </section>

    <!-- service section ends -->

    <!-- about section -->

    <section class="about_section">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-5 offset-md-1">
                    <div class="detail-box pr-md-2">
                        <div class="heading_container">
                            <h2 class="">
                                About Us
                            </h2>
                        </div>
                        <p class="detail_p_mt">
                            GGW is a Christian ministry with a global vision of revealing Christ Jesus to all people; for salvation, transformation, equipment of the saints for the work of the ministry and other divine activities. 
                        </p>
                        <a href="{{ route("about.index") }}" class="">
                            Read More
                        </a>
                    </div>
                </div>
                <div class="col-md-6 px-0">
                    <div class="img-box ">
                        <img src="{{ asset('images/logo.png') }}" class="box_img img-fluid" alt="about img">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- about section ends -->

    <!-- team section -->

    <section class="team_section layout_padding">
        <div class="container">
            <div class="heading_container heading_center">
                <h2>
                    Our Team
                </h2>
                <p>
                    Good God's Word Ministries is up because of the following people and more. This is the group of people that make this ministry what 
                    it is and always up and running.
                </p>
            </div>
            @php
                $team_img = ["DSC_6382.JPG","1.JPG","2.JPG","DSC_6338.JPG","DSC_6350.JPG","DSC_6362.JPG","DSC_6367.JPG","DSC_6372.JPG","DSC_8057.JPG","DSC_8088.JPG"];
                $team_titles = ["Executive Director","Heads of Projects Department","Head of Missions and Outreach Department","Head of Education and Training Department","Head of Music Department","Head of Pastoral Department","A few of the Ministers' team","Missions and Outreach Team","Ministry choir members","Head of Family and Marriage affairs"];
                $team_name = ["AP. Nsubuga Thomas L.","Ddamulira Denis","Tamale Ivan","Kibirige Vicent", "Vicent Ssengendo","Paul Gizamba","","","","Jemimah Nakazzi"];
            @endphp
            <div class="row">
                @for ($i=0; $i<count($team_img); $i++)
                <div class="col-md-4 col-sm-6 mx-auto">
                    <div class="box">
                        <div class="img-box">
                            <img class="img-fluid" src="{{ asset('images/staff/'.$team_img[$i].'') }}" alt="">
                        </div>
                        <div class="detail-box">
                            <h5>
                                {{ $team_name[$i] }}
                            </h5>
                            <h6 class="">
                                {{ $team_titles[$i] }}
                            </h6>
                        </div>
                    </div>
                </div>
                @endfor
            </div>
        </div>
    </section>

    <!-- end team section -->

    <!-- contact section -->
    <section class="contact_section mb-5">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6 px-0">
                    <div class="img-box ">
                        <img src="{{ asset('images/courses/videography/4.jpg') }}" class="box_img img-fluid" alt="about img">
                    </div>
                </div>
                <div class="col-md-5 mx-auto">
                    <div class="form_container">
                        <div class="heading_container heading_center">
                            <h2>Get In Touch</h2>
                        </div>
                        <form id="contact_form">
                            <div class="form-row">
                                <div class="form-group col">
                                    <input type="text" class="form-control" placeholder="Your Name" />
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-lg-6">
                                    <input type="number" class="form-control" placeholder="Phone Number" />
                                </div>
                                <div class="form-group col-lg-6 d-none">
                                    <select name="" id="" class="form-control wide">
                                        <option value="">Select Service</option>
                                        <option value="">Service 1</option>
                                        <option value="">Service 2</option>
                                        <option value="">Service 3</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col">
                                    <input type="email" id="contact_email" class="form-control" placeholder="Email" />
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col">
                                    <input type="text" id="contact_msg" class="message-box form-control" placeholder="Message" />
                                </div>
                            </div>
                            <div class="btn_box">
                                <button type="submit">
                                    SEND
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end contact section -->

    <!-- client section -->
    <section class="client_section layout_padding d-none">
        <div class="container ">
            <div class="heading_container heading_center">
                <h2>
                    Testimonial
                </h2>
                <hr>
            </div>
            <div id="carouselExample2Controls" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <div class="row">
                            <div class="col-lg-7 col-md-9 mx-auto">
                                <div class="client_container ">
                                    <div class="img-box">
                                        <img src="{{ asset('images/client.jpg') }}" alt="">
                                    </div>
                                    <div class="detail-box">
                                        <h5>
                                            Jone Mark
                                        </h5>
                                        <p>
                                            Editors now use Lorem Ipsum as their default model text, and a search for 'lorem
                                            ipsum' will uncover many web sites still in their infancy. Various versions have
                                            evolved over the years, sometimes by
                                        </p>
                                        <span>
                                            <i class="fa fa-quote-left" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="row">
                            <div class="col-lg-7 col-md-9 mx-auto">
                                <div class="client_container ">
                                    <div class="img-box">
                                        <img src="{{ asset('images/client.jpg') }}" alt="">
                                    </div>
                                    <div class="detail-box">
                                        <h5>
                                            Jone Mark
                                        </h5>
                                        <p>
                                            Editors now use Lorem Ipsum as their default model text, and a search for 'lorem
                                            ipsum' will uncover many web sites still in their infancy. Various versions have
                                            evolved over the years, sometimes by
                                        </p>
                                        <span>
                                            <i class="fa fa-quote-left" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="row">
                            <div class="col-lg-7 col-md-9 mx-auto">
                                <div class="client_container ">
                                    <div class="img-box">
                                        <img src="{{ asset('images/client.jpg') }}" alt="">
                                    </div>
                                    <div class="detail-box">
                                        <h5>
                                            Jone Mark
                                        </h5>
                                        <p>
                                            Editors now use Lorem Ipsum as their default model text, and a search for 'lorem
                                            ipsum' will uncover many web sites still in their infancy. Various versions have
                                            evolved over the years, sometimes by
                                        </p>
                                        <span>
                                            <i class="fa fa-quote-left" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel_btn-box">
                    <a class="carousel-control-prev" href="#carouselExample2Controls" role="button" data-slide="prev">
                        <span>
                            <i class="fa fa-arrow-left" aria-hidden="true"></i>
                        </span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExample2Controls" role="button" data-slide="next">
                        <span>
                            <i class="fa fa-arrow-right" aria-hidden="true"></i>
                        </span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- end client section -->
@endsection
