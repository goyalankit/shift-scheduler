<?php

/* Author: Ankit Goyal
 * Date: 10/23/2013
 *
 * page for the schedule selecion.
 * 
 */

require_once(realpath(dirname(__FILE__) . "/../../resources/config.php"));

/*VARIABLES
 * $weekday is defined in config.php.
 * 
 */
$weekdays = array(0 => 'Sunday', 1 => 'Monday', 2 => 'Tuesday', 3 => 'Wednesday',
    4 => 'Thursday', 5 => 'Friday', 6 => 'Saturday');


/* TODO Fetch from database*/
//$time = array("00"=>"12:30-2:30pm", "01"=>"12:30-2:30pm", "02"=>"9:30-2:30pm", 13=>"12:30-2:30pm", 4=>"12:30-2:30pm", 5=>"12:30-2:30pm", 6=>"12:30-2:30pm", 7=>"2:30-2:30pm");

$time = $variables;
echo "<div class='schedule-day'>
          <div class='day'> Day </div>".                         
          "<div class='shift-header'> Shift 1 </div>".
          "<div class='shift-header'> Shift 2 </div>".
          "<div class='shift-header'> Shift 3 </div>".
     "</div><br/>";

echo '<form action="processSchedule.php" method="post">';
foreach ($weekdays as $key => $value) {
    echo "<div class='schedule-day'>
            <div class='day'>" . $value ."</div>".                         
            "<div class='shift1'>
                <input type=checkbox name='".strtolower($value)."_".$key."0'>
                    <label> ".$time[$key."0"]."</label>
             </div>".
            "<div class='shift2'>
                <input type=checkbox name='".strtolower($value)."_".$key."1'>
                <label> ".$time[$key."1"]."</label>
            </div>".
            "<div class='shift3'>
                <input type=checkbox name='".strtolower($value)."_".$key."2'>
                <label> ".$time[$key."2"]."</label>
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