@extends('admin.layouts.app_forms')
@section('content')
    <main id="main" class="main">
        <button type="button" class="btn btn-sm btn-outline-primary mb-3" id="addEmployee"><i class="bi bi-plus">Add New
                Employee</i></button>
        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-text text-black">Employees List</h4>
                        </div>
                        <div class="card-body" style="padding: 20px">
                            <div
                                class="table-responsive-lg table-responsive-md table-responsive-sm table-responsive-xl table-responsive-xxl">
                                <table class="table table-hover table-sm" id="employeeTable">
                                    <thead>
                                        <tr>
                                            <th class="fw-semibold" style="font-size: 0.75rem">#</th>
                                            <th class="fw-semibold" style="font-size: 0.75rem">Name:</th>
                                            <th class="fw-semibold" style="font-size: 0.75rem">Email</th>
                                            <th class="fw-semibold" style="font-size: 0.75rem">Contact</th>
                                            <th class="fw-semibold" style="font-size: 0.75rem">Created</th>
                                            <th class="fw-semibold" style="font-size: 0.75rem">Action</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    {{-- Add Employee Modal --}}
    <div class="modal fade" id="addEmployeeModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title">Add Employee</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="addEmployeeForm">
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="name">Employee Name<span class="text-danger">*</span></label>
                                <input class="form-control" id="name" name="name" type="text"
                                    placeholder="Employee Name" />
                                <span class="text-danger" id="name_error"></span>
                            </div>
                            <div class="col-md-6">
                                <label for="email">Email<span class="text-danger">*</span></label>
                                <input class="form-control" id="email" name="email" type="email"
                                    placeholder="Enter Email" />
                                <span class="text-danger" id="email_error"></span>
                            </div>
                            <div class="col-md-6">
                                <label for="contact">contact<span class="text-danger">*</span></label>
                                <input class="form-control" id="contact" name="contact" type="text"
                                    placeholder="Enter Contact No" />
                                <span class="text-danger" id="contact_error"></span>
                            </div>
                            <div class="col-md-6">
                                <label for="password">Password<span class="text-danger">*</span></label>
                                <input class="form-control" id="password" name="password" type="password"
                                    placeholder="Enter Password" />
                                <span class="text-danger" id="password_error"></span>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-danger btn-sm" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-outline-primary btn-sm" id="addEmpBtn">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Edit Employee Modal --}}
    <div class="modal fade" id="editEmployeeModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title">Edit Employee</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editEmployeeForm">
                    {{ csrf_field() }}
                    <input type="hidden" name="employee_id" id="employee_id" />
                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="edit_name">Employee Name<span class="text-danger">*</span></label>
                                <input class="form-control" id="edit_name" name="edit_name" type="text"
                                    placeholder="Employee Name" />
                                <span class="text-danger" id="edit_name_error"></span>
                            </div>
                            <div class="col-md-6">
                                <label for="edit_email">Email<span class="text-danger">*</span></label>
                                <input class="form-control" id="edit_email" name="edit_email" type="email"
                                    placeholder="Enter Email" />
                                <span class="text-danger" id="edit_email_error"></span>
                            </div>
                            <div class="col-md-6">
                                <label for="edit_contact">Contact<span class="text-danger">*</span></label>
                                <input class="form-control" id="edit_contact" name="edit_contact" type="text"
                                    placeholder="Enter Contact No" />
                                <span class="text-danger" id="edit_contact_error"></span>
                            </div>
                            <div class="col-md-6">
                                <label for="edit_password">Password<span class="text-danger">*</span></label>
                                <input class="form-control" id="edit_password" name="edit_password" type="password"
                                    placeholder="Enter Password" />
                                <span class="text-danger" id="edit_password_error"></span>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-danger btn-sm"
                            data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-outline-primary btn-sm" id="updateEmpBtn">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- View Client Details --}}
    <div class="modal fade" id="viewAllTaskUserTabletModal" tabindex="-1">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">View All Task Specific Employee</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive-lg table-responsive-md table-responsive-sm table-responsive-xl table-responsive-xxl p-3">
                        <table class="table table-bordered table-hover" id="viewAllTaskUserTable">
                            <thead>
                                <tr>
                                    <th class="fw-semibold" style="font-size: 0.75rem">#</th>
                                    <th class="fw-semibold" style="font-size: 0.75rem">Employee Name</th>
                                    <th class="fw-semibold" style="font-size: 0.75rem">Task Name</th>
                                    <th class="fw-semibold" style="font-size: 0.75rem">Start Date</th>
                                    <th class="fw-semibold" style="font-size: 0.75rem">Due Date</th>
                                    <th class="fw-semibold" style="font-size: 0.75rem">Project Name</th>
                                    <th class="fw-semibold" style="font-size: 0.75rem">Client Name</th>
                                    <th class="fw-semibold" style="font-size: 0.75rem">project Summary</th>
                                    <th class="fw-semibold" style="font-size: 0.75rem">Task Description</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-danger btn-sm" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('custom_scripts')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(document).ready(function() {
            // Get Employee Lists
            $("#employeeTable").DataTable({
                autoWidth: false,
                processing: true,
                serverSide: true,
                lengthChange: true,
                pageLength: 10,
                // scrollY: "500px",
                scrollCollapse: true,
                ajax: "{{ route('fetch-employee') }}",
                columns: [{
                        data: null,
                        render: function(data, type, row, meta) {
                            return meta.row + 1;
                        },
                    },
                    {
                        data: "name",
                        name: "name",
                    },
                    {
                        data: "email",
                        name: "email",
                    },
                    {
                        data: 'contact',
                        name: 'contact'
                    },
                    {
                        data: 'created_at',
                        name: 'created_at'
                    },
                    {
                        data: "action",
                        name: "action",
                        orderable: false,
                        searchable: false,
                    },
                ],
            });

            // Add Employee
            $('#addEmployee').click(function() {
                $('#addEmployeeModal').modal('show');
            });

            $('#addEmployeeForm').submit(function(e) {
                e.preventDefault();
                var formData = new FormData(this);
                var action_url = "{{ route('add-employee') }}";

                $('#addEmployeeForm input, #addEmployeeForm select').on(
                    'input change',
                    function() {
                        var fieldName = $(this).attr('name');
                        clearFieldError(fieldName);
                    });
                $.ajax({
                    type: "POST",
                    url: action_url,
                    data: formData,
                    processData: false,
                    contentType: false,
                    beforeSend: function() {
                        $('#addEmpBtn').attr('disabled', true);
                        $('#addEmpBtn').html(
                            '<i class="fa fa-spinner fa-spin"></i> Processing...');
                    },
                    success: function(response) {
                        if (response.status == true) {
                            $("#addEmployeeModal").modal("hide");
                            $("#addEmployeeForm")[0].reset();
                            $("#employeeTable").DataTable().ajax.reload();
                            toastr.options = {
                                closeButton: true,
                                progressBar: true,
                            };
                            toastr.success(response.message);
                        } else {
                            toastr.options = {
                                closeButton: true,
                                progressBar: true,
                            };
                            toastr.error(response.errors);
                        }
                    },
                    error: function(xhr, status, error) {
                        var errors = xhr.responseJSON.errors;
                        $.each(errors, function(field, error) {
                            displayValidationError(field, error[0]);
                        });
                    },
                    complete: function() {
                        $('#addEmpBtn').attr('disabled', false);
                        $('#addEmpBtn').html('Add');
                    }
                });
            });

            // Edit Employee
            $(document).on('click', '.employee_edit_btn', function() {
                var id = $(this).data('id');
                $.ajax({
                    url: "{{ route('edit-employee') }}",
                    data: {
                        id: id
                    },
                    dataType: "json",
                    success: function(data) {
                        $('#employee_id').val(id);
                        let result = data.data;
                        console.log(result);
                        $('#edit_name').val(result.name);
                        $('#edit_email').val(result.email);
                        $('#edit_contact').val(result.contact);
                        $('#edit_gender').val(result.gender);
                        $('#editEmployeeModal').modal('show');
                    }
                })
            });


            // View All Task Appropriate Users
            $(document).on('click', '.employee_view_btn', function() {
                var clientId = $(this).data('id');
                $('#viewAllTaskUserTabletModal').modal('show');
                $('#viewAllTaskUserTable').DataTable().destroy();
                $('#viewAllTaskUserTable').DataTable({
                    autoWidth: false,
                    processing: true,
                    serverSide: true,
                    lengthChange: true,
                    pageLength: 10,
                    scrollCollapse: true,
                    ajax: {
                        url: "{{ route('view-employee') }}",
                        type: 'GET',
                        data: {
                            id: clientId
                        }
                    },
                    columns: [{
                            data: null,
                            render: function(data, type, row, meta) {
                                return meta.row + 1;
                            }
                        },
                        {
                            data: 'user.name',
                            name: 'user.name'
                        },
                        {
                            data: 'title',
                            name: 'title'
                        },
                        {
                            data: 'start_date',
                            name: 'start_date',
                            render: function(data) {
                                var date = new Date(data);
                                var day = date.getDate().toString().padStart(2, '0');
                                var month = (date.getMonth() + 1).toString().padStart(2,
                                    '0');
                                var year = date.getFullYear();
                                return day + '-' + month + '-' + year;
                            }
                        },
                        {
                            data: 'due_date',
                            name: 'due_date',
                            render: function(data) {
                                var date = new Date(data);
                                var day = date.getDate().toString().padStart(2, '0');
                                var month = (date.getMonth() + 1).toString().padStart(2,
                                    '0');
                                var year = date.getFullYear();
                                return day + '-' + month + '-' + year;
                            }
                        },
                        {
                            data: 'project.project_name',
                            name: 'project.project_name'
                        },
                        {
                            data: 'client.client_name',
                            name: 'client.client_name'
                        },
                        {
                            data: 'project.project_summary',
                            name: 'project.project_summary'
                        },
                        {
                            data: 'description',
                            name: 'description'
                        },
                    ],
                });
            });


            // Update Employee
            $('#editEmployeeForm').submit(function(e) {
                e.preventDefault();
                var formData = new FormData(this);
                var action_url = "{{ route('update-employee') }}";
                $('#editEmployeeForm input, #editEmployeeForm select').on(
                    'input change',
                    function() {
                        var fieldName = $(this).attr('name');
                        clearFieldError(fieldName);
                    });
                $.ajax({
                    type: "POST",
                    url: action_url,
                    data: formData,
                    processData: false,
                    contentType: false,
                    beforeSend: function() {
                        $('#updateEmpBtn').attr('disabled', true);
                        $('#updateEmpBtn').html(
                            '<i class="fa fa-spinner fa-spin"></i> Processing...');
                    },
                    success: function(response) {
                        if (response.status == true) {
                            $("#editEmployeeModal").modal("hide");
                            $("#editEmployeeForm")[0].reset();
                            $("#employeeTable").DataTable().ajax.reload();
                            toastr.options = {
                                closeButton: true,
                                progressBar: true,
                            };
                            toastr.success(response.message);
                        } else {
                            toastr.options = {
                                closeButton: true,
                                progressBar: true,
                            };
                            toastr.error(response.errors);
                        }
                    },
                    error: function(xhr, status, error) {
                        var errors = xhr.responseJSON.errors;
                        $.each(errors, function(field, error) {
                            displayValidationError(field, error[0]);
                        });
                    },
                    complete: function() {
                        $('#updateEmpBtn').attr('disabled', false);
                        $('#updateEmpBtn').html('Update');
                    }
                });
            });
        });

        // Delete Employee
        $(document).on('click', '.employee_delete_btn', function() {
            var id = $(this).data('id');
            var url = "{{ route('delete-employee') }}";
            if (confirm('Are you sure to delete this employee?')) {
                $.ajax({
                    url: url,
                    type: "POST",
                    data: {
                        id: id,
                    },
                    success: function(response) {
                        if (response.status == true) {
                            $("#employeeTable").DataTable().ajax.reload();
                            toastr.options = {
                                closeButton: true,
                                progressBar: true,
                            };
                            toastr.success(response.message);
                        } else {
                            toastr.options = {
                                closeButton: true,
                                progressBar: true,
                            };
                            toastr.error(response.errors);
                        }
                    }
                });
            }
        })


        $('#addEmployeeModal').on('hidden.bs.modal', function() {
            $("#name_error").html('');
            $("#email_error").html('');
            $("#contact_error").html('');
            $("#password_error").html('');
            // Clear Field if modal is closed
            $('#addEmployeeForm')[0].reset();
        });

        $('#editEmployeeModal').on('hidden.bs.modal', function() {
            $("#edit_name_error").html('');
            $("#edit_email_error").html('');
            $("#edit_contact_error").html('');
            $("#edit_password_error").html('');
        });

        // Display Validation Error
        function displayValidationError(field, error) {
            $('#' + field + '_error').text(error);
        }
        // Clear Validation Error
        function clearFieldError(field) {
            $('#' + field + '_error').text('');
        }
    </script>
@endpush
