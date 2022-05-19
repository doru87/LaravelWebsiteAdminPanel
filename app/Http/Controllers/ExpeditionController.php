<?php

namespace App\Http\Controllers;

use App\Models\Boat;
use App\Models\Expedition;
use App\Services\ExpeditionService;
use DateTime;
use Illuminate\Http\Request;

class ExpeditionController extends Controller
{
    protected $service;

    public function __construct()
    {
        $this->service = new ExpeditionService();
    }
    public function index()
    {
        $boats = Boat::all();
        return view('admin.expeditie.expeditie')->with('boats', $boats);
    }

    public function create(Request $request)
    {
        if ($request->isMethod('post')) {
            $validator = $this->service->validateExpedition($request);
            $success = '';

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()]);
            }

            $expedition = $this->service->storeExpedition($request);
            $detailsExpedition = $this->service->storeDetailsExpedition($request, $expedition);

            if ($detailsExpedition) {
                $success = 'Expeditia a fost adaugata';
                return response()->json(['success' => $success]);
            }
        }
    }

    public function display()
    {
        $data = Expedition::with('details')->with('itineraries')->get();
        $boats = Boat::all();
        return view('admin.expeditie.afisare_expeditii')->with('data', $data)->with('boats', $boats);
    }

    public function edit(Request $request)
    {
        $validator = $this->service->validateExpedition($request);
        $success = '';

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }

        $expedition = $this->service->editExpedition($request);
        $detailsExpedition = $this->service->editDetailsExpedition($request, $expedition);

        if ($detailsExpedition) {
            $success = 'Informatiile despre expeditie au fost editate';
            return response()->json(['success' => $success,'expedition'=>$expedition]);
        }
    }
    public function delete(Request $request)
    {
        $deletedExpedition = Expedition::where('id', $request->expeditionDeleteId)->delete();
        if ($deletedExpedition) {
            $success = 'Expeditia a fost stearsa';
            return response()->json(['success' => $success]);
        }
    }
    public function setPeriod(Request $request){
        
        if ($request->has('check_in')) {
            $check_in = explode('-', $request->get('check_in'));
            $inceput_sezon = getMonths($check_in);
            $perioada = $inceput_sezon[2] . ' ' . $inceput_sezon[1] . '-';   
            return $perioada;
        }else if ($request->has('check_out')) {
            $check_out = explode('-', $request->get('check_out'));
            $final_sezon = getMonths($check_out);
            $perioada = $final_sezon[2] . ' ' . $final_sezon[1]. ' '.$check_out[0];
            return $perioada;
        }
     
    }
}
