<?php

namespace Model;

use Librairy\personnaliser;

class listeEvenement extends personnaliser
{
    public int $year;
    public int $month;
    public int $day;
    public int $idclient;
    private $db; // déclaration de la variable de connexion

    public function __construct()
    {
        $this->db = Database::connect();
    }

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

    public function getYear(): int
    {
        return $this->year;

    }

    public function getMonth(): int
    {
        return $this->month;

    }

    public function getDay(): int
    {
        return $this->day;

    }

    public function getIdclient(): int
    {

        return $this->idclient;

    }

    /**
     * @return array
     */
    public function getEvenement(): array
    {
        $dateActuel = date('Y-m-d', strtotime($this->getYear() . '-' . $this->getMonth() . '-' . $this->getDay()));
        $reqjour = $this->db->prepare('select * from evenement join typeevenement t on evenement.Id_TypeEvenement = t.Id_TypeEvenement where DATE (Datedebut_Evenement)<=? and  DATE (Datefin_Evenement)>=?   and Id_Client=?');
        $reqjour->execute(array($dateActuel, $dateActuel, $this->getIdclient()));
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