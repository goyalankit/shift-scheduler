<?php
/* Author: Ankit Goyal
 * Date: 10/23/2013
 *
 * page for the schedule selecion.
 * 
 */

require_once(realpath(dirname(__FILE__) . "/../../resources/config.php"));

/* VARIABLES
 * 
 * 
 */
$weekdays = array(0 => 'Sunday', 1 => 'Monday', 2 => 'Tuesday', 3 => 'Wednesday',
    4 => 'Thursday', 5 => 'Friday', 6 => 'Saturday');


$time = $variables;
//print_r($variables);
$user_shifts = $variables["day_shiftn"];

//echo "<div class='schedule-day'>
//          <div class='day'> Day </div>".                         
//          "<div class='shift-header'> Shift 1 </div>".
//          "<div class='shift-header'> Shift 2 </div>".
//        "<div class='shift-header'> Shift 3 </div>".
//          "<div class='shift-header'> Shift 4</div>".
//     "</div><br/>";
?>

<style>    
    td { font-size: 130%; color: black;}
</style>
<br/><br/><br/><br/>
<table class="table table-striped table-hover">    
    <tr>
        <th>Day</th>
        <th>Shift 1</th>
        <th> Shift 2</th>
        <th>Shift 3</th>        
        <th>Shift 4</th>        
    </tr>
    <?php
    echo '<form action="processSchedule.php" method="post" >';
//foreach ($weekdays as $key => $value) {
//    echo "<div class='row'>
//            <div class='col-md-2'>" . $value ."</div>".                                     
//            "<div class='col-md-2'>
//                <input type='text' name='shift1_shiftid' class='hidden' value='".$time["shift1"]["ShiftId"]."'>    
//                <input type=checkbox name='".strtolower($value)."_0' ".((isset($user_shifts[strtolower($value)]) && $user_shifts[strtolower($value)] == 1) ? "checked" : "")." >
//                    <label> ".$time["shift1"]["ShiftFrom"]."-".$time["shift1"]["ShiftTo"]."</label>
//             </div>".
//            "<div class='col-md-2'>
//                <input type='text' name='shift2_shiftid' class='hidden' value='".$time["shift2"]["ShiftId"]."'>    
//                <input type=checkbox name='".strtolower($value)."_1' ".((isset($user_shifts[strtolower($value)]) && $user_shifts[strtolower($value)] == 2) ? "checked" : "")."  >
//                <label> ".$time["shift2"]["ShiftFrom"]."-".$time["shift2"]["ShiftTo"]."</label>
//            </div>".
//            "<div class='col-md-2'>
//                <input type='text' name='shift3_shiftid' class='hidden' value='".$time["shift3"]["ShiftId"]."'>    
//                <input type=checkbox name='".strtolower($value)."_2' ".((isset($user_shifts[strtolower($value)]) && $user_shifts[strtolower($value)] == 3) ? "checked" : "")." >
//                <label> ".$time["shift3"]["ShiftFrom"]."-".$time["shift3"]["ShiftTo"]."</label>
//            </div>".(isset($time["shift4"]) ? 
//            "<div class='col-md-2'>
//                <input type='text' name='shift4_shiftid' class='hidden' value='".$time["shift4"]["ShiftId"]."'>    
//                <input type=checkbox name='".strtolower($value)."_3' ".((isset($user_shifts[strtolower($value)]) && $user_shifts[strtolower($value)] == 4) ? "checked" : "")." >
//                <label> ".$time["shift4"]["ShiftFrom"]."-".$time["shift4"]["ShiftTo"]."</label>
//            </div>" : "").
//          "</div><br/>";
//}

    foreach ($weekdays as $key => $value) {
        echo "
        <tr>
            <td>" . $value . "</td>        
            <td>
             <input type='text' name='shift1_shiftid' class='hidden' value='" . $time["shift1"]["ShiftId"] . "'> <input type=checkbox name='" . strtolower($value) . "_0' " . ((isset($user_shifts[strtolower($value)]) && $user_shifts[strtolower($value)] == 1) ? "checked" : "") . " >
                                <span class='label label-warning'> " . $time["shift1"]["ShiftFrom"] . "-" . $time["shift1"]["ShiftTo"] . "</span>
            </td>                                    
            <td>
                         <input type='text' name='shift2_shiftid' class='hidden' value='" . $time["shift2"]["ShiftId"] . "'>     <input type=checkbox name='" . strtolower($value) . "_1' " . ((isset($user_shifts[strtolower($value)]) && $user_shifts[strtolower($value)] == 2) ? "checked" : "") . "  >
                                <span class='label label-primary'> " . $time["shift2"]["ShiftFrom"] . "-" . $time["shift2"]["ShiftTo"] . "</span>
            </td>
            
            <td>
                         <input type='text' name='shift3_shiftid' class='hidden' value='" . $time["shift3"]["ShiftId"] . "'>     <input type=checkbox name='" . strtolower($value) . "_2' " . ((isset($user_shifts[strtolower($value)]) && $user_shifts[strtolower($value)] == 3) ? "checked" : "") . "  >
                                <span class='label label-success'> " . $time["shift3"]["ShiftFrom"] . "-" . $time["shift3"]["ShiftTo"] . "</span>
            </td>
            
            <td>
                         <input type='text' name='shift4_shiftid' class='hidden' value='" . $time["shift4"]["ShiftId"] . "'>     <input type=checkbox name='" . strtolower($value) . "_3' " . ((isset($user_shifts[strtolower($value)]) && $user_shifts[strtolower($value)] == 4) ? "checked" : "") . "  >
                                <span class='label label-default'> " . $time["shift4"]["ShiftFrom"] . "-" . $time["shift4"]["ShiftTo"] . "</span>
            </td>
        </tr>        
    ";
    }
    ?>
