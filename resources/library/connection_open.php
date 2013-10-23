<?php

require_once(realpath(dirname(__FILE__) . "/../config.php"));

/*
 * This file reads database parameters from config.php and established a connection
 * to mysql. Database handler can then be used at any place where this file is icluded.
 * 
 */

$environment = "development"; //could be development or production   

/* @var $config ArrayObject */
$db_parameters = $config["db"][$environment];

$connString = "mysql:host=" . $db_parameters["host"] . ";dbname=" . $db_parameters["dbname"] . "";

try {
    $dbh = new PDO($connString, $db_parameters["username"], $db_parameters["password"]);
} catch (PDOException $e) {
    echo "CONNECTION ERROR! : " . $e->GetMessage();
}
?>