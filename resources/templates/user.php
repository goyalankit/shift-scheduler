<?php
if (isset($_SESSION['errors'])) {
    echo '<div class="alert alert-danger .alert-dismissable">
            ' . $_SESSION['errors'] . '
        </div>';
    unset($_SESSION['errors']);
} elseif (isset($_SESSION['success'])) {
    echo '<div class="alert alert-success .alert-dismissable">
            ' . $_SESSION['success'] . '
        </div>';
    unset($_SESSION['success']);
}
?>

<style>
    ul {max-width: 300px;}
    li {color: black; border: black 2px;}
</style>

<div class="page-header">
    <h3>User home</h3>
</div>




<ul class="nav nav-pills nav-stacked">
    <li><a href="generateSchedule.php">Sign up for shifts.</a></li><br/>          
    <li><a href="showSchedule.php">Check Current Week's Schedule</a></li><br/>


</ul>