<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Services\ContactService;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    protected $service;

    public function __construct()
    {
        $this->service = new ContactService();
    }
    public function contact() {
        return view('frontend.contact.contact');
    }

    public function create(Request $request)
    {
        if ($request->isMethod('post')) {
            $validator = $this->service->validateContact($request);
            $success = '';

            if ($validator->fails()) {
                return  back()
                    ->withErrors($validator)
                    ->withInput();
            }

            // if ($validator->fails()) {
            //     return response()->json(['errors' => $validator->errors()]);
            // }

            $contact = $this->service->storeContact($request);
        
            if ($contact) {
                $success = 'Datele au fost trimise cu succes!';
                // return response()->json(['success' => $success]);
                return redirect()->back()->with(['success' => $success]);

            }
        }
    }
    
}
