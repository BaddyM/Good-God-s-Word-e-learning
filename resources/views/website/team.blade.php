@extends("common.website")

@section("title")
    Team
@endsection

@section("body")
    <div class="container-fluid">
        <nav class="breadcrumb my-3">
            <a class="breadcrumb-item" href="{{ route("home.index") }}">Home</a>
            <span class="breadcrumb-item active" aria-current="page">The Team</span>
        </nav>

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
    </div>
@endsection

@push("scripts")
    <script>
        $(document).ready(function(){

        });
    </script>
@endpush