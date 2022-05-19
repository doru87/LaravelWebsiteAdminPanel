<?php
namespace App\Services;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use TimeHunter\LaravelGoogleReCaptchaV3\Validations\GoogleReCaptchaV3ValidationRule;

class ContactService {
    public function validateContact(Request $request) {
        $rules = [
            'nume' => 'required|regex:/^[a-zA-Z]+ [a-zA-Z]+$/',
            'email' => 'required|email',
            'telefon' => 'required|regex:/^(?=0[723][2-8]\d{7})(?!.*(.)\1{2,}).{10}$/|min:10',
            'mesaj' => 'required',
            'g-recaptcha-response' => [new GoogleReCaptchaV3ValidationRule('contact_us_action')]
        ];
        $messages = [
            'nume.required' => 'Campul nume trebuie sa fie completat',
            'nume.regex' => 'Va rugam sa furnizati un nume valid, incluzand nume si prenume.',
            'email.required' => 'Campul email trebuie sa fie completat',
            'email.email' => 'Va rugam sa furnizati un email valid.',
            'telefon.required' => 'Campul telefon trebuie sa fie completat',
            'telefon.regex' => 'Va rugam sa furnizati un numar valid.',
            'telefon.min' => 'Campul telefon trebuie sa aibe minim 10 cifre',
            'mesaj.required' => 'Campul mesaj trebuie sa fie completat',
        ];
        return
        $validator = Validator::make($request->all(), $rules, $messages);
        // dd($validator->toArray());
    }

    public function storeContact(Request $request)
    {
        $contact = new Contact();
        $contact->nume = $request->get('nume');
        $contact->email = $request->get('email');
        $contact->telefon = $request->get('telefon');
        $contact->mesaj = $request->get('mesaj');

        $contact->save();
        return $contact;
    }

}