<?php
//ONLY CHECK IF unique id is set
if (!isset($_SESSION['uniqueId'])) {
    header('Location: /public_html/');
}

$details = $variables[0];
?>

<form method='post' action='processIsCorrectUser.php'>    

    <div class="jumbotron">
        <h1>Are you <?php print $details['FirstName'] ." ".$details['LastName'] ?> ? </h1>
        <br/>
        <div class="btn-group">        
            <button class="btn btn-success btn-lg" name='isuser' type="submit" value='yes'><i class="icon-white icon-ok"></i> Yes I am</button>    
            <button class="btn btn-danger btn-lg" role="button" type="submit" name='isuser' value ='no'> No, get me out of here </button>
        </div>
</form>
