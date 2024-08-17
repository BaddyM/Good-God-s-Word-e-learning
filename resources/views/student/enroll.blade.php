@extends('common.master')

@section('title')
    Enroll
@endsection

@section('body')
    <div class="container-fluid pt-3 landing">
        <form id="enroll_course" method="post">
            @csrf
            <input type="hidden" name="course_id" value="{{ $course->course_id }}">
            <div class="col-md-7">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-2" style="gap:10px;">
                            <p class="mb-0 fw-bold h6 bg-secondary col-md-3 p-2 text-white rounded-1">Level </p>
                            <input type="text" name="course_level" value="{{ $course->course_level }}" readonly
                                class="form-control rounded-0 bg-light">
                        </div>
                        <div class="d-flex align-items-center mb-2" style="gap:10px;">
                            <p class="mb-0 fw-bold h6 bg-secondary col-md-3 p-2 text-white rounded-1">Tutor </p>
                            <input type="text" value="{{ $course->lname . ' ' . $course->fname }}" readonly
                                class="form-control rounded-0 bg-light">
                        </div>
                        <div class="d-flex align-items-center mb-2" style="gap:10px;">
                            <p class="mb-0 fw-bold h6 bg-secondary col-md-3 p-2 text-white rounded-1">Cost </p>
                            <input type="text" name="amount" value='{{ number_format($course->level_price) }}' readonly
                                class="form-control rounded-0 bg-light">
                        </div>
                        <div class="mb-2" style="gap:10px;">
                            <p class="mb-2 fw-bold h6">Payment Method</p>
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="home-tab" data-bs-toggle="tab"
                                        data-bs-target="#home" type="button" role="tab" aria-controls="home"
                                        aria-selected="true">
                                        MTN
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile"
                                        type="button" role="tab" aria-controls="profile" aria-selected="false">
                                        Airtel
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="messages-tab" data-bs-toggle="tab"
                                        data-bs-target="#messages" type="button" role="tab" aria-controls="messages"
                                        aria-selected="false">
                                        Debit/Credit Card
                                    </button>
                                </li>
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div class="tab-pane active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                    <div class="d-flex align-items-center my-3" style="gap:10px;">
                                        <label class="form-label h6 fw-bold">MTN Mobile Money</label>
                                        <input type="radio" class="form-check-radio" style="width:20px; height:20px;"
                                            name="payment_method" value="MTN">
                                    </div>
                                </div>
                                <div class="tab-pane" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                    <div class="d-flex align-items-center my-3" style="gap:10px;">
                                        <label class="form-label h6 fw-bold">Airtel Money</label>
                                        <input type="radio" class="form-check-radio" style="width:20px; height:20px;"
                                            name="payment_method" value="Airtel">
                                    </div>
                                </div>
                                <div class="tab-pane" id="messages" role="tabpanel" aria-labelledby="messages-tab">
                                    <div class="d-flex align-items-center my-3" style="gap:10px;">
                                        <label class="form-label h6 fw-bold">Debit/Credit Card</label>
                                        <input type="radio" class="form-check-radio" style="width:20px; height:20px;"
                                            name="payment_method" value="Debit/Credit Card">
                                    </div>
                                    <div>
                                        <div class="col-md-8">
                                            <div class="card border-0 shadow rounded-3">
                                                <div class="card-body">
                                                    <div class="debit_card">
                                                        <label class="form-label fw-bold h6">Card Number</label>
                                                        <div class="d-flex">
                                                            @for ($i = 1; $i <= 4; $i++)
                                                                <input type="text" maxlength="1">
                                                            @endfor
                                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                            @for ($i = 1; $i <= 4; $i++)
                                                                <input type="text" maxlength="1">
                                                            @endfor
                                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                            @for ($i = 1; $i <= 4; $i++)
                                                                <input type="text" maxlength="1">
                                                            @endfor
                                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                            @for ($i = 1; $i <= 4; $i++)
                                                                <input type="text" maxlength="1">
                                                            @endfor
                                                        </div>
                                                    </div>
                                                    <div class="debit_card">
                                                        <label class="form-label fw-bold h6">Security Number</label>
                                                        <div class="d-flex">
                                                            @for ($i = 1; $i <= 3; $i++)
                                                                <input type="text" maxlength="1">
                                                            @endfor
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <button class="submit-btn" type="submit">Confirm</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $("#enroll_course").on("submit", function(e) {
                e.preventDefault();
                const confirm_enroll = confirm("Are you sure?");
                if (confirm_enroll == true) {
                    $.ajax({
                        type: "POST",
                        url: "{{ route('course.enroll.start') }}",
                        data: new FormData(this),
                        processData: false,
                        contentType: false,
                        cache: false,
                        success: function(response) {
                            var status = response.status;
                            $("#alert_modal").modal("show");
                            $("#alert_body").text(response.response);
                            setTimeout(() => {
                                $("#alert_modal").modal("hide");
                            }, 2000);
                            if (status == 200) {
                                setTimeout(() => {
                                    location.replace("{{ route('courses') }}");
                                }, 2500);
                            }
                        },
                        error: function() {
                            $("#alert_modal").modal("show");
                            $("#alert_body").text("Failed to Enroll for Course!");
                            setTimeout(() => {
                                $("#alert_modal").modal("hide");
                            }, 2000);
                        }
                    });
                }
            });
        })
    </script>
@endpush
