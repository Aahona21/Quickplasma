<?php

@include 'config.php';
session_start();
// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    // Validate form data (you can add more validation if needed)
    if (empty($name) || empty($email) || empty($phone)) {
        echo "All fields are required.";
    } else {
        // Connect to your database (replace with your actual database credentials)
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "db";

        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($con->connect_error) {
            die("Connection failed: " . $con->connect_error);
        }

        // Prepare SQL statement to insert donation data into the database
        $sql = "INSERT INTO donors (name, email) 
                VALUES ('$name', '$email')";

        if ($con->query($sql) === TRUE) {
            echo "Thank you for your donation!";
        } else {
            echo "Error: " . $sql . "<br>" . $con->error;
        }

        // Close database connection
        $con->close();
    }
} else {
    // Redirect back to the donation form if accessed directly
    header("Location: donation_form.html");
    exit();
}
