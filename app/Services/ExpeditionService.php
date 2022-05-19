<?php

namespace App\Services;

use App\Models\DetailsExpedition;
use App\Models\Expedition;
use App\Models\ExpeditionItinerary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ExpeditionService
{
    public function validateExpedition(Request $request)
    {
        $expedition = Expedition::where('nume', $request->nume)->first();

        // $images=[];
        // foreach ($request->imagini as $imagine) {
        //     $image = explode("/",urldecode($imagine));
        //     $new = $image[count($image)-1];
        //     array_push($images,$new);
        // }
        // dd($request->all());

        $rules = [
            'pozitie' => 'required|integer',
            'nume' => 'required',
            'descriere' => 'required',
            'locatie' => 'required',
            'modelBarcaSelectat' => 'required|not_in:0',
            'perioada' => 'required',
            'skipper' => 'required',
            'pret' => 'required',
            'imagine' => 'required|max:2048',
            'imagini.*' => 'required|max:2048',
            'servicii_incluse' => 'required',
            'check_in' => 'required|date_format:Y-m-d',
            'check_out' => 'required|date_format:Y-m-d',
        ];
        $messages = [
            'pozitie.required' => 'Campul Pozitie trebuie sa fie completat',
            'pozitie.integer' => 'Campul Pozitie trebuie sa contina doar numere',
            'nume.required' => 'Campul Nume trebuie sa fie completat',
            'descriere.required' => 'Campul Descriere trebuie sa fie completat',
            'locatie.required' => 'Campul Locatie trebuie sa fie completat',
            'modelBarcaSelectat.not_in' => 'Campul Model Barca trebuie sa fie selectat',
            'perioada.required' => 'Campul Perioada trebuie sa fie completat',
            'skipper.required' => 'Campul Skipper trebuie sa fie completat',
            'pret.required' => 'Campul Pret trebuie sa fie completat',
            // 'imagine.image' => 'Imaginea trebuie sa fie incarcata',
            'imagine.required' => 'Imaginea trebuie sa fie incarcata',
            'imagine.max' => 'Nu s-a putut incarca imaginea. Dimensiunea maxima a imaginii este de 2 MB',
            'servicii_incluse.required' => 'Campul Servicii incluse trebuie sa fie completat',
            'imagini.*.required' => 'Imaginea trebuie sa fie incarcata',
            // 'imagini.*.image' => 'Galeria de imagini trebuie sa fie incarcata',
            'imagini.*.max' => 'Nu s-a putut incarca imaginea din galerie. Dimensiunea maxima a imaginii este de 2 MB',
            'check_in.required' => 'Campul Check-in trebuie sa fie completat',
            'check_out.required' => 'Campul Check-out trebuie sa fie completat',
            // 'check_in.date_format' => 'Campul Check-in trebuie sa fie de tip data',
            // 'check_out.date_format' => 'Campul Check-out trebuie sa fie de tip data',

        ];
  
        return
            Validator::make($request->all(), $rules, $messages);
    }

    public function storeExpedition(Request $request)
    {
    //    dd($request->all());
        $itinerarii = json_decode($request->itinerarii, true);
        // dd($itinerarii);
        unset ($itinerarii[count($itinerarii)-1]);
        $expedition = new Expedition();
        $expedition->nume = $request->get('nume');
        $expedition->descriere = $request->get('descriere');
        $expedition->locatie = $request->get('locatie');
        $expedition->model = $request->get('modelBarcaSelectat');
        $expedition->perioada = $request->get('perioada');
        $expedition->skipper = $request->get('skipper');
        $expedition->pret = $request->get('pret');
        if ($request->hasfile('imagine')) {
            $expedition->imagine = $request->imagine->getClientOriginalName();
            $request->file('imagine')->move(public_path('files'), $request->imagine->getClientOriginalName());
        }
        $expedition->pozitie = $request->get('pozitie');
        $expedition->save();
        // dd($itinerarii);
        foreach ($itinerarii as $itinerariu) {
            if(!empty($itinerariu["destinatie"]) && !empty($itinerariu["perioada"]) && !empty($itinerariu["descriere"]) || !empty($itinerariu["destinatie"]) || !empty($itinerariu["perioada"]) || !empty($itinerariu["descriere"])){
                $expeditionItinerary = new ExpeditionItinerary();
                $expeditionItinerary->expedition_id = $expedition->id;
            
                    $expeditionItinerary->destinatie = $itinerariu["destinatie"];
                    $expeditionItinerary->perioada = $itinerariu["perioada"];
                    $expeditionItinerary->descriere = $itinerariu["descriere"];  
                
                $expeditionItinerary->save();
        }
        }

        return $expedition;
    }

    public function storeDetailsExpedition(Request $request, $expedition)
    {
        // dd($request->all());
        $detailsExpedition = new DetailsExpedition();
        $detailsExpedition->expedition_id = $expedition->id;

        $files = [];
        if ($request->hasfile('imagini')) {
            foreach ($request->file('imagini') as $file) {
                $name = $file->getClientOriginalName();
                $file->move(public_path('files'), $name);
                $files[] = $name;
            }
        }

        $detailsExpedition->imagini = $files;
        $detailsExpedition->servicii_incluse = $request->get('servicii_incluse');
        $detailsExpedition->check_in = $request->get('check_in');
        $detailsExpedition->check_out = $request->get('check_out');

        $detailsExpedition->save();
        return $detailsExpedition;
    }


    public function editExpedition(Request $request)
    {
        // dd($request->all());
 
        // $image = explode("/",urldecode($request->imagine));
        // dd($image[count($image)-1]);

        $expedition = Expedition::with('details')->where('id', $request->expeditionEditId)->first();
        $expedition->nume = $request->get('nume');
        $expedition->descriere = $request->get('descriere');
        $expedition->locatie = $request->get('locatie');
        $expedition->model = $request->get('modelBarcaSelectat');
        $expedition->perioada = $request->get('perioada');
        $expedition->skipper = $request->get('skipper');
        $expedition->pret = $request->get('pret');

        if ($request->hasfile('imagine')) {
            $expedition->imagine = $request->imagine->getClientOriginalName();
            $request->file('imagine')->move(public_path('files'), $request->imagine->getClientOriginalName());
        }
        $expedition->pozitie = $request->get('pozitie');
        $expedition->save();
        
        if($request->itinerarii !== null){
            foreach ($request->itinerarii as $key => $itinerariu) {
                $itinerariu = json_decode($itinerariu,true);
                $expedition_itineraries = ExpeditionItinerary::where('expedition_id',$request->expeditionEditId)->get();
                $expedition_itineraries[$key]->destinatie = $itinerariu["destinatie"];
                $expedition_itineraries[$key]->perioada = $itinerariu["perioada"];
                $expedition_itineraries[$key]->descriere = $itinerariu["descriere"];
                $expedition_itineraries[$key]->save();
        } 
        }
  
        return $expedition;
    }

    public function editDetailsExpedition(Request $request, $expedition)
    {
        // dd($request->all());
        $detailsExpedition = DetailsExpedition::where('expedition_id', $expedition->id)->first();

        $files = [];
        if ($request->hasfile('imagini')) {
            foreach ($request->file('imagini') as $file) {
                $name = $file->getClientOriginalName();
                $file->move(public_path('files'), $name);
                $files[] = $name;
            }
            $detailsExpedition->imagini = $files;
        }

        $detailsExpedition->servicii_incluse = $request->get('servicii_incluse');
        $detailsExpedition->check_in = $request->get('check_in');
        $detailsExpedition->check_out = $request->get('check_out');
        $detailsExpedition->save();

        return $detailsExpedition;
    }
}
