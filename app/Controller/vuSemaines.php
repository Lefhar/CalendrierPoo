<?php

namespace Controller;

use Model\getRdv;

class vuSemaines extends getRdv
{


    public function index(): array
    {
        return $this->getSemaine();
    }

}