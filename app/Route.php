<?php

namespace App;

use Controller\joursController;
use Controller\listeevenementController;
use Controller\moisController;
use Controller\nouveaurdvController;
use Controller\nouveautypeevenementController;
use Controller\semainesController;
use Librairy\ConvertDate;
use Model\chargerView;
use Model\typeEvenement;

class Route extends chargerView
{
    public function index()
    {
        $uris = $_SERVER['REQUEST_URI'];
        $url = explode('/', $uris);
        $data = array();
        $vujour = new joursController();


        switch ($url['1']) {
            case 'jour';
                $vujour = new joursController();
                if (!empty($url[4])) {

                    $year = (ctype_digit($url[4]) && strlen($url[4]) >= 4) ? $url[4] : (int)date('Y', strtotime(date('Y-m-d')));

                } else {
                    $year = (int)date('Y', strtotime(date('Y-m-d')));
                }

                if (!empty($url[3])) {
                    $month = ($url[3] >= 1 && $url[3] <= 12) ? (int)$url[3] : (int)date('m', strtotime(date('Y-m-d')));

                } else {
                    $month = (int)date('m', strtotime(date('Y-m-d')));

                }
                $day = (!empty($url[2]) ? (int)$url[2] : (int)date('d', strtotime(date('Y-m-d'))));
                $vujour->setDay($day);
                $vujour->setMonth($month);
                $vujour->setYear($year);
                $vujour->setIdclient(1);

                $data['day'] = $day;
                $data['month'] = $month;
                $data['year'] = $year;
                $data['dateRdv'] = $vujour->index();
                $typeEvenement = new typeEvenement();
                $typeEvenement->setIdclient(1);
                $data['TypeEve'] = $typeEvenement->getTypeEvenement();
                $data['jourLettre'] = (new ConvertDate)->getJourLettre(strftime("%u", strtotime(date($year . '-' . $month . '-' . $day))));
                $data['tabMois'] = (new ConvertDate)->getMoisLettre($month);
                $data['title']= 'Calendrier du jour';
                $this->view('header', $data);
                $this->view('jour', $data);

                break;
            case'semaine';

                $vusemaine = new semainesController();

                $week = (!empty($url[2] && $url[2] >= 1 and $url[2] <= 52) ? (int)$url[2] : date('W', strtotime(date('Y-m-d'))));


                if (!empty($url[3])) {

                    $year = (ctype_digit($url[3]) && strlen($url[3]) >= 3) ? $url[3] : (int)date('Y', strtotime(date('Y-m-d')));

                } else {
                    $year = (int)date('Y', strtotime(date('Y-m-d')));
                }

                $vusemaine->setYear($year);
                $vusemaine->setWeek($week);
                $vusemaine->setIdclient(1);
                $data['title']= 'Calendrier de la semaine';
                $data['dateRdv'] = $vusemaine->index();
                $data['dateLundi'] = (new ConvertDate)->getLundi($week, $year);
                $data['dateVendredi'] = (new ConvertDate)->getVendredi($week, $year);
                $data['dateLundiLettre'] = (new ConvertDate)->getLundilettre($week, $year);
                $data['dateVendrediLettre'] = (new ConvertDate)->getVendredilettre($week, $year);
                $data['tabjour'] = (new ConvertDate)->getWeek($week, $year);
                $data['tabjourLettre'] = (new ConvertDate)->getTabjourlettre();
                $typeEvenement = new typeEvenement();
                $typeEvenement->setIdclient(1);
                $data['TypeEve'] = $typeEvenement->getTypeEvenement();
                $data['year'] = $year;
                $data['week'] = $week;
                $this->view('header', $data);
                $this->view('semaine', $data);
                break;

            case 'mois';
                $vumois = new moisController;
                $month = (!empty($url[2] && $url[2] >= 1 && $url[2] <= 12) ? $url[2] : (int)date('m', strtotime(date('Y-m-d'))));
                if (!empty($url[3])) {
                    $year = (ctype_digit($url[3]) && strlen($url[3]) >= 3) ? $url[3] : (int)date('Y', strtotime(date('Y-m-d')));
                } else {
                    $year = (int)date('Y', strtotime(date('Y-m-d')));
                }

                $data['title']= 'Calendrier du mois';
                $data['month'] = $month;
                $data['year'] = $year;
                $vumois->setMonth($month);
                $vumois->setYear($year);
                $vumois->setIdclient(1);
                $data['tabsemaine'] = (new ConvertDate)->getTabMonth($year, $month);
                $typeEvenement = new typeEvenement();
                $typeEvenement->setIdclient(1);
                $data['TypeEve'] = $typeEvenement->getTypeEvenement();

                $data['tabMois'] = (new ConvertDate)->getTabMoisLettre();
                $data['tab_jours'] = (new ConvertDate)->getTabjourlettre();

                $data['dateRdv'] = $vumois->index();
                $this->view('header', $data);
                $this->view('mois', $data);

                break;

            case 'nouveaurdv';
                if (!empty($url[2])) {
                    $month = ($url[2] >= 1 && $url[2] <= 12) ? (int)$url[2] : (int)date('m', strtotime(date('Y-m-d')));

                } else {
                    $month = (int)date('m', strtotime(date('Y-m-d')));

                }
                $year = (!empty($url[3]) ? $url[3] : (int)date('Y', strtotime(date('Y-m-d'))));
                $day = (!empty($url[4]) ? $url[4] : (int)date('d', strtotime(date('Y-m-d'))));
                $hour = (!empty($url[5]) ? $url[5] : date('H', strtotime(date('Y-m-d H:i:s'))));

                $nouveaurdv = new nouveaurdvController();
                if ($_POST) {
                    $nouveaurdv->setPost($_POST);
                }
                $nouveaurdv->setYear($year);
                $nouveaurdv->setDay($day);
                $nouveaurdv->setMonth($month);
                $nouveaurdv->setHour($hour);
                $nouveaurdv->setIdclient(1);
                $typeEvenement = new typeEvenement();
                $typeEvenement->setIdclient(1);
                $data['TypeEve'] = $typeEvenement->getTypeEvenement();
                $data['title']= 'Nouveau Rendez-vous';

                $data['dateActuel'] = $nouveaurdv->getFormrdv();

                $this->view('header', $data);
                $this->view('nouveaurdv', $data);
                break;


            case 'nouveautypeevenement';
                $nouveauTeve = new nouveautypeevenementController();
                $nouveauTeve->setIdclient(1);

                if ($_POST) {
                    $nouveauTeve->setPost($_POST);
                    $nouveauTeve->getFormtypeeve();
                }
                $data['title']= 'Nouveau type d\'événement';

                $this->view('header', $data);
                $this->view('nouveautypeevenement', $data);
                break;


            case 'voirevenement';
                if (!empty($url[2])) {

                    $year = (ctype_digit($url[2]) && strlen($url[2]) >= 4) ? $url[2] : (int)date('Y', strtotime(date('Y-m-d')));

                } else {
                    $year = (int)date('Y', strtotime(date('Y-m-d')));
                }
                if (!empty($url[3])) {
                    $month = ($url[3] >= 1 && $url[3] <= 12) ? (int)$url[3] : (int)date('m', strtotime(date('Y-m-d')));

                } else {
                    $month = (int)date('m', strtotime(date('Y-m-d')));

                }
                $day = (!empty($url[4]) ? $url[4] : (int)date('d', strtotime(date('Y-m-d'))));
                $data['title']= 'Evénement du jour';
                $listeEvenement = new listeevenementController();
                $listeEvenement->setIdclient(1);
                $listeEvenement->setYear($year);
                $listeEvenement->setMonth($month);
                $listeEvenement->setDay($day);
                $typeEvenement = new typeEvenement();
                $typeEvenement->setIdclient(1);
                $data['TypeEve'] = $typeEvenement->getTypeEvenement();
                $data['dateRdv'] = $listeEvenement->index();
                $this->view('header', $data);
                $this->view('listeevenement', $data);
                break;
            default;
                if (!empty($url[4])) {

                    $year = (ctype_digit($url[4]) && strlen($url[4]) >= 4) ? $url[4] : (int)date('Y', strtotime(date('Y-m-d')));

                } else {
                    $year = (int)date('Y', strtotime(date('Y-m-d')));
                }

                if (!empty($url[3])) {
                    $month = ($url[3] >= 1 && $url[3] <= 12) ? (int)$url[3] : (int)date('m', strtotime(date('Y-m-d')));

                } else {
                    $month = (int)date('m', strtotime(date('Y-m-d')));

                }
                $day = (!empty($url[2]) ? $url[2] : (int)date('d', strtotime(date('Y-m-d'))));
                $vujour->setDay($day);
                $vujour->setMonth($month);
                $vujour->setYear($year);
                $vujour->setIdclient(1);
                $data['title']= 'Calendrier du jour';
                $data['day'] = $day;
                $data['month'] = $month;
                $data['year'] = $year;
                $data['dateRdv'] = $vujour->index();
                $data['TypeEve'] = (new typeEvenement)->getTypeEvenement();
                $data['jourLettre'] = (new ConvertDate)->getJourLettre(strftime("%u", strtotime(date($year . '-' . $month . '-' . $day))));
                $data['tabMois'] = (new ConvertDate)->getMoisLettre($month);

                $this->view('header', $data);
                $this->view('jour', $data);
                break;

        }
        $this->view('footer', $data);
    }
}