<?php
session_start();

if(empty($_POST) || !isset($_POST)){
    header("/admin");
}

    	require_once(realpath(dirname(__FILE__) . "/../resources/config.php"));

	require_once(LIBRARY_PATH . "/templateFunctions.php");
        require_once(LIBRARY_PATH . "/connection_open.php");
        require_once(LIBRARY_PATH . "/entryManagement.php");

$field_names = array("FirstName" => "required", "LastName" => "optional", "NickName" => "optional", "UniqueId" => "required", "Active" => "required");
$data = array();
$errors = array();

foreach ($field_names as $key => $value) {
    if($value == "required" && !isset($_POST[$key])){
        array_push($errors, $key." missing");
    }else{
        if(isset($_POST[$key])){
            $data[$key] = $_POST[$key];        
        }
       }
    }

    if(!empty($errors)){
        print_r($errors);
    }
    
    $result = createOrUpdateUser($data, $dbh);
    if (strpos($result,'ERROR') !== false) {
        $_SESSION['error'] = $result;
    }else{
        $_SESSION['success'] = $result;
    }
    
    header('Location: admin.php');
    

?>
