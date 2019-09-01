<?php
session_start();
include 'db.php';
date_default_timezone_set('Africa/Accra');
require_once 'php/connect.php'; require_once 'php/functions.php';
?>

<!DOCTYPE html>
<html>

<head>
    <title>Ucomso</title>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="css/style.css" rel="stylesheet" type="text/css">
    <link href="css/style2.css" rel="stylesheet" type="text/css">
    <script src="js/jquery-3.2.1.min.js" rel="script" type="text/javascript"></script>
    <script src="js/bootstrap.min.js" rel="script" type="text/javascript"></script>
    <script src="js/global.js" rel="script" type="text/javascript"></script>
    <script src="js/default.js" rel="script" type="text/javascript"></script>
</head>

<body>

<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php">UCOMSO FORUM <span class='glyphicon glyphicon-home'></span></a>
        </div> <!-- End of Navbar header Div -->
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <?php
                    if(isset($_SESSION['id'])){
                        echo "<form style='margin-top: 10px; margin-right: 15px' action='includes/logout.inc.php' method='POST'>
                        <button class='btn btn-danger' type='submit'>Logout <span class='glyphicon glyphicon-log-out'></span></button>
                        </form>";
                    }
                    else{
                        echo "<form style='position: inherit; top: 8px; margin-right: 15px' class='login_form form-group form-inline' action='includes/login.inc.php' method='POST'>
                          <input class='form-control' type='text' name='uid' placeholder='Username'>
                          <input class='form-control' type='password' name='pwd' placeholder='Password'>
                          <button class='btn btn-success' type='submit'>Login <span class='glyphicon glyphicon-log-in'></span></button>
                    </form>";
                    }
                    ?>
                </li>
                <li class="active"><a href="index.php"><span class='glyphicon glyphicon-home'> Home</a></li>
                <li><a href="signup.php"><span class='glyphicon glyphicon-registration-mark'></span> Signup</a></li>
                <li><a href="contactus.php"><span class='glyphicon glyphicon-envelope'></span> Contact</a></li>
                <li><a href="index.php"><span class='glyphicon glyphicon-info-sign'></span> About</a></li>
            </ul> <!-- End of Navbar Right UL -->
        </div> <!-- End of Navbar Collapse Div -->
    </div> <!-- End of Container Div -->
</div> <!-- End of Navbar Default -->

<div id="container" class="container-fluid">
