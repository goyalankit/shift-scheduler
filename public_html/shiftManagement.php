<?php

    	require_once(realpath(dirname(__FILE__) . "/../resources/config.php"));

	require_once(LIBRARY_PATH . "/templateFunctions.php");
        require_once(LIBRARY_PATH . "/connection_open.php");
        
        
        if(isset($_POST['action']) && $_POST['action'] = 'add'){                       
            $variables = array();
            renderLayoutWithContentFile("shifts.php", $variables);            
        }else{
            $variables = array();
            renderLayoutWithContentFile("shiftsIndex.php", $variables);                        
        }                                        
?>

