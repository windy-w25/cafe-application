<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Client;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use App\Mail\ClientPasswordMail;

use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function add(Request $request)
    {
 
        return view('client.client_add');
    }

    public function view(Request $request)
    {
        $clients = Client::all();
        return view('client.view', compact('clients'));
    }

    public function store(Request $request)
    {
  
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'contact' => 'required|numeric',
            'gender' => 'required|in:male,female',
            'street_no' => 'required|string|max:255',
            'street_address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'email' => 'required|email',
            'dob_year' => 'required|numeric|digits:4',
            'dob_month' => 'required|numeric|between:1,12',
            'dob_day' => 'required|numeric|between:1,31',
            'status' => 'required|in:active,inactive',
        ]);

        $password = Str::random(10);
        $hashedPassword = Hash::make($password);

        $user = User::create([
            'name' => $validated['first_name'],
            'email' => $validated['email'],
            'password' => $hashedPassword,

        ]);

        $client = Client::create([
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'contact' => $validated['contact'],
            'gender' => $validated['gender'],
            'street_no' => $validated['street_no'],
            'street_address' => $validated['street_address'],
            'city' => $validated['city'],
            'email' => $validated['email'],
            'dob_year' => $validated['dob_year'],
            'dob_month' => $validated['dob_month'],
            'dob_day' => $validated['dob_day'],
            'status' => $validated['status'],
        ]);

   

        return redirect()->route('client-view')->with('success', 'Client created successfully.');
    }

    public function edit($id)
    {
        $client = Client::findOrFail($id);
        return view('client.client_edit', compact('client'));
    }

    public function update(Request $request, $id)
    {
 
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'contact' => 'required|numeric',
            'gender' => 'required|in:male,female',
            'street_no' => 'required|string|max:255',
            'street_address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'email' => 'required|email',
            'dob_year' => 'required|numeric|digits:4',
            'dob_month' => 'required|numeric|between:1,12',
            'dob_day' => 'required|numeric|between:1,31',
            'status' => 'required|in:active,inactive',
        ]);


        $client = Client::findOrFail($id);

        $client->update([
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'contact' => $validated['contact'],
            'gender' => $validated['gender'],
            'street_no' => $validated['street_no'],
            'street_address' => $validated['street_address'],
            'city' => $validated['city'],
            'email' => $validated['email'],
            'dob_year' => $validated['dob_year'],
            'dob_month' => $validated['dob_month'],
            'dob_day' => $validated['dob_day'],
            'status' => $validated['status'],
        ]);

        return redirect()->route('client-view')->with('success', 'Client updated successfully');
    }

    public function destroy($id)
    {

        $client = Client::findOrFail($id);
        $client->delete();

        return redirect()->route('client-view')->with('success', 'Client Deleted successfully');
    }

    public function show($id)
    {
        $client = Client::findOrFail($id);
        return response()->json($client);
    }

}
