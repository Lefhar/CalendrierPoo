<?php

namespace App;
use Controller\vuJours;
use Controller\vuSemaines;
use Librairy\ConvertDate;
use Model\ChargerView;
use Model\TypeEvenement;

class Route extends ChargerView
{
    public function index()
    {
       $uris = $_SERVER['REQUEST_URI'];
       $url = explode('/',$uris);
       $data = array();
        switch ($url['1'])
        {
            case 'vujour';
            $vujour = new vuJours();
            $year = (!empty($url[4])?$url[4]:date('Y',strtotime(date('Y-m-d'))));
            $month = (!empty($url[3])?$url[3]:date('m',strtotime(date('Y-m-d'))));
            $day = (!empty($url[2])?$url[2]:date('d',strtotime(date('Y-m-d'))));
            $vujour->setDay($day);
            $vujour->setMonth($month);
            $vujour->setYear($year);
            $data['day']= $day;
            $data['month']= $month;
            $data['year']= $year;
            $data['dateRdv']= $vujour->index();
            $data['TypeEve']= (new TypeEvenement)->getEvenement();
            $data['jourLettre']= (new ConvertDate)->getJourLettre(strftime("%u", strtotime(date($year . '-' . $month . '-' . $day))));
            $data['tabMois']= (new ConvertDate)->getMoisLettre($month);
            $this->view('header',$data);
            $this->view('jour',$data);
            $this->view('footer',$data);

            break;
            case'vusemaine';
            $vusemaine = new vuSemaines();
                $data['dateRdv']= $vusemaine->index();

                $week = (!empty($url[2])?$url[2]:date('W',strtotime(date('Y-m-d'))));
                $year = (!empty($url[3])?$url[3]:date('Y',strtotime(date('Y-m-d'))));
                $data['dateLundi'] = (new ConvertDate)->getLundi($week,$year);
                $data['dateVendredi'] = (new ConvertDate)->getVendredi($week,$year);
                $data['dateLundiLettre'] = (new ConvertDate)->getLundilettre($week,$year);
                $data['dateVendrediLettre'] = (new ConvertDate)->getVendredilettre($week,$year);
                $data['tabjour']= (new ConvertDate)->getWeek($week,$year);
                $data['tabjourLettre']= (new ConvertDate)->getTabjourlettre();
                //$dateVendrediLettre = date('d', strtotime($dateVendredi)) . ' ' . $tabMois[(int)date('m', strtotime($dateVendredi))];
                $data['TypeEve']= (new TypeEvenement)->getEvenement();
                $data['year']= $year;
                $data['week']= $week;
                $this->view('header',$data);
                $this->view('semaine',$data);
                $this->view('footer',$data);
                break;

            case 'vumois';

                break;

            default ;

        }
    }
}