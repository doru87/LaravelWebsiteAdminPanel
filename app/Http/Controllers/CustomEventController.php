<?php

namespace App\Http\Controllers;

use App\Models\CorporateEvent;
use App\Models\CustomEvent;
use App\Services\CustomEventService;
use Illuminate\Http\Request;

class CustomEventController extends Controller
{
    protected $service;

    public function __construct()
    {
        $this->service = new CustomEventService();
    }
    public function index()
    {
        return view('admin.eveniment.eveniment_personalizat');
    }

    public function create(Request $request)
    {
        if ($request->isMethod('post')) {
            $validator = $this->service->validateCustomEvent($request);
            $success = '';

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()]);
            }

            $event = $this->service->storeCustomEvent($request);
            $detailsEvent = $this->service->storeDetailsCustomEvent($request, $event);

            if ($detailsEvent) {
                $success = 'Evenimentul personalizat a fost adaugat';
                return response()->json(['success' => $success]);
            }
        }
    }

    public function display()
    {
        $data = CustomEvent::with('details')->get();
        return view('admin.eveniment.afisare_eveniment')->with('data', $data);
    }

    public function edit(Request $request)
    {
        $validator = $this->service->validateCustomEvent($request);
        $success = '';

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }

        $customEvent = $this->service->editCustomEvent($request);
        $detailsCustomeEvent = $this->service->editDetailsCustomEvent($request, $customEvent);

        if ($detailsCustomeEvent) {
            $success = 'Informatiile despre evenimentul personalizat au fost editate';
            return response()->json(['success' => $success,'customEvent'=>$customEvent]);
        }
    }
    public function delete(Request $request)
    {
        $deletedEvent = CustomEvent::where('id', $request->eventDeleteId)->delete();
        if ($deletedEvent) {
            $success = 'Evenimentul personalizat a fost sters';
            return response()->json(['success' => $success]);
        }
    }
}
