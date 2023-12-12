<?php
// Database connection parameters

$username = $_POST["username"];
$password = $_POST["password"];
// Create a database connection
$conn = new mysqli('localhost','root','','se');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve content from the database
$sql = "SELECT username , password FROM login"; // You can modify the query as needed
$result = $conn->query($sql);

if ($result) {
    $content = "No content found.";
    if ($result->num_rows > 0) {
        
        while ($row = $result->fetch_assoc()) {
            // Escape the data to prevent XSS
            $x= htmlspecialchars($row['username']);
            $y= htmlspecialchars($row['password']);
            echo "<script> alert($x); </script>";
            if($x == $username){
                
                if($y == $password){
                    $content="success";
                    echo "<script> alert(\"Login success\");window.location.href=\"home.html\"; </script>";
                    break;
                }else{
                    $content="failed";
                }
            }else{
                $content="failed";
            }
        }
    }
    if($content=="failed"){
        echo "<script> alert(\"Wrong username or password\");window.location.href=\"login-page.html\"; </script>";
} else {
    $content = "Query failed: " . $conn->error;
}
}
$conn->close();
?>

