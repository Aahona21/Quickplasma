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

// Database connection parameters
$host = 'localhost';
$dbname = 'db';
$username = 'root';
$password = '';

// Connect to the database
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    // Set PDO to throw exceptions on errors
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

// Process registration form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate input data
    $errors = [];

    if (empty($_POST["username"])) {
        $errors[] = "Username is required.";
    } else {
        $username = $_POST["username"];
        // Validate username format (e.g., length, allowed characters)
        if (!preg_match("/^[a-zA-Z0-9_]+$/", $username)) {
            $errors[] = "Invalid username format. Only letters, numbers, and underscores are allowed.";
        }
    }

    if (empty($_POST["email"])) {
        $errors[] = "Email is required.";
    } else {
        $email = $_POST["email"];
        // Validate email format
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Invalid email format.";
        }
    }

    if (empty($_POST["password"])) {
        $errors[] = "Password is required.";
    } else {
        $password = $_POST["password"];
        // Validate password strength (e.g., length, complexity)
        if (strlen($password) < 8) {
            $errors[] = "Password must be at least 8 characters long.";
        }
    }

    // Check for referral code format (optional)
    $referralCode = $_POST["referral_code"];
    if (!empty($referralCode)) {
        // Validate referral code format (e.g., length, allowed characters)
        if (!preg_match("/^[a-zA-Z0-9]+$/", $referralCode)) {
            $errors[] = "Invalid referral code format. Only letters and numbers are allowed.";
        }
    }

    // Check if any errors occurred during validation
    if (!empty($errors)) {
        // Display validation errors to the user
        foreach ($errors as $error) {
            echo "<p>Error: $error</p>";
        }
    } else {
        // Validation passed, proceed with registration process
        
        // Check if referral code is valid
        $isValidReferral = false;
        if (!empty($referralCode)) {
            // Perform validation (e.g., check if referral code exists in database)
            if (isValidReferralCode($pdo, $referralCode)) {
                $isValidReferral = true;
            }
        }

        // Insert user into database
        // You should use prepared statements to prevent SQL injection
        $query = "INSERT INTO users (username, email, password, referral_code) VALUES (?, ?, ?, ?)";
        $statement = $pdo->prepare($query);
        $statement->execute([$username, $email, $password, $isValidReferral ? $referralCode : null]);

        // Redirect user after registration
        header("Location: registration_success.php");
        exit();
    }
}

// Function to validate referral code
function isValidReferralCode($pdo, $referralCode) {
    // Implement your validation logic here (e.g., check if referral code exists in database)
    $query = "SELECT COUNT(*) FROM users WHERE referral_code = ?";
    $statement = $pdo->prepare($query);
    $statement->execute([$referralCode]);
    $count = $statement->fetchColumn();
    return $count > 0;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donor Registration</title>
</head>
<body>
    <h2>Donor Registration</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="username">Username:</label>
        <input type="text" name="username" id="username" required><br><br>
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required><br><br>
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required><br><br>
        <label for="referral_code">Referral Code:</label>
        <input type="text" name="referral_code" id="referral_code"><br><br>
        <input type="submit" value="Register">
    </form>
</body>
</html>
