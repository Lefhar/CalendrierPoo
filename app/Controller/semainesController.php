<?php

namespace Controller;

use Model\getRdv;

class semainesController extends getRdv
{

    /**
     * @return array
     */
    public function index(): array
    {
        return $this->getSemaine();
    }

}