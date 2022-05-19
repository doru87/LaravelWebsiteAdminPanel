<?php

use App\Http\Controllers\AboutUsController;
use App\Http\Controllers\BoatController;
use App\Http\Controllers\CalendarRegattaController;
use App\Http\Controllers\CharterController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ContactsController;
use App\Http\Controllers\CorporateEventController;
use App\Http\Controllers\CustomEventController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DiaryController;
use App\Http\Controllers\ExpeditionController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\PrivacyPolicyController;
use App\Http\Controllers\RegattaController;
use App\Http\Controllers\RegattaSeasonController;
use App\Http\Controllers\TermsAndConditionsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('admin.dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';

Route::get('/test', [BoatController::class, 'testSlug']);
Route::get('/', [MainController::class, 'home'])->name('home.index');
Route::get('barci', [MainController::class, 'barci'])->name('front.barci.index');
Route::get('barca/{slug}', [MainController::class, 'barca_detalii'])->name('front.barci.view');

Route::get('chartere', [MainController::class, 'chartere'])->name('front.chartere.index');
Route::get('charter/{slug}', [MainController::class, 'charter_detalii'])->name('front.charter.view');

Route::get('expeditii', [MainController::class, 'expeditii'])->name('front.expeditii.index');
Route::get('expeditie/{slug}', [MainController::class, 'expeditie_detalii'])->name('front.expeditie.view');

Route::get('regate', [MainController::class, 'regate'])->name('front.regate.index');
Route::get('regata/{slug}', [MainController::class, 'regata_detalii'])->name('front.regata.view');

Route::get('sezonregata/{slug}', [MainController::class, 'sezonregata_detalii'])->name('front.sezonregata.view');

Route::get('corporate', [MainController::class, 'corporate'])->name('front.corporate.index');
Route::get('corporate/{slug}', [MainController::class, 'corporate_detalii'])->name('front.corporate.view');

Route::get('evenimente', [MainController::class, 'evenimente'])->name('front.evenimente.index');
Route::get('eveniment/{slug}', [MainController::class, 'eveniment_detalii'])->name('front.eveniment.view');

Route::get('jurnale', [MainController::class, 'jurnale'])->name('front.jurnale.index');
Route::get('jurnal/{slug}', [MainController::class, 'jurnal_detalii'])->name('front.jurnal.view');

Route::get('contact', [ContactController::class, 'contact'])->name('front.contact.index');
Route::post('contact/creare', [ContactController::class, 'create'])->name('front.contact.create');

Route::post('newsletter', [NewsletterController::class, 'addSubscriber'])->name('front.newsletter.add');
Route::get('newsletter/email', [NewsletterController::class, 'sendEmail'])->name('front.email.index');

Route::get('despre-noi', [MainController::class, 'displayAboutUs'])->name('front.about-us.display');
Route::get('politica-de-confidentialitate', [MainController::class, 'displayPrivacyPolicy'])->name('front.privacy-policy.display');
Route::get('termeni-si-conditii', [MainController::class, 'displayTermsAndConditions'])->name('front.terms-and-conditions.display');


Route::middleware(['web', 'isAdmin'])->prefix('admin')->group(function () {

Route::prefix("barca")->group(function(){
    Route::get('', [BoatController::class, 'index'])->name('boat.index');
    Route::post('creare', [BoatController::class, 'create'])->name('boat.create');
    Route::get('listare', [BoatController::class, 'display'])->name('boat.display');
    Route::put('editare', [BoatController::class, 'edit'])->name('boat.edit');
    Route::delete('stergere', [BoatController::class, 'delete'])->name('boat.delete');
});

Route::prefix("charter")->group(function(){
    Route::get('', [CharterController::class, 'index'])->name('charter.index');
    Route::post('creare', [CharterController::class, 'create'])->name('charter.create');
    Route::get('listare', [CharterController::class, 'display'])->name('charter.display');
    Route::put('editare', [CharterController::class, 'edit'])->name('charter.edit');
    Route::delete('stergere', [CharterController::class, 'delete'])->name('charter.delete');
    Route::post('perioada', [CharterController::class, 'setPeriod'])->name('charter.get');
});

Route::prefix("expeditie")->group(function(){
    Route::get('', [ExpeditionController::class, 'index'])->name('expedition.index');
    Route::post('creare', [ExpeditionController::class, 'create'])->name('expedition.create');
    Route::get('listare', [ExpeditionController::class, 'display'])->name('expedition.display');
    Route::post('editare', [ExpeditionController::class, 'edit'])->name('expedition.edit');
    Route::delete('stergere', [ExpeditionController::class, 'delete'])->name('expedition.delete');
    Route::post('perioada', [ExpeditionController::class, 'setPeriod'])->name('expedition.get');
});

Route::prefix("regata")->group(function(){
    Route::get('', [RegattaController::class, 'index'])->name('regatta.index');
    Route::post('creare', [RegattaController::class, 'create'])->name('regatta.create');
    Route::post('idCalendar', [RegattaController::class, 'getCalendar'])->name('regatta.calendar');
    Route::get('listare', [RegattaController::class, 'display'])->name('regatta.display');
    Route::put('editare', [RegattaController::class, 'edit'])->name('regatta.edit');
    Route::delete('stergere', [RegattaController::class, 'delete'])->name('regatta.delete');
});
// Route::get('calendar-regate/listare', [RegattaController::class, 'calendar'])->name('calendar.display');

// Route::prefix("sezon-regate")->group(function(){
//     Route::get('', [RegattaSeasonController::class, 'index'])->name('regattaseason.index');
//     Route::post('creare', [RegattaSeasonController::class, 'create'])->name('regattaseason.create');
//     Route::get('listare', [RegattaSeasonController::class, 'display'])->name('regattaseason.display');
//     Route::put('editare', [RegattaSeasonController::class, 'edit'])->name('regattaseason.edit');
//     Route::delete('stergere', [RegattaSeasonController::class, 'delete'])->name('regattaseason.delete');
// });
Route::prefix("calendar-regate")->group(function(){
    Route::get('', [CalendarRegattaController::class, 'index'])->name('regattacalendar.index');
    Route::post('creare', [CalendarRegattaController::class, 'create'])->name('regattacalendar.create');
    Route::get('listare', [CalendarRegattaController::class, 'display'])->name('regattacalendar.display');
    Route::put('editare', [CalendarRegattaController::class, 'edit'])->name('regattacalendar.edit');
    Route::delete('stergere', [CalendarRegattaController::class, 'delete'])->name('regattacalendar.delete');
});
Route::prefix("corporate")->group(function(){
    Route::get('', [CorporateEventController::class, 'index'])->name('corporate.index');
    Route::post('stocare', [CorporateEventController::class, 'create'])->name('corporate.create');
    Route::get('listare', [CorporateEventController::class, 'display'])->name('corporate.display');
    Route::put('editare', [CorporateEventController::class, 'edit'])->name('corporate.edit');
    Route::delete('stergere', [CorporateEventController::class, 'delete'])->name('corporate.delete');
});

Route::prefix("eveniment-personalizat")->group(function(){
    Route::get('', [CustomEventController::class, 'index'])->name('event.index');
    Route::post('creare', [CustomEventController::class, 'create'])->name('event.create');
    Route::get('listare', [CustomEventController::class, 'display'])->name('event.display');
    Route::put('editare', [CustomEventController::class, 'edit'])->name('event.edit');
    Route::delete('stergere', [CustomEventController::class, 'delete'])->name('event.delete');
});

Route::prefix("jurnal")->group(function(){
    Route::get('', [DiaryController::class, 'index'])->name('diary.index');
    Route::post('creare', [DiaryController::class, 'create'])->name('diary.create');
    Route::post('idEveniment', [DiaryController::class, 'getEvent'])->name('diary.event');
    Route::get('listare', [DiaryController::class, 'display'])->name('diary.display');
    Route::put('editare', [DiaryController::class, 'edit'])->name('diary.edit');
    Route::delete('stergere', [DiaryController::class, 'delete'])->name('diary.delete');
});

Route::prefix("despre-noi")->group(function(){
    Route::get('', [AboutUsController::class, 'index'])->name('about-us.index');
    Route::post('creare', [AboutUsController::class, 'create'])->name('about-us.create');
    Route::post('uploadimage', [AboutUsController::class, 'incarca_imaginea'])->name('about-us.uploadimage');
});

Route::prefix("politica-de-confidentialitate")->group(function(){
    Route::get('', [PrivacyPolicyController::class, 'index'])->name('privacy-policy.index');
    Route::post('creare', [PrivacyPolicyController::class, 'create'])->name('privacy-policy.create');
});

Route::prefix("termeni-si-conditii")->group(function(){
    Route::get('', [TermsAndConditionsController::class, 'index'])->name('terms-and-conditions.index');
    Route::post('creare', [TermsAndConditionsController::class, 'create'])->name('terms-and-conditions.create');
});
Route::prefix("contacte")->group(function(){
    Route::get('listare', [ContactsController::class, 'display'])->name('contact.create');
    Route::delete('stergere', [ContactsController::class, 'delete'])->name('contact.delete');
});
});

Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard.index');


