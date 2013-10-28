<?php
session_start();
if(isset($_POST['isuser'])){    
   if($_POST['isuser'] == 'yes') {
       echo "Awesome";
   }else{
       unset($_SESSION['uniqueId']);       
       header('Location: /public_html/');
   }
}

$details = $variables[0];

echo "Are you? <br/>";
echo "First Name: ".$details['FirstName']." ".$details['LastName'];
echo "<br/>";   
?>

<br/>
<form method='post' action='processIsCorrectUser.php'>    
    <input type='submit' name='isuser' value='yes'/>
    <input type='submit' name='isuser' value='no'/>        
</form>
<br/>