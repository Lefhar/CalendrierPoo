<?php

namespace Controller;

use Model\listeEvenement;

class listeevenementController extends listeEvenement
{
    /**
     * @return array
     */
    public function index(): array
    {
        return $this->getEvenement();
    }

}