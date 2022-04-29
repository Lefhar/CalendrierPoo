<?php

namespace Controller;

use Model\getRdv;

class semainesController extends getRdv
{


    public function index(): array
    {
        return $this->getSemaine();
    }

}