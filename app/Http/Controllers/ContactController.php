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


        $contact = new Contact(); // On instancie un nouvel objet Contact
        $contact->name = request('name'); // On attribue les valeurs des champs du formulaire
        $contact->email = request('email');
        $contact->message = request('message');
        $contact->phone = request('phone');

        $contact->save(); // On sauvegarde les données dans la base de données

        return redirect('/contact')->with('success', 'Message sent with sucess!!'); // On redirige l'utilisateur vers la page d'accueil

    }
}
