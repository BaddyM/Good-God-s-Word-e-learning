@extends('common.master')

@section('title')
    Courses
@endsection

@section('body')
    <style>
        tr td {
            vertical-align: middle;
        }

        iframe {
            width: 200px !important;
            height: 200px !important;
        }

        #update_course_form input,
        #update_course_form select,
        #update_course_form textarea{
            color:blue !important;
        }

    </style>
    <div class="container-fluid mt-2">
        <p class="h4 fw-bold">My Courses</p>
        <div class="row justify-content-between my-3">
            <div class="col"></div>
            <div class="col text-end"><button id="add_course_btn" class="submit-btn">Add Course</button></div>
        </div>
        <div class="card border-0 shadow-sm">
            <div class="card-body over-flow-scroll">
                <table class="table table-responsive" id="course-table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Course Name</th>
                            <th scope="col">Description</th>
                            <th scope="col">Video</th>
                            <th scope="col">Level</th>
                            <th scope="col">Length</th>
                            <th scope="col">Uploaded By</th>
                            <th scope="col">Created On</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>

        <div class="modal fade" id="add_course_modal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalTitleId">
                            Add a Course <i class="fa fa-circle-plus"></i>
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body overflow-scroll">
                        <form id="add_course_form" enctype="multipart/form-data" method="post">
                            @csrf
                            <div class="mb-2">
                                <label class="form-label fw-bold h6">Course Name <strong class="text-danger">*</strong></label>
                                <input type="text" class="form-control" name="course_name" placeholder="Add a Course Name" required>
                            </div>
                            <div class="mb-2">
                                <label class="form-label fw-bold h6">Course Level <strong class="text-danger">*</strong></label>
                                <select class="form-select" name="level" required>
                                    @php
                                        $levels = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12];
                                    @endphp
                                    <option value="">Select a Level</option>
                                    @foreach ($levels as $level)
                                        <option value="{{ $level }}">{{ $level }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-2">
                                <label class="form-label fw-bold h6">Course Description <strong class="text-danger">*</strong></label>
                                <textarea name="description" placeholder="Description" style="height: 200px;" class="form-control" required></textarea>
                            </div>
                            <div>
                                <label class="form-label fw-bold h6">Video Period<strong class="text-danger">*</strong></label>
                                <div class="row justify-content-between">
                                    <div class="col-md-6 mb-2">
                                        <label class="fw-bold h6">Hours</label>
                                        <input type="number" class="form-control check_period_val" name="hours" maxlength="2" placeholder="Hours" required>
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <label class="fw-bold h6">Minutes</label>
                                        <input type="number" class="form-control check_period_val" name="minutes" maxlength="2" placeholder="Minutes" required>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-2">
                                <label class="form-label fw-bold h6">Youtube Link <strong class="text-danger">*</strong></label>
                                <div class="mb-2">
                                    <div class="alert alert-danger shadow-sm">
                                        <Strong><i class="fa fa-exclamation-triangle"></i> Note:</Strong> <br>
                                        The youtube link should be like the example below, other than that, the system
                                        will not accept the link.
                                    </div>
                                    <p class="mb-1 text-muted" id="link_example">Example: <strong>https://youtu.be/P2EbhIdAo5Q</strong></p>
                                </div>
                                <textarea name="link" class="form-control" placeholder="Add Youtube Link here"></textarea>
                            </div>
                            <button class="submit-btn d-flex align-items-center" type="submit" id="upload_course_btn" style="gap:5px;">
                                <div class="d-flex justify-content-center align-items-center">
                                    <div class="spinner-border text-white spinner-border-sm
                                    d-none" role="status" id="spinner">
                                    </div>
                                </div>
                                <span id="button-text">Add</span>
                            </button>
                        </form>
                        <div class="d-none" id="upload_progress_container">
                            <p class="mb-2 fw-bold h6">Upload Progress</p>
                            <div class="progress mt-3">
                                <div id="upload_progress" class="progress-bar bg-primary" role="progressbar" style="width: 0%;">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> {{-- Add Course Modal --}}

        <div class="modal fade" id="update_course_modal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">
                            Update Course <i class="fa fa-pen"></i>
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body overflow-scroll">
                        <form id="update_course_form" enctype="multipart/form-data" method="post">
                            @csrf
                            <input type="hidden" name="id" id="update_course_id">
                            <div class="mb-2">
                                <label class="form-label fw-bold h6">Course Name <strong class="text-danger">*</strong></label>
                                <input type="text" class="form-control" name="course_name" id="update_course_name" placeholder="Add a Course Name" required>
                            </div>
                            <div class="mb-2">
                                <label class="form-label fw-bold h6">Course Level <strong class="text-danger">*</strong></label>
                                <select class="form-select" name="level" id="update_course_level" required>
                                    @php
                                        $levels = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12];
                                    @endphp
                                    <option value="">Select a Level</option>
                                    @foreach ($levels as $level)
                                        <option value="{{ $level }}">{{ $level }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-2">
                                <label class="form-label fw-bold h6">Course Description <strong class="text-danger">*</strong></label>
                                <textarea name="description" id="update_course_description" placeholder="Description" style="height: 200px;" class="form-control" required></textarea>
                            </div>
                            <div>
                                <label class="form-label fw-bold h6">Video Period<strong class="text-danger">*</strong></label>
                                <div class="row justify-content-between">
                                    <div class="col-md-6 mb-2">
                                        <label class="fw-bold h6">Hours</label>
                                        <input type="number" id="update_course_hour" class="form-control check_period_val" name="hours" maxlength="2" placeholder="Hours" required>
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <label class="fw-bold h6">Minutes</label>
                                        <input type="number" id="update_course_mins" class="form-control check_period_val" name="minutes" maxlength="2" placeholder="Minutes" required>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-2">
                                <label class="form-label fw-bold h6">Youtube Link <strong class="text-danger">*</strong></label>
                                <div class="mb-2">
                                    <div class="alert alert-danger shadow-sm">
                                        <Strong><i class="fa fa-exclamation-triangle"></i> Note:</Strong> <br>
                                        The youtube link should be like the example below, other than that, the system
                                        will not accept the link.
                                    </div>
                                    <p class="mb-1 text-muted" id="link_example">Example: <strong>https://youtu.be/P2EbhIdAo5Q</strong></p>
                                </div>
                                <textarea name="link" id="update_course_link" class="form-control" placeholder="Add Youtube Link here"></textarea>
                            </div>
                            <button class="submit-btn d-flex align-items-center" type="submit" id="upload_course_btn" style="gap:5px;">
                                <div class="d-flex justify-content-center align-items-center">
                                    <div class="spinner-border text-white spinner-border-sm
                                    d-none" role="status" id="spinner">
                                    </div>
                                </div>
                                <span id="button-text">Update</span>
                            </button>
                        </form>
                        <div class="d-none" id="upload_progress_container">
                            <p class="mb-2 fw-bold h6">Upload Progress</p>
                            <div class="progress mt-3">
                                <div id="upload_progress" class="progress-bar bg-primary" role="progressbar" style="width: 0%;">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>{{-- Update course modal --}}
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $("#add_course_btn").on("click", function() {
                $("#add_course_modal").modal("show");
            });

            $(".check_period_val").on("keyup", function(e) {
                var period_length = $(this).val().length;
                var period_val = $(this).val();
                if (period_length > 2 || period_val > 60) {
                    alert("Invalid Time!");
                    $(this).val(null);
                }
            });

            //Disable mouse copy and paste
            $('#link_example').on('mousedown', function(e) {
                return false;
            });

            $(document).on("click",".update_course",function(){
                var course_name = $(this).data("title");
                var description = $(this).data("description");
                var material = $(this).data("material");
                var hours = $(this).data("hours");
                var mins = $(this).data("mins");
                var material = $(this).data("material");
                var level = $(this).data("level");
                var id = $(this).data("id");

                $("#update_course_name").val(course_name);
                $("#update_course_description").text(description);
                $("#update_course_level").val(level);
                $("#update_course_hour").val(hours);
                $("#update_course_mins").val(mins);
                $("#update_course_link").val(material);
                $("#update_course_id").val(id);
                $("#update_course_modal").modal("show");
            })

            $("#course-table").DataTable({
                serverSide: true,
                processing: true,
                autoWidth: false,
                ajax: {
                    type: "POST",
                    url: "{{ route('tutor.course.data') }}"
                },
                columns: [{
                        data: "DT_RowIndex"
                    },
                    {
                        data: "title"
                    },
                    {
                        data: "description"
                    },
                    {
                        data: "material"
                    },
                    {
                        data: "level"
                    },
                    {
                        data: "length"
                    },
                    {
                        data: "users"
                    },
                    {
                        data: "created_at"
                    },
                    {
                        data: "action"
                    }
                ],
                columnDefs: [
                    {
                    targets: [0,4,5,8],
                    className: "dt-center"
                    },
                    {
                    targets: [8],
                    width: "150px"
                    },
                ]
            });

            $("#add_course_form").on("submit", function(e) {
                e.preventDefault();
                $("#spinner").removeClass("d-none");
                $("#button-text").text("Please Wait...");
                $.ajax({
                    type: "POST",
                    xhr: function() {
                        $("#upload_progress_container").removeClass("d-none");
                        $("#add_course_form").addClass("d-none");
                        $("#add_course_modal button").prop("disabled", true);
                        var xhr = new window.XMLHttpRequest();
                        xhr.upload.addEventListener("progress", function(evt) {
                            if (evt.lengthComputable) {
                                var percentComplete = evt.loaded / evt.total;
                                percentComplete = parseInt(percentComplete * 100);
                                $("#upload_progress").css("width",
                                    `${percentComplete}%`);
                                if (percentComplete === 100) {

                                }
                            }
                        }, false);

                        return xhr;
                    },
                    url: "{{ route('tutor.course.add') }}",
                    data: new FormData(this),
                    contentType: false,
                    processData: false,
                    cache: false,
                    success: function(response) {
                        $("#add_course_form")[0].reset();
                        $("#spinner").addClass("d-none");
                        $("#button-text").text("Add");
                        $("#add_course_modal").modal("hide");
                        $("#alert_modal").modal("show");
                        $("#course-table").DataTable().draw(false);
                        $("#alert_body").text(response);
                        $("#add_course_form").removeClass("d-none");
                        $("#add_course_modal button").prop("disabled", false);
                        setTimeout(() => {
                            $("#upload_progress_container").addClass("d-none");
                            $("#upload_progress").css("width", `0%`);
                        }, 2400);
                        setTimeout(() => {
                            $("#alert_modal").modal("hide");
                        }, 2500);
                    },
                    error: function() {
                        $("#spinner").addClass("d-none");
                        $("#button-text").text("Add");
                        $("#alert_modal").modal("show");
                        $("#alert_body").text("Failed, Try Again!");
                        setTimeout(() => {
                            $("#alert_modal").modal("hide");
                        }, 2000);

                        $("#add_course_form")[0].reset();
                        $("#spinner").addClass("d-none");
                        $("#button-text").text("Add");
                        $("#add_course_modal").modal("hide");
                        $("#add_course_form").removeClass("d-none");
                        $("#add_course_modal button").prop("disabled", false);
                        setTimeout(() => {
                            $("#upload_progress_container").addClass("d-none");
                            $("#upload_progress").css("width", `0%`);
                        }, 2400);
                        setTimeout(() => {
                            $("#alert_modal").modal("hide");
                        }, 2500);
                    }
                })
            });

            //Update course
            $("#update_course_form").on("submit", function(e) {
                e.preventDefault();
                $("#spinner").removeClass("d-none");
                $("#button-text").text("Please Wait...");
                $.ajax({
                    type: "POST",
                    xhr: function() {
                        $("#upload_progress_container").removeClass("d-none");
                        $("#update_course_form").addClass("d-none");
                        $("#update_course_modal button").prop("disabled", true);
                        var xhr = new window.XMLHttpRequest();
                        xhr.upload.addEventListener("progress", function(evt) {
                            if (evt.lengthComputable) {
                                var percentComplete = evt.loaded / evt.total;
                                percentComplete = parseInt(percentComplete * 100);
                                $("#upload_progress").css("width",
                                    `${percentComplete}%`);
                                if (percentComplete === 100) {

                                }
                            }
                        }, false);

                        return xhr;
                    },
                    url: "{{ route('tutor.course.update') }}",
                    data: new FormData(this),
                    contentType: false,
                    processData: false,
                    cache: false,
                    success: function(response) {
                        $("#update_course_form")[0].reset();
                        $("#spinner").addClass("d-none");
                        $("#button-text").text("Add");
                        $("#update_course_modal").modal("hide");
                        $("#alert_modal").modal("show");
                        $("#course-table").DataTable().draw(false);
                        $("#alert_body").text(response);
                        $("#update_course_form").removeClass("d-none");
                        $("#update_course_modal button").prop("disabled", false);
                        setTimeout(() => {
                            $("#upload_progress_container").addClass("d-none");
                            $("#upload_progress").css("width", `0%`);
                        }, 2400);
                        setTimeout(() => {
                            $("#alert_modal").modal("hide");
                        }, 2500);
                    },
                    error: function() {
                        $("#spinner").addClass("d-none");
                        $("#button-text").text("Add");
                        $("#alert_modal").modal("show");
                        $("#alert_body").text("Failed, Try Again!");
                        setTimeout(() => {
                            $("#alert_modal").modal("hide");
                        }, 2000);

                        $("#uddate_course_form")[0].reset();
                        $("#spinner").addClass("d-none");
                        $("#button-text").text("Add");
                        $("#update_course_modal").modal("hide");
                        $("#update_course_form").removeClass("d-none");
                        $("#update_course_modal button").prop("disabled", false);
                        setTimeout(() => {
                            $("#upload_progress_container").addClass("d-none");
                            $("#upload_progress").css("width", `0%`);
                        }, 2400);
                        setTimeout(() => {
                            $("#alert_modal").modal("hide");
                        }, 2500);
                    }
                })
            });

            //Delete Course
            $(document).on("click", ".delete_course", function(e) {
                e.preventDefault();
                var id = $(this).data("id");
                const confirm_delete = confirm("Are you sure?");
                if (confirm_delete == true) {
                    $.ajax({
                        type: "POST",
                        url: "{{ route('tutor.course.delete') }}",
                        data: {
                            id: id
                        },
                        success: function(response) {
                            $("#alert_modal").modal("show");
                            $("#course-table").DataTable().draw(false);
                            $("#alert_body").text(response);
                            setTimeout(() => {
                                $("#alert_modal").modal("hide");
                            }, 2000);
                        },
                        error: function() {
                            $("#alert_modal").modal("show");
                            $("#alert_body").text("Failed,Try Again!");
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
