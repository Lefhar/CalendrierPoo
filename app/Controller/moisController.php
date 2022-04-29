<?php

namespace Controller;

use Model\getRdv;

class moisController  extends getRdv
{

    public function index(): array
    {
        return $this->getMois();
    }
}