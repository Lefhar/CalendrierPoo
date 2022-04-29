<?php

namespace Controller;

use Model\nouveauRdv;

class nouveaurdvController extends  nouveauRdv
{
    /**
     * @return false|string|void
     */
    public function index()
    {
        return $this->getFormrdv();
    }

}