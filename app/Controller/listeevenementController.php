<?php

namespace Controller;

use Model\listeEvenement;

class listeevenementController extends listeEvenement
{
    public function index()
    {
        return $this->getEvenement();
    }

}