<?php
if (!function_exists('getMonths')) {
    function getMonths($inceput_sezon)
    {
        switch ($inceput_sezon[1]) {
            case '01':
                $inceput_sezon[1] = "Ianuarie";
                break;
            case '02':
                $inceput_sezon[1] = "Februarie";
                break;
            case '03':
                $inceput_sezon[1] = "Martie";
                break;
            case '04':
                $inceput_sezon[1] = "Aprilie";
                break;
            case '05':
                $inceput_sezon[1] = "Mai";
                break;
            case '06':
                $inceput_sezon[1] = "Iunie";
                break;
            case '07':
                $inceput_sezon[1] = "Iulie";
                break;
            case '08':
                $inceput_sezon[1] = "August";
                break;
            case '09':
                $inceput_sezon[1] = "Septembrie";
                break;
            case '10':
                $inceput_sezon[1] = "Octombrie";
                break;
            case '11':
                $inceput_sezon[1] = "Noiembrie";
                break;
            case '12':
                $inceput_sezon[1] = "Decembrie";
                break;

            default:
                # code...
                break;
        }
        return $inceput_sezon;
    }
}
