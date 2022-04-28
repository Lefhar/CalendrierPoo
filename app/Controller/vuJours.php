<?php

namespace Controller;

use Model\getRdv;

class vuJours extends getRdv
{


    public function index(): array
    {
        return $this->getJour();
    }



}