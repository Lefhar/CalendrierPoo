<?php

namespace Controller;

use Model\nouveauTypeevenement;

class nouveautypeevenementController extends nouveauTypeevenement
{
    public function index()
    {
        return $this->getFormtypeeve();
    }

}