<?php

namespace App\Services;

use App\Models\DetailsRegattaSeason;
use App\Models\RegattaSeason;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RegattaSeasonService
{
    public function validateRegattaSeason(Request $request)
    {
        $rules = [
            'nume' => 'required',
            'descriere' => 'required',
            'nivel_performanta' => 'required',
            'an_fabricatie' => 'required|digits:4|integer',
            'pret' => 'required|regex:/^\d+(\.\d{1,5})?$/',
            'inceput_sezon' => 'required|date_format:Y-m-d',
            'final_sezon' => 'required|date_format:Y-m-d',
            'imagine' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'imagini.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',

        ];
        $messages = [
            'nume.required' => 'Campul Nume trebuie sa fie completat',
            'descriere.required' => 'Campul Descriere trebuie sa fie completat',
            'nivel_performanta.required' => 'Campul Nivel Performanta trebuie sa fie completat',
            'an_fabricatie.required' => 'Campul An Fabricatie trebuie sa fie completat',
            // 'an_fabricatie.digits' => 'Campul an fabricatie trebuie sa contina 4 cifre',
            'an_fabricatie.integer' => 'Campul Anul fabricatiei trebuie sa contina doar numere',
            'pret.required' => 'Campul Pret trebuie sa fie completat',
            'pret.regex' =>'Campul pret trebuie sa contina cifre',
            'inceput_sezon.required' => 'Campul Inceput sezon trebuie sa fie completat',
            'final_sezon.required' => 'Campul Final sezon trebuie sa fie completat',
            'imagine.image' => 'Tipul fisierul incarcat trebuie sa fie o imagine',
            'imagine.required' => 'Imaginea trebuie sa fie incarcata',
            'imagine.uploaded' => 'Nu s-a putut incarca imaginea. Dimensiunea maxima a imaginii este de 2 MB',
            'imagini.required' => 'Galeria de imagini trebuie sa fie incarcata',
            'imagini.image' => 'Tipul fisierelor incarcate trebuie sa fie o imagine',
            // 'check_in.date_format' => 'Campul Check-in trebuie sa fie de tip data',
            // 'check_out.date_format' => 'Campul Check-out trebuie sa fie de tip data',
        ];
        return
            Validator::make($request->all(), $rules, $messages);
    }

    public function storeRegattaSeason(Request $request)
    {
        // dd($request->all());
        $regattaSeason = new RegattaSeason();
        $regattaSeason->nume = $request->get('nume');
        $regattaSeason->descriere = $request->get('descriere');
        $regattaSeason->nivel_performanta = $request->get('nivel_performanta');
        $regattaSeason->model = $request->get('model_barca');
        $regattaSeason->an_fabricatie = $request->get('an_fabricatie');
        $regattaSeason->pret = $request->get('pret');
        if ($request->has('imagine')) {
            $regattaSeason->imagine = $request->imagine->getClientOriginalName();
            $request->file('imagine')->move(public_path('files'), $request->imagine->getClientOriginalName());
        }
        $regattaSeason->save();
        return $regattaSeason;
    }

    public function storeDetailsRegattaSeason(Request $request, $regattaSeason)
    {
        $detailsRegattaSeason = new DetailsRegattaSeason();
        $detailsRegattaSeason->regatta_season_id = $regattaSeason->id;
        $detailsRegattaSeason->inceput_sezon = $request->get('inceput_sezon');
        $detailsRegattaSeason->final_sezon = $request->get('final_sezon');
        $files = [];
        if ($request->has('imagini')) {
            foreach ($request->file('imagini') as $file) {
                $name = $file->getClientOriginalName();
                $file->move(public_path('files'), $name);
                $files[] = $name;
            }
        }

        $detailsRegattaSeason->imagini = $files;
        $detailsRegattaSeason->save();

        return $detailsRegattaSeason;
    }

    public function editRegattaSeason(Request $request)
    {
        $regattaSeason = RegattaSeason::with('details')->where('id', $request->regattaSeasonEditId)->first();
        $regattaSeason->nume = $request->get('nume');
        $regattaSeason->descriere = $request->get('descriere');
        $regattaSeason->nivel_performanta = $request->get('nivel_performanta');
        $regattaSeason->model = $request->get('model');
        $regattaSeason->an_fabricatie = $request->get('an_fabricatie');
        $regattaSeason->pret = $request->get('pret');
        if ($request->hasfile('imagine')) {
            $regattaSeason->imagine = $request->imagine->getClientOriginalName();
        }
        $regattaSeason->save();
        return $regattaSeason;
    }

    public function editDetailsRegattaSeason(Request $request, $regattaSeason)
    {
        $detailsRegattaSeason = DetailsRegattaSeason::where('regatta_season_id', $regattaSeason->id)->first();

        $detailsRegattaSeason->inceput_sezon = $request->get('inceput_sezon');
        $detailsRegattaSeason->final_sezon = $request->get('final_sezon');
        $files = [];
        if ($request->hasfile('imagini')) {
            foreach ($request->file('imagini') as $file) {
                $name = $file->getClientOriginalName();
                $file->move(public_path('files'), $name);
                $files[] = $name;
            }
            $detailsRegattaSeason->imagini = $files;
        }

        $detailsRegattaSeason->save();
        return $detailsRegattaSeason;
    }
}
