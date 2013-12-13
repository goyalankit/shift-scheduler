<?php
    if(isset($_SESSION['errors'])){
        echo '<div class="alert alert-danger .alert-dismissable">
            '.$_SESSION['errors'].'
        </div>';
        unset ($_SESSION['errors']);    
    }elseif (isset($_SESSION['success'])) {
        echo '<div class="alert alert-success .alert-dismissable">
            '.$_SESSION['success'].'
        </div>';
        unset ($_SESSION['success']); 
    }
?>

<style>
    ul {max-width: 300px;}
    li {color: black; border: black 2px;}
</style>

<div class="page-header">
<h3>Admin Control Panel</h3>
</div>




<ul class="nav nav-pills nav-stacked">
     <li><a href="userManagement.php">Add a new user</a></li><br/>
     <li>  <form type="submit" action="searchAndEditUser.php" method='post' >
    <div class="input-group">
        <input name="UniqueId"  type="text" class="form-control" placeholder="Enter username" required>      
      <span class="input-group-btn">
          <input type="submit" class="btn btn-inverse btn-large" value="Edit User"/>
<!--        <button class="btn btn-default" type="submit"></button>-->
      </span>
    </div><!-- /input-group --> 
</form></li><br/>
     <li><a href="shiftManagement.php">Add/Edit Next Week Shifts</a></li><br/>          
      <li>  <form type="submit" action="downloadManager.php" method='post' >
    <div class="input-group">
        <input name="WeekNumber"  type="text" class="form-control" placeholder="Enter week number" required>      
      <span class="input-group-btn">
          <input type="submit" class="btn btn-inverse btn-large" value="Get Link"/>
<!--        <button class="btn btn-default" type="submit"></button>-->
      </span>
    </div><!-- /input-group --> 
</form></li><br/>          

</ul>