<?php

namespace App\Services;

use App\Models\Boat;
use App\Models\DetailsBoat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Traits\DataTrait;
class BoatService
{
    use DataTrait;
    public function validateBoat(Request $request)
    {
        $rules = [
            'pozitie' => 'required|integer',
            'nume' => 'required', 'string',
            'model' => 'required', 'string',
            // 'an_fabricatie' => 'required|digits:4|integer',
            'capacitate' => 'required|integer',
            'layout' => 'required',
            'imagine' => 'image|max:2048',
            'descriere' => 'required',
            'wc_dus' => 'required',
            'lungime' => 'required',
            // 'imagini' => 'required',
            'imagini.*' => 'image|max:2048',
            'punte_cockpit' => 'required',
            'bucatarie_salon' => 'required',
            'cabine' => 'required',
            'echipament_navigatie' => 'required',
            'echipament_siguranta' => 'required',
        ];
        $messages = [
            'pozitie.required' => 'Campul Pozitie trebuie sa fie completat',
            'pozitie.integer' => 'Campul Pozitie trebuie sa contina doar numere',
            'nume.required' => 'Campul Nume trebuie sa fie completat',
            'model.required' => 'Campul Model trebuie sa fie completat',
            'model.string' => 'Campul Model trebuie sa contina doar litere',
            // 'an_fabricatie.required' => 'Campul an fabricatie trebuie sa fie completat',
            // 'an_fabricatie.digits' => 'Campul an fabricatie trebuie sa contina 4 cifre',
            'an_fabricatie.integer' => 'Campul Anul fabricatiei trebuie sa contina doar numere',
            // 'capacitate.required' => 'Campul capacitate trebuie sa fie completat',
            // 'capacitate.integer' => 'Campul an capacitate trebuie sa contina doar numere',
            'layout.required' => 'Campul Layout trebuie sa fie completat',
            // 'imagine.required' => 'Imaginea trebuie sa fie incarcata',
            'imagine.image' => 'Imaginea trebuie sa fie incarcata',
            'imagine.max' => 'Nu s-a putut incarca imaginea. Dimensiunea maxima a imaginii este de 2 MB',
            'descriere.required' => 'Campul Descriere trebuie sa fie completat',
            'wc_dus.required' => 'Campul Wc cu dus trebuie sa fie completat',
            'lungime.required' => 'Campul lungime trebuie sa fie completat',
            // 'imagini.*.required' => 'Galeria de imagini trebuie sa fie incarcata',
            'imagini.*.image' => 'Galeria de imagini trebuie sa fie incarcata',
            'imagini.*.max' => 'Nu s-a putut incarca imaginea din galerie. Dimensiunea maxima a imaginii este de 2 MB',
            'punte_cockpit.required' => 'Campul Dotari punte si cockpit trebuie sa fie completat',
            'bucatarie_salon.required' => 'Campul Dotari bucatarie si salon trebuie sa fie completat',
            'cabine.required' => 'Campul Cabine trebuie sa fie completat',
            'echipament_navigatie.required' => 'Campul Echipament de navigatie trebuie sa fie completat',
            'echipament_siguranta.required' => 'Campul Echipament de siguranta trebuie sa fie completat',

        ];
        return
            Validator::make($request->all(), $rules, $messages);
    }

    public function storeBoat(Request $request)
    {
        $boat = new Boat();
        $boat->nume = $request->get('nume');
        $boat->model = $request->get('model');
        $boat->an_fabricatie = $request->get('an_fabricatie');
        $boat->capacitate = $request->get('capacitate');
        $boat->layout = $request->get('layout');
        if ($request->hasfile('imagine')) {
            $boat->imagine = $request->imagine->getClientOriginalName();
            $request->file('imagine')->move(public_path('files'), $request->imagine->getClientOriginalName());
        }
        $boat->pozitie = $request->get('pozitie');
        $boat->save();
        return $boat;
    }

    public function storeDetailsBoat(Request $request, $boat)
    {
        $detailsBoat = new DetailsBoat();
        $detailsBoat->boat_id = $boat->id;
        $detailsBoat->descriere = $request->get('descriere');
        $detailsBoat->wc_dus = $request->get('wc_dus');
        $detailsBoat->lungime = $request->get('lungime');

        $files = [];
        if ($request->hasfile('imagini')) {
            foreach ($request->file('imagini') as $file) {
                $name = $file->getClientOriginalName();
                $file->move(public_path('files'), $name);
                $files[] = $name;
            }
        }
        // $files = $this->saveImages($request);

        $detailsBoat->imagini = $files;
        $detailsBoat->dotari_punte_cockpit = $request->get('punte_cockpit');
        $detailsBoat->dotari_bucatarie_salon = $request->get('bucatarie_salon');
        $detailsBoat->dotari_cabine = $request->get('cabine');
        $detailsBoat->echipament_navigatie = $request->get('echipament_navigatie');
        $detailsBoat->echipament_siguranta = $request->get('echipament_siguranta');

        $detailsBoat->save();
        return $detailsBoat;
    }

    public function editBoat(Request $request)
    {
        $boat = Boat::with('details')->where('id', $request->boatEditId)->first();
        $boat->nume = $request->get('nume');
        $boat->model = $request->get('model');
        $boat->an_fabricatie = $request->get('an_fabricatie');
        $boat->capacitate = $request->get('capacitate');
        $boat->layout = $request->get('layout');
        if ($request->hasfile('imagine')) {
            $boat->imagine = $request->imagine->getClientOriginalName();
            $request->file('imagine')->move(public_path('files'), $request->imagine->getClientOriginalName());
        }
        $boat->pozitie = $request->get('pozitie');
        $boat->save();
        return $boat;
    }

    public function editDetailsBoat(Request $request, $boat)
    {
        $detailsBoat = DetailsBoat::where('boat_id', $boat->id)->first();
        $detailsBoat->descriere = $request->get('descriere');
        $detailsBoat->wc_dus = $request->get('wc_dus');
        $detailsBoat->lungime = $request->get('lungime');

        $files = [];
        if ($request->hasfile('imagini')) {
            foreach ($request->file('imagini') as $file) {
                $name = $file->getClientOriginalName();
                $file->move(public_path('files'), $name);
                $files[] = $name;
            }
            $detailsBoat->imagini = $files;
        }
        // $files = $this->saveImages($request);
        
        // $detailsBoat->imagini = $files;
        $detailsBoat->dotari_punte_cockpit = $request->get('punte_cockpit');
        $detailsBoat->dotari_bucatarie_salon = $request->get('bucatarie_salon');
        $detailsBoat->dotari_cabine = $request->get('cabine');
        $detailsBoat->echipament_navigatie = $request->get('echipament_navigatie');
        $detailsBoat->echipament_siguranta = $request->get('echipament_siguranta');

        $detailsBoat->save();
        return $detailsBoat;
    }
}
