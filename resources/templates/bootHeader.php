<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="../../docs-assets/ico/favicon.png">

    <title>OSR</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">  
    <link type="text/css" href="css/bootstrap-timepicker.min.css" rel="stylesheet"/>        

  </head>

  <body>

    <div class="container">
      <div class="header">
        <ul class="nav nav-pills pull-right">
            <li class="active"><a href="<?php isset($_SESSION['uniqueId']) ? print "user_home.php" : "./" ?>">Home</a></li>
          <li <?php !isset($_SESSION['uniqueId']) ? print "class='hidden'" : print ""  ?> ><a href="showSchedule.php">Schedule</a></li>
          <li <?php !isset($_SESSION['uniqueId']) ? print "class='hidden'" : print ""  ?>><a href="logout.php">Log out</a></li>
        </ul>
        <h3 class="text-muted">Office of Survey and Research</h3>
      </div>