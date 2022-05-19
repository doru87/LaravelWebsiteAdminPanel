<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // $this->app->bind('path.public', function() {
        //     return base_path().'/../mariner.programatorweb.ro';
        // });
        $lists = array('barca', 'charter', 'expeditie','calendar-regate','regata', 'corporate', 'eveniment-personalizat', 'jurnal','despre-noi','politica-de-confidentialitate','termeni-si-conditii','contacte');
        $ani_fabricatie = array();
        for ($i = 1990; $i <= 2022; $i++) {
            array_push($ani_fabricatie, $i);
        }

        $capacitate_persoane = array();
        for ($i = 2; $i < 15; $i++) {
            array_push($capacitate_persoane, $i);
        }
        $wc_dus = array();
        for ($i = 0; $i <= 3; $i++) {
            array_push($wc_dus, $i);
        }
        // $lungime_barca = array();
        // for ($i = 5; $i <= 15; $i++) {
        //     array_push($lungime_barca, $i);
        // }

        $capacitate_charter = array();
        for ($i = 1; $i <= 20; $i++) {
            array_push($capacitate_charter, $i);
        }
        $capacitate_corporate = array();
        for ($i = 1; $i <= 40; $i++) {
            array_push($capacitate_corporate, $i);
        }
        Paginator::useBootstrap();
        View::share([
            'lists' => $lists, 'ani_fabricatie' => $ani_fabricatie, 'capacitate_persoane' => $capacitate_persoane, 'wc_dus' => $wc_dus,
            'capacitate_charter' => $capacitate_charter, 'capacitate_corporate' => $capacitate_corporate
        ]);
    }
}
