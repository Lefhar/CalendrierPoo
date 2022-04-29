<?php

namespace Model;

use Librairy\personnaliser;

class nouveauRdv extends personnaliser
{
    public $post;
    public $year;
    public $month;
    public $day;
    public $hour;
    public $idclient;
    private $db; // déclaration de la variable de connexion

    public function __construct()
    {
        $this->db = Database::connect();
    }

    public function setPost($post)
    {
        $this->post = $post;
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

    public function getHour():int
    {
        return $this->hour;

    }



    public function getPost()
    {
        return $this->post;

    }
    public function getIdclient(): int
    {

        return $this->idclient;

    }

    /**
     * @return false|string|void
     */
    public function getFormrdv()
    {


        $dateActuel = date('Y-m-d\TH:i', strtotime($this->getYear() . '-' . $this->getMonth() . '-' . $this->getDay() . ' ' . $this->getHour() . ':00'));
        if(!empty($this->getPost())) {

            $post = $this->getPost();
            $objet= $post['objet'];
            $contenu= $post['contenu'];
            $url= $post['url'];
            $debut= $post['debut'];
            $fin= $post['fin'];
            $type= $post['type'];
            $rdv = $this->db->prepare('insert into evenement ( Objet_Evenement, Contenu_Evenement, Url_Evenement, Datedebut_Evenement, Datefin_Evenement, Id_TypeEvenement) values (?,?,?,?,?,?) ');
            if($rdv->execute(array($objet, $contenu, $url, $debut, $fin, $type))){
                $this->redirect('/jour');
            }

        }else{
            return $dateActuel;
        }
    }
}