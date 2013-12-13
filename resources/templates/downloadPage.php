<?php
$link = $variables[0];
print_r($link);
?>
<div class="page-header">
    <h3>Download results.</h3>
</div>

<?php
    if (isset($link) && $link != "") {
?>
    <a href="<?php echo $link ?>" class="btn btn-primary btn-lg active" role="button"><span class="glyphicon glyphicon-download"> </span> Download </a>

<?php
    } else {
?>
    <div class="alert alert-danger">Oh snap! could not find your file</div>
<?php 
    }
?>    
    <a href="processAdminLogin.php" class="btn btn-info btn-large"><i class="icon-white icon-arrow-left"></i> back</a>
<?php

    

?>    
    

<!--echo "<a href=".$link."> download </a>"-->
