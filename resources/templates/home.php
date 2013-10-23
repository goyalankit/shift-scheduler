<?php session_start(); ?>

<h2>Schedule your next shift.</h2>


<?php

if(isset($_SESSION['errors'])){
    echo "<div class='error-message'>
        Incorrect unique id. Please try again
    </div>";
}

?>        
        
<form type="submit" action="validateUser.php" method='post'>
    <div id="name-box">
        Please enter your unique id:<input name="unique_id" type="text">
        <input type="submit"/>
    </div>
</form>

<?php

?>