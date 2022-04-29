<?php

namespace Model;

class TypeEvenement extends getRdv
{

    public function getEvenement()
    {

        $db = Database::connect();
        $reqeve = $db->prepare('select * from typeevenement where Id_Client=? order by Nom_TypeEvenement ');
        $reqeve->execute(array($this->idclient));
       return $reqeve->fetchAll();
    }

}