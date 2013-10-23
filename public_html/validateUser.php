<?php
session_start();

require_once(realpath(dirname(__FILE__) . "/../resources/config.php"));

require_once(LIBRARY_PATH . "/templateFunctions.php");
require_once(LIBRARY_PATH . "/connection_open.php");
require_once(LIBRARY_PATH . "/entryManagement.php");

$details = validateUser($_POST['unique_id'], $dbh);

if(empty($details)){    
    $_SESSION['errors'] = "invalid id";
    header('Location: /public_html/');
       
}else{    
    print_r($details);
    $_SESSION['uniqueId'] = $_POST['unique_id'];    
}

?>
