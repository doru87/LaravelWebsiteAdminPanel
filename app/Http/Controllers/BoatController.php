<?php

namespace App\Http\Controllers;

use App\Models\Boat;
use App\Services\BoatService;
use Illuminate\Http\Request;
use App\Mail\NewsletterMail;
use App\Models\CalendarSeasonRegatta;
use App\Models\Charter;
use App\Models\CorporateEvent;
use App\Models\CustomEvent;
use App\Models\Expedition;
use App\Models\NewsletterSubscriber;
use App\Models\Regatta;
use App\Models\RegattaSeason;
use Illuminate\Support\Facades\Mail;

class BoatController extends Controller
{
    protected $service;

    public function __construct()
    {
        $this->service = new BoatService();
    }
    public function index()
    {
        return view('admin.barca.barca');
    }
    public function create(Request $request)
    {

        if ($request->isMethod('post')) {
            $validator = $this->service->validateBoat($request);
            $success = '';

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()]);
            }

            $boat = $this->service->storeBoat($request);
            $detailsBoat = $this->service->storeDetailsBoat($request, $boat);

            if ($detailsBoat) {
                $subscribers = NewsletterSubscriber::all();
                foreach ($subscribers as $subscriber) {
                    Mail::to($subscriber->email)->later(now()->addMinutes(10), new NewsletterMail($boat));
                    // return new NewsletterMail();
                }
          
                $success = 'Barca a fost adaugata';
                return response()->json(['success' => $success]);
            }
        }
    }

    public function display(Request $request)
    {
        $data = Boat::with('details')->get();
        if ($request->ajax()) {
            return response()->json($data);
        }

        return view('admin.barca.afisare_barci')->with('data', $data);
    }

    public function edit(Request $request)
    {
        $validator = $this->service->validateBoat($request);
        $success = '';

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }

        $boat = $this->service->editBoat($request);
        $detailsBoat = $this->service->editDetailsBoat($request, $boat);

        if ($detailsBoat) {
            $success = 'Informatiile despre barca au fost editate';
            return response()->json(['success' => $success,'boat'=>$boat]);
        }
    }

    public function delete(Request $request)
    {

        $deletedBoat = Boat::where('id', $request->boatDeleteId)->delete();
        if ($deletedBoat) {
            $success = 'Barca a fost stearsa';
            return response()->json(['success' => $success]);
        }
    }
    public function testSlug() {

        $boats = Regatta::all();
        foreach ($boats as $boat) {
            $boat->nume = $boat->nume.' '; 
           $boat->save();
        }
        return 1;
    }
}
