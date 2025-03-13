<?php

namespace App\Http\Controllers;

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
    public function dashboard(){
        return view('SuperAdmin.dashboard');
    }
}
