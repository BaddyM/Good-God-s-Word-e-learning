@extends('common.master')

@section('title')
    My Course
@endsection

@section('body')
    <div class="py-2 px-1 d-none" style="background:rgb(16, 113, 248);">
        <p class="mb-0 text-white fw-bold text-uppercase">Level {{ $id = 1 }}</p>
    </div>
    <div class="container-fluid pt-3 course_material">
        @foreach ($courses as $course)
            <form id="course_form" method="post">
                @csrf
                <input type="hidden" name="code" value="{{ $course->pay_code }}">
            </form>
            <div class="accordion mb-3" id="accordionExample{{ $course->course_id }}">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingOne{{ $course->course_id }}">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapse{{ $course->course_id }}" aria-expanded="true"
                            aria-controls="collapseOne">
                            Material {{ $course->course_id }}
                        </button>
                    </h2>
                    <div id="collapse{{ $course->course_id }}" class="accordion-collapse collapse">
                        <div class="accordion-body">
                            <div class="course_description">
                                <p class="mb-1 h6">
                                    <span class="fw-bold">Tutor: </span>
                                    <span>
                                        {{ $course->lname . ' ' . $course->fname }}
                                    </span>
                                </p>
                                <hr style="color:background:rgb(16, 113, 248);">
                                <p class="mb-1 h6">
                                    <span class="fw-bold">Description: </span>
                                    <span>
                                        {{ $course->course_description }}
                                    </span>
                                </p>
                            </div>
                            <div class="materials">
                                @if ($course->type == 'video')
                                    <video controls class="video-js w-100" id="my-player"
                                        src="{{ asset("materials/$course->course_id/$course->material") }}"></video>
                                @else
                                    <img class="img-fluid"
                                        src="{{ asset("materials/$course->course_id/$course->materials") }}">
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection

@push('scripts')
    <script>
        var options = {}
        var player = videojs('my-player', options, function onPlayerReady() {
            this.play();

            // How about an event listener?
            this.on('ended', function() {
                var code = $("input[name='code']").val();
                $.ajax({
                    type: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{ route('complete.course') }}",
                    data: {
                        code: code
                    },
                    success: function(response) {
                        $("#alert_modal").modal("show");
                        $("#alert_body").text(response);
                        setTimeout(() => {
                            $("#alert_modal").modal("hide");
                        }, 2000);
                    },
                    error: function() {
                        $("#alert_modal").modal("show");
                        $("#alert_body").text("Course Incomplete");
                        setTimeout(() => {
                            $("#alert_modal").modal("hide");
                        }, 2000);
                    }
                });
            });
            var currentTime = 0;
            this.on("seeking", function(event) {
                if (currentTime < this.currentTime()) {
                    this.currentTime(currentTime);
                }
            });

            this.on("seeked", function(event) {
                if (currentTime < this.currentTime()) {
                    this.currentTime(currentTime);
                }
            });
        });
    </script>
@endpush
