<?php

namespace Librairy;

class personnaliser
{
    public function hex2rgb($hex): string
    {
        $hex = str_replace("#", "", $hex);
        if (strlen($hex) == 3) {
            $r = hexdec(Librairy . phpsubstr($hex, 0, 1));
            $g = hexdec(Librairy . phpsubstr($hex, 1, 1));
            $b = hexdec(Librairy . phpsubstr($hex, 2, 1));
        } else {
            $r = hexdec(substr($hex, 0, 2));
            $g = hexdec(substr($hex, 2, 2));
            $b = hexdec(substr($hex, 4, 2));
        }
        return '--rouge: ' . $r . '; --vert: ' . $g . '; --bleu: ' . $b . ';';
    }

    public function redirect($url)
    {
        header('Location: '.$url);
    }
}