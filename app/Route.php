<?php

namespace App;

use Controller\vuJours;
use Controller\VuMois;
use Controller\vuSemaines;
use Librairy\ConvertDate;
use Model\ChargerView;
use Model\TypeEvenement;

class Route extends ChargerView
{
    public function index()
    {
        $uris = $_SERVER['REQUEST_URI'];
        $url = explode('/', $uris);
        $data = array();
        $vujour = new vuJours();


        switch ($url['1']) {
            case 'jour';
                $vujour = new vuJours();
                $year = (!empty($url[4]) ? $url[4] : (int)date('Y', strtotime(date('Y-m-d'))));
                $month = (!empty($url[3]&&$url[3]>=1 && $url[3]<=12) ? (int)$url[3] : (int)date('m', strtotime(date('Y-m-d'))));
                $day = (!empty($url[2]) ? $url[2] : (int)date('d', strtotime(date('Y-m-d'))));
                $vujour->setDay($day);
                $vujour->setMonth($month);
                $vujour->setYear($year);
                $vujour->setIdclient(1);
                $data['day'] = $day;
                $data['month'] = $month;
                $data['year'] = $year;
                $data['dateRdv'] = $vujour->index();
                $data['TypeEve'] = (new TypeEvenement)->getEvenement();
                $data['jourLettre'] = (new ConvertDate)->getJourLettre(strftime("%u", strtotime(date($year . '-' . $month . '-' . $day))));
                $data['tabMois'] = (new ConvertDate)->getMoisLettre($month);
                $this->view('header', $data);
                $this->view('jour', $data);
                $this->view('footer', $data);

                break;
            case'semaine';

                $vusemaine = new vuSemaines();

                $week = (!empty($url[2]&&$url[2]>=1 and $url[2]<=52) ? (int)$url[2] : date('W', strtotime(date('Y-m-d'))));
                $year = (!empty($url[3]) ? $url[3] : date('Y', strtotime(date('Y-m-d'))));
                $vusemaine->setYear($year);
                $vusemaine->setWeek($week);
                $vusemaine->setIdclient(1);

                $data['dateRdv'] = $vusemaine->index();
                $data['dateLundi'] = (new ConvertDate)->getLundi($week, $year);
                $data['dateVendredi'] = (new ConvertDate)->getVendredi($week, $year);
                $data['dateLundiLettre'] = (new ConvertDate)->getLundilettre($week, $year);
                $data['dateVendrediLettre'] = (new ConvertDate)->getVendredilettre($week, $year);
                $data['tabjour'] = (new ConvertDate)->getWeek($week, $year);
                $data['tabjourLettre'] = (new ConvertDate)->getTabjourlettre();
                //$dateVendrediLettre = date('d', strtotime($dateVendredi)) . ' ' . $tabMois[(int)date('m', strtotime($dateVendredi))];
                $data['TypeEve'] = (new TypeEvenement)->getEvenement();
                $data['year'] = $year;
                $data['week'] = $week;
                $this->view('header', $data);
                $this->view('semaine', $data);
                $this->view('footer', $data);
                break;

            case 'mois';
                $vumois = new VuMois;
                $month = (!empty($url[2]&&$url[2]>=1 && $url[2]<=12) ? $url[2] : date('m', strtotime(date('Y-m-d'))));
                $year = (!empty($url[3]) ? $url[3] : date('Y', strtotime(date('Y-m-d'))));
                $data['month'] = $month;
                $data['year'] = $year;
                $vumois->setMonth($month);
                $vumois->setYear($year);
                $vumois->setIdclient(1);
                $data['tabsemaine'] = (new ConvertDate)->getSemaines($year, $month);
                $data['TypeEve'] = (new TypeEvenement)->getEvenement();
                $data['tabMois'] = (new ConvertDate)->getTabMoisLettre();
                $data['tab_jours'] = (new ConvertDate)->getTabjourlettre();

                $data['dateRdv'] = $vumois->index();
                $this->view('header', $data);
                $this->view('mois', $data);
                $this->view('footer', $data);

                break;

            default;
                $year = (!empty($url[4]) ? $url[4] : (int)date('Y', strtotime(date('Y-m-d'))));
                $month = (!empty($url[3]&&$url[3]>=1 && $url[3]<=12) ? $url[3] : (int)date('m', strtotime(date('Y-m-d'))));
                $day = (!empty($url[2]) ? (int)$url[2] : (int)date('d', strtotime(date('Y-m-d'))));
                $vujour->setDay($day);
                $vujour->setMonth($month);
                $vujour->setYear($year);
                $vujour->setIdclient(1);

                $data['day'] = $day;
                $data['month'] = $month;
                $data['year'] = $year;
                $data['dateRdv'] = $vujour->index();
                $data['TypeEve'] = (new TypeEvenement)->getEvenement();
                $data['jourLettre'] = (new ConvertDate)->getJourLettre(strftime("%u", strtotime(date($year . '-' . $month . '-' . $day))));
                $data['tabMois'] = (new ConvertDate)->getMoisLettre($month);

                $this->view('header', $data);
                $this->view('jour', $data);
                $this->view('footer', $data);
                break;

        }
    }
}