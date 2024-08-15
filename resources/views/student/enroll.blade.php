@extends('common.master')

@section('title')
    Enroll
@endsection

@section('body')
    <div class="container-fluid pt-3 landing">
        <form id="enroll_course" method="post">
            @csrf
            <div class="col-md-7">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-2" style="gap:10px;">
                            <p class="mb-0 fw-bold h6 bg-secondary col-md-3 p-2 text-white rounded-1">Level </p>
                            <input type="text" value="1" readonly class="form-control rounded-0 bg-light">
                        </div>
                        <div class="d-flex align-items-center mb-2" style="gap:10px;">
                            <p class="mb-0 fw-bold h6 bg-secondary col-md-3 p-2 text-white rounded-1">Tutor </p>
                            <input type="text" value="Mr. John" readonly class="form-control rounded-0 bg-light">
                        </div>
                        <div class="d-flex align-items-center mb-2" style="gap:10px;">
                            <p class="mb-0 fw-bold h6 bg-secondary col-md-3 p-2 text-white rounded-1">Cost </p>
                            <input type="text" value="200,000" readonly class="form-control rounded-0 bg-light">
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
                                            name="payment_method">
                                    </div>
                                </div>
                                <div class="tab-pane" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                    <div class="d-flex align-items-center my-3" style="gap:10px;">
                                        <label class="form-label h6 fw-bold">Airtel Money</label>
                                        <input type="radio" class="form-check-radio" style="width:20px; height:20px;"
                                            name="payment_method">
                                    </div>
                                </div>
                                <div class="tab-pane" id="messages" role="tabpanel" aria-labelledby="messages-tab">
                                    <div class="d-flex align-items-center my-3" style="gap:10px;">
                                        <label class="form-label h6 fw-bold">Debit/Credit Card</label>
                                        <input type="radio" class="form-check-radio" style="width:20px; height:20px;"
                                            name="payment_method">
                                    </div>
                                    <div>
                                        <div class="col-md-8">
                                            <div class="card border-0 shadow rounded-3">
                                                <div class="card-body">
                                                    <div class="debit_card">
                                                        <label class="form-label fw-bold h6">Card Number</label>
                                                        <div class="d-flex">
                                                            @for ($i=1; $i<=4; $i++)
                                                            <input type="text" maxlength="1">
                                                        @endfor
                                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                        @for ($i=1; $i<=4; $i++)
                                                            <input type="text" maxlength="1">
                                                        @endfor
                                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                        @for ($i=1; $i<=4; $i++)
                                                            <input type="text" maxlength="1">
                                                        @endfor
                                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                        @for ($i=1; $i<=4; $i++)
                                                            <input type="text" maxlength="1">
                                                        @endfor
                                                        </div>
                                                    </div>
                                                    <div class="debit_card">
                                                        <label class="form-label fw-bold h6">Security Number</label>
                                                        <div class="d-flex">
                                                            @for ($i=1; $i<=3; $i++)
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
                        <button class="submit-btn">Confirm</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function(){
            $("#enroll_course").on("submit",function(e){
                e.preventDefault();
                $("#alert_modal").modal("show");
                $("#alert_body").text("Course Enrolled Successfully");
                setTimeout(() => {
                    $("#alert_modal").modal("hide");
                }, 2000);
                setTimeout(() => {
                    location.replace("{{ route('home') }}");
                }, 2500);
            });
        })
    </script>
@endpush
