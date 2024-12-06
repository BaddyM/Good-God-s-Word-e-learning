@extends('common.master')

@section('title')
    Enrollment
@endsection

@section('body')
    <style>
        tr td {
            vertical-align: middle;
        }
    </style>
    <div class="container-fluid mt-2">
        <p class="h4 fw-bold">Enrollment</p>
        <div class="card border-0 shadow-sm">
            <div class="card-body over-flow-scroll">
                <table class="table table-responsive" id="enrollment-table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Student Name</th>
                            <th scope="col">Level</th>
                            <th scope="col">Level Status</th>
                            <th scope="col">Pay Status</th>
                            <th scope="col">Amount</th>
                            <th scope="col">Payment Method</th>
                            <th scope="col">Created On</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $("#enrollment-table").DataTable({
                serverSide: true,
                processing: true,
                autoWidth: false,
                ajax: {
                    type: "POST",
                    url: "{{ route('enrollment.data') }}"
                },
                columns: [{
                        data: "DT_RowIndex"
                    },
                    {
                        data: "name"
                    },
                    {
                        data: "level"
                    },
                    {
                        data: "level_status"
                    },
                    {
                        data: "status"
                    },
                    {
                        data: "paid"
                    },
                    {
                        data: "method"
                    },
                    {
                        data: "created_at"
                    },
                    {
                        data: "action"
                    }
                ],
                columnDefs: [{
                    targets: [0,2,3, 4, 5, 6, 8],
                    className: "dt-center"
                }]
            });

            $(document).on("click", ".accept_enrollment", function(e) {
                e.preventDefault();
                var id = $(this).data("id");
                const confirm_activate = confirm("Are you sure?");
                if (confirm_activate == true) {
                    $.ajax({
                        type: "POST",
                        url: "{{ route('enrollment.accept') }}",
                        data: {
                            id: id
                        },
                        success: function(response) {
                            $("#alert_modal").modal("show");
                            $("#enrollment-table").DataTable().draw(false);
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
                    });
                }
            });

            $(document).on("click", ".cancel_enrollment", function(e) {
                e.preventDefault();
                var id = $(this).data("id");
                const confirm_activate = confirm("Are you sure?");
                if (confirm_activate == true) {
                    $.ajax({
                        type: "POST",
                        url: "{{ route('enrollment.cancel') }}",
                        data: {
                            id: id
                        },
                        success: function(response) {
                            $("#alert_modal").modal("show");
                            $("#enrollment-table").DataTable().draw(false);
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
                    });
                }
            });
        });
    </script>
@endpush
