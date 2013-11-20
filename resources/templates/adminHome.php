
<style>
    
/* LIST #2 */
#list2 { width:320px; }
#list2 ol{ font-style:italic; font-family:Georgia, Times, serif; font-size:24px; color:#bfe1f1;  }
h3{ font-family:Georgia, Times, serif; font-size:24px;;  }
#list2 ol li { }
#list2 ol li p { padding:8px; font-style:normal; font-family:Arial; font-size:13px; color:#eee; border-left: 1px solid #999; }
#list2 ol li p em { display:block; }
#list2 ol li p em a { text-decoration:none; color:#000; }
#list2 ol li p em a:hover { text-decoration:underline; color:#000; }

</style>

<h3>Admin Control Panel</h3>
<div id="list2">
   <ol>
      <li><p><em><a href="userManagement.php">Add a new user</a></em> </p></li>
      <li><em><form style='margin: 0; padding: 0' action="searchAndEditUser.php" method="POST">  
                      <input style='display:inline;' 
            type='text' name="UniqueId"
            />  
     <input style='display:inline;' 
            type='submit' 
            value='edit user'/>  
</form></em></li>
      <li><p><em><a href="shiftManagement.php">Add/Edit Next Week Shifts</a></em> </p></li>
      <li><p><em><a href="/scheduleManagement.php">Check Current Week's Schedule</a></em> </p></li>
          
   </ol>
</div>