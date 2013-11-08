<?php
/* Author: Ankit Goyal
 * Date: 10/23/2013
 *
 * Layout for the final schedule for the candidate.
 * All the data is passed from processSchedule.php
 * 
 */

session_start();
?>

<table cellspacing='0'>
    <thead>
        <tr>
            <th>Day</th>
            <th>Shift 1</th>
            <th>Shift 2</th>
            <th>Shift 3</th>
            <th>Shift 4</th>			
        </tr>
    </thead>
    <tbody>

        <?php
        print_r($variables);

        foreach ($variables as $key => $value) {
            $count = 3;
            echo '<tr' . ($count % 2 == 0 ? "class='even'" : "") . '.>';
            echo '<td>' . $key . '</td>';
            $col = 1;

            $previous = 0;
            foreach ($value as $timevalue) {
                while ($previous < $timevalue[0] - 1) {
                    echo '<td></td>';
                    $previous++;
                }

                $previous = $timevalue[0];
                echo '<td>' . $timevalue[1] . '</td>';
            }

            echo '</tr>';
        }
        ?>
</table>