<?php

namespace Controller;

use Model\nouveauRdv;

class vuNouveaurdv extends  nouveauRdv
{

    public function index()
    {
        return $this->getFormrdv();
    }

}