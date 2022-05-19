<?php

namespace App\Services;

use App\Models\CorporateEvent;
use App\Models\DetailsCorporateEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CorporateEventService
{
    public function validateCorporateEvent(Request $request)
    {

        $rules = [
            'pozitie' => 'required|integer',
            'nume' => 'required', 'string',
            'descriere' => 'required',
            'tip_activitate' => 'required',
            'durata' => 'required',
            'destinatie' => 'required',
            'capacitate' => 'required',
            'imagine' => 'image|max:2048',
            'imagini.*' => 'image|max:2048',
            'servicii_incluse' => 'required',
            'servicii_optionale' => 'required',

        ];
        $messages = [
            'pozitie.required' => 'Campul Pozitie trebuie sa fie completat',
            'pozitie.integer' => 'Campul Pozitie trebuie sa contina doar numere',
            'nume.required' => 'Campul Nume trebuie sa fie completat',
            'descriere.required' => 'Campul Descriere trebuie sa fie completat',
            'tip_activitate.required' => 'Campul Tip activitate trebuie sa fie completat',
            'durata.required' => 'Campul Perioada trebuie sa fie completat',
            'destinatie.required' => 'Campul Destimatie trebuie sa fie completat',
            'capacitate.required' => 'Campul Perioada trebuie sa fie completat',
            'imagine.image' => 'Imaginea trebuie sa fie incarcata',
            'imagine.max' => 'Nu s-a putut incarca imaginea. Dimensiunea maxima a imaginii este de 2 MB',
            'servicii_incluse.required' => 'Campul Servicii incluse trebuie sa fie completat',
            'imagini.*.image' => 'Galeria de imagini trebuie sa fie incarcata',
            'imagini.*.max' => 'Nu s-a putut incarca imaginea din galerie. Dimensiunea maxima a imaginii este de 2 MB',
            'servicii_incluse.required' => 'Campul Servicii incluse trebuie sa fie completat',
            'servicii_optionale.required' => 'Campul Servicii optionale Check-out trebuie sa fie completat',

        ];

        return
            Validator::make($request->all(), $rules, $messages);
    }

    public function storeCorporateEvent(Request $request)
    {
        $corporateEvent = new CorporateEvent();
        $corporateEvent->nume = $request->get('nume');
        $corporateEvent->descriere = $request->get('descriere');
        $corporateEvent->tip_activitate = $request->get('tip_activitate');
        $corporateEvent->durata = $request->get('durata');
        $corporateEvent->destinatie = $request->get('destinatie');
        $corporateEvent->capacitate = $request->get('capacitate');
        if ($request->hasfile('imagine')) {
            $corporateEvent->imagine = $request->imagine->getClientOriginalName();
            $request->file('imagine')->move(public_path('files'), $request->imagine->getClientOriginalName());
        }
        $corporateEvent->pozitie = $request->get('pozitie');
        $corporateEvent->save();
        return $corporateEvent;
    }

    public function storeDetailsCorporateEvent(Request $request, $corporate)
    {
        $detailsCorporateEvent = new DetailsCorporateEvent();
        $detailsCorporateEvent->corporate_event_id = $corporate->id;

        $files = [];
        if ($request->hasfile('imagini')) {
            foreach ($request->file('imagini') as $file) {
                $name = $file->getClientOriginalName();
                $file->move(public_path('files'), $name);
                $files[] = $name;
            }
        }

        $detailsCorporateEvent->imagini = $files;
        $detailsCorporateEvent->servicii_incluse = $request->get('servicii_incluse');
        $detailsCorporateEvent->servicii_optionale = $request->get('servicii_optionale');

        $detailsCorporateEvent->save();
        return $detailsCorporateEvent;
    }

    public function editCorporateEvent(Request $request)
    {

        $corporateEvent = CorporateEvent::with('details')->where('id', $request->corporateEditId)->first();
        $corporateEvent->nume = $request->get('nume');
        $corporateEvent->descriere = $request->get('descriere');
        $corporateEvent->tip_activitate = $request->get('tip_activitate');
        $corporateEvent->durata = $request->get('durata');
        $corporateEvent->destinatie = $request->get('destinatie');
        $corporateEvent->capacitate = $request->get('capacitate');

        if ($request->hasfile('imagine')) {
            $corporateEvent->imagine = $request->imagine->getClientOriginalName();
            $request->file('imagine')->move(public_path('files'), $request->imagine->getClientOriginalName());
        }
        $corporateEvent->pozitie = $request->get('pozitie');
        $corporateEvent->save();
        return $corporateEvent;
    }

    public function editDetailsCorporateEvent(Request $request, $corporateEvent)
    {
        $corporateEvent = DetailsCorporateEvent::where('corporate_event_id', $corporateEvent->id)->first();

        $files = [];
        if ($request->hasfile('imagini')) {
            foreach ($request->file('imagini') as $file) {
                $name = $file->getClientOriginalName();
                $file->move(public_path('files'), $name);
                $files[] = $name;
            }
            $corporateEvent->imagini = $files;
        }

        $corporateEvent->servicii_incluse = $request->get('servicii_incluse');
        $corporateEvent->servicii_optionale = $request->get('servicii_optionale');
        $corporateEvent->save();

        return $corporateEvent;
    }
}
