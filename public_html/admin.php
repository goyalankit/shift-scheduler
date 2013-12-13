<?php

        session_start();
        require_once(realpath(dirname(__FILE__) . "/../resources/config.php"));

	require_once(LIBRARY_PATH . "/templateFunctions.php");
        require_once(LIBRARY_PATH . "/connection_open.php");                
        
        //DEBUGGING: REVERT LATER
        if((isset($_SESSION["admin_username"]) && isset($_SESSION["isadmin"]) && $_SESSION['isadmin'] == "true"))            
            renderLayoutWithContentFile("adminHome.php");
        else        
            renderLayoutWithContentFile("login.php");            
?>
