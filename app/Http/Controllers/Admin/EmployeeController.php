<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Enums\Role;
use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\addEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use Yajra\DataTables\Contracts\DataTable;

class EmployeeController extends Controller
{
    public function index()
    {
        return view('admin.employees');
    }

    public function fetchEmployee(Request $request)
    {
        if ($request->ajax()) {
            try {
                $employees = User::select('id', 'name', 'email', 'contact', 'created_at', 'role')->whereRole('employee')->get();
                return DataTables::of($employees)
                    ->addColumn('action', function ($employee) {
                        return '<div class="dropdown">
                        <button class="btn btn-sm" type="button"
                        id="dropdownPrimeCategory" data-bs-toggle="dropdown">
                        <i class="bi bi-three-dots-vertical"></i>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item employee_view_btn" data-id="' . $employee->id . '"><i class="bi bi-eye"></i>View</a></li>
                        <li><a class="dropdown-item employee_edit_btn" data-id="' . $employee->id . '"><i class="bi bi-pencil"></i>Edit</a></li>
                        <li><a class="dropdown-item employee_delete_btn" data-id="' . $employee->id . '"><i class="bi bi-trash"></i>Delete</a></li>
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
    public function addEmployee(addEmployeeRequest $request)
    {
        if ($request->ajax()) {
            try {
                $result = User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'contact' => $request->contact,
                    'role' => Role::EMPLOYEE,
                    'remember_token' => Str::random(10),
                    'password' => Hash::make($request->password),
                ]);
                return response()->json(['status' => true, 'message' => 'Employee added successfully!']);
            } catch (Exception $e) {
                return response()->json(['status' => false, 'message' => $e->getMessage()]);
            }
        } else {
            return response()->json(['status' => false, 'message' => 'Invalid request']);
        }
    }
    public function editEmployee(Request $request)
    {
        if (request()->ajax()) {
            try {
                $data = User::select('id', 'name', 'email', 'contact')->where(['id' => $request->id, 'role' => Role::EMPLOYEE])
                    ->first();

                return response()->json(['status' => true, 'data' => $data]);
            } catch (Exception $e) {
                return response()->json(['status' => false, 'message' => $e->getMessage()]);
            }
        }
    }
    public function viewEmployee(Request $request)
    {
        if (request()->ajax()) {
            try {
                $data = Task::select('id', 'title', 'start_date', 'due_date', 'description', 'user_id', 'client_id', 'project_id')
                    ->with(['user', 'project', 'client'])
                    ->where('user_id', $request->id)
                    ->get();
                return DataTables::of($data)->make(true);
            } catch (Exception $e) {
                return response()->json(['status' => false, 'message' => $e->getMessage()]);
            }
        }
    }
    public function updateEmployee(UpdateEmployeeRequest $request)
    {
        if ($request->ajax()) {
            try {
                $employee = User::where(['id' => $request->employee_id, 'role' => Role::EMPLOYEE])->first();
                if (!$employee) {
                    return response()->json([
                        'status' => false,
                        'errors' => 'Employee not found',
                    ]);
                }
                $employee->name = $request->edit_name;
                $employee->email = $request->edit_email;
                $employee->contact = $request->edit_contact;
                if ($request->filled('edit_password')) {
                    $employee->password = Hash::make($request->edit_password);
                }

                $employee->save();

                return response()->json([
                    'status' => true,
                    'message' => 'Employee Updated Successfully',
                ]);
            } catch (Exception $e) {
                return response()->json([
                    'status' => false,
                    'errors' => $e->getMessage(),
                ]);
            }
        }
    }

    public function deleteEmployee(Request $request)
    {
        try {
            $employee = User::where(['id', $request->id, 'role', Role::EMPLOYEE])->first();
            if (!$employee) {
                return response()->json(['status' => false, 'message' => 'Employee not found!']);
            }
            $employee->delete();
            return response()->json(['status' => true, 'message' => 'Employee deleted successfully!']);
        } catch (Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()]);
        }
    }
}
