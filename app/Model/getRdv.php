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


    public int $year;
    public int $month;
    public int $day;
    public $hour;
    public $week;
    public $idclient;


    public function setIdclient($idclient)
    {
        $this->idclient = $idclient;
    }

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

    public function getYear():int
    {
        return $this->year;

    }

    public function getMonth():int
    {
        return $this->month;

    }

    public function getDay():int
    {
        return $this->day;

    }

    public function getWeek():int
    {
        return $this->week;

    }

    public function getIdclient(): int
    {
        return $this->idclient;

    }

    /**
     * @return array
     */
    public function getJour(): array
    {

        $reqjour = $this->db->prepare('select * from evenement join typeevenement t on evenement.Id_TypeEvenement = t.Id_TypeEvenement where YEAR(Datedebut_Evenement)=? and MONTH(Datedebut_Evenement)=? and YEAR(Datefin_Evenement)=? and MONTH(Datefin_Evenement)=?  and Id_Client=?');
        $reqjour->execute(array($this->getYear(), $this->getMonth(), $this->getYear(), $this->getMonth(), $this->getIdclient()));
        $dateEve = $reqjour->fetchAll();
        //on déclare un tableau vide
        $dateRdv = array();
        //on analyse le tableau afin de changer le code couleur hex en RGB
        foreach ($dateEve as $change) {
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
        $dateLundi = (new ConvertDate())->getLundi($this->getWeek(), $this->getYear());

        $dateVendredi = date('Y-m-d', strtotime("+6 day", strtotime($dateLundi)));
        $reqjour = $this->db->prepare('select * from evenement join typeevenement t on evenement.Id_TypeEvenement = t.Id_TypeEvenement where date(Datedebut_Evenement)>=? and date(Datefin_Evenement)<=?  and Id_Client=?');
        $reqjour->execute(array($dateLundi, $dateVendredi, $this->getIdclient()));
        $dateEve = $reqjour->fetchAll();
        //on déclare un tableau vide
        $dateRdv = array();
        //on analyse le tableau afin de changer le code couleur hex en RGB
        foreach ($dateEve as $change) {
            //on fait le replacement
            $change['Couleur_TypeEvenement'] = str_replace($change['Couleur_TypeEvenement'], $this->hex2rgb($change['Couleur_TypeEvenement']), $change['Couleur_TypeEvenement']);
            $dateRdv[] = $change;
        }
        return $dateRdv;
    }

    /**
     * @return array
     */
    public function getMois(): array
    {
        $dateJour = date('Y-m-d', strtotime($this->getYear() . '-' . $this->getMonth() . '-01'));
        $debutreq = date('Y-m-d', strtotime('last monday', strtotime($dateJour)));
        $finreq = date("Y-m-d", strtotime($debutreq . '+ 42 days'));
        $reqjour = $this->db->prepare('select * from evenement join typeevenement t on evenement.Id_TypeEvenement = t.Id_TypeEvenement where date(Datedebut_Evenement)>=? and date(Datefin_Evenement)<=?  and Id_Client=?');
        $reqjour->execute(array($debutreq, $finreq, $this->getIdclient()));
        $dateEve = $reqjour->fetchAll();
        //on déclare un tableaux vide
        $dateRdv = array();
        //on analyse le tableau afin de changer le code couleur hex en RGB
        foreach ($dateEve as $key => $change) {
            //on fait le replacement
            $change['Couleur_TypeEvenement'] = str_replace($change['Couleur_TypeEvenement'], $this->hex2rgb($change['Couleur_TypeEvenement']), $change['Couleur_TypeEvenement']);
            $dateRdv[] = $change;
        }
        return $dateRdv;
    }
}