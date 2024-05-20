<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\addClientRequest;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\UpdateClientRequest;
use App\Models\Project;

class ClientController extends Controller
{
    public function index()
    {
        return view('admin.clients');
    }
    // Fetch Client
    public function fetchClient()
    {
        if (request()->ajax()) {
            try {
                $clients = Client::select(['id', 'client_name', 'gender', 'email', 'contact', 'created_at'])->get();
                return DataTables::of($clients)
                    ->addColumn('action', function ($client) {
                        return '<div class="dropdown">
                        <button class="btn btn-sm" type="button"
                        id="dropdownPrimeCategory" data-bs-toggle="dropdown">
                        <i class="bi bi-three-dots-vertical"></i>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a title="View client" class="dropdown-item client_view_btn"  data-id="' . $client->id . '"><i class="bi bi-eye"></i>Edit</a></li>
                        <li><a title="Edit client" class="dropdown-item client_edit_btn"  data-id="' . $client->id . '"><i class="bi bi-pencil"></i>Edit</a></li>
                        <li><a title="Delete client" class="dropdown-item client_delete_btn" data-id="' . $client->id . '"><i class="bi bi-trash"></i>Delete</a></li>
                    </ul>
                </div>';
                    })
                    ->rawColumns(['action'])
                    ->make(true);
            } catch (Exception $th) {
                return response()->json(['status' => false, 'message' => $th->getMessage()]);
            }
        }
    }

    // Add Client
    public function addClient(addClientRequest $request)
    {
        if ($request->ajax()) {
            try {
                Client::create([
                    'client_name' => $request->name,
                    'email' => $request->email,
                    'contact' => $request->contact,
                    'gender' => $request->gender,
                ]);
                return response()->json([
                    'status' => true,
                    'success' => 'Client Added Successfully',
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

    // Edit Client
    public function editClient(Request $request)
    {
        if ($request->ajax()) {
            try {
                $id = $request->id;
                $client = Client::select('id', 'client_name', 'email', 'contact', 'gender')->findOrFail($id);
                return response()->json(['status' => true, 'data' => $client]);
            } catch (Exception $e) {
                return response()->json(['status' => false, 'errors' => $e->getMessage()]);
            }
        }
    }
    public function viewClient(Request $request)
    {
        if ($request->ajax()) {
            try {
                $projects = Project::select(['id', 'project_name', 'start_date', 'dead_line', 'project_cost', 'project_budget', 'project_summary', 'created_at', 'client_id'])
                    ->with(['client:id,client_name,gender,email,contact'])
                    ->where('client_id', $request->id)
                    ->get();
                return DataTables::of($projects)->make(true);
            } catch (Exception $e) {
                return response()->json(['status' => false, 'errors' => $e->getMessage()]);
            }
        }
    }
    // Update Client List
    public function updateClient(UpdateClientRequest $request)
    {
        if ($request->ajax()) {
            try {
                $client = Client::findOrFail($request->client_id);
                $data = [
                    'client_name' => $request->edit_name,
                    'email' => $request->edit_email,
                    'contact' => $request->edit_contact,
                    'gender' => $request->edit_gender,
                ];
                $client->fill($data)->save();
                return response()->json([
                    'status' => true,
                    'message' => 'Client Updated Successfully',
                ]);
            } catch (Exception $e) {
                return response()->json([
                    'status' => false,
                    'errors' => $e->getMessage(),
                ]);
            }
        }
    }

    // Delete Client List
    public function deleteClient(Request $request)
    {
        try {
            $client = Client::find($request->id);
            if (!$client) {
                return response()->json([
                    'status' => false,
                    'message' => 'Client not found.',
                ]);
            }
            $client->delete();
            return response()->json([
                'status' => true,
                'message' => 'Client Deleted Successfully',
            ]);
        } catch (Exception $th) {
            return response()->json([
                'status' => false,
                'errors' => $th->getMessage(),
            ]);
        }
    }
}
