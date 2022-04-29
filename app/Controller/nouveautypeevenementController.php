<?php

namespace Controller;

use Model\nouveauTypeevenement;

class nouveautypeevenementController extends nouveauTypeevenement
{
    /**
     * @return bool
     */
    public function index(): bool
    {
        return $this->getFormtypeeve();
    }

}