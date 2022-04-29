<?php

namespace Controller;

use Model\nouveauRdv;

class nouveaurdvController extends  nouveauRdv
{

    public function index()
    {
        return $this->getFormrdv();
    }

}