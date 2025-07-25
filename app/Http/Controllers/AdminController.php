<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Website;
use App\Models\User;
use App\Notifications\SSLActivatedNotification;
use Illuminate\Support\Facades\Notification;

class AdminController extends Controller
{
    /**
     * Summary of index
     * @return response()     */
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function index()
    {
        $websites = Website::all();
        return view('monitoring.index', compact('websites'));
    }


    public function store(Request $request)
    {
        $validateddata = $request->validate([
            'name' => 'required|string|max: 255',
            'client' => 'required|string|max :255',
            'url' => 'required|string|max :255',

        ]);

        $website = new Website;
        $website->name = $validateddata['name'];
        $website->client = $validateddata['client'];
        $website->url = $validateddata['url'];
        $website->save();

        return redirect()->back()->with('success', 'Member added successfully!');
    }

    public function edit($id)
    {
        $website = Website::findOrFail($id);
        return view('websites.edit', compact('website'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'client' => 'required|string|max:255',
            'url' => 'required|string|max:255',
        ]);

        $website = Website::findOrFail($id);
        $website->name = $validatedData['name'];
        $website->client = $validatedData['client'];
        $website->url = $validatedData['url'];
        $website->save();

        return redirect()->back()->with('success', 'Website updated successfully!');
    }

    // public function activateSSL($id)
    // {
    //     $website = Website::findOrFail($id);

    //     // Send the notification to the hardcoded email
    //     Notification::route('mail', 'learning9241@gmail.com')
    //         ->notify(new SSLActivatedNotification());

    //     // You can also store SSL status if needed
    //     // $website->ssl_active = true;
    //     // $website->save();

    //     return redirect()->back()->with('success', 'SSL activation email sent!');
    // }
    
    public function activateSSL($id)
    {
        $website = Website::findOrFail($id);

        Notification::route('mail', 'learning9241@gmail.com')
            ->notify(new SSLActivatedNotification($website));

        return redirect()->back()->with('success', 'SSL activation email sent!');
    }
}
