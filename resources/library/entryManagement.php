<?php

/*
 * Author: Ankit Goyal
 * Date: 10/23/2013
 *
 */

function validateUser($uniqueId, $dbh){
    $sql = "SELECT * FROM USER where UniqueId=:uniqueId";
    $sth = $dbh -> prepare($sql);
    $data['uniqueId'] = trim($uniqueId);
    $success = $sth -> execute($data);  
    $details = $sth -> fetchAll();    
    return $details;
}

?>
