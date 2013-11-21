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
        <input name="UniqueId"  type="text" class="form-control" placeholder="Enter username">      
      <span class="input-group-btn">
        <button class="btn btn-default" type="submit">Edit User</button>
      </span>
    </div><!-- /input-group --> 
</form></li><br/>
     <li><a href="shiftManagement.php">Add/Edit Next Week Shifts</a></li><br/>
     <li><a href="shiftManagement.php">Check Current Week's Schedule</a></li><br/>
      

</ul>