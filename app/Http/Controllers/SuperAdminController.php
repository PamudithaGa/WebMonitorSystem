<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\website;
use App\Models\WebsiteLog;
use Illuminate\Http\Request;


class SuperAdminController extends Controller
{
    /**
     * 
     * 
     * 
     * 
     * 
     * @return response()
     */
    public function dashboard()
    {
        return view('SuperAdmin.dashboard');
    }


    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'role' => 'required|in:user,admin,superadmin',
        ]);

        $user = new User;
        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
        $user->password = Hash::make($validatedData['password']);
        $user->role = $validatedData['role'];
        $user->save();

        return redirect()->back()->with('success', 'Member added successfully!');
    }


    public function destroy($id)
    {
        $website = Website::find($id);
        if ($website) {
            $website->delete();
            return redirect()->back()->with('success', 'Website deleted successfully!');
        }
        return redirect()->back()->with('success', 'Website deleted not success!');
    }


    // public function index()
    // {
    //     $sales = \App\Models\WebsiteLog::all();
    //     return view('superadmin.', compact('sales'));
    // }
}
