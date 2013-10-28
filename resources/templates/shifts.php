<script>
 jQuery(function() {
    $("#time3, #time4").timePicker();
 });
</script>

        <form type="submit" method="post" action="processShifts.php">
    
        
 <?php

for ($i = 1; $i < 5; $i++) {
    echo '<div>
    <h3> Shift'.($i).'</h3>
    Active <input type="checkbox" name="shift'.$i.'_active"/> <br/>
    from: <input type="text" id="time3" name="shift'.$i.'_from" size="10" value="08:00" /> 
    to: <input type="text" id="time4" name="shift'.$i.'_to" size="10" value="09:00" /><br/>
    Number of Candidates <input type="number" name="shift'.$i.'_numberOfCandidates" value="1"/>        
    </div><hr/>';    
}

?>
        <input type="submit">

    </form>