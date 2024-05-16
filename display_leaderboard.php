<?php
// Connect to the database
$con = mysqli_connect("localhost", "root", "", "db");

// Check connection
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

// Fetch leaderboard
$sql = "SELECT * FROM donors ORDER BY donations DESC";
$result = mysqli_query($con, $sql);

if (mysqli_num_rows($result) > 0) {
    // Start table
    echo "<table border='1'>";
    echo "<tr><th>Name</th><th>Points</th></tr>";
    
    // Output data of each row
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row["name"] . "</td>";
        echo "<td>" . $row["donations"] . "</td>";
        echo "</tr>";
    }
    
    // End table
    echo "</table>";
} else {
    echo "0 results";
}

mysqli_close($con);
?>
