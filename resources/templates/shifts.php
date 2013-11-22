

        <form type="submit" method="post" action="processShifts.php" class="well">

            
<!--            <h3> Shift 1 </h3>
            
            <div class="form-group">
                <label for="firstname" class="col-sm-2 control-label">First Name</label>
                <div class="col-sm-4">
                <input type="text" class="form-control" id="name" name="FirstName" value="<?php isset($variables["FirstName"]) ? print $variables["FirstName"] : "" ?>" required/>      
            </div>-->
            
            
<?php
for ($i = 1; $i < 5; $i++) {
    $shift_var = empty($variables["shift".$i]) ? NULL : $variables["shift".$i]  ;                
    
    //print_r($shift_var);
    
    echo '<h3> Shift'.($i).'</h3>
        <input type="text" name="shift'.$i.'_shiftid" class="hidden" '.(is_null($shift_var) ? "" : "value=".$shift_var["ShiftId"]).'>
        <div class="form-group">
            <label for="Active" class="col-sm-2 control-label">Active</label>
            <div class="col-sm-4">
                <input type="checkbox" value="true" '.(is_null($shift_var) ? false : ($shift_var["Active"] == 'true' ? "checked" : "")).' name="shift'.$i.'_active"/> <br/>
            </div>
        </div>
        <br/>
        <div class="form-group">
            <label for="from" class="col-sm-2 control-label">Timings</label>
            <div class="col-sm-4">               
               From: <input type="text" id="time3" name="shift'.$i.'_from" size="10" value="'.(is_null($shift_var) ? "08:00" : $shift_var["ShiftFrom"]).'" />                    
                   To: <input type="text" id="time4" name="shift'.$i.'_to" size="10" value="'.(is_null($shift_var) ? "12:00" : $shift_var["ShiftTo"]).'" />
            </div>
        </div><br/>
        
        <div class="form-group">
            <label for="to" class="col-sm-2 control-label">Number of Candidates </label>
            <div class="col-sm-1">               
              <input type="number" name="shift'.$i.'_numberOfCandidates" value="'.(is_null($shift_var) ? 3 : $shift_var["NumberOfCandidates"]).'" />          
            </div>
        </div>
<br/>


        ';
    
}


?>            
                                  
            
 <?php 
 
//
// //print_r($variables);
//
//for ($i = 1; $i < 5; $i++) {
//    $shift_var = empty($variables["shift".$i]) ? NULL : $variables["shift".$i]  ;                
//    
//    //print_r($shift_var);
//    
//    echo '<div>
//    <h3> Shift'.($i).'</h3>
//    <input type="text" name="shift'.$i.'_shiftid" class="hidden-field" '.(is_null($shift_var) ? "" : "value=".$shift_var["ShiftId"]).'>    
//    Active <input type="checkbox" value="true" '.(is_null($shift_var) ? false : ($shift_var["Active"] == 'true' ? "checked" : "")).' name="shift'.$i.'_active"/> <br/>
//    from: <input type="text" id="time3" name="shift'.$i.'_from" size="10" value="'.(is_null($shift_var) ? "08:00" : $shift_var["ShiftFrom"]).'"  /> 
//    to: <input type="text" id="time4" name="shift'.$i.'_to" size="10" value="'.(is_null($shift_var) ? "12:00" : $shift_var["ShiftTo"]).'" /><br/>
//    Number of Candidates <input type="number" name="shift'.$i.'_numberOfCandidates" value="'.(is_null($shift_var) ? 3 : $shift_var["NumberOfCandidates"]).'" />        
//    </div><hr/>';    
//}
//
//?>

<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-primary">Sign in</button>
    </div>
  </div>   <br/> 

    </form>

<br/>