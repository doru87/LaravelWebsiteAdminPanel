<?php

namespace App\Services;

use App\Models\CalendarRegatta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CalendarRegattaService
{
    public function validateCalendarRegatta(Request $request)
    {
            $rules = [
                'pozitie' => 'required|integer',
                'nume' => 'required',
                'inceput_perioada' => 'required|date_format:Y-m-d',
                'final_perioada' => 'required|date_format:Y-m-d',
                'locatie' => 'required',

            ];
            $messages = [
                'pozitie.required' => 'Campul Pozitie trebuie sa fie completat',
                'pozitie.integer' => 'Campul Pozitie trebuie sa contina doar numere',
                'nume.required' => 'Campul Nume trebuie sa fie completat',
                'inceput_perioada.required' => 'Campul Inceput perioada trebuie sa fie completat',
                'final_perioada.required' => 'Campul Final perioada trebuie sa fie completat',
                'locatie.required' => 'Campul Locatie trebuie sa fie completat',
            ];

        return
            Validator::make($request->all(), $rules, $messages);
    }

    public function storeCalendarRegatta(Request $request) {
        $calendarRegatta = new CalendarRegatta();
        $calendarRegatta->nume = $request->get('nume');;
        
        $inceput_perioada = explode('-', $request->get('inceput_perioada'));
        $final_perioada = explode('-', $request->get('final_perioada'));
        $inceput_perioada = getMonths($inceput_perioada);

        $perioada = $inceput_perioada[2] . '-' . $final_perioada[2] . ' ' . $inceput_perioada[1];

        $calendarRegatta->perioada = $perioada;
        
        $calendarRegatta->inceput_perioada = $request->get('inceput_perioada');
        $calendarRegatta->final_perioada = $request->get('final_perioada');

        $calendarRegatta->locatie = $request->get('locatie');
        $calendarRegatta->pozitie = $request->get('pozitie');
        $calendarRegatta->save();
        return $calendarRegatta;
    }
    public function editCalendarRegatta(Request $request)
    {
        $calendarRegatta = CalendarRegatta::where('id', $request->calendarEditId)->first();
        $calendarRegatta->nume = $request->get('nume');

        $inceput_perioada = explode('-', $request->get('inceput_perioada'));
        $final_perioada = explode('-', $request->get('final_perioada'));
        $inceput_perioada = getMonths($inceput_perioada);

        $perioada = $inceput_perioada[2] . '-' . $final_perioada[2] . ' ' . $inceput_perioada[1];
        $calendarRegatta->perioada = $perioada;

        $calendarRegatta->inceput_perioada = $request->get('inceput_perioada');
        $calendarRegatta->final_perioada = $request->get('final_perioada');
        $calendarRegatta->locatie = $request->get('locatie');
        $calendarRegatta->pozitie = $request->get('pozitie');
        $calendarRegatta->save();
        return $calendarRegatta;
    }

}