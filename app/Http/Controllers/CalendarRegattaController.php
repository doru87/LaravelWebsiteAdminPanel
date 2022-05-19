<?php

namespace App\Http\Controllers;

use App\Models\CalendarRegatta;
use App\Services\CalendarRegattaService;
use Illuminate\Http\Request;

class CalendarRegattaController extends Controller
{
    protected $service;

    public function __construct()
    {
        $this->service = new CalendarRegattaService();
    }
    public function index()
    {
        return view('admin.calendar_regate.calendar_regate');
    }

    public function create(Request $request)
    {
        if ($request->isMethod('post')) {
            $validator = $this->service->validateCalendarRegatta($request);
            $success = '';

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()]);
            }

            $calendarRegatta = $this->service->storeCalendarRegatta($request);

            if ($calendarRegatta) {
                $success = 'Calendarul a fost adaugat';
                return response()->json(['success' => $success]);
            }
        }
    }

    public function display()
    {
        $data = CalendarRegatta::get();
        return view('admin.calendar_regate.afisare_calendar_regate')->with('data', $data);
    }

    public function edit(Request $request)
    {
        $validator = $this->service->validateCalendarRegatta($request);
        $success = '';

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }

        $calendarRegatta = $this->service->editCalendarRegatta($request);

        if ($calendarRegatta) {
            $success = 'Informatiile despre calendar au fost editate';
            return response()->json(['success' => $success,'calendar'=>$calendarRegatta]);
        }
    }

    public function delete(Request $request)
    {
        $deletedCalendarRegatta = CalendarRegatta::where('id', $request->calendarDeleteId)->delete();
        if ($deletedCalendarRegatta) {
            $success = 'Calendarul a fost sters';
            return response()->json(['success' => $success]);
        }
    }
}