</table>

<div class='schedule-day'>
    <div class="submit-button"> 
        <button class="btn btn-primary btn-lg" role="button" type="submit" value='yes'> Submit </button>
    </div>
</div>
</form>


<!--foreach ($weekdays as $key => $value) {
    echo "<div class='schedule-day'>
            <div class='day'>" . $value ."</div>".                         
            "<div class='shift1'>
                <input type='text' name='shift1_shiftid' class='hidden-field' value='".$time["shift1"]["ShiftId"]."'>    
                <input type=checkbox name='".strtolower($value)."_0' ".((isset($user_shifts[strtolower($value)]) && $user_shifts[strtolower($value)] == 1) ? "checked" : "")." >
                    <label> ".$time["shift1"]["ShiftFrom"]."-".$time["shift1"]["ShiftTo"]."</label>
             </div>".
            "<div class='shift2'>
                <input type='text' name='shift2_shiftid' class='hidden-field' value='".$time["shift2"]["ShiftId"]."'>    
                <input type=checkbox name='".strtolower($value)."_1' ".((isset($user_shifts[strtolower($value)]) && $user_shifts[strtolower($value)] == 2) ? "checked" : "")."  >
                <label> ".$time["shift2"]["ShiftFrom"]."-".$time["shift2"]["ShiftTo"]."</label>
            </div>".
            "<div class='shift3'>
                <input type='text' name='shift3_shiftid' class='hidden-field' value='".$time["shift3"]["ShiftId"]."'>    
                <input type=checkbox name='".strtolower($value)."_2' ".((isset($user_shifts[strtolower($value)]) && $user_shifts[strtolower($value)] == 3) ? "checked" : "")." >
                <label> ".$time["shift3"]["ShiftFrom"]."-".$time["shift3"]["ShiftTo"]."</label>
            </div>".(isset($time["shift4"]) ? 
            "<div class='shift4'>
                <input type='text' name='shift4_shiftid' class='hidden-field' value='".$time["shift4"]["ShiftId"]."'>    
                <input type=checkbox name='".strtolower($value)."_3' ".((isset($user_shifts[strtolower($value)]) && $user_shifts[strtolower($value)] == 4) ? "checked" : "")." >
                <label> ".$time["shift4"]["ShiftFrom"]."-".$time["shift4"]["ShiftTo"]."</label>
            </div>" : "").
          "</div><br/>";
}-->