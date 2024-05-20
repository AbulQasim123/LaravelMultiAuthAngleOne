@extends('admin.layouts.app_forms')
@section('content')
    <main id="main" class="main">
        <button type="button" class="btn btn-sm btn-outline-primary mb-3" id="addClient"><i class="bi bi-plus">Add New
                Client</i></button>
        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-text text-black">Clients List</h4>
                        </div>
                        <div class="card-body" style="padding: 20px">
                            <div class="table-responsive-lg table-responsive-md table-responsive-sm table-responsive-xl table-responsive-xxl">
                                <table class="table table-hover table-sm" id="clientTable">
                                    <thead>
                                        <tr>
                                            <th class="fw-semibold" style="font-size: 0.75rem">#</th>
                                            <th class="fw-semibold" style="font-size: 0.75rem">Name:</th>
                                            <th class="fw-semibold" style="font-size: 0.75rem">Email</th>
                                            <th class="fw-semibold" style="font-size: 0.75rem">Contact</th>
                                            <th class="fw-semibold" style="font-size: 0.75rem">Gender</th>
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
    {{-- Add Client Modal --}}
    <div class="modal fade" id="addClientModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Client</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="addClientForm">
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="name">Name<span class="text-danger">*</span></label>
                                <input class="form-control" id="name" name="name" type="text"
                                    placeholder="Enter Client Name" />
                                <span class="text-danger" id="name_error"></span>
                            </div>
                            <div class="col-md-6">
                                <label for="gender">Gender<span class="text-danger">*</span></label>
                                <select name="gender" id="gender" class="form-select">
                                    <option value="" selected>Select Gender</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                    <option value="Other">Other</option>
                                </select>
                                <span class="text-danger" id="gender_error"></span>
                            </div>
                            <div class="col-md-6">
                                <label for="email">Email<span class="text-danger">*</span></label>
                                <input class="form-control" id="email" name="email" type="email"
                                    placeholder="Enter Email" />
                                <span class="text-danger" id="email_error"></span>
                            </div>
                            <div class="col-md-6">
                                <label for="contact">Contact<span class="text-danger">*</span></label>
                                <input class="form-control" id="contact" name="contact" type="number"
                                    placeholder="Enter Contact No" onwheel="return false;" />
                                <span class="text-danger" id="contact_error"></span>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-danger btn-sm" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-outline-primary btn-sm" id="addClientBtn">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Edit Client Modal --}}
    <div class="modal fade" id="editClientModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Client</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editClientForm" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <input type="hidden" name="client_id" id="client_id">
                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="edit_name">Name<span class="text-danger">*</span></label>
                                <input class="form-control" id="edit_name" name="edit_name" type="text"
                                    placeholder="Enter Client Name" />
                                <span class="text-danger" id="edit_name_error"></span>
                            </div>
                            <div class="col-md-6">
                                <label for="edit_gender">Gender<span class="text-danger">*</span></label>
                                <select name="edit_gender" id="edit_gender" class="form-select">
                                    <option value="" selected selected>Select Gender</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                    <option value="Other">Other</option>
                                </select>
                                <span class="text-danger" id="edit_gender_error"></span>
                            </div>
                            <div class="col-md-6">
                                <label for="edit_email">Email<span class="text-danger">*</span></label>
                                <input class="form-control" id="edit_email" name="edit_email" type="email"
                                    placeholder="Enter Email" />
                                <span class="text-danger" id="edit_email_error"></span>
                            </div>
                            <div class="col-md-6">
                                <label for="edit_contact">Contact<span class="text-danger">*</span></label>
                                <input class="form-control" id="edit_contact" name="edit_contact" type="number"
                                    placeholder="Enter Contact No" onwheel="return false;" />
                                <span class="text-danger" id="edit_contact_error"></span>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-danger btn-sm"
                            data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-outline-primary btn-sm"
                            id="updateClientBtn">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- View Client Details --}}
    <div class="modal fade" id="viewClientWiseProjectModal" tabindex="-1">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">View Client All Projects Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive-lg table-responsive-md table-responsive-sm table-responsive-xl table-responsive-xxl p-3">
                        <table class="table table-bordered table-hover" id="viewClientWiseProjectTable">
                            <thead>
                                <tr>
                                    <th class="fw-semibold" style="font-size: 0.75rem">#</th>
                                    <th class="fw-semibold" style="font-size: 0.75rem">Project Name</th>
                                    <th class="fw-semibold" style="font-size: 0.75rem">Start Date</th>
                                    <th class="fw-semibold" style="font-size: 0.75rem">Dead Line</th>
                                    <th class="fw-semibold" style="font-size: 0.75rem">Project Cost</th>
                                    <th class="fw-semibold" style="font-size: 0.75rem">Project Budget</th>
                                    <th class="fw-semibold" style="font-size: 0.75rem">Project Summary</th>
                                    <th class="fw-semibold" style="font-size: 0.75rem">CreatedAt</th>
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
            // Get Client Lists
            $("#clientTable").DataTable({
                autoWidth: false,
                processing: true,
                serverSide: true,
                lengthChange: true,
                pageLength: 10,
                // scrollY: "1000px",
                scrollCollapse: true,
                ajax: "{{ route('fetch-client') }}",
                columns: [{
                        data: null,
                        render: function(data, type, row, meta) {
                            return meta.row + 1;
                        },
                    },
                    {
                        data: "client_name",
                        name: "client_name",
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
                        data: 'gender',
                        name: 'gender'
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
            $('#addClient').click(function() {
                $('#addClientModal').modal('show');
            });

            $('#addClientForm').submit(function(e) {
                e.preventDefault();
                var formData = new FormData(this);
                var action_url = "{{ route('add-client') }}";

                $('#addClientForm input, #addClientForm select').on(
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
                        $('#addClientBtn').attr('disabled', true);
                        $('#addClientBtn').html(
                            '<i class="fa fa-spinner fa-spin"></i> Processing...');
                    },
                    success: function(response) {
                        if (response.status == true) {
                            $("#addClientModal").modal("hide");
                            $("#addClientForm")[0].reset();
                            $("#clientTable").DataTable().ajax.reload();
                            toastr.options = {
                                closeButton: true,
                                progressBar: true,
                            };
                            toastr.success(response.success);
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
                        $('#addClientBtn').attr('disabled', false);
                        $('#addClientBtn').html('Add');
                    }
                });
            });

            // Edit Employee
            $(document).on('click', '.client_edit_btn', function() {
                var id = $(this).data('id');
                $.ajax({
                    url: "{{ route('edit-client') }}",
                    data: {
                        id: id
                    },
                    dataType: "json",
                    success: function(data) {
                        let result = data.data;
                        let clientName = result.client_name;
                        let client_name = clientName.replace(/^(Mr|Mrs|Ms)\s+/i, '');
                        $('#client_id').val(id);
                        $('#edit_name').val(client_name);
                        $('#edit_email').val(result.email);
                        $('#edit_contact').val(result.contact);
                        $('#edit_gender').val(result.gender);
                        $('#editClientModal').modal('show');
                    }
                })
            });

            // View Client Wise Project Table
            $(document).on('click', '.client_view_btn', function() {
                var clientId = $(this).data('id');
                $('#viewClientWiseProjectModal').modal('show');
                $('#viewClientWiseProjectTable').DataTable().destroy();
                $('#viewClientWiseProjectTable').DataTable({
                    autoWidth: false,
                    processing: true,
                    serverSide: true,
                    lengthChange: true,
                    pageLength: 10,
                    scrollCollapse: true,
                    ajax: {
                        url: "{{ route('view-client') }}",
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
                            data: 'project_name',
                            name: 'project_name'
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
                            data: 'dead_line',
                            name: 'dead_line',
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
                            data: 'project_cost',
                            name: 'project_cost'
                        },
                        {
                            data: 'project_budget',
                            name: 'project_budget'
                        },
                        {
                            data: 'project_summary',
                            name: 'project_summary'
                        },
                        {
                            data: 'created_at',
                            name: 'created_at'
                        },
                    ],
                });
            });

            // Update Employee
            $('#editClientForm').submit(function(e) {
                e.preventDefault();
                var formData = new FormData(this);
                var action_url = "{{ route('update-client') }}";
                $('#editClientForm input, #editClientForm select').on(
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
                        $('#updateClientBtn').attr('disabled', true);
                        $('#updateClientBtn').html(
                            '<i class="fa fa-spinner fa-spin"></i> Processing...');
                    },
                    success: function(response) {
                        if (response.status == true) {
                            $("#editClientModal").modal("hide");
                            $("#editClientForm")[0].reset();
                            $("#clientTable").DataTable().ajax.reload();
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
                        $('#updateClientBtn').attr('disabled', false);
                        $('#updateClientBtn').html('Update');
                    }
                });
            });
        });

        // Delete Employee
        $(document).on('click', '.client_delete_btn', function() {
            var id = $(this).data('id');
            var url = "{{ route('delete-client') }}";
            if (confirm('Are you sure to delete this client?')) {
                $.ajax({
                    url: url,
                    type: "POST",
                    data: {
                        id: id,
                    },
                    success: function(response) {
                        if (response.status == true) {
                            $("#clientTable").DataTable().ajax.reload();
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
            $("#gender_error").html('');
            // Clear Field if modal is closed
            $('#addEmployeeForm')[0].reset();
        });

        $('#editEmployeeModal').on('hidden.bs.modal', function() {
            $("#edit_name_error").html('');
            $("#edit_email_error").html('');
            $("#edit_contact_error").html('');
            $("#edit_contact_error").html('');
            $("#edit_gender_error").html('');
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
