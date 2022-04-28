<?php

namespace Model;

class TypeEvenement
{

    public function getEvenement()
    {
        $db = Database::connect();
        $reqeve = $db->prepare('select * from typeevenement where Id_Client=? order by Nom_TypeEvenement ');
        $reqeve->execute(array(1));
       return $reqeve->fetchAll();
    }

}