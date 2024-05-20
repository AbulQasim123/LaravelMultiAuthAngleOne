<?php

namespace App\Http\Controllers\Employee;

use Exception;
use App\Models\Task;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\AddTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use Yajra\DataTables\Facades\DataTables;

class EmployeeController extends Controller
{
    public function dashboard()
    {
        return view('employee.tasks');
    }

    public function fetchTask(Request $request)
    {
        if ($request->ajax()) {
            try {
                $tasks = Task::select(['id', 'title', 'created_at', 'client_id', 'project_id'])
                    ->with([
                        'client:id,client_name,email',
                        'project:id,project_name'
                    ])
                    ->where(['user_id' => auth()->user()->id])
                    ->get();
                return DataTables::of($tasks)
                    ->addColumn('action', function ($task) {
                        return '<div class="dropdown">
                        <button class="btn btn-sm" type="button"
                        id="dropdownPrimeCategory" data-bs-toggle="dropdown">
                        <i class="bi bi-three-dots-vertical"></i>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a title="View task" class="dropdown-item task_view_btn" data-id="' . $task->id . '"><i class="bi bi-eye"></i>View</a></li>
                        <li><a title="Edit task" class="dropdown-item task_edit_btn" data-id="' . $task->id . '"><i class="bi bi-pencil"></i>Edit</a></li>
                        <li><a title="Delete task" class="dropdown-item task_delete_btn" data-id="' . $task->id . '"><i class="bi bi-trash"></i>Delete</a></li>
                    </ul>
                </div>';
                    })
                    ->rawColumns(['action'])
                    ->make(true);
            } catch (Exception $e) {
                return response()->json(['status' => false, 'message' => $e->getMessage()]);
            }
        }
    }
    public function addTask(AddTaskRequest $request)
    {
        if ($request->ajax()) {
            try {
                Task::create([
                    'title' => $request->title_name,
                    'project_id' => $request->project_id,
                    'client_id' => $request->client_id,
                    'user_id' => auth()->user()->id,
                    'start_date' => $request->start_date,
                    'due_date' => $request->due_date,
                    'description' => $request->description,
                ]);
                return response()->json([
                    'status' => true,
                    'success' => 'Task Added Successfully',
                ]);
            } catch (Exception $th) {
                return response()->json([
                    'status' => false,
                    'errors' => $th->getMessage(),
                ]);
            }
        } else {
            return response()->json(['status' => false, 'message' => 'Invalid request']);
        }
    }
    public function editTask(Request $request)
    {
        if ($request->ajax()) {
            try {
                $task = Task::where(['id' => $request->id, 'user_id' => auth()->user()->id])->first();
                return response()->json(['status' => true, 'data' => $task]);
            } catch (Exception $e) {
                return response()->json(['status' => false, 'errors' => $e->getMessage()]);
            }
        }
    }
    public function viewTask(Request $request)
    {
        if ($request->ajax()) {
            try {
                $task = Task::select(['id', 'title', 'start_date', 'due_date', 'description', 'created_at', 'user_id', 'client_id', 'project_id'])
                    ->with([
                        'user:id,name,email,contact',
                        'client:id,client_name,gender,email,contact',
                        'project:id,project_name,start_date,dead_line,project_cost,project_budget,project_summary'
                    ])
                    ->where(['id' => $request->id, 'user_id' => auth()->user()->id])
                    ->first();
                return response()->json(['status' => true, 'data' => $task]);
            } catch (Exception $e) {
                return response()->json(['status' => false, 'errors' => $e->getMessage()]);
            }
        }
    }
    public function updateTask(UpdateTaskRequest $request)
    {
        if ($request->ajax()) {
            try {
                $task = Task::findOrFail($request->task_id);
                $data = [
                    'title' => $request->edit_title_name,
                    'project_id' => $request->edit_project_id,
                    'client_id' => $request->edit_client_id,
                    'user_id' => auth()->user()->id,
                    'start_date' => $request->edit_start_date,
                    'due_date' => $request->edit_due_date,
                    'description' => $request->edit_description,
                ];
                $task->fill($data)->save();
                return response()->json([
                    'status' => true,
                    'message' => 'Task Updated Successfully',
                ]);
            } catch (Exception $e) {
                return response()->json([
                    'status' => false,
                    'errors' => $e->getMessage(),
                ]);
            }
        }
    }
    public function deleteTask(Request $request)
    {
        try {
            $task = Task::find($request->id);
            if (!$task) {
                return response()->json([
                    'status' => false,
                    'message' => 'Task not found.',
                ]);
            }
            $task->delete();
            return response()->json([
                'status' => true,
                'message' => 'Task Deleted Successfully',
            ]);
        } catch (Exception $th) {
            return response()->json([
                'status' => false,
                'errors' => $th->getMessage(),
            ]);
        }
    }
}
