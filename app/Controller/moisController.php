<?php

namespace Controller;

use Model\getRdv;

class moisController  extends getRdv
{

    /**
     * @return array
     */
    public function index(): array
    {
        return $this->getMois();
    }
}