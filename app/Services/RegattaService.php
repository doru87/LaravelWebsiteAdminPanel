<?php

namespace App\Services;

use App\Models\Boat;
use App\Models\DetailsRegatta;
use App\Models\Regatta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RegattaService
{
    public function validateRegatta(Request $request)
    {
        $boats = Boat::all()->pluck('model')->toArray();
        $list = implode(",", $boats);
        $trim = trim($list,'"');

        $rules = [
            'pozitie' => 'required|integer',
            'nume' => 'required',
            'descriere' => 'required',
            'nivel_performanta' => 'required',
            'modelBarcaSelectat' => 'required|not_in:0',
            'an_fabricatie' => 'required|digits:4|integer',
            'pret' => 'required',


        ];
        $messages = [
            'pozitie.required' => 'Campul Pozitie trebuie sa fie completat',
            'pozitie.integer' => 'Campul Pozitie trebuie sa contina doar numere',
            'nume.required' => 'Campul Nume trebuie sa fie completat',
            'descriere.required' => 'Campul Descriere trebuie sa fie completat',
            'nivel_performanta.required' => 'Campul Nivel Performanta trebuie sa fie completat',
            'modelBarcaSelectat.not_in' => 'Campul Model Barca trebuie sa fie selectat',
            'an_fabricatie.required' => 'Campul An Fabricatie trebuie sa fie completat',
            'an_fabricatie.integer' => 'Campul Anul fabricatiei trebuie sa contina doar numere',
            'pret.required' => 'Campul Pret trebuie sa fie completat',
        ];

        return
            Validator::make($request->all(), $rules, $messages);
    }

    public function storeRegatta(Request $request)
    {
        $regatta = new Regatta();
        $regatta->nume = $request->get('nume');
        $regatta->descriere = $request->get('descriere');
        $regatta->nivel_performanta = $request->get('nivel_performanta');
        $regatta->model = $request->get('modelBarcaSelectat');
        $regatta->an_fabricatie = $request->get('an_fabricatie');
        $regatta->pret = $request->get('pret');
        if ($request->has('imagine')) {
            $regatta->imagine = $request->imagine->getClientOriginalName();
            $request->file('imagine')->move(public_path('files'), $request->imagine->getClientOriginalName());
        }
        $regatta->pozitie = $request->get('pozitie');
        $regatta->save();
        return $regatta;
    }

    public function storeDetailsRegatta(Request $request, $regatta)
    {
        $detailsRegatta = new DetailsRegatta();
        $detailsRegatta->regatta_id = $regatta->id;
        $detailsRegatta->inceput_sezon = $request->get('inceput_sezon');
        $detailsRegatta->final_sezon = $request->get('final_sezon');
        $files = [];
        if ($request->has('imagini')) {
            foreach ($request->file('imagini') as $file) {
                $name = $file->getClientOriginalName();
                $file->move(public_path('files'), $name);
                $files[] = $name;
            }
        }

        $detailsRegatta->imagini = $files;
        $detailsRegatta->save();

        return $detailsRegatta;
    }

    public function editRegatta(Request $request)
    {
        // dd($request->all());
        $regatta = Regatta::with('details')->where('id', $request->regattaEditId)->first();
        $regatta->nume = $request->get('nume');
        $regatta->descriere = $request->get('descriere');
        $regatta->nivel_performanta = $request->get('nivel_performanta');
        $regatta->model = $request->get('modelBarcaSelectat');
        $regatta->an_fabricatie = $request->get('an_fabricatie');
        $regatta->pret = $request->get('pret');
        if ($request->hasfile('imagine')) {
            $regatta->imagine = $request->imagine->getClientOriginalName();
            $request->file('imagine')->move(public_path('files'), $request->imagine->getClientOriginalName());
        }
        $regatta->pozitie = $request->get('pozitie');
        $regatta->save();
        return $regatta;
    }

    public function editDetailsRegatta(Request $request, $regatta)
    {
        $detailsRegatta = DetailsRegatta::where('regatta_id', $regatta->id)->first();

        $detailsRegatta->inceput_sezon = $request->get('inceput_sezon');
        $detailsRegatta->final_sezon = $request->get('final_sezon');
        $files = [];
        if ($request->hasfile('imagini')) {
            foreach ($request->file('imagini') as $file) {
                $name = $file->getClientOriginalName();
                $file->move(public_path('files'), $name);
                $files[] = $name;
            }
            $detailsRegatta->imagini = $files;
        }

        $detailsRegatta->save();
        return $detailsRegatta;
    }
}

// namespace App\Services;

// use App\Models\CalendarRegatta;
// use App\Models\CalendarSeasonRegatta;
// use App\Models\DetailsExpedition;
// use App\Models\DetailsRegatta;
// use App\Models\Expedition;
// use App\Models\Regatta;
// use DateTime;
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Validator;

// class RegattaService
// {
//     public function validateRegatta(Request $request)
//     {
//         $regatta = Regatta::where('nume', $request->nume)->first();
//         $rules = [
//             'nume' => 'required',
//             'descriere' => 'required',
//             'pret' => 'required|integer',
//             'inceput_sezon' => 'required|date_format:Y-m-d',
//             'final_sezon' => 'required|date_format:Y-m-d',
//             'imagine' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
//             'imagini.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',

