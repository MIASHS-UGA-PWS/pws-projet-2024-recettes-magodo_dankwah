<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
    //
    public function index()
    {
        $contacts = \App\Models\Contact::all();

        return view('/contact', [
            'contacts' => $contacts,

        ]);
    }

    public function create()
    {
        return view('/contact');
    }

    public function store()
    {
        request()->validate([
            'name' => ['required', 'string'],
            'email' => ['required', 'email'],
            'message' => ['required', 'string'],
            'phone' => ['required', 'string'],
        ]);


        $contact = new Contact(); // we instantiate a new object contact
        $contact->name = request('name'); // We assign values to the form fields
        $contact->email = request('email');
        $contact->message = request('message');
        $contact->phone = request('phone');

        $contact->save(); // we save the data in the database

        return redirect('/contact')->with('success', 'Message sent with sucess!!'); // we direct the user to the home page

    }
}
