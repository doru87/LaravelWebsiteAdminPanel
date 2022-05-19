<?php

namespace App\Services;

use App\Models\CustomEvent;
use App\Models\DetailsDiary;
use App\Models\Diary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DiaryService
{
    public function validateDiary(Request $request)
    {

        $rules = [
            'pozitie' => 'required|integer',
            'descriere' => 'required',
            'inceput_perioada' => 'required|date_format:Y-m-d',
            'final_perioada' => 'required|date_format:Y-m-d',
            'itinerariu' => 'required',
            // 'descriere_detaliata' => 'required',

        ];
        $messages = [
            'pozitie.required' => 'Campul Pozitie trebuie sa fie completat',
            'pozitie.integer' => 'Campul Pozitie trebuie sa contina doar numere',
            'descriere.required' => 'Campul Descriere trebuie sa fie completat',
            'inceput_perioada.required' => 'Campul Inceput perioada trebuie sa fie completat',
            'final_perioada.required' => 'Campul Final perioada trebuie sa fie completat',
            'itinerariu.required' => 'Campul Itinerariu trebuie sa fie completat',
            // 'descriere_detaliata.required' => 'Campul Descriere detaliata trebuie sa fie completat',
        ];

        return
            Validator::make($request->all(), $rules, $messages);
    }

    public function storeDiary(Request $request)
    {
        $diary = new Diary();
        $event = CustomEvent::with('details')->where('id',$request->id_eveniment)->first();
        $diary->nume_eveniment = $request->get('nume_eveniment');
        $diary->descriere = $request->get('descriere');

        $inceput_perioada = explode('-', $request->get('inceput_perioada'));
        $final_perioada = explode('-', $request->get('final_perioada'));
        $inceput_perioada = getMonths($inceput_perioada);

        $perioada = $inceput_perioada[2] . '-' . $final_perioada[2] . ' ' . $inceput_perioada[1];

        $diary->perioada = $perioada;
        $diary->inceput_perioada = $request->get('inceput_perioada');
        $diary->final_perioada = $request->get('final_perioada');
        $diary->itinerariu = $request->get('itinerariu');
        $diary->imagine = $event->imagine;
        $diary->pozitie = $request->get('pozitie');
     
        $diary->save();
        return $diary;
    }

    public function storeDetailsDiary(Request $request, $diary)
    {
        $detailsDiary = new DetailsDiary();
        $event = CustomEvent::where('id',$request->id_eveniment)->first();
        $detailsDiary->diary_id = $diary->id;

        $detailsDiary->imagini = $event->details->imagini;
        $detailsDiary->save();

        return $detailsDiary;
    }


    public function editDiary(Request $request)
    {
        $diary = Diary::with('details')->where('id', $request->diaryEditId)->first();
        $diary->descriere = $request->get('descriere');

        $diary->inceput_perioada = $request->get('inceput_perioada');
        $diary->final_perioada = $request->get('final_perioada');

        $diary->itinerariu = $request->get('itinerariu');
        $diary->pozitie = $request->get('pozitie');

        $diary->save();

        return $diary;
    }

    public function editDetailsDiary(Request $request, $diary)
    {
        $detailsDiary = DetailsDiary::where('diary_id', $diary->id)->first();

        $files = [];
        if ($request->hasfile('imagini')) {
            foreach ($request->file('imagini') as $file) {
                $name = $file->getClientOriginalName();
                $file->move(public_path('files'), $name);
                $files[] = $name;
            }
            $detailsDiary->imagini = $files;
        }

        $detailsDiary->save();

        return $detailsDiary;
    }
}
