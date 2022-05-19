<?php

namespace App\Http\Controllers;

use App\Models\Boat;
use App\Models\CalendarRegatta;
use App\Models\Regatta;
use App\Models\RegattaSeason;
use App\Services\RegataService;
use App\Services\RegattaSeasonService;
use Illuminate\Http\Request;

class RegattaSeasonController extends Controller
{
    protected $service;

    public function __construct()
    {
        $this->service = new RegattaSeasonService();
    }
    public function index()
    {
        $boats = Boat::all();
        return view('admin.sezon regata.sezon_regata')->with('boats', $boats);
    }

    public function create(Request $request)
    {
        if ($request->isMethod('post')) {
            $validator = $this->service->validateRegattaSeason($request);
            $success = '';

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()]);
            }

            $regattaSeason = $this->service->storeRegattaSeason($request);
            $detailsRegatta = $this->service->storeDetailsRegattaSeason($request, $regattaSeason);

            if ($detailsRegatta) {
                $success = 'Sezonul de regate a fost adaugat';
                return response()->json(['success' => $success]);
            }
        }
    }

    public function display()
    {
        $data = RegattaSeason::with(['details'])->get();
        return view('admin.sezon regata.afisare_sezon_regate')->with('data', $data);
    }

    public function edit(Request $request)
    {
        $validator = $this->service->validateRegattaSeason($request);
        $success = '';

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }

        $regattaSeason = $this->service->editRegattaSeason($request);
        $detailsRegatta = $this->service->editDetailsRegattaSeason($request, $regattaSeason);

        if ($detailsRegatta) {
            $success = 'Informatiile despre sezonul de regate au fost editate';
            return response()->json(['success' => $success,'regattaSeason'=>$regattaSeason]);
        }
    }

    public function delete(Request $request)
    {
        $deletedRegattaSeason = RegattaSeason::where('id', $request->regattaSeasonDeleteId)->delete();
        if ($deletedRegattaSeason) {
            $success = 'Sezonul de regate a fost stears';
            return response()->json(['success' => $success]);
        }
    }
}
