<?php

namespace Model;

class ChargerView
{

    public function view($vu='index',$data=""){
        $baseDir =  dirname(__DIR__);

        if(!empty($data)){
            extract($data, EXTR_OVERWRITE);
        }
        include($baseDir.'/view/'.$vu.'.php');

  }
}