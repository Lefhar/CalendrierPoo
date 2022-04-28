<?php

namespace Controller;

use Model\getRdv;

class VuMois  extends getRdv
{

    public function index(): array
    {
        return $this->getMois();
    }
}