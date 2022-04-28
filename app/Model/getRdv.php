<?php

namespace Model;


use Librairy\ConvertDate;
use Librairy\personnaliser;

class getRdv extends personnaliser
{
    private $db; // déclaration de la variable de connexion

    public function __construct()
    {
        $this->db = Database::connect();
    }


    public $year;
    public $month;
    public $day;
    public $hour;
    public $week;


    public function setYear($year)
    {
        $this->year = $year;
    }

    public function setMonth($month)
    {
        $this->month = $month;
    }

    public function setDay($day)
    {
        $this->day = $day;
    }
    public function setWeek($week)
    {
        $this->week = $week;
    }

    public function setHour($hour)
    {
        $this->hour = $hour;
    }

    public function getYear()
    {
        return $this->year;

    }

    public function getMonth()
    {
        return $this->month;

    }

    public function getDay()
    {
        return $this->day;

    }
    public function getWeek()
    {
        return $this->week;

    }

    /**
     * @return array
     */
    public function getJour(): array
    {
        $idclient = 1;

        $reqjour = $this->db->prepare('select * from evenement join typeevenement t on evenement.Id_TypeEvenement = t.Id_TypeEvenement where YEAR(Datedebut_Evenement)=? and MONTH(Datedebut_Evenement)=? and YEAR(Datefin_Evenement)=? and MONTH(Datefin_Evenement)=?  and Id_Client=?');
        $reqjour->execute(array($this->year, $this->month, $this->year, $this->month, $idclient));
        $dateEve = $reqjour->fetchAll();
        //on déclare un tableau vide
        $dateRdv = array();
        //on analyse le tableau afin de changer le code couleur hex en RGB
        foreach ($dateEve as  $change) {
            //on fait le replacement
            $change['Couleur_TypeEvenement'] = str_replace($change['Couleur_TypeEvenement'], $this->hex2rgb($change['Couleur_TypeEvenement']), $change['Couleur_TypeEvenement']);
            $dateRdv[] = $change;
        }
        return $dateRdv;
    }

    /**
     * @return array
     */
    public function getSemaine(): array
    {
        $idclient = 1;
        $dateLundi = (new ConvertDate())->getLundi($this->week, $this->year);

        $dateVendredi = date('Y-m-d', strtotime("+6 day", strtotime($dateLundi)));
        $reqjour = $this->db->prepare('select * from evenement join typeevenement t on evenement.Id_TypeEvenement = t.Id_TypeEvenement where date(Datedebut_Evenement)>=? and date(Datefin_Evenement)<=?  and Id_Client=?');
        $reqjour->execute(array($dateLundi, $dateVendredi, $idclient));
        $dateEve = $reqjour->fetchAll();
        //on déclare un tableau vide
        $dateRdv = array();
        //on analyse le tableau afin de changer le code couleur hex en RGB
        foreach ($dateEve as  $change) {
            //on fait le replacement
            $change['Couleur_TypeEvenement'] = str_replace($change['Couleur_TypeEvenement'], $this->hex2rgb($change['Couleur_TypeEvenement']), $change['Couleur_TypeEvenement']);
            $dateRdv[] = $change;
        }
        return $dateRdv;
    }
}