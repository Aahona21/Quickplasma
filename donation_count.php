<?php
@include 'config.php';
session_start();

// Check if user is logged in
if (!isset($_SESSION["username"])) {
    // Redirect user to login page if not logged in
    header("Location: login.php");
    exit();
}

// Database connection parameters
$host = 'localhost';
$dbname = 'db';
$username = 'root';
$password = "";

// Connect to the database
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    // Set PDO to throw exceptions on errors
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

// Function to update user's points
function updateUserPoints($pdo, $userId) {
    // Update points in the database
    $query = "UPDATE donors SET donations = donations + 1 WHERE id = ?";
    $statement = $pdo->prepare($query);
    $statement->execute([$userId]);
}

// Process blood donation
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get user ID from session
    $userId = $_SESSION["user_id"];

    // Update user's points
    updateUserPoints($pdo, $userId);

    // Redirect user to a confirmation page or wherever you want
    header("Location: donation_success.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blood Donation</title>
</head>
<body>
    <h2>Blood Donation</h2>
    <p>Thank you for your willingness to donate blood. Your contribution is greatly appreciated.</p>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <input type="submit" value="Donate Blo