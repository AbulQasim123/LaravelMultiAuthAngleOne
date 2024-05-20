<?php

namespace App\Http\Controllers\Admin;

use App\Enums\Role;
use App\Models\Task;
use App\Models\User;
use App\Models\Client;
use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function loadRegister()
    {
        if (Auth::user()) {
            $route = $this->redirectDash();
            return redirect($route);
        }
        return view('register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:2',
            'email' => 'required|string|email|max:100|unique:users',
            'contact' => 'required|digits:10|unique:users',
            'password' => 'required|string|min:6',
            'password_confirmation' => 'required|string|same:password|min:6'
        ]);

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = Role::ADMIN;
        $user->contact = $request->contact;
        $user->password = Hash::make($request->password);
        $user->save();
        return redirect('/')->withSuccess('Your Registration has been successfull.');
    }

    public function loadLogin()
    {
        if (Auth::user()) {
            $route = $this->redirectDash();
            return redirect($route);
        }
        return view('login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|required|email',
            'password' => 'required|string|required'
        ]);

        $userCredential = $request->only('email', 'password');
        if (Auth::attempt($userCredential)) {
            $route = $this->redirectDash();
            return redirect($route)->withSuccess('Great! You have Successfully logged in');
        } else {
            return redirect()->back()->withError('Username & Password is incorrect');
        }
    }

    public function dashboard()
    {
        if (!Auth::user()) {
            return redirect('/');
        }
        $totals = [
            'employeeTotal' => User::whereRole(Role::EMPLOYEE)->count(),
            'clientTotal' => Client::count(),
            'projectTotal' => Project::count(),
            'taskTotal' => Task::count(),
        ];
        return view('admin.dashboard', compact('totals'));
    }
    public function redirectDash()
    {
        $redirect = '';
        $userRole = Auth::user()->role;
        if ($userRole === Role::ADMIN) {
            $redirect = '/admin/dashboard';
        } else {
            $redirect = '/employee/dashboard';
        }
        return $redirect;
    }

    public function logout(Request $request)
    {
        $request->session()->flush();
        Auth::logout();
        return redirect('/');
    }
}
