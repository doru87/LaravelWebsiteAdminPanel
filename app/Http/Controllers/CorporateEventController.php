<?php

namespace App\Http\Controllers;

use App\Models\CorporateEvent;
use App\Services\CorporateEventService;
use Illuminate\Http\Request;

class CorporateEventController extends Controller
{
    protected $service;

    public function __construct()
    {
        $this->service = new CorporateEventService();
    }
    public function index()
    {
        return view('admin.corporate.eveniment_corporate');
    }

    public function create(Request $request)
    {
        if ($request->isMethod('post')) {
            $validator = $this->service->validateCorporateEvent($request);
            $success = '';

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()]);
            }

            $corporate = $this->service->storeCorporateEvent($request);
            $detailsCorporate = $this->service->storeDetailsCorporateEvent($request, $corporate);

            if ($detailsCorporate) {
                $success = 'Evenimentul corporate a fost adaugat';
                return response()->json(['success' => $success]);
            }
        }
    }

    public function display()
    {
        $data = CorporateEvent::with('details')->get();
        return view('admin.corporate.afisare_corporate')->with('data', $data);
    }

    public function edit(Request $request)
    {
        $validator = $this->service->validateCorporateEvent($request);
        $success = '';

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }

        $corporateEvent = $this->service->editCorporateEvent($request);
        $detailsCorporateEvent = $this->service->editDetailsCorporateEvent($request, $corporateEvent);

        if ($detailsCorporateEvent) {
            $success = 'Informatiile despre evenimentul corporate au fost editate';
            return response()->json(['success' => $success,'corporateEvent'=>$corporateEvent]);
        }
    }
    public function delete(Request $request)
    {
        $deletedCorporate = CorporateEvent::where('id', $request->corporateDeleteId)->delete();
        if ($deletedCorporate) {
            $success = 'Evenimentul corporate a fost sters';
            return response()->json(['success' => $success]);
        }
    }
}
