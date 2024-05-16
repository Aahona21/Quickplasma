<?php
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
        // Include your database connection file
        include_once 'config.php';

        // Prepare SQL statement to insert donation data into the database
        $sql = "INSERT INTO donors (name, email, phone) 
                VALUES ($name, $email, $phone)";
        
        // Prepare and bind parameters
        $stmt = $con->prepare($sql);
        $stmt->bind_param("sss", $name, $email, $phone);

        // Execute the query
        if ($stmt->execute()) {
            echo "Thank you for your donation!";
        } else {
            echo "Error: " . $stmt->error;
        }

        // Close statement
        $stmt->close();
        // Close database connection
        $con->close();
    }
} else {
    // Redirect back to the donation form if accessed directly
    header("Location: donation_form.html");
    exit();
}

