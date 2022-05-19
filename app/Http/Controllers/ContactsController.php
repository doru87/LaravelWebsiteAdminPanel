<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;

class ContactsController extends Controller
{
    public function display(Request $request)
    {
        $data = Contact::get();
        return view('admin.contact.afisare_contact')->with('data', $data);
    }

    public function delete(Request $request)
    {
        $deletedContact = Contact::where('id', $request->contactDeleteId)->delete();
        if ($deletedContact) {
            $success = 'Mesajul a fost sters';
            return response()->json(['success' => $success]);
        }
    }
}
