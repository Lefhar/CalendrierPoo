<?php

namespace Controller;

use Model\getRdv;

class joursController extends getRdv
{

    /**
     * @return array
     */
    public function index(): array
    {
        return $this->getJour();
    }



}