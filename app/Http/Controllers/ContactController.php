<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Mail\ContactMail;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function __invoke(ContactRequest $request)
    {
         // Invia una email utilizzando la classe ContactMail con i dati di validazione
        Mail::to('marcofonti@gmail.com')->send(new ContactMail($request->name, $request->email, $request->body));

        // Salva i dati nel database
        $contact = new Contact();
        $contact->name = $request->name;
        $contact->email = $request->email;
        $contact->body = $request->body;
        $contact->save();
        
        // Reindirizza l'utente alla pagina precedente
        return redirect()->back();
    }
}