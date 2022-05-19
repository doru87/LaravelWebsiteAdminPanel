<?php

namespace App\Http\Controllers;

use App\Models\TermsAndConditions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TermsAndConditionsController extends Controller
{
    public function index()
    {
        return view('admin.termeni-si-conditii.termeni-si-conditii');
    }
    public function create(Request $request) {

        if ($request->isMethod('post')) {
            $success = '';

            $rules = [
                'continut' => 'required',
            ];
            $messages = [
                'continut.required' => 'Campul Continut trebuie sa fie completat',
            ];
            $validator = Validator::make($request->all(), $rules, $messages);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()]);
            }

            $terms_and_conditions = new TermsAndConditions();
            $terms_and_conditions->continut = $request->get('continut');
            $terms_and_conditions->save();

            if ($terms_and_conditions) {
                $success = 'Sectiunea Termeni si conditii a fost adaugata';
                return response()->json(['success' => $success]);
            }
        }

    } 
}