//         ];
//         $messages = [
//             'nume.required' => 'Campul Nume trebuie sa fie completat',
//             'descriere.required' => 'Campul Descriere trebuie sa fie completat',
//             'pret.required' => 'Campul Pret trebuie sa fie completat',
//             'pret.integer' => 'Campul Pret trebuie sa contina cifre',
//             'inceput_sezon.required' => 'Campul Inceput sezon trebuie sa fie completat',
//             'final_sezon.required' => 'Campul Final sezon trebuie sa fie completat',
//             'imagine.image' => 'Tipul fisierul incarcat trebuie sa fie o imagine',
//             'imagine.required' => 'Imaginea trebuie sa fie incarcata',
//             'imagine.uploaded' => 'Nu s-a putut incarca imaginea. Dimensiunea maxima a imaginii este de 2 MB',
//             'imagini.required' => 'Galeria de imagini trebuie sa fie incarcata',
//             'imagini.image' => 'Tipul fisierelor incarcate trebuie sa fie o imagine',
//             // 'check_in.date_format' => 'Campul Check-in trebuie sa fie de tip data',
//             // 'check_out.date_format' => 'Campul Check-out trebuie sa fie de tip data',
//         ];
//         return
//             Validator::make($request->all(), $rules, $messages);
//     }

//     public function storeRegatta(Request $request)
//     {
//         $regatta = new Regatta();
//         $regatta->nume = $request->get('nume');
//         $regatta->descriere = $request->get('descriere');
//         $regatta->pret = $request->get('pret');
//         if ($request->has('imagine')) {
//             $regatta->imagine = $request->imagine->getClientOriginalName();
//             $request->file('imagine')->move(public_path('files'), $request->imagine->getClientOriginalName());
//         }
//         $regatta->save();
//         return $regatta;
//     }

//     public function storeDetailsRegatta(Request $request, $regatta)
//     {
//         $detailsRegatta = new DetailsRegatta();
//         $detailsRegatta->regatta_id = $regatta->id;
//         $detailsRegatta->inceput_sezon = $request->get('inceput_sezon');
//         $detailsRegatta->final_sezon = $request->get('final_sezon');
//         $files = [];
//         if ($request->has('imagini')) {
//             foreach ($request->file('imagini') as $file) {
//                 $name = $file->getClientOriginalName();
//                 $file->move(public_path('files'), $name);
//                 $files[] = $name;
//             }
//         }

//         $detailsRegatta->imagini = $files;
//         $detailsRegatta->save();
//         $this->createCalendarSeasonRegatta($request, $regatta);
//         return $detailsRegatta;
//     }

//     public function createCalendarSeasonRegatta($request, $regatta)
//     {
//         $calendarSeasonRegatta = new CalendarSeasonRegatta();
//         $calendarSeasonRegatta->regatta_id = $regatta->id;
//         $calendarSeasonRegatta->nume = $request->nume;
//         $calendarSeasonRegatta->locatie = $request->locatie;

//         $inceput_sezon = explode('-', $request->get('inceput_sezon'));
//         $final_sezon = explode('-', $request->get('final_sezon'));
//         $inceput_sezon = getMonths($inceput_sezon);

//         $perioada = $inceput_sezon[2] . '-' . $final_sezon[2] . ' ' . $inceput_sezon[1];

//         $calendarSeasonRegatta->perioada = $perioada;
//         $calendarSeasonRegatta->save();
//     }


//     public function editRegatta(Request $request)
//     {
//         $regatta = Regatta::with('details')->where('id', $request->regattaEditId)->first();
//         $regatta->nume = $request->get('nume');
//         $regatta->descriere = $request->get('descriere');
//         $regatta->pret = $request->get('pret');
//         if ($request->hasfile('imagine')) {
//             $regatta->imagine = $request->imagine->getClientOriginalName();
//         }
//         $regatta->save();
//         return $regatta;
//     }

//     public function editDetailsRegatta(Request $request, $regatta)
//     {
//         $detailsRegatta = DetailsRegatta::where('regatta_id', $regatta->id)->first();

//         $detailsRegatta->inceput_sezon = $request->get('inceput_sezon');
//         $detailsRegatta->final_sezon = $request->get('final_sezon');
//         $files = [];
//         if ($request->hasfile('imagini')) {
//             foreach ($request->file('imagini') as $file) {
//                 $name = $file->getClientOriginalName();
//                 $file->move(public_path('files'), $name);
//                 $files[] = $name;
//             }
//             $detailsRegatta->imagini = $files;
//         }

//         $detailsRegatta->save();
//         $this->updateCalendarSeasonRegatta($request, $regatta);
//         return $detailsRegatta;
//     }

//     public function updateCalendarSeasonRegatta($request, $regatta)
//     {

//         $calendarRegatta = CalendarSeasonRegatta::where('regatta_id', $regatta->id)->first();

//         $inceput_sezon = explode('-', $request->get('inceput_sezon'));
//         $final_sezon = explode('-', $request->get('final_sezon'));

//         $inceput_sezon = getMonths($inceput_sezon);
//         $final_sezon = getMonths($final_sezon);

//         $perioada = $inceput_sezon[2] . ' ' . $inceput_sezon[1] . '-' . $final_sezon[2] . ' ' . $final_sezon[1];
//         $calendarRegatta->perioada = $perioada;
//         $calendarRegatta->locatie = $request->get('locatie');
//         $calendarRegatta->save();
//     }
// }
