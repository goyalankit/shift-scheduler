<?php

require_once(realpath(dirname(__FILE__) . "/../resources/config.php"));
require_once(LIBRARY_PATH . "/templateFunctions.php");
require_once(LIBRARY_PATH . "/connection_open.php");
require_once(LIBRARY_PATH . "/entryManagement.php");


if(isset($_POST['isuser'])){    
   if($_POST['isuser'] != 'yes') {
       unset($_SESSION['uniqueId']);       
       header('Location: /public_html/');       
   }
}

header('Location: /public_html/generateSchedule.php');       
?>
