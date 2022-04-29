<?php

namespace Model;

class chargerView
{

    public function view($vu='index',$data=""){
        $baseDir =  dirname(__DIR__);

        if(!empty($data)){
            extract($data, EXTR_OVERWRITE);
        }
        include($baseDir.'/view/'.$vu.'.php');

  }
}