<?php

/* Author: Ankit Goyal
 * Date: 10/23/2013
 *
 * page for the schedule selecion.
 * 
 */

require_once(realpath(dirname(__FILE__) . "/../../resources/config.php"));

/*VARIABLES
 * 
 * 
 */
$weekdays = array(0 => 'Sunday', 1 => 'Monday', 2 => 'Tuesday', 3 => 'Wednesday',
    4 => 'Thursday', 5 => 'Friday', 6 => 'Saturday');


$time = $variables["available"];
echo "<div class='schedule-day'>
          <div class='day'> Day </div>".                         
          "<div class='shift-header'> Shift 1 </div>".
          "<div class='shift-header'> Shift 2 </div>".
        "<div class='shift-header'> Shift 3 </div>".
          "<div class='shift-header'> Shift 4</div>".
     "</div><br/>";

echo '<form action="processSchedule.php" method="post">';
foreach ($weekdays as $key => $value) {
    echo "<div class='schedule-day'>
            <div class='day'>" . $value ."</div>".                         
            "<div class='shift1'>
                <input type='text' name='shift1_shiftid' class='hidden-field' value='".$time[$key."0"]["shiftid"]."'>    
                <input type=checkbox name='".strtolower($value)."_".$key."0' ".(isset($signed_up[$key."".$time[$key."0"]["shiftid"]]) ? "checked" : "" )." >
                    <label> ".$time[$key."0"]["time"]."</label>
             </div>".
            "<div class='shift2'>
                <input type='text' name='shift2_shiftid' class='hidden-field' value='".$time[$key."1"]["shiftid"]."'>    
                <input type=checkbox name='".strtolower($value)."_".$key."1'".(isset($signed_up[$key."".$time[$key."1"]["shiftid"]]) ? "checked" : "" ).">
                <label> ".$time[$key."1"]["time"]."</label>
            </div>".
            "<div class='shift3'>
                <input type='text' name='shift3_shiftid' class='hidden-field' value='".$time[$key."2"]["shiftid"]."' >    
                <input type=checkbox name='".strtolower($value)."_".$key."2' ".(isset($signed_up[$key."".$time[$key."2"]["shiftid"]]) ? "checked" : "" ).">
                <label> ".$time[$key."2"]["time"]."</label>
            </div>".
            "<div class='shift4'>
                <input type='text' name='shift4_shiftid' class='hidden-field' value='".$time[$key."3"]["shiftid"]."'>    
                <input type=checkbox name='".strtolower($value)."_".$key."3' ".(isset($signed_up[$key."".$time[$key."3"]["shiftid"]]) ? "checked" : "" ).">
                <label> ".$time[$key."3"]["time"]."</label>
            </div>".
          "</div><br/>";
}
?>


<div class='schedule-day'>
    <div class="submit-button"> 
        <input type='submit'/>
    </div>
</div>
</form>