<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>User Login</title>
    <link rel="stylesheet" href="style.css"/>
</head>
<body>
<?php
    @include 'config.php';
    //require('db.php');
    session_start();
    // When form submitted, check and create user session.
    // if (isset($_POST['username'])) {
    //     $username = stripslashes($_REQUEST['username']);    // removes backslashes
    //     $username = mysqli_real_escape_string($con, $username);
    //     $password = stripslashes($_REQUEST['password']);
    //     $password = mysqli_real_escape_string($con, $password);

    //     // Check user is exist in the database
    //     $query    = "SELECT * FROM `users` WHERE username='$username'
//         --              AND password=' $hashedPassword '";
//         -- $result = mysqli_query($con, $query) or die(mysqli_connect_error());
//         -- $rows = mysqli_num_rows($result);
//         -- if ($rows == 1) {
//         --     $_SESSION['username'] = $username;
//         --     // Redirect to user dashboard page
//         --     header("Location: dashboard.php");
//         -- } else {
//         --     echo "<div class='form'>
//         --           <h3>Incorrect Username/password.</h3><br/>
//         --           <p class='link'>Click here to <a href='login.php'>Login</a> again.</p>
//         --           </div>";
//         -- }
//     } else {
// 
if (isset($_POST['username'])) {
    $username = stripslashes($_REQUEST['username']);
    $username = mysqli_real_escape_string($con, $username);
    $password = stripslashes($_REQUEST['password']);
    $password = mysqli_real_escape_string($con, $password);

    // Retrieve the hashed password from the database based on the provided username
    $query = "SELECT password FROM `users` WHERE username='$username'";
    $result = mysqli_query($con, $query) or die(mysqli_connect_error());

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $hashedPasswordFromDB = $row['password'];

        // Verify the provided password against the hashed password from the database
        if (password_verify($password, $hashedPasswordFromDB)) {
            // Password is correct, set session and redirect
            $_SESSION['username'] = $username;
            header("Location: dashboard.php"); // Redirect to user dashboard
            exit();
        } else {
            // Password is incorrect
            echo "abcIncorrect password.";
        }
    } else {
        // User does not exist
        echo "User does not exist.";
    }
}

    ?>
    <form class="form" method="post" name="login">
        <h1 class="login-title">Login</h1>
        <input type="text" class="login-input" name="username" placeholder="Username" autofocus="true"/>
        <input type="password" class="login-input" name="password" placeholder="Password"/>
        <a href="loginpage.html" type="submit" value="Login" style="font-size:20px" name="submit" class="login-button">Login</a>/>
        <br><br><br>
        &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
        &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
        &nbsp &nbsp &nbsp &nbsp &nbsp 
        <a href="registration.php">New Registration</a> &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
        <a href="index.html">Back to home</a>
  </form>
<?php
    
?>
</body>
</html>