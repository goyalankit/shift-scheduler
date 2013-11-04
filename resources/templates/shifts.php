<script>
 jQuery(function() {
    $("#time3, #time4").timePicker();
 });
</script>

        <form type="submit" method="post" action="processShifts.php">
            
 <?php 
 

 print_r($variables);
 
for ($i = 1; $i < 5; $i++) {
    $shift_var = empty($variables["shift".$i]) ? NULL : $variables["shift".$i][0];        
    
    echo '<div>
    <h3> Shift'.($i).'</h3>
    <input type="text" name="shift'.$i.'_shiftid" class="hidden-field" '.(is_null($shift_var) ? "" : "value=".$shift_var["ShiftId"]).'>    
    Active <input type="checkbox" value="true" '.(is_null($shift_var) ? false : "checked").' name="shift'.$i.'_active"/> <br/>
    from: <input type="text" id="time3" name="shift'.$i.'_from" size="10" value="'.(is_null($shift_var) ? "08:00" : $shift_var["ShiftFrom"]).'"  /> 
    to: <input type="text" id="time4" name="shift'.$i.'_to" size="10" value="'.(is_null($shift_var) ? "12:00" : $shift_var["ShiftTo"]).'" /><br/>
    Number of Candidates <input type="number" name="shift'.$i.'_numberOfCandidates" value="'.(is_null($shift_var) ? 3 : $shift_var["NumberOfCandidates"]).'" />        
    </div><hr/>';    
}

?>
        <input type="submit">

    </form>