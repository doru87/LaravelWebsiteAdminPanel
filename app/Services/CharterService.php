<?php

namespace App\Services;

use App\Models\Charter;
use App\Models\DetailsCharter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CharterService
{
    public function validateCharter(Request $request)
    {

        $rules = [
            'pozitie' => 'required|integer',
            'nume' => 'required', 'string',
            'descriere' => 'required',
            'perioada' => 'required',
            'capacitate' => 'required',
            // 'skipper' => 'required',
            'pret' => 'required',
            'imagine' => 'image|max:2048',
            'imagini.*' => 'image|max:2048',
            'servicii_incluse' => 'required',
            // 'check_in' => 'required|date_format:Y-m-d',
            // 'check_out' => 'required|date_format:Y-m-d',
        ];
        $messages = [
            'pozitie.required' => 'Campul Pozitie trebuie sa fie completat',
            'pozitie.integer' => 'Campul Pozitie trebuie sa contina doar numere',
            'nume.required' => 'Campul Nume trebuie sa fie completat',
            'descriere.required' => 'Campul Descriere trebuie sa fie completat',
            'perioada.required' => 'Campul Perioada trebuie sa fie completat',
            'capacitate.required' => 'Campul Perioada trebuie sa fie completat',
            // 'skipper.required' => 'Campul Skipper trebuie sa fie completat',
            'pret.required' => 'Campul Pret trebuie sa fie completat',
            'imagine.image' => 'Imaginea trebuie sa fie incarcata',
            'imagine.max' => 'Nu s-a putut incarca imaginea. Dimensiunea maxima a imaginii este de 2 MB',
            // 'imagine.required' => 'Imaginea trebuie sa fie incarcata',
            'imagine.uploaded' => 'Nu s-a putut incarca imaginea. Dimensiunea maxima a imaginii este de 2 MB',
            'servicii_incluse.required' => 'Campul Servicii incluse trebuie sa fie completat',
            // 'imagini.*.required' => 'Galeria de imagini trebuie sa fie incarcata',
            'imagini.*.image' => 'Galeria de imagini trebuie sa fie incarcata',
            'imagini.*.max' => 'Nu s-a putut incarca imaginea din galerie. Dimensiunea maxima a imaginii este de 2 MB',
            // 'check_in.required' => 'Campul Check-in trebuie sa fie completat',
            // 'check_out.required' => 'Campul Check-out trebuie sa fie completat',

        ];

        return
            Validator::make($request->all(), $rules, $messages);
    }

    public function storeCharter(Request $request)
    {
        $charter = new Charter();
        $charter->nume = $request->get('nume');
        $charter->descriere = $request->get('descriere');
        $charter->perioada = $request->get('perioada');
        $charter->capacitate = $request->get('capacitate');
        $charter->skipper = $request->get('skipper');
        $charter->pret = $request->get('pret');
        if ($request->hasfile('imagine')) {
            $charter->imagine = $request->imagine->getClientOriginalName();
            $request->file('imagine')->move(public_path('files'), $request->imagine->getClientOriginalName());
        }
        $charter->pozitie = $request->get('pozitie');
        $charter->save();
        return $charter;
    }

    public function storeDetailsCharter(Request $request, $charter)
    {
        $detailsCharter = new DetailsCharter();
        $detailsCharter->charter_id = $charter->id;

        $files = [];
        if ($request->hasfile('imagini')) {
            foreach ($request->file('imagini') as $file) {
                $name = $file->getClientOriginalName();
                $file->move(public_path('files'), $name);
                $files[] = $name;
            }
        }

        $detailsCharter->imagini = $files;
        $detailsCharter->servicii_incluse = $request->get('servicii_incluse');
        // $detailsCharter->check_in = $request->get('check_in');
        // $detailsCharter->check_out = $request->get('check_out');

        $detailsCharter->save();
        return $detailsCharter;
    }


    public function editCharter(Request $request)
    {

        $charter = Charter::with('details')->where('id', $request->charterEditId)->first();
        $charter->nume = $request->get('nume');
        $charter->descriere = $request->get('descriere');
        $charter->perioada = $request->get('perioada');
        $charter->capacitate = $request->get('capacitate');
        $charter->skipper = $request->get('skipper');
        $charter->pret = $request->get('pret');

        if ($request->hasfile('imagine')) {
            $charter->imagine = $request->imagine->getClientOriginalName();
            $request->file('imagine')->move(public_path('files'), $request->imagine->getClientOriginalName());
        }
        $charter->pozitie = $request->get('pozitie');
        $charter->save();
        return $charter;
    }

    public function editDetailsCharter(Request $request, $charter)
    {
        $detailsCharter = DetailsCharter::where('charter_id', $charter->id)->first();

        $files = [];
        if ($request->hasfile('imagini')) {
            foreach ($request->file('imagini') as $file) {
                $name = $file->getClientOriginalName();
                $file->move(public_path('files'), $name);
                $files[] = $name;
            }
            $detailsCharter->imagini = $files;
        }

        $detailsCharter->servicii_incluse = $request->get('servicii_incluse');
        // $detailsCharter->check_in = $request->get('check_in');
        // $detailsCharter->check_out = $request->get('check_out');
        $detailsCharter->save();

        return $detailsCharter;
    }
}
