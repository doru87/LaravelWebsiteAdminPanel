<?php

namespace App\Http\Controllers;

namespace App\Http\Controllers;

use App\Models\Boat;
use App\Models\CalendarRegatta;
use App\Models\Regatta;
use App\Services\RegattaService;
use Illuminate\Http\Request;

class RegattaController extends Controller
{
    protected $service;

    public function __construct()
    {
        $this->service = new RegattaService();
    }
    public function index()
    {
        $boats = Boat::all();
        $calendarRegatta = CalendarRegatta::all();
        return view('admin.regata.regata')->with('boats', $boats)->with('calendarRegatta',$calendarRegatta);
    }

    public function create(Request $request)
    {
        if ($request->isMethod('post')) {
            $validator = $this->service->validateRegatta($request);
            $success = '';

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()]);
            }

            $regatta = $this->service->storeRegatta($request);
            $detailsRegatta = $this->service->storeDetailsRegatta($request, $regatta);

            if ($detailsRegatta) {
                $success = 'Regata a fost adaugata';
                return response()->json(['success' => $success]);
            }
        }
    }

    public function display()
    {
        // $data = CalendarRegatta::with(['regatta.details'])->get();
        $data = Regatta::with('details')->get();

        $boats = Boat::all();
        return view('admin.regata.afisare_regate')->with('data', $data)->with('boats', $boats);
    }

    public function edit(Request $request)
    {
        $validator = $this->service->validateRegatta($request);
        $success = '';

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }

        $regatta = $this->service->editRegatta($request);
        $detailsRegatta = $this->service->editDetailsRegatta($request, $regatta);

        if ($detailsRegatta) {
            $success = 'Informatiile despre regata au fost editate';
            return response()->json(['success' => $success,'regatta'=>$regatta]);
        }
    }

    public function delete(Request $request)
    {
        $regatta = Regatta::where('id', $request->regattaDeleteId)->delete();
        if ($regatta) {
            $success = 'Regata a fost stearsa';
            return response()->json(['success' => $success]);
        }
    }
    public function getCalendar(Request $request) {
        $calendar = CalendarRegatta::where('id', $request->id)->first();
        if (!$calendar) {
            return response()->json(['error' => "Calendaraul nu a fost gasit"]);
        }
        return response()->json(['success' => $calendar]);
    }
}

// namespace App\Http\Controllers;

// use App\Models\CalendarSeasonRegatta;
// use App\Models\Regatta;
// use App\Services\RegattaService;
// use Illuminate\Http\Request;

// class RegattaController extends Controller
// {
//     protected $service;

//     public function __construct()
//     {
//         $this->service = new RegattaService();
//     }
//     public function index()
//     {
//         return view('admin.regata.regata');
//     }

//     public function create(Request $request)
//     {
//         if ($request->isMethod('post')) {
//             $validator = $this->service->validateRegatta($request);
//             $success = '';

//             if ($validator->fails()) {
//                 return response()->json(['errors' => $validator->errors()]);
//             }

//             $regatta = $this->service->storeRegatta($request);
//             $detailsRegatta = $this->service->storeDetailsRegatta($request, $regatta);

//             if ($detailsRegatta) {
//                 $success = 'Regata a fost adaugata';
//                 return response()->json(['success' => $success]);
//             }
//         }
//     }

//     public function display()
//     {
//         $data = Regatta::with(['details', 'calendar'])->get();
//         return view('admin.regata.afisare_regate')->with('data', $data);
//     }

//     public function edit(Request $request)
//     {
//         $validator = $this->service->validateRegatta($request);
//         $success = '';

//         if ($validator->fails()) {
//             return response()->json(['errors' => $validator->errors()]);
//         }

//         $regatta = $this->service->editRegatta($request);
//         $detailsRegatta = $this->service->editDetailsRegatta($request, $regatta);

//         if ($detailsRegatta) {
//             $success = 'Informatiile despre regata au fost editate';
//             return response()->json(['success' => $success,'regatta'=>$regatta]);
//         }
//     }

//     public function delete(Request $request)
//     {
//         $deletedRegatta = Regatta::where('id', $request->regattaDeleteId)->delete();
//         if ($deletedRegatta) {
//             $success = 'Regata a fost stearsa';
//             return response()->json(['success' => $success]);
//         }
//     }
//     public function calendar()
//     {
//         $data = CalendarSeasonRegatta::all();
//         return view('admin.regata.calendar_regate')->with('data', $data);
//     }
// }
