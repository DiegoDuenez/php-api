<?php

require_once realpath("vendor/autoload.php");

use App\Controllers\UserController;
use Utilities\Log;


/*
$log = new Logger("web");

$log->pushHandler(new BrowserConsoleHandler(Logger::DEBUG));
$log->pushHandler(new StreamHandler(__DIR__."/storage/Logs/log.log", Logger::WARNING));

$log->info("Mensaje nuev2o", ['logger' => true]);
$log->warning("Mensaje nALERTo", ['logger' => true]);*/


// add records to the log
$UserController = new UserController;
//echo $UserController->index();


// echo Env::get('DB_HOST');