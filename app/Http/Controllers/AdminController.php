<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Website;
use App\Models\User;


class AdminController extends Controller
{
    /**
     * Summary of index
     * @return response()     */
    public function dashboard(){
        return view('admin.dashboard');
    }

    public function index()
    {
        $websites = Website::all();
        return view('monitoring.index', compact('websites'));
    }


    public function store (Request $request){
        $validateddata = $request-> validate([
            'name' => 'required|string|max: 255',
            'client'=>'required|string|max :255',
            'url' => 'required|string|max :255',
            
        ]);

        $website = new Website;
        $website->name = $validateddata['name'];
        $website->client = $validateddata['client'];
        $website->url = $validateddata['url'];
        $website->save();

        return redirect()->back()->with('success', 'Member added successfully!');
    }
}




// namespace App\Http\Controllers;

// use Illuminate\Http\Request;
// use App\Models\Website;
// use App\Models\User;

// class AdminController extends Controller
// {
//     /**
//      * Display the admin dashboard.
//      *
//      * @return \Illuminate\View\View
//      */
//     public function dashboard()
//     {
//         return view('admin.dashboard');
//     }

//     /**
//      * Store a new website project.
//      *
//      * @param  \Illuminate\Http\Request  $request
//      * @return \Illuminate\Http\Response
//      */
//     public function store(Request $request)
//     {
//         // Validate the input
//         $validateddata = $request->validate([
//             'name' => 'required|string|max:255',
//             'client' => 'required|string|max:255',
//             'url' => 'required|string|max:255',
//             'user_id' => 'required|array',
//             'user_id.*' => 'exists:users,id',  // Validate that each user_id exists in the users table
//         ]);

//         // Create a new website project
//         $website = new Website;
//         $website->name = $validateddata['name'];
//         // $website->client = $validateddata['client'];
//         $website->url = $validateddata['url'];
//         // $website->user_id = auth()->user()->id;  // The project creator (Kanchana, in this case)
//         $website->save();

//         // Attach users (if it's a many-to-many relationship)
//         // Assuming 'website_user' is a pivot table for many-to-many relationship between Website and User
//         // $website->users()->attach($validateddata['user_id']);

//         // Redirect or return a response
//         return redirect()->back()->with('success', 'Member added successfully!');
//     }
// }
