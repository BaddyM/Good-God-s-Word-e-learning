@extends('common.master')

@section('title')
    Accounts
@endsection

@section('body')
    <style>
        tr td {
            vertical-align: middle;
        }
    </style>
    <div class="container-fluid mt-2">
        <p class="h4 fw-bold">Accounts</p>
        <div class="row justify-content-between my-3">
            <div class="col"></div>
            <div class="col text-end"><button id="add_account_btn" class="submit-btn">Add Account</button></div>
        </div>
        <div class="card border-0 shadow-sm">
            <div class="card-body over-flow-scroll">
                <table class="table table-responsive" id="user-table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">User</th>
                            <th scope="col">Email</th>
                            <th scope="col">Priviledge</th>
                            <th scope="col">Status</th>
                            <th scope="col">Created On</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>

        <div class="modal fade" id="add_account_modal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false"
            role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalTitleId">
                            Add a Course <i class="fa fa-circle-plus"></i>
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body overflow-scroll">
                        <form id="add_account_form" enctype="multipart/form-data" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 mb-2">
                                    <label class="fw-bold h6">Last Name <i style="color:red;">*</i></label>
                                    <input type="text" name="lname" class="form-control rounded-2"
                                        placeholder="Enter Last Name" required>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label class="fw-bold h6">First Name <i style="color:red;">*</i></label>
                                    <input type="text" name="fname" class="form-control rounded-2"
                                        placeholder="Enter First Name" required>
                                </div>
                            </div>
                            <div class="mb-2">
                                <label class="fw-bold h6">Email <i style="color:red;">*</i></label>
                                <input type="email" name="email" class="form-control rounded-2"
                                    placeholder="Enter Email" required>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-2">
                                    <label class="fw-bold h6">Gender <i style="color:red;">*</i></label>
                                    <select name="gender" class="form-select rounded-2" required>
                                        <option value="">Select Gender</option>
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label class="fw-bold h6">Account Type <i style="color:red;">*</i></label>
                                    <select name="account_type" class="form-select rounded-2" required>
                                        <option value="">Select Account Type</option>
                                        <option value="student">Student</option>
                                        <option value="tutor">Tutor</option>
                                        <option value="admin">Admin</option>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-2">
                                <label class="fw-bold h6">Password <i style="color:red;">*</i></label>
                                <input type="password" name="password" class="form-control rounded-2"
                                    placeholder="Enter Password" required>
                            </div>
                            <button class="submit-btn d-flex align-items-center" type="submit" id="upload_course_btn"
                                style="gap:5px;">
                                <div class="d-flex justify-content-center align-items-center">
                                    <div class="spinner-border text-white spinner-border-sm
                                    d-none"
                                        role="status" id="spinner">
                                    </div>
                                </div>
                                <span id="button-text">Add</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $("#add_account_btn").on("click", function() {
                $("#add_account_modal").modal("show");
            });

            $("#add_account_modal").on("hidden.bs.modal",function(){
                $("#add_account_form")[0].reset();
            })

            $("#user-table").DataTable({
                serverSide: true,
                processing: true,
                autoWidth: false,
                ajax: {
                    type: "POST",
                    url: "{{ route('accounts.list.data') }}"
                },
                columns: [{
                        data: "DT_RowIndex"
                    },
                    {
                        data: "user"
                    },
                    {
                        data: "email"
                    },
                    {
                        data: "priviledge"
                    },
                    {
                        data: "status"
                    },
                    {
                        data: "created_at"
                    },
                    {
                        data: "action"
                    }
                ],
                columnDefs: [{
                    targets: [0, 3, 4, 6],
                    className: "dt-center"
                }]
            });

            $(document).on("click", ".activate_user", function(e) {
                e.preventDefault();
                var id = $(this).data("id");
                const confirm_activate = confirm("Are you sure?");
                if (confirm_activate == true) {
                    $.ajax({
                        type: "POST",
                        url: "{{ route('accounts.activate') }}",
                        data: {
                            id: id
                        },
                        success: function(response) {
                            $("#alert_modal").modal("show");
                            $("#user-table").DataTable().draw(false);
                            $("#alert_body").text(response);
                            setTimeout(() => {
                                $("#alert_modal").modal("hide");
                            }, 2000);
                        },
                        error: function() {
                            $("#alert_modal").modal("show");
                            $("#alert_body").text("Failed, Try Again!");
                            setTimeout(() => {
                                $("#alert_modal").modal("hide");
                            }, 2000);
                        }
                    })
                }
            });

            $(document).on("click", ".deactivate_user", function(e) {
                e.preventDefault();
                var id = $(this).data("id");
                const confirm_deactivate = confirm("Are you sure?");
                if (confirm_deactivate == true) {
                    $.ajax({
                        type: "POST",
                        url: "{{ route('accounts.deactivate') }}",
                        data: {
                            id: id
                        },
                        success: function(response) {
                            $("#alert_modal").modal("show");
                            $("#user-table").DataTable().draw(false);
                            $("#alert_body").text(response);
                            setTimeout(() => {
                                $("#alert_modal").modal("hide");
                            }, 2000);
                        },
                        error: function() {
                            $("#alert_modal").modal("show");
                            $("#alert_body").text("Failed, Try Again!");
                            setTimeout(() => {
                                $("#alert_modal").modal("hide");
                            }, 2000);
                        }
                    })
                }
            });

            $(document).on("click", ".delete_user", function(e) {
                e.preventDefault();
                var id = $(this).data("id");
                const confirm_delete = confirm("Are you sure?");
                if (confirm_delete == true) {
                    $.ajax({
                        type: "POST",
                        url: "{{ route('accounts.delete') }}",
                        data: {
                            id: id
                        },
                        success: function(response) {
                            $("#alert_modal").modal("show");
                            $("#user-table").DataTable().draw(false);
                            $("#alert_body").text(response);
                            setTimeout(() => {
                                $("#alert_modal").modal("hide");
                            }, 2000);
                        },
                        error: function() {
                            $("#alert_modal").modal("show");
                            $("#alert_body").text("Failed, Try Again!");
                            setTimeout(() => {
                                $("#alert_modal").modal("hide");
                            }, 2000);
                        }
                    })
                }
            });

            $("#add_account_form").on("submit", function(e) {
                e.preventDefault();
                $("#spinner").removeClass("d-none");
                $("#button-text").text("Please Wait...");
                $.ajax({
                    type: "POST",
                    url: "{{ route('accounts.add') }}",
                    data: new FormData(this),
                    contentType: false,
                    processData: false,
                    cache: false,
                    success: function(response) {
                        $("#spinner").addClass("d-none");
                        $("#button-text").text("Add");
                        $("#add_account_form")[0].reset();
                        $("#add_account_modal").modal("hide");
                        $("#alert_modal").modal("show");
                        $("#user-table").DataTable().draw(false);
                        $("#alert_body").text(response);
                        setTimeout(() => {
                            $("#alert_modal").modal("hide");
                        }, 2000);
                    },
                    error: function() {
                        $("#spinner").addClass("d-none");
                        $("#button-text").text("Add");
                        $("#add_account_form")[0].reset();
                        $("#alert_modal").modal("show");
                        $("#alert_body").text("Failed, Try Again!");
                        setTimeout(() => {
                            $("#alert_modal").modal("hide");
                        }, 2000);
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
                            $("#user-table").DataTable().draw(false);
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
