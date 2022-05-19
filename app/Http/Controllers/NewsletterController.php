<?php

namespace App\Http\Controllers;

use App\Mail\NewsletterMail;
use App\Models\NewsletterSubscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class NewsletterController extends Controller
{
    public function addSubscriber(Request $request) {
        if ($request->isMethod('post')) {
            $validator = $this->validateSubscriber($request);
            $success = '';

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()]);
            }
            $contact = $this->storeSubscriber($request);
        
            if ($contact) {
                $success = 'Iti multumim pentru ca te-ai abonat!';
                return response()->json(['success' => $success]);
            }
        }
    }

    public function validateSubscriber(Request $request) {
        $rules = [
            'email' => 'required|email|unique:newsletter_subscribers',
        ];
        $messages = [
            'email.email' => 'Va rugam sa furnizati un nume valid.',
            'email.required' => 'Campul email trebuie sa fie completat',
            'email.unique' => 'Email-ul exista deja in baza de date!',
        ];
        return
        Validator::make($request->all(), $rules, $messages);
    }

    public function storeSubscriber(Request $request) {
        $subscriber = new NewsletterSubscriber();
        $subscriber->email = $request->email;
        $subscriber->save();
        return $subscriber;
    }
    // public function sendEmail() {
    //     $subscribers = NewsletterSubscriber::all();
    //     foreach ($subscribers as $subscriber) {
    //         Mail::to($subscriber->email)->send(new NewsletterMail());
    //     }
    //     return new NewsletterMail();
    // }
    
}
