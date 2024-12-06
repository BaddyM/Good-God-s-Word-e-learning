@extends('common.website')

@section('title')
    About
@endsection

@section('body')
    <div class="container-fluid">
        <nav class="breadcrumb my-3">
            <a class="breadcrumb-item" href="{{ route('home.index') }}">Home</a>
            <span class="breadcrumb-item active" aria-current="page">About</span>
        </nav>

        <div class="col-md-4 mb-3">
            <div class="alert alert-primary shadow-sm p-2">
                <strong>Mission</strong>
                <hr>
                <p class="mb-0">To reveal Christ in every aspect of life and realm of existence. </p>
            </div>
            <div class="alert alert-primary shadow-sm p-2">
                <strong>Vision</strong>
                <hr>
                <p class="mb-0">To bring man to God’s purpose both in eternity and the natural realm . </p>
            </div>
        </div>

        <div class="row justify-content-between">
            <div class="col-md-6 mb-3">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-warning">
                        <p class="h5 mb-0 fw-bold">Ministries</p>
                    </div>
                    <div class="card-body">
                        @php
                            $ministries = [
                                "Evangelism ministry (missions and outreaches)",
                                "Discipleship (teaching and training the saints in the word for establishment in the faith and also for the work of the ministry).",
                                "Pastoral (running the planted churches, counselling and guidance etc.)",
                                "Marriage and Family affairs ministry",
                                "Youths and Children ministry",
                                "Charity  ministry",
                                "Education and financial empowerment ministry"
                            ];
                        @endphp
                        <ul class="list-group list-group-numbered">
                            @foreach ($ministries as $m)
                                <li class="list-group-item">{{ $m }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>{{-- Ministries --}}
            <div class="col-md-6 mb-3">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-info">
                        <p class="h5 mb-0 fw-bold">Activities</p>
                    </div>
                    <div class="card-body">
                        @php
                            $activities = [
                                'Church planting, establishment and administration.',
                                'Christian Missions and outreaches. These include prisons, hospitals, schools, open air crusades, one on one evangelism etc.',
                                'Counselling and guidance.',
                                'Discipleship.',
                                'Charity.',
                                'Health camps (for sensitization, checkups and treatment).',
                                'Media. This includes social media platforms, radio and Tv programs, and publication.',
                                'Education and vocational training and management skills.',
                            ];
                        @endphp
                        <ul class="list-group list-group-numbered">
                            @foreach ($activities as $a)
                                <li class="list-group-item">{{ $a }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>{{-- Church activities --}}
        </div>

        <section class="about_section layout_padding">
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
                                GGW is a Christian ministry with a global vision of revealing Christ Jesus to all people;
                                for salvation, transformation, equipment of the saints for the work of the ministry and
                                other divine activities.
                            </p>
                        </div>
                    </div>
                    <div class="col-md-6 px-0">
                        <div class="img-box ">
                            <img src="images/logo.png" class="box_img img-fluid" alt="about img">
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- about section ends -->
    </div>
@endsection
