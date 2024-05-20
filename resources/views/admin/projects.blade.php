@extends('admin.layouts.app_forms')
@section('content')
    @php
        use App\Models\Client;
        $clients = Client::select('id', 'client_name')->get();
    @endphp
    <main id="main" class="main">
        <button type="button" class="btn btn-sm btn-outline-primary mb-3" id="addProject"><i class="bi bi-plus">Add New
                Project</i></button>
        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-text text-black">Projects List</h4>
                        </div>
                        <div class="card-body" style="padding: 20px">
                            <div class="table-responsive-lg table-responsive-md table-responsive-sm table-responsive-xl table-responsive-xxl">
                                <table class="table table-hover table-sm" id="projectTable">
                                    <thead>
                                        <tr>
                                            <th class="fw-semibold" style="font-size: 0.75rem">#</th>
                                            <th class="fw-semibold" style="font-size: 0.75rem">Project Name:</th>
                                            <th class="fw-semibold" style="font-size: 0.75rem">Client Name:</th>
                                            <th class="fw-semibold" style="font-size: 0.75rem">CreatedAt</th>
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

    {{-- Add Project Modal --}}
    <div class="modal fade" id="addProjectModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Project</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="addProjectForm">
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label for="project_name">Project Name<span class="text-danger">*</span></label>
                                <input type="text" name="project_name" id="project_name" placeholder="Project Name"
                                    class="form-control">
                                <span class="text-danger" id="project_name_error"></span>
                            </div>
                            <div class="col-md-4">
                                <label for="client_id">Client name</label>
                                <select name="client_id" id="client_id" class="form-select">
                                    <option value="" selected>Select Client</option>
                                    @foreach ($clients as $client)
                                        <option value="{{ $client->id }}">
                                            {{ $client->client_name }}
                                        </option>
                                    @endforeach
                                </select>
                                <span class="text-danger" id="client_id_error"></span>
                            </div>
                            <div class="col-md-4">
                                <label for="start_date">Start date<span class="text-danger">*</span></label>
                                <input class="dateselect form-control" id="start_date" name="start_date" type="date"
                                    placeholder="Start date" />
                                <span class="text-danger" id="start_date_error"></span>
                            </div>
                            <div class="col-md-4">
                                <label for="dead_line">Dead line<span class="text-danger">*</span></label>
                                <input class="dateselect form-control" id="dead_line" name="dead_line" type="date"
                                    placeholder="Dead line" />
                                <span class="text-danger" id="dead_line_error"></span>
                            </div>
                            <div class="col-md-4">
                                <label for="project_cost">Project Cost<span class="text-danger">*</span></label>
                                <input class="form-control" id="project_cost" name="project_cost" type="number"
                                    placeholder="Project Cost" onwheel="return false;" />
                                <span class="text-danger" id="project_cost_error"></span>
                            </div>
                            <div class="col-md-4">
                                <label for="project_budget">Project Budget<span class="text-danger">*</span></label>
                                <input class="form-control" id="project_budget" name="project_budget"
                                    type="number"placeholder="Project Budget" onwheel="return false;" />
                                <span class="text-danger" id="project_budget_error"></span>
                            </div>
                            <div class="col-md-12">
                                <label for="summary">Project summary</label>
                                <textarea name="summary" id="summary" placeholder="Summary goes here" class="form-control"></textarea>
                                <span class="text-danger" id="summary_error"></span>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-danger btn-sm"
                            data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-outline-primary btn-sm" id="addProjectBtn">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Edit Project Modal --}}
    <div class="modal fade" id="editProjectModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Project</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editProjectForm">
                    {{ csrf_field() }}
                    <input type="hidden" name="project_id" id="project_id">
                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label for="edit_project_name">Project Name<span class="text-danger">*</span></label>
                                <input type="text" name="edit_project_name" id="edit_project_name"
                                    class="form-control">
                                <span class="text-danger" id="edit_project_name_error"></span>
                            </div>
                            <div class="col-md-4">
                                <label for="edit_client_id">Client name</label>
                                <select name="edit_client_id" id="edit_client_id" class="form-select">
                                    <option value="" disabled>Select Client</option>
                                    @foreach ($clients as $client)
                                        <option value="{{ $client->id }}" selected>
                                            {{ $client->client_name }}
                                        </option>
                                    @endforeach
                                </select>
                                <span class="text-danger" id="edit_client_id_error"></span>
                            </div>
                            <div class="col-md-4">
                                <label for="edit_start_date">Start date<span class="text-danger">*</span></label>
                                <input class="dateselect form-control" id="edit_start_date" name="edit_start_date"
                                    type="date" placeholder="Start date" />
                                <span class="text-danger" id="edit_start_date_error"></span>
                            </div>
                            <div class="col-md-4">
                                <label for="edit_dead_line">Dead line<span class="text-danger">*</span></label>
                                <input class="dateselect form-control" id="edit_dead_line" name="edit_dead_line"
                                    type="date" placeholder="Dead line" />
                                <span class="text-danger" id="edit_dead_line_error"></span>
                            </div>
                            <div class="col-md-4">
                                <label for="edit_project_cost">Project Cost<span class="text-danger">*</span></label>
                                <input class="form-control" id="edit_project_cost" name="edit_project_cost"
                                    type="number" placeholder="Project Cost" onwheel="return false;" />
                                <span class="text-danger" id="edit_project_cost_error"></span>
                            </div>
                            <div class="col-md-4">
                                <label for="edit_project_budget">Project Budget<span class="text-danger">*</span></label>
                                <input class="form-control" id="edit_project_budget" name="edit_project_budget"
                                    type="number"placeholder="Project Budget" onwheel="return false;" />
                                <span class="text-danger" id="edit_project_budget_error"></span>
                            </div>
                            <div class="col-md-12">
                                <label for="edit_summary">Project summary</label>
                                <textarea name="edit_summary" placeholder="Summary goes here" id="edit_summary" class="form-control"></textarea>
                                <span class="text-danger" id="edit_summary_error"></span>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-danger btn-sm"
                            data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-outline-primary btn-sm"
                            id="updateProjectBtn">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- View Client Details --}}
    <div class="modal fade" id="viewClientModal" tabindex="-1">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">View Client & Project Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="clientDetails">
                        <!-- Client details will be displayed here -->
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
            // Get Project Lists
            $("#projectTable").DataTable({
                autoWidth: false,
                processing: true,
                serverSide: true,
                lengthChange: true,
                pageLength: 10,
                // scrollY: "500px",
                scrollCollapse: true,
                ajax: "{{ route('fetch-project') }}",
                columns: [{
                        data: null,
                        render: function(data, type, row, meta) {
                            return meta.row + 1;
                        },
                    },
                    {
                        data: "project_name",
                        name: "project_name",
                    },
                    {
                        data: "client.client_name",
                        name: "client.client_name",
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
            $('#addProject').click(function() {
                $('#addProjectModal').modal('show');
            });

            $('#addProjectForm').submit(function(e) {
                e.preventDefault();
                var formData = new FormData(this);
                var action_url = "{{ route('add-project') }}";

                $('#addProjectForm input, #addProjectForm select').on(
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
                        $('#addProjectBtn').attr('disabled', true);
                        $('#addProjectBtn').html(
                            '<i class="fa fa-spinner fa-spin"></i> Processing...');
                    },
                    success: function(response) {
                        if (response.status == true) {
                            $("#addProjectModal").modal("hide");
                            $("#addProjectForm")[0].reset();
                            $("#projectTable").DataTable().ajax.reload();
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
                        $('#addProjectBtn').attr('disabled', false);
                        $('#addProjectBtn').html('Create');
                    }
                });
            });

            // Edit Employee
            $(document).on('click', '.project_edit_btn', function() {
                var id = $(this).data('id');
                $.ajax({
                    url: "{{ route('edit-project') }}",
                    data: {
                        id: id
                    },
                    dataType: "json",
                    success: function(data) {
                        let result = data.data;
                        $('#project_id').val(id);
                        $('#edit_project_name').val(result.project_name);
                        $('#edit_client_id').val(result.client_id);
                        $('#edit_start_date').val(result.start_date);
                        $('#edit_dead_line').val(result.dead_line);
                        $('#edit_project_cost').val(result.project_cost);
                        $('#edit_project_budget').val(result.project_budget);
                        $('#edit_summary').val(result.project_summary);
                        $('#editProjectModal').modal('show');
                    }
                })
            });

            // View Employee
            $(document).on('click', '.project_view_btn', function() {
                var id = $(this).data('id');
                $.ajax({
                    url: "{{ route('view-project') }}",
                    data: {
                        id: id
                    },
                    dataType: "json",
                    success: function(data) {
                        let result = data.data;
                        let clientDetailsHtml = `
                        <div class="container">
                            <div class="row">
                                <div class="col-md-6">
                                    <h5>Client Details:</h5>
                                    <p>Name: ${result.client.client_name}</p>
                                    <p>Email: ${result.client.email}</p>
                                    <p>Contact: ${result.client.contact}</p>
                                    <p>Registered Date: ${result.client.client_created_at}</p>
                                </div>
                                <div class="col-md-6">
                                    <h5>Project Details:</h5>
                                    <p>Name: ${result.project_name}</p>
                                    <p>Start Date: ${result.start_date}</p>
                                    <p>End Date: ${result.dead_line}</p>
                                    <p>Project Cost: ${result.project_cost}</p>
                                    <p>Project Budget: ${result.project_budget}</p>
                                    <p>Project Summary: ${result.project_summary}</p>
                                </div>
                            </div>
                        </div>`;
                        $('#clientDetails').html(clientDetailsHtml);
                        $('#viewClientModal').modal('show');
                    }
                });
            });

            // Update Employee
            $('#editProjectForm').submit(function(e) {
                e.preventDefault();
                var formData = new FormData(this);
                var action_url = "{{ route('update-project') }}";
                $('#editProjectForm input, #editProjectForm select').on(
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
                        $('#updateProjectBtn').attr('disabled', true);
                        $('#updateProjectBtn').html(
                            '<i class="fa fa-spinner fa-spin"></i> Processing...');
                    },
                    success: function(response) {
                        if (response.status == true) {
                            $("#editProjectModal").modal("hide");
                            $("#editProjectForm")[0].reset();
                            $("#projectTable").DataTable().ajax.reload();
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
                        $('#updateProjectBtn').attr('disabled', false);
                        $('#updateProjectBtn').html('Update');
                    }
                });
            });
        });

        // Delete Employee
        $(document).on('click', '.project_delete_btn', function() {
            var id = $(this).data('id');
            var url = "{{ route('delete-project') }}";
            if (confirm('Are you sure to delete this project?')) {
                $.ajax({
                    url: url,
                    type: "POST",
                    data: {
                        id: id,
                    },
                    success: function(response) {
                        if (response.status == true) {
                            $("#projectTable").DataTable().ajax.reload();
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


        $('#addProjectModal').on('hidden.bs.modal', function() {
            $("#project_name_error").html('');
            $("#start_date_error").html('');
            $("#dead_line_error").html('');
            $("#project_cost_error").html('');
            $("#project_budget_error").html('');
            $("#client_id_error").html('');
        });

        $('#editProjectModal').on('hidden.bs.modal', function() {
            $("#edit_project_name_error").html('');
            $("#edit_start_date_error").html('');
            $("#edit_dead_line_error").html('');
            $("#edit_project_cost_error").html('');
            $("#edit_project_budget_error").html('');
            $("#edit_client_id_error").html('');
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
