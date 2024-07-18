<?php

require_once "vendor/autoload.php";

require_once "config.php";
require_once "App/function.php";

Flight::route('GET /', ['App\Controllers\Home', 'index']);



Flight::start();