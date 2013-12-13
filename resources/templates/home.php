<?php session_start(); ?>

<div class="page-header">
  <h3>Schedule your next shift.</h3>
</div>

<?php

if(isset($_SESSION['errors'])){    
    echo '<div class="alert alert alert-danger alert-dismissable">
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
  <strong>Error!</strong> Incorrect Username. Please try again
</div>';    
    unset($_SESSION['errors']);
    session_destroy();
} elseif (isset($_SESSION['uniqueId'])) {
    header("Location: validateUser.php");    
}
?>        

<form type="submit" action="validateUser.php" method='post'>
 <div class="col-lg-6">
    <div class="input-group">
        <input name="unique_id" type="text" class="form-control" placeholder="Enter you username">      
      <span class="input-group-btn">
        <button class="btn btn-success" type="submit">Go!</button>
      </span>
    </div><!-- /input-group -->
  </div><!-- /.col-lg-6 -->
</form>
<?php
?>