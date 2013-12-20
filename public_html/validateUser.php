<?php

session_start();

require_once(realpath(dirname(__FILE__) . "/../resources/config.php"));

require_once(LIBRARY_PATH . "/templateFunctions.php");
require_once(LIBRARY_PATH . "/connection_open.php");
require_once(LIBRARY_PATH . "/entryManagement.php");

$details = validateUser($_POST['unique_id'], $dbh);
if (empty($details)) {
    print_r($_POST);
    $_SESSION['errors'] = "Incorrect Username. Please try again";
    header('Location: /public_html/');
}else if($details[0]["Active"] == "false"){    
    $_SESSION['errors'] = "Your account has been deactivated. Please contact OSR office.";
    header('Location: /public_html/');
} 
else {

    $_SESSION['uniqueId'] = $_POST['unique_id'];
    renderLayoutWithContentFile("isCorrectUser.php", $details);
}
?>
