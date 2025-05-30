<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');

        $admin = Admin::where('username', $credentials['username'])->first();
        
        // Success Login
        if ($admin && Hash::check($credentials['password'], $admin->password)) {
            session(['admin_id' => $admin->id]);
            return redirect()->route('admin.dashboard');
        }

        // Failed Login
        return back()->withErrors([
            'login' => 'Invalid username or password.',
        ]);
    }

    public function dashboard()
    {
        if (!session()->has('admin_id')) {
            return redirect()->route('admin.login');
        }

        return view('admin.dashboard');
    }

    public function logout()
    {
        session()->forget('admin_id');
        return redirect()->route('admin.login');
    }
}
