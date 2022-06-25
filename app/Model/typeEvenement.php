<?php

namespace Model;

class typeEvenement
{

    public $idclient;

    public function setIdclient($idclient)
    {
        $this->idclient = $idclient;
    }

    public function getIdclient()
    {
        return $this->idclient;
    }

    /**
     * Charge la liste des types d'événement en fonction de l'id du client
     * @return array|false
     */
    public function getTypeEvenement()
    {

        $db = Database::connect();
        $reqeve = $db->prepare('select * from typeevenement where Id_Client=? order by Nom_TypeEvenement ');
        $reqeve->execute(array($this->getIdclient()));
       return $reqeve->fetchAll();
    }

}