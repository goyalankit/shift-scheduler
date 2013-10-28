<?php

require_once(realpath(dirname(__FILE__) . "/../resources/config.php"));
require_once(LIBRARY_PATH . "/templateFunctions.php");

if(isset($_POST['isuser'])){    
   if($_POST['isuser'] != 'yes') {
       unset($_SESSION['uniqueId']);       
       header('Location: /public_html/');       
   }
}

$variables = array();
renderLayoutWithContentFile("schedule.php", $variables);

?>
