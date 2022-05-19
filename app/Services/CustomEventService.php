<?php

namespace App\Services;

use App\Models\CustomEvent;
use App\Models\DetailsCustomEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CustomEventService
{
    public function validateCustomEvent(Request $request)
    {
            $rules = [
                'pozitie' => 'required|integer',
                'nume' => 'required', 'string',
                'descriere' => 'required',
                'destinatie' => 'required',
                'imagine' => 'image|max:2048',
                'imagini.*' => 'image|max:2048',

            ];
            $messages = [
                'pozitie.required' => 'Campul Pozitie trebuie sa fie completat',
                'pozitie.integer' => 'Campul Pozitie trebuie sa contina doar numere',
                'nume.required' => 'Campul Nume trebuie sa fie completat',
                'descriere.required' => 'Campul Descriere trebuie sa fie completat',
                'destinatie.required' => 'Campul Destimatie trebuie sa fie completat',

                'imagine.image' => 'Imaginea trebuie sa fie incarcata',
                'imagine.max' => 'Nu s-a putut incarca imaginea. Dimensiunea maxima a imaginii este de 2 MB',
                
                'imagini.*.image' => 'Galeria de imagini trebuie sa fie incarcata',
                'imagini.*.max' => 'Nu s-a putut incarca imaginea din galerie. Dimensiunea maxima a imaginii este de 2 MB',
            ];

        return
            Validator::make($request->all(), $rules, $messages);
    }

    public function storeCustomEvent(Request $request)
    {
        // dd($request->all());
        $customEvent = new CustomEvent();
        $customEvent->nume = $request->get('nume');
        $customEvent->descriere = $request->get('descriere');
        $customEvent->destinatie = $request->get('destinatie');
        if ($request->hasfile('imagine')) {
            $customEvent->imagine = $request->imagine->getClientOriginalName();
            $request->file('imagine')->move(public_path('files'), $request->imagine->getClientOriginalName());
        }
        $customEvent->pozitie = $request->get('pozitie');
        $customEvent->save();
        return $customEvent;
    }

    public function storeDetailsCustomEvent(Request $request, $event)
    {
        $detailsCustomEvent = new DetailsCustomEvent();
        $detailsCustomEvent->custom_event_id = $event->id;

        $files = [];
        if ($request->hasfile('imagini')) {
            foreach ($request->file('imagini') as $file) {
                $name = $file->getClientOriginalName();
                $file->move(public_path('files'), $name);
                $files[] = $name;
            }
        }

        $detailsCustomEvent->imagini = $files;
        $detailsCustomEvent->save();
        return $detailsCustomEvent;
    }


    public function editCustomEvent(Request $request)
    {

        $customEvent = CustomEvent::with('details')->where('id', $request->eventEditId)->first();
        $customEvent->nume = $request->get('nume');
        $customEvent->descriere = $request->get('descriere');
        $customEvent->destinatie = $request->get('destinatie');

        if ($request->hasfile('imagine')) {
            $customEvent->imagine = $request->imagine->getClientOriginalName();
            $request->file('imagine')->move(public_path('files'), $request->imagine->getClientOriginalName());
        }
        $customEvent->pozitie = $request->get('pozitie');
        $customEvent->save();
        return $customEvent;
    }

    public function editDetailsCustomEvent(Request $request, $customEvent)
    {
        $customEvent = DetailsCustomEvent::where('custom_event_id', $customEvent->id)->first();

        $files = [];
        if ($request->hasfile('imagini')) {
            foreach ($request->file('imagini') as $file) {
                $name = $file->getClientOriginalName();
                $file->move(public_path('files'), $name);
                $files[] = $name;
            }
            $customEvent->imagini = $files;
        }
        $customEvent->save();

        return $customEvent;
    }
}
