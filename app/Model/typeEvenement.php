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

    /***
     * @return array|false
     */
    public function getEvenement()
    {

        $db = Database::connect();
        $reqeve = $db->prepare('select * from typeevenement where Id_Client=? order by Nom_TypeEvenement ');
        $reqeve->execute(array($this->getIdclient()));
       return $reqeve->fetchAll();
    }

}