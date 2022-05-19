<?php

namespace App\Http\Controllers;

use App\Models\AboutUs;
use App\Models\Boat;
use App\Models\CalendarRegatta;
use App\Models\CalendarSeasonRegatta;
use App\Models\Charter;
use App\Models\CorporateEvent;
use App\Models\CustomEvent;
use App\Models\Diary;
use App\Models\Expedition;
use App\Models\Regatta;
use App\Models\RegattaSeason;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class MainController extends Controller
{
    public function barci()
    {
        $barci = Boat::with('details')->orderBy('pozitie', 'asc')->paginate(20);
        foreach ($barci as $barca) {
            $descriere_trunchiata = Str::limit($barca->descriere, 80, '...');
            $barca->descriere = $descriere_trunchiata;
        }
        return view('frontend.barca.barci')->with('barci', $barci);
    }
    public function chartere(){
        $chartere = Charter::with('details')->orderBy('pozitie', 'asc')->paginate(20);
        foreach ($chartere as $charter) {
            $descriere_trunchiata = Str::limit($charter->descriere, 80, '...');
            $charter->descriere = $descriere_trunchiata;
        }
        return view('frontend.charter.chartere')->with('chartere', $chartere);
    }
    public function expeditii(){
        $expeditii = Expedition::with('details')->orderBy('pozitie', 'asc')->paginate(20);
        foreach ($expeditii as $expeditie) {
            $descriere_trunchiata = Str::limit($expeditie->descriere, 80, '...');
            $expeditie->descriere = $descriere_trunchiata;
        }
        return view('frontend.expeditie.expeditii')->with('expeditii', $expeditii);
    }
    public function regate(){
        $regate = Regatta::with('details')->orderBy('pozitie', 'asc')->paginate(20);
        // $calendarRegate = CalendarRegatta::with('regatta')->orderBy('pozitie', 'asc')->paginate(20);
        // $sezonregate = RegattaSeason::with('details')->paginate(3);
        foreach ($regate as $regata) {
            $descriere_trunchiata = Str::limit($regata->descriere, 80, '...');
            $regata->descriere = $descriere_trunchiata;
        }
        return view('frontend.regata.regate')->with(['regate'=> $regate]);
    }
    public function corporate(){
        $evenimente_corporate = CorporateEvent::with('details')->orderBy('pozitie', 'asc')->paginate(20);
        foreach ($evenimente_corporate as $eveniment_corporate) {
            $descriere_trunchiata = Str::limit($eveniment_corporate->descriere, 80, '...');
            $eveniment_corporate->descriere = $descriere_trunchiata;
        }
        return view('frontend.corporate.corporate')->with('evenimente_corporate', $evenimente_corporate);
    }
    public function evenimente(){
        $evenimente = CustomEvent::with('details')->orderBy('pozitie', 'asc')->paginate(20);

        foreach ($evenimente as $eveniment) {
            $descriere_trunchiata = Str::limit($eveniment->descriere, 80, '...');
            $eveniment->descriere = $descriere_trunchiata;
        }
        return view('frontend.eveniment.evenimente')->with('evenimente', $evenimente);
    }
    public function jurnale(){
        $jurnale = Diary::with('details')->orderBy('pozitie', 'asc')->paginate(20);
        foreach ($jurnale as $jurnal) {
            $descriere_trunchiata = Str::limit($jurnal->descriere, 60, '...');
            $jurnal->descriere = $descriere_trunchiata;
        }
        return view('frontend.jurnal.jurnale')->with('jurnale', $jurnale);
    }
    public function home()
    {
        $barci = Boat::with('details')->take(3)->get();
        $chartere = Charter::take(4)->get();
        foreach ($chartere as $charter) {
            $charter_trunchiat = Str::limit($charter->descriere, 80, '...');
            $charter->descriere = $charter_trunchiat;
        }
        $expeditii = Expedition::take(8)->get();
        foreach ($expeditii as $expeditie) {
            $itinerariu_trunchiat = Str::limit($expeditie->itinerariu, 40, '...');
            $expeditie->itinerariu = $itinerariu_trunchiat;
        }

        $regate = Regatta::take(4)->get();
        foreach ($regate as $regata) {
            $regata_trunchiata = Str::limit($regata->descriere, 80, '...');
            $regata->descriere = $regata_trunchiata;
        }
        $evenimente_corporate = CorporateEvent::take(4)->get();
        foreach ($evenimente_corporate as $eveniment_corporate) {
            $corporate_trunchiat = Str::limit($eveniment_corporate->descriere, 80, '...');
            $eveniment_corporate->descriere = $corporate_trunchiat;
        }
        $numarul_expeditii = Expedition::get()->count();
        $numarul_regate = Regatta::get()->count();
        $numarul_evenimente = CustomEvent::get()->count();

        return view('frontend.homepage')->with(['barci' => $barci, 'chartere' => $chartere, 'expeditii' => $expeditii, 'regate' => $regate, 'evenimente_corporate' => $evenimente_corporate, 'numarul_expeditii' => $numarul_expeditii, 'numarul_regate' => $numarul_regate, 'numarul_evenimente' => $numarul_evenimente]);
    }
    public function barca_detalii($slug)
    {
        $boat = Boat::with('details')->where('slug', $slug)->first();
        if(!$boat){
            abort(404);
        }
        return view('frontend.barca.barca_detalii')->with('boat', $boat);
    }
    public function charter_detalii($slug)
    {
        $charter = Charter::with('details')->where('slug', $slug)->first();
        if(!$charter){
            abort(404);
        }

        // $check_in = explode('-', $charter->details->check_in);
        // $check_out = explode('-', $charter->details->check_out);
        // $check_in = getMonths($check_in);
        // $check_out = getMonths($check_out);

        // $check_in_final = $check_in[2] . ' ' . $check_in[1] . ' ' . $check_in[0];
        // $check_out_final = $check_out[2] . ' ' . $check_out[1] . ' ' . $check_out[0];

        // $charter->details->check_in =  $check_in_final;
        // $charter->details->check_out =  $check_out_final;
        return view('frontend.charter.charter_detalii')->with('charter', $charter);
    }
    public function expeditie_detalii($slug)
    {
        $expedition = Expedition::with('details')->with('itineraries')->where('slug', $slug)->first();
        if(!$expedition){
            abort(404);
        }
        return view('frontend.expeditie.expeditie_detalii')->with('expedition', $expedition);
    }
    public function regata_detalii($slug)
    {
        $regata = Regatta::with('details')->where('slug', $slug)->first();
        if(!$regata){
            abort(404);
        }
        $slug = Boat::where('model',$regata->model)->first()->slug;
        $calendar = CalendarRegatta::orderBy('inceput_perioada', 'asc')->get();
        return view('frontend.regata.regata_detalii')->with(['regata'=>$regata,'slug'=>$slug,'calendar'=>$calendar]);
    }

    public function sezonregata_detalii ($slug) {
        $sezonregata = RegattaSeason::with('details')->where('slug', $slug)->first();
        if(!$sezonregata){
            abort(404);
        }
        $slug = Boat::where('model',$sezonregata->model)->first()->slug;
        // $id_barca=10;
        $calendar = CalendarSeasonRegatta::all();
        return view('frontend.regata.sezon_regate_detalii')->with(['sezonregata'=>$sezonregata,'slug'=>$slug,'calendar'=>$calendar]);
    }

    public function corporate_detalii($slug)
    {
        $corporate_event = CorporateEvent::with('details')->where('slug', $slug)->first();
        if(!$corporate_event){
            abort(404);
        }
        return view('frontend.corporate.corporate_detalii')->with('corporate_event',$corporate_event);
    }
    public function eveniment_detalii($slug)
    {
        $custom_event = CustomEvent::with('details')->where('slug', $slug)->first();
        if(!$custom_event){
            abort(404);
        }
        return view('frontend.eveniment.eveniment_detalii')->with('custom_event',$custom_event);
    }
    public function jurnal_detalii($slug)
    {
        $jurnal = Diary::with('details')->where('slug', $slug)->first();
        if(!$jurnal){
            abort(404);
        }
        return view('frontend.jurnal.jurnal_detalii')->with('jurnal',$jurnal);
    }

    // public function despre_noi() {
    //     $about_us = AboutUs::latest('id')->first();
    //     if(!$about_us){
    //         abort(404);
    //     }

        // return view('frontend.despre-noi.despre-noi')->with('about_us',$about_us);
    // }
    public function displayAboutUs() {
        $about_us = DB::table('about_us')->latest('id')->first();
        if (!$about_us) {
            abort(404);
            // return response()->json(['imagine'=>$about_us->imagine,'about_us'=>$about_us]);
        
        }
        return view('frontend.despre-noi.despre-noi')->with('about_us',$about_us)->with('imagine',$about_us->imagine);
    }
    public function displayPrivacyPolicy() {
        $privacy_policy = DB::table('privacy_policies')->latest('id')->first();
        if (!$privacy_policy) {
            abort(404);
            // return response()->json(['imagine'=>$about_us->imagine,'about_us'=>$about_us]);
        
        }
        return view('frontend.politica-de-confidentialitate.politica-de-confidentialitate')->with('privacy_policy',$privacy_policy);
    }
    public function displayTermsAndConditions() {
        $terms_and_conditions = DB::table('terms_and_conditions')->latest('id')->first();
        if (!$terms_and_conditions) {
            abort(404);
            // return response()->json(['imagine'=>$about_us->imagine,'about_us'=>$about_us]);
        
        }
        return view('frontend.termeni-si-conditii.termeni-si-conditii')->with('terms_and_conditions',$terms_and_conditions);
    }
}
