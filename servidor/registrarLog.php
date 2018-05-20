<?php
include("../utilities/log4php/Logger.php");
Logger::configure('../utilities/log4phpConfig.xml');
$logger = Logger::getLogger("main");

$datos = json_decode($_POST["datos"]);
$level = $datos->level;
$msg = $datos->message;

switch($level)
{
    case "debug":
        $logger->debug($msg);
        break;
    case "info":
        $logger->info($msg);
        break;
    case "warn":
        $logger->warn($msg);
        break;
    case "error":
        $logger->error($msg);
        break;
}

?>