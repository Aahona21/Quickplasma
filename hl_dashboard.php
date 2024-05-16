<?php
//include auth_session.php file on all user panel pages
@include 'config.php';
include("hl_auth_session.php");
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Dashboard - Hospital Area</title>
    <link rel="stylesheet" href="style.css" />
</head>
<body>
    <div class="form">
        <p>Hey, <?php echo $_SESSION['hlemail']; ?>!</p>
        <p>Hospital Logged in successfully !!!</p>
        <p><a href="hl_logout.php">Logout</a></p>
    </div>
</body>
</html>