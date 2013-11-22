<?php
/* Author: Ankit Goyal
 * Date: 10/23/2013
 *
 * Layout for the final schedule for the candidate.
 * All the data is passed from processSchedule.php
 * 
 */


?>

<table class="table table-striped table-hover">    
    <thead>
        <tr>
            <th>Date</th>
            <th>Day</th>
            <th>Time</th>            
        </tr>
    </thead>
    <tbody>

        <?php
        //print_r($variables);
        foreach ($variables as $key => $value) {
            echo "<tr><td>".$value["ShiftDate"]."</td> <td>".ucwords($value["Day"])."</td><td> ".$value["ShiftFrom"]."-".$value["ShiftTo"]."<td></tr>";            
        }
        ?>                
</table>
<a href="user_home.php" class="btn btn-info btn-large"><i class="icon-white icon-arrow-left"></i> back</a>