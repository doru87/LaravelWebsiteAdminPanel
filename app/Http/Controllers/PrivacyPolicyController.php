<?php

namespace App\Http\Controllers;

use App\Models\PrivacyPolicy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PrivacyPolicyController extends Controller
{
    public function index()
    {
        return view('admin.politica-de-confidentialitate.politica-de-confidentialitate');
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
            $privacy_policy = new PrivacyPolicy();
            $privacy_policy->continut = $request->get('continut');
            $privacy_policy->save();

            if ($privacy_policy) {
                $success = 'Sectiunea Politica de confidentialitate a fost adaugata';
                return response()->json(['success' => $success]);
            }
        }

    } 
}
