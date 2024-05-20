@extends('employee.layouts.app_forms')
@section('content')
    @php
        use App\Models\Client;
        use App\Models\Project;
        use App\Enums\Role;
        $clients = Client::select('id', 'client_name')->get();
        $projects = Project::select('id', 'project_name')->get();
    @endphp
    <main id="main" class="main">
        <button type="button" class="btn btn-sm btn-outline-primary mb-3" id="addTask"><i class="bi bi-plus">Add New
                Task</i></button>
        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-text text-black">Tasks List</h4>
                        </div>
                        <div class="card-body" style="padding: 20px">
                            <div class="table-responsive-lg table-responsive-md table-responsive-sm table-responsive-xl table-responsive-xxl">
                                <table class="table table-hover table-sm" id="taskTable">
                                    <thead>
                                        <tr>
                                            <th class="fw-semibold" style="font-size: 0.75rem">#</th>
                                            <th class="fw-semibold" style="font-size: 0.75rem">Task Name</th>
                                            <th class="fw-semibold" style="font-size: 0.75rem">Project Name</th>
                                            <th class="fw-semibold" style="font-size: 0.75rem">Client Name</th>
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
    {{-- Add Task Modal --}}
    <div class="modal fade" id="addTaskModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Task</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="addTaskForm">
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="">Title<span class="text-danger">*</span></label>
                                <input class="form-control" placeholder="Task Name" id="title_name" name="title_name"
                                    type="text" placeholder="" />
                                <span class="text-danger" id="title_name_error"></span>
                            </div>
                            <div class="col-md-6">
                                <label for="client_id">Client Name<span class="text-danger">*</span></label>
                                <select id="client_id" name="client_id" class="form-select">
                                    <option value="" selected disabled>Select Client</option>
                                    @foreach ($clients as $client)
                                        <option value="{{ $client->id }}">
                                            {{ $client->client_name }}
                                        </option>
                                    @endforeach
                                </select>
                                <span class="text-danger" id="client_id_error"></span>
                            </div>
                            <div class="col-md-6">
                                <label for="project_id">Project Name<span class="text-danger">*</span></label>
                                <select name="project_id" id="project_id" class="form-select">
                                    <option value="" selected disabled>Select Project</option>
                                    @foreach ($projects as $project)
                                        <option value="{{ $project->id }}">
                                            {{ $project->project_name }}
                                        </option>
                                    @endforeach
                                </select>
                                <span class="text-danger" id="project_id_error"></span>
                            </div>
                            <div class="col-md-6">
                                <label for="start_date">Start date<span class="text-danger">*</span></label>
                                <input class="form-control" type="date" name="start_date" id="start_date" />
                                <span class="text-danger" id="start_date_error"></span>
                            </div>
                            <div class="col-md-6">
                                <label for="due_date">Due date<span class="text-danger">*</span></label>
                                <input class="form-control" id="due_date" name="due_date" type="date" />
                                <span class="text-danger" id="due_date_error">
                            </div>
                            <div class="col-md-6">
                                <label for="description">Description</label>
                                <textarea name="description" placeholder="Description goes here" id="description" class="form-control"></textarea>
                                <span class="text-danger" id="description_error"></span>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-danger btn-sm"
                            data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-outline-primary btn-sm" id="addTaskBtn">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Edit Task Modal --}}
    <div class="modal fade" id="editTaskModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Task</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editTaskForm">
                    {{ csrf_field() }}
                    <input type="hidden" name="task_id" id="task_id">
                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="edit_title_name">Title<span class="text-danger">*</span></label>
                                <input class="form-control" placeholder="Task Name" id="edit_title_name"
                                    name="edit_title_name" type="text" placeholder="" />
                                <span class="text-danger" id="edit_title_name_error"></span>
                            </div>
                            <div class="col-md-6">
                                <label for="edit_client_id">Client Name</label>
                                <select id="edit_client_id" name="edit_client_id" class="form-select">
                                    @foreach ($clients as $client)
                                        <option value="{{ $client->id }}" selected>
                                            {{ $client->client_name }}
                                        </option>
                                    @endforeach
                                </select>
                                <span class="text-danger" id="edit_client_id_error"></span>
                            </div>
                            <div class="col-md-6">
                                <label for="edit_project_id">Project Name</label>
                                <select name="edit_project_id" id="edit_project_id" class="form-select">
                                    @foreach ($projects as $project)
                                        <option value="{{ $project->id }}">
                                            {{ $project->project_name }}
                                        </option>
                                    @endforeach
                                </select>
                                <span class="text-danger" id="edit_project_id_error"></span>
                            </div>
                            <div class="col-md-6">
                                <label for="edit_start_date">Start date<span class="text-danger">*</span></label>
                                <input class="form-control" type="date" name="edit_start_date"
                                    id="edit_start_date" />
                                <span class="text-danger" id="edit_start_date_error"></span>
                            </div>
                            <div class="col-md-6">
                                <label for="edit_due_date">Due date<span class="text-danger">*</span></label>
                                <input class="form-control" id="edit_due_date" name="edit_due_date" type="date" />
                                <span class="text-danger" id="edit_due_date_error">
                            </div>
                            <div class="col-md-6">
                                <label for="edit_description">Description<span class="text-danger">*</span></label>
                                <textarea name="edit_description" placeholder="Description goes here" id="edit_description" class="form-control"></textarea>
                                <span class="text-danger" id="edit_description_error"></span>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-danger btn-sm"
                            data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-outline-primary btn-sm" id="updateTaskBtn">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- View Task Details --}}
    <div class="modal fade" id="viewTaskModal" tabindex="-1">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">View Task Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="taskDetails">
                        <!-- Task details will be displayed here -->
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
            // Get Task Lists
            $("#taskTable").DataTable({
                autoWidth: false,
                processing: true,
                serverSide: true,
                lengthChange: true,
                pageLength: 10,
                // scrollY: "500px",
                scrollCollapse: true,
                ajax: "{{ route('emp-fetch-task') }}",
                columns: [{
                        data: null,
                        render: function(data, type, row, meta) {
                            return meta.row + 1;
                        },
                    },
                    {
                        data: "title",
                        name: "title",
                    },
                    {
                        data: "project.project_name",
                        name: "project.project_name",
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
            $('#addTask').click(function() {
                $('#addTaskModal').modal('show');
            });

            $('#addTaskForm').submit(function(e) {
                e.preventDefault();
                let formData = new FormData(this);
                let action_url = "{{ route('emp-add-task') }}";
                $('#addTaskForm input, #addTaskForm select').on(
                    'input change',
                    function() {
                        let fieldName = $(this).attr('name');
                        clearFieldError(fieldName);
                    });
                $.ajax({
                    type: "POST",
                    url: action_url,
                    data: formData,
                    processData: false,
                    contentType: false,
                    beforeSend: function() {
                        $('#addTaskBtn').attr('disabled', true);
                        $('#addTaskBtn').html(
                            '<i class="fa fa-spinner fa-spin"></i> Processing...');
                    },
                    success: function(response) {
                        if (response.status == true) {
                            $("#addTaskModal").modal("hide");
                            $("#addTaskForm")[0].reset();
                            $("#taskTable").DataTable().ajax.reload();
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
                        $('#addTaskBtn').attr('disabled', false);
                        $('#addTaskBtn').html('Create');
                    }
                });
            });

            // Edit Employee
            $(document).on('click', '.task_edit_btn', function() {
                var id = $(this).data('id');
                $.ajax({
                    url: "{{ route('emp-edit-task') }}",
                    data: {
                        id: id
                    },
                    dataType: "json",
                    success: function(data) {
                        let result = data.data;
                        $('#task_id').val(id);
                        $('#edit_title_name').val(result.title);
                        $('#edit_client_id').val(result.client_id);
                        $('#edit_project_id').val(result.project_id);
                        $('#edit_start_date').val(result.start_date);
                        $('#edit_due_date').val(result.due_date);
                        $('#edit_description').val(result.description);
                        $('#editTaskModal').modal('show');
                    }
                })
            });

            // View Employee
            $(document).on('click', '.task_view_btn', function() {
                var id = $(this).data('id');
                $.ajax({
                    url: "{{ route('emp-view-task') }}",
                    data: {
                        id: id
                    },
                    dataType: "json",
                    success: function(data) {
                        let result = data.data;
                        let taskDetailsHtml = `
                        <div class="container">
                            <div class="row">
                                <div class="col-md-6">
                                    <h5><b>Task Details:</b></h5>
                                    <p>Task Name: ${result.title}</p>
                                    <p>Start Date: ${result.start_date}</p>
                                    <p>Due Date: ${result.due_date}</p>
                                    <p>Description: ${result.description}</p>
                                </div>
                                <div class="col-md-6">
                                    <h5><b>User Details:</b></h5>
                                    <p>Name: ${result.user.name}</p>
                                    <p>Email: ${result.user.email}</p>
                                    <p>Contact: ${result.user.contact}</p>
                                </div>
                                <div class="col-md-6">
                                    <h5><b>Client Details:</b></h5>
                                    <p>Name: ${result.client.client_name}</p>
                                    <p>Email: ${result.client.email}</p>
                                    <p>Contact: ${result.client.contact}</p>
                                </div>
                                <div class="col-md-6">
                                    <h5><b>Project Details:</b></h5>
                                    <p>Name: ${result.project.project_name}</p>
                                    <p>Start Date: ${result.project.start_date}</p>
                                    <p>End Date: ${result.project.dead_line}</p>
                                    <p>Project Cost: ${result.project.project_cost}</p>
                                    <p>Project Budget: ${result.project.project_budget}</p>
                                    <p>Project Summary: ${result.project.project_summary}</p>
                                </div>
                            </div>
                        </div>`;
                        $('#taskDetails').html(taskDetailsHtml);
                        $('#viewTaskModal').modal('show');
                    }
                });
            });

            // Update Employee
            $('#editTaskForm').submit(function(e) {
                e.preventDefault();
                var formData = new FormData(this);
                var action_url = "{{ route('emp-update-task') }}";
                $('#editTaskForm input, #editTaskForm select').on(
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
                        $('#updateTaskBtn').attr('disabled', true);
                        $('#updateTaskBtn').html(
                            '<i class="fa fa-spinner fa-spin"></i> Processing...');
                    },
                    success: function(response) {
                        if (response.status == true) {
                            $("#editTaskModal").modal("hide");
                            $("#editTaskForm")[0].reset();
                            $("#taskTable").DataTable().ajax.reload();
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
                        $('#updateTaskBtn').attr('disabled', false);
                        $('#updateTaskBtn').html('Update');
                    }
                });
            });
        });

        // Delete Employee
        $(document).on('click', '.task_delete_btn', function() {
            var id = $(this).data('id');
            var url = "{{ route('emp-delete-task') }}";
            if (confirm('Are you sure to delete this Task?')) {
                $.ajax({
                    url: url,
                    type: "POST",
                    data: {
                        id: id,
                    },
                    success: function(response) {
                        if (response.status == true) {
                            $("#taskTable").DataTable().ajax.reload();
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


        $('#addTaskModal').on('hidden.bs.modal', function() {
            $("#project_name_error").html('');
            $("#start_date_error").html('');
            $("#dead_line_error").html('');
            $("#project_cost_error").html('');
            $("#project_budget_error").html('');
            $("#client_id_error").html('');
        });

        $('#editTaskModal').on('hidden.bs.modal', function() {
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
