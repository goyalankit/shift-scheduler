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

$user_shifts = $variables["day_shiftn"];
?>

<style>    
    td { font-size: 130%; color: black;}
</style>
<br/><br/><br/><br/>
<table class="table table-striped table-hover">    
    <tr>
        <th>Day</th>
        <?php if (isset($time["shift1"])) {
            echo "<th>Shift 1</th>";
        }else{
        
            echo"<th></th>";        
        }
        ?>
        <?php if (isset($time["shift2"])) {
            echo "<th>Shift 2</th>";
        }else{
        
            echo"<th></th>";        
        }
        ?>
        <?php if (isset($time["shift3"])) {
            echo "<th>Shift 3</th>";
        }else{
        
            echo"<th></th>";        
        }
        ?>
    <?php if (isset($time["shift4"])) {
        echo "<th>Shift 4</th>";
    }
    ?>

    </tr>
    <?php
    echo '<form action="processSchedule.php" method="post" >';

    //print_r($time);

    foreach ($weekdays as $key => $value) {        
        
        echo "<tr>";                
        echo   "<td>" . $value . "</td> ";
                
        if (isset($time["shift1"]) && shift_for_day_exists($value, $time["shift1"]["ShiftId"])) {
            echo "
                    
            <td>            
             <input type='text' name='shift1_shiftid' class='hidden' value='" . array_search (strtolower($value), $time["shift1"]["ShiftId"] ). "'> <input type=checkbox name='" . strtolower($value) . "_0' " . ((isset($user_shifts[strtolower($value)]) && $user_shifts[strtolower($value)] == 1) ? "checked" : "") . " >
                                <span class='label label-warning'> " . $time["shift1"]["ShiftFrom"] . "-" . $time["shift1"]["ShiftTo"] . "</span>
            </td>                                    
        ";
        }else{
            echo"<td></td>";
        }
        
        if (isset($time["shift2"]) && shift_for_day_exists($value, $time["shift2"]["ShiftId"])) {
            echo "<td>
                         <input type='text' name='shift2_shiftid' class='hidden' value='" .array_search (strtolower($value), $time["shift2"]["ShiftId"] ). "'>     <input type=checkbox name='" . strtolower($value) . "_1' " . ((isset($user_shifts[strtolower($value)]) && $user_shifts[strtolower($value)] == 2) ? "checked" : "") . "  >
                                <span class='label label-primary'> " . $time["shift2"]["ShiftFrom"] . "-" . $time["shift2"]["ShiftTo"] . "</span>
            </td>";
        }else{
            echo"<td></td>";
        }
        if (isset($time["shift3"]) && shift_for_day_exists($value, $time["shift3"]["ShiftId"])) {
            echo"
            <td>
                         <input type='text' name='shift3_shiftid' class='hidden' value='" . array_search (strtolower($value), $time["shift3"]["ShiftId"] )."'>     <input type=checkbox name='" . strtolower($value) . "_2' " . ((isset($user_shifts[strtolower($value)]) && $user_shifts[strtolower($value)] == 3) ? "checked" : "") . "  >
                                <span class='label label-success'> " . $time["shift3"]["ShiftFrom"] . "-" . $time["shift3"]["ShiftTo"] . "</span>
            </td>
            ";
        }else{
            echo"<td></td>";
        }
        if (isset($time["shift4"]) && shift_for_day_exists($value, $time["shift4"]["ShiftId"])) {
            echo "
            <td>
                         <input type='text' name='shift4_shiftid' class='hidden' value='" . array_search (strtolower($value), $time["shift4"]["ShiftId"] ). "'>     <input type=checkbox name='" . strtolower($value) . "_3' " . ((isset($user_shifts[strtolower($value)]) && $user_shifts[strtolower($value)] == 4) ? "checked" : "") . "  >
                                <span class='label label-default'> " . $time["shift4"]["ShiftFrom"] . "-" . $time["shift4"]["ShiftTo"] . "</span>
            </td>}";
        }
        echo "
        </tr>        
    ";
    }
    ?>
</table>

<div class='schedule-day'>
    <div class="submit-button"> 
        <button class="btn btn-primary btn-lg" role="button" type="submit" value='yes'> Submit </button>                        
        <a href="user_home.php" class="btn btn-info btn-large"><i class="icon-white icon-arrow-left"></i> back</a>
    </div>
</div>
</form>

<?php
    function shift_for_day_exists($day, $shifts){        
        return (in_array(strtolower($day), $shifts));            
    }
?>