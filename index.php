<?php
date_default_timezone_set('Europe/Paris');
use App\Route;
require 'vendor/autoload.php';
$route = new Route();
$route->index();