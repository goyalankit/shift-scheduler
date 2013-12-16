<?php

require_once(realpath(dirname(__FILE__) . "/../resources/config.php"));

require_once(LIBRARY_PATH . "/templateFunctions.php");
require_once(LIBRARY_PATH . "/connection_open.php");
require_once(LIBRARY_PATH . "/entryManagement.php");

print_r($_POST);
$uniqueId = $_POST["UniqueId"];
$user_details = validateUser($uniqueId, $dbh);
if (!empty($user_details)) {
    renderLayoutWithContentFile("new_user.php", $user_details);
}
?>
