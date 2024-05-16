<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Donor Registration</title>
    <link rel="stylesheet" href="style.css"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js">
    </script>
</head>
<body>
<?php
    @include 'config.php';
    //require('db.php');
    // When form submitted, insert values into the database.
    $referralCode = '';
    
    if($con){
    if (isset($_REQUEST['username'])) {
        // removes backslashes
        $username = stripslashes($_REQUEST['username']);
        //escapes special characters in a string
        $username = mysqli_real_escape_string($con, $username);
        $mob    = stripslashes($_REQUEST['mob']);
        $mob    = mysqli_real_escape_string($con, $mob);
        $location   = stripslashes($_REQUEST['location']);
        $location   = mysqli_real_escape_string($con, $location);
        $email    = stripslashes($_REQUEST['email']);
        $email    = mysqli_real_escape_string($con, $email);
        // $age    = stripslashes($_REQUEST['age']);
        // $age    = mysqli_real_escape_string($con, $age);
        // $weight   = stripslashes($_REQUEST['weight']);
        // $weight    = mysqli_real_escape_string($con, $weight);
        
        $password = stripslashes($_REQUEST['password']);
        $password = mysqli_real_escape_string($con, $password);
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $referral = mysqli_real_escape_string($con, $referral);
        $referral = stripslashes($_REQUEST['referral']);
         $referral = mysqli_real_escape_string($con, $referral);
        //$cpassword = stripslashes($_REQUEST['cpassword']);
        //$cpassword = mysqli_real_escape_string($con, $cpassword);
        // $gender    = stripslashes($_REQUEST['gender']);
        // $gender    = mysqli_real_escape_string($con, $gender);
        // $create_datetime = date("Y-m-d H:i:s");
        $query    = "INSERT into `users` (username, mob, location, email, password, referral)
                     VALUES ('$username', '$mob','$location','$email', '$hashedPassword', '$referral')";
        $result   = mysqli_query($con, $query);
        if ($result) {
            echo "<div class='form'>
                  <h3>You are registered successfully.</h3><br/>
                  <p class='link'>Click here to <a href='login.php'>Login</a></p>
                  </div>";
        } else {
            echo "<div class='form'>
                  <h3>Required fields are missing.</h3><br/>
                  </div>";
        }
    }
    else {
        echo "<div class='form'>
          
          <p class='link'>Click here to <a href='registration.php'>registration</a> again.</p>
          </div>";
    }
?>
    <form class="form" action="" method="post">
        <h1 class="login-title">Donor Registration</h1>
        <input type="text" class="login-input" name="username" placeholder="Username" required/>
        <input type="text" class="login-input" minlength="10" maxlength="10" name="mob" placeholder="Enter Mobile Number">
        <input type="text" class="login-input" name="location" placeholder="Enter your address">
        <input type="text" class="login-input" name="email" placeholder="Email Address">
        <input type="text" class="login-input" name="referral" placeholder="Referral Code">

        
        
        <input type="password" class="login-input" name="password" placeholder="Set Password (Strong password required)">
         
          <br><br><br>

        <input type="submit" name="submit" value="Register" class="login-button" style="font-size:20px"><br><br><br>
        &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
        &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
        &nbsp &nbsp &nbsp &nbsp &nbsp 
    
        <a href="index.html" class="navback">Back to home</a>

    </form>
<?php
    }
?>
</body>
<script>
    $(function() {
        $("input[name='mob']").on('input', function(e) {
            $(this).val($(this).val().replace(/[^0-9]/g, ''));
        });
    });
</script>

</html>