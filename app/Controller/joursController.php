<?php

namespace Controller;

use Model\getRdv;

class joursController extends getRdv
{


    public function index(): array
    {
        return $this->getJour();
    }



}