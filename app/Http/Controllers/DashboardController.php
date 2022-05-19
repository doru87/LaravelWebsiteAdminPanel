<?php

namespace App\Http\Controllers;

use App\Models\Boat;
use App\Models\Charter;
use App\Models\CorporateEvent;
use App\Models\CustomEvent;
use App\Models\Diary;
use App\Models\Expedition;
use App\Models\Regatta;
use App\Models\RegattaSeason;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $barci = Boat::count();
        $chartere = Charter::count();
        $expeditii = Expedition::count();
        $regate = Regatta::count();
        $corporate = CorporateEvent::count();
        $evenimente = CustomEvent::count();
        $jurnale = Diary::count();
        
        return view('admin.dashboard', [
         'barci' => $barci,'chartere'=>$chartere,'expeditii'=>$expeditii,'regate'=>$regate,'corporate'=>$corporate,
         'evenimente'=>$evenimente,'jurnale'=>$jurnale]);
    }

}
