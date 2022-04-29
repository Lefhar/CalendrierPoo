<?php

namespace Model;

class chargerView
{
    /**
     * @param string $vu
     * @param array $data
     * @return void
     */
    public function view(string $vu='index', array $data=array()){
        $baseDir =  dirname(__DIR__);

        if(!empty($data)){
            extract($data, EXTR_OVERWRITE);
        }
        include($baseDir.'/view/'.$vu.'.php');

  }
}