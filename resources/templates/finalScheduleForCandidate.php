<?php
/* Author: Ankit Goyal
 * Date: 10/23/2013
 *
 * Layout for the final schedule for the candidate.
 * All the data is passed from processSchedule.php
 * 
 */



echo "Final schedule for candidate";

print_r($variables);

/*foreach ($weekdays as $key => $value) {
    echo "<div class='schedule-day'>
            <div class='day'>" . $value ."</div>".                         
            "<div class='shift1'>
                <input type=checkbox name='".strtolower($value)."_".$key."0'>
                    <label> ".$time["00"]."</label>
             </div>".
            "<div class='shift2'>
                <input type=checkbox name='".strtolower($value)."_".$key."1'>
                <label> ".$time["01"]."</label>
            </div>".
            "<div class='shift3'>
                <input type=checkbox name='".strtolower($value)."_".$key."2'>
                <label> ".$time["02"]."</label>
            </div>".
          "</div><br/>";
}*/
?>
