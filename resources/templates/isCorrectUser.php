<?php


//ONLY CHECK IF unique id is set
if(!isset($_SESSION['uniqueId'])){       
   header('Location: /public_html/');   
}

$details = $variables[0];
?>

<form method='post' action='processIsCorrectUser.php'>    
    
    <div class="jumbotron">
  <h1>Are you <?php print $details['FirstName']?> <? print $details['LastName']?> ? </h1>
    <div class="btn-group">
        <br/>
    <button class="btn btn-primary btn-lg" role="button" name='isuser' type="submit" value='yes'> Yes </button>
    <button class="btn btn-danger btn-lg" role="button" type="submit" name='isuser' value ='no'> No </button>
    </div>
</form>
