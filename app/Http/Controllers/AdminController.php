<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Summary of index
     * @return response()     */
    public function dashboard(){
        return view('admin.dashboard');
    }
}
