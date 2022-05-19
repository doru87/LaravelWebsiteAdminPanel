<?php

namespace App\Http\Controllers;

use App\Models\CustomEvent;
use App\Models\Diary;
use App\Services\DiaryService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DiaryController extends Controller
{
    protected $service;

    public function __construct()
    {
        $this->service = new DiaryService();
    }
    public function index()
    {
        $customEvents = CustomEvent::all();
        return view('admin.jurnal.jurnal')->with('customEvents', $customEvents);
    }
    public function getEvent(Request $request)
    {
        $event = CustomEvent::with('details')->where('id', $request->id)->first();
        if (!$event) {
            return response()->json(['error' => "Evenimentul nu a fost gasit"]);
        }
        return response()->json(['success' => $event]);
    }

    public function create(Request $request)
    {
        if ($request->isMethod('post')) {
            $validator = $this->service->validateDiary($request);
            $success = '';

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()]);
            }

            $diary = $this->service->storeDiary($request);
            $detailsDiary = $this->service->storeDetailsDiary($request, $diary);

            if ($detailsDiary) {
                $success = 'Jurnalul a fost adaugat';
                return response()->json(['success' => $success]);
            }
        }
    }

    public function display()
    {
        $data = Diary::with('details')->get();
        return view('admin.jurnal.afisare_jurnale')->with('data', $data);
    }

    public function edit(Request $request)
    {
        $validator = $this->service->validateDiary($request);
        $success = '';

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }

        $diary = $this->service->editDiary($request);
        $detailsDiary = $this->service->editDetailsDiary($request, $diary);

        if ($detailsDiary) {
            $success = 'Informatiile despre jurnal au fost editate';
            return response()->json(['success' => $success,'diary'=>$diary]);
        }
    }
    public function delete(Request $request)
    {
        $deletedDiary = Diary::where('id', $request->diaryDeleteId)->delete();
        if ($deletedDiary) {
            $success = 'Jurnalul a fost stears';
            return response()->json(['success' => $success]);
        }
    }
}
