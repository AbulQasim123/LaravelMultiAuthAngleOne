<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\Client;
use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\addProjectRequest;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\UpdateProjectRequest;

class ProjectController extends Controller
{
    public function index()
    {
        return view('admin.projects');
    }

    public function fetchProject(Request $request)
    {
        if ($request->ajax()) {
            try {
                $projects = Project::select(['id', 'project_name', 'client_id', 'created_at'])->with('client:id,client_name')
                    ->get();
                return DataTables::of($projects)
                    ->addColumn('action', function ($project) {
                        return '<div class="dropdown">
                        <button class="btn btn-sm" type="button"
                        id="dropdownPrimeCategory" data-bs-toggle="dropdown">
                        <i class="bi bi-three-dots-vertical"></i>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a title="View project" class="dropdown-item project_view_btn" data-id="' . $project->id . '"><i class="bi bi-eye"></i>View</a></li>
                        <li><a title="Edit project" class="dropdown-item project_edit_btn" data-id="' . $project->id . '"><i class="bi bi-pencil"></i>Edit</a></li>
                        <li><a title="Delete project" class="dropdown-item project_delete_btn" data-id="' . $project->id . '"><i class="bi bi-trash"></i>Delete</a></li>
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

    public function addproject(addProjectRequest $request)
    {
        if ($request->ajax()) {
            try {
                Project::create([
                    'project_name' => $request->project_name,
                    'start_date' => $request->start_date,
                    'dead_line' => $request->dead_line,
                    'client_id' => $request->client_id,
                    'project_cost' => $request->project_cost,
                    'project_budget' => $request->project_budget,
                    'project_summary' => $request->summary,
                ]);
                return response()->json([
                    'status' => true,
                    'success' => 'Project Added Successfully',
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
    public function editproject(Request $request)
    {
        if ($request->ajax()) {
            try {
                $project = Project::select(['id', 'project_name', 'start_date', 'dead_line', 'client_id', 'project_cost', 'project_budget', 'project_summary'])->findOrFail($request->id);
                return response()->json(['status' => true, 'data' => $project]);
            } catch (Exception $e) {
                return response()->json(['status' => false, 'errors' => $e->getMessage()]);
            }
        }
    }
    public function viewproject(Request $request)
    {
        if ($request->ajax()) {
            try {
                $project = Project::select(['id', 'project_name', 'start_date', 'dead_line', 'project_cost', 'project_budget', 'project_summary', 'created_at', 'client_id'])
                    ->with(['client:id,client_name,gender,email,contact,created_at as client_created_at'])
                    ->where('id', $request->id)
                    ->first();
                return response()->json(['status' => true, 'data' => $project]);
            } catch (Exception $e) {
                return response()->json(['status' => false, 'errors' => $e->getMessage()]);
            }
        }
    }

    public function updateproject(UpdateProjectRequest $request)
    {
        if ($request->ajax()) {
            try {
                $project = Project::findOrFail($request->project_id);
                $data = [
                    'project_name' => $request->edit_project_name,
                    'start_date' => $request->edit_start_date,
                    'dead_line' => $request->edit_dead_line,
                    'client_id' => $request->edit_client_id,
                    'project_cost' => $request->edit_project_cost,
                    'project_budget' => $request->edit_project_budget,
                    'project_summary' => $request->edit_summary,
                ];
                $project->fill($data)->save();
                return response()->json([
                    'status' => true,
                    'message' => 'Project Updated Successfully',
                ]);
            } catch (Exception $e) {
                return response()->json([
                    'status' => false,
                    'errors' => $e->getMessage(),
                ]);
            }
        }
    }
    public function deleteproject(Request $request)
    {
        try {
            $project = Project::find($request->id);
            if (!$project) {
                return response()->json([
                    'status' => false,
                    'message' => 'Project not found.',
                ]);
            }
            $project->delete();
            return response()->json([
                'status' => true,
                'message' => 'Project Deleted Successfully',
            ]);
        } catch (Exception $th) {
            return response()->json([
                'status' => false,
                'errors' => $th->getMessage(),
            ]);
        }
    }
}
