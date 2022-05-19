<?php

namespace App\Http\Controllers;

use App\Models\Charter;
use App\Services\CharterService;
use DateTime;
use Illuminate\Http\Request;

class CharterController extends Controller
{
    protected $service;

    public function __construct()
    {
        $this->service = new CharterService();
    }
    public function index()
    {
        return view('admin.charter.charter');
    }

    public function create(Request $request)
    {

        if ($request->isMethod('post')) {
            $validator = $this->service->validateCharter($request);
            $success = '';

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()]);
            }

            $charter = $this->service->storeCharter($request);
            $detailsCharter = $this->service->storeDetailsCharter($request, $charter);

            if ($detailsCharter) {
                $success = 'Charter-ul a fost adaugat';
                return response()->json(['success' => $success]);
            }
        }
    }

    public function display()
    {
        $data = Charter::with('details')->get();
        return view('admin.charter.afisare_chartere')->with('data', $data);
    }

    public function edit(Request $request)
    {
        $validator = $this->service->validateCharter($request);
        $success = '';

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }

        $charter = $this->service->editCharter($request);
        $detailsCharter = $this->service->editDetailsCharter($request, $charter);

        if ($detailsCharter) {
            $success = 'Informatiile despre charter au fost editate';
            return response()->json(['success' => $success,'charter'=>$charter]);
        }
    }
    public function delete(Request $request)
    {
        $deletedCharter = Charter::where('id', $request->charterDeleteId)->delete();
        if ($deletedCharter) {
            $success = 'Charter-ul a fost stears';
            return response()->json(['success' => $success]);
        }
    }
    public function setPeriod(Request $request){

        $check_in = $request->check_in;
        $check_out = $request->check_out;

        $check_in = explode('-', $check_in);
        $check_out = explode('-', $check_out);

        $inceput = new DateTime();
        $inceput->setDate($check_in[0], $check_in[1], $check_in[2]);
        $final = new DateTime();
        $final->setDate($check_out[0], $check_out[1], $check_out[2]);

        $difference = $inceput->diff($final);
        return $difference->days;
    }
}
