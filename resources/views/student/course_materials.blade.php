@extends('common.master')

@section('title')
    Level {{ $level }}
@endsection

@section('body')
    <div class="container-fluid">
        @if ($status == null)
            {{-- - First enrollment for the level --}}
            <div class="container-fluid pt-3">
                <div class="col-md-4 mb-4">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <div class="alert alert-primary">
                                <p class="mb-0">
                                    <strong>Note</strong>
                                <ol>
                                    <li>Select the Payment Method.</li>
                                    <li>Make the payment via the mobile number.</li>
                                    <li>Wait for Confirmation of Payment.</li>
                                    <li>Start Learning.</li>
                                </ol>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <form id="enroll_course" method="post">
                    @csrf
                    <input type="hidden" name="level_id" value="{{ $level }}">
                    <div class="col-md-7">
                        <div class="card shadow-sm border-0">
                            <div class="card-body">
                                <div class="d-flex align-items-center mb-2" style="gap:10px;">
                                    <p class="mb-0 fw-bold h6 bg-secondary col-md-3 p-2 text-white rounded-1">Level </p>
                                    <input type="text" name="course_level" value="{{ $level }}" readonly class="form-control rounded-0 bg-light">
                                </div>
                                <div class="d-flex align-items-center mb-2" style="gap:10px;">
                                    <p class="mb-0 fw-bold h6 bg-secondary col-md-3 p-2 text-white rounded-1">Cost </p>
                                    <input type="text" name="amount" value='{{ number_format($price) }}' readonly class="form-control rounded-0 bg-light">
                                </div>
                                <div class="mb-2" style="gap:10px;">
                                    <p class="mb-2 fw-bold h6">Payment Method</p>
                                    <!-- Nav tabs -->
                                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">
                                                MTN
                                            </button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">
                                                Airtel
                                            </button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="messages-tab" data-bs-toggle="tab" data-bs-target="#messages" type="button" role="tab" aria-controls="messages" aria-selected="false">
                                                Debit/Credit Card
                                            </button>
                                        </li>
                                    </ul>

                                    <!-- Tab panes -->
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                            <div class="d-flex align-items-center my-3" style="gap:10px;">
                                                <label class="form-label h6 fw-bold">MTN Mobile Money</label>
                                                <input type="radio" class="form-check-radio" style="width:20px; height:20px;" name="payment_method" value="MTN">
                                            </div>
                                            <div class="d-flex align-items-center" style="gap:5px;">
                                                <label class="form-label h6 fw-bold mb-0">Number</label>
                                                <input type="number" value="0781831552" class="form-control" readonly>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                            <div class="d-flex align-items-center my-3" style="gap:10px;">
                                                <label class="form-label h6 fw-bold">Airtel Money</label>
                                                <input type="radio" class="form-check-radio" style="width:20px; height:20px;" name="payment_method" value="Airtel">
                                            </div>
                                            <div class="d-flex align-items-center" style="gap:5px;">
                                                <label class="form-label h6 fw-bold mb-0">Number</label>
                                                <input type="number" value="0754654641" class="form-control" readonly>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="messages" role="tabpanel" aria-labelledby="messages-tab">
                                            <div class="d-flex align-items-center my-3" style="gap:10px;">
                                                <label class="form-label h6 fw-bold">Debit/Credit Card</label>
                                                <input type="radio" class="form-check-radio" style="width:20px; height:20px;" name="payment_method" value="Debit/Credit Card">
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
                                                                <label class="form-label fw-bold h6">Security
                                                                    Number</label>
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
        @elseif($status == 'incomplete' && $pay_status == 'confirmed')
            {{-- - Display course material - --}}
            <div class="col-md-4">
                <div class="alert alert-danger">
                    <strong>Note: </strong><br>
                    <hr class="my-1">
                    <i class="bi bi-chevron-double-right"></i> Copying or Sharing youtube links is unadvisable and will lead to closure of account with immedidate effect.
                </div>
            </div>

            <div>
                @foreach ($course as $c)
                    <div class="col-md-12 my-4">
                        <div class="card shadow-sm border-0">
                            <div class="card-header">
                                <p class="mb-0 fw-bold" id="course_{{ $c->course_id }}_timer"></p>
                            </div>
                            <iframe class="img-fluid material-video" src="https://www.youtube.com/embed/{{ $c->material }}?rel=0&modestbranding=1&showinfo=0&autohide=1" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <p class="col-md-2 fw-bold mb-0">Title</p>
                                    <p class="mb-0 col-md-8">{{ ucfirst($c->course_title) }}</p>
                                </div>
                                <hr>
                                <div class="row align-items-center">
                                    <p class="col-md-2 fw-bold mb-0">Level</p>
                                    <p class="mb-0 col-md-8">{{ ucfirst($c->course_level) }}</p>
                                </div>
                                <hr>
                                <div class="row align-items-center">
                                    <p class="col-md-2 fw-bold mb-0">Period</p>
                                    @php
                                        $hours = explode(':', $c->length)[0];
                                        $mins = explode(':', $c->length)[1];
                                    @endphp
                                    <p class="mb-0 col-md-8">{{ $hours }} hour(s) : {{ $mins }} minutes</p>
                                </div>
                                <hr>
                                <div class="row align-items-center">
                                    <p class="col-md-2 fw-bold mb-0">Course Description</p>
                                    <p class="mb-0 col-md-8">{{ ucfirst($c->course_description) }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

                @if (count($course) > 0)
                    <form id="course_complete_form" method="post">
                        @csrf
                        <input type="hidden" name="level" value="{{ $level }}">
                        <button type="submit" class="btn btn-success bg-gradient fw-bold shadow-sm"><i class="fa fa-circle-check"></i> Mark as complete</button>
                    </form>
                @else
                    <div class="alert alert-warning mt-3 col-md-4 shadow-sm">
                        <Strong>Sorry</Strong> <br>
                        <p class="mb-0">No material has been uploaded yet!</p>
                    </div>
                @endif
            </div>
        @elseif($status == 'complete')
            {{-- If level is completed --}}
            <div class="col-md-4">
                <div class="alert alert-success shadow-sm">
                    <i class="fa fa-circle-check"></i> Level {{ $level }} has been completed successfully, <br>
                    You can now enroll for another Level.
                </div>
            </div>
        @else
            <div class="col-md-4">
                <div class="alert alert-danger shadow-sm">
                    Please wait, payment awaiting confirmation.
                </div>
            </div>
        @endif
    </div>
@endsection

@push('scripts')  
    <script>
        $(document).ready(function() {
            $("#course_complete_form").on("submit", function(e) {
                e.preventDefault();
                const confirm_complete = confirm("Are you sure?");
                if (confirm_complete == true) {
                    $.ajax({
                        type: "POST",
                        url: "{{ route('complete.course') }}",
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
                                    location.reload();
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
                                    location.reload();
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
        });
    </script>
@endpush
