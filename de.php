<?php
// Database connection parameters
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'se';

// Create a database connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve content from the database
$sql = "SELECT * FROM login where username like '2%'"; // You can modify the query as needed
$result = $conn->query($sql);

if ($result) {
    $content = "No content found.";
    if ($result->num_rows > 0) {
        $content = ''; // Initialize an empty string for content
        while ($row = $result->fetch_assoc()) {
            // Escape the data to prevent XSS
            $content .= htmlspecialchars($row['username']) . '<br>';
        }
    }
} else {
    $content = "Query failed: " . $conn->error;
}

$conn->close();
?>

<!-- HTML Page to Display Content -->
<!DOCTYPE html>
<html>
<head>
    <title>Content from Database</title>
</head>
<body>
    <h1>Content from Database</h1>
    <p style="color: black;"><?php echo $content; ?></p>
</body>
</html>
