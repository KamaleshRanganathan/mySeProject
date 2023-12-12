

<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get user input
    $email = $_POST["email"];
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Database connection
    $conn = new mysqli('localhost', 'root', '', 'se');

    // Check if the connection was successful
    if ($conn->connect_error) {
        die('Connection Failed: ' . $conn->connect_error);
    }

    // Check if the username already exists
    $checkUsernameSql = "SELECT * FROM login WHERE username = ?";
    
    if ($stmt = $conn->prepare($checkUsernameSql)) {
        $stmt->bind_param("s", $username); // Bind the username parameter
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // Username already exists
            echo "<script> alert(\"Username already available\");window.location.href=\"sign-in-page.html\"; </script>";
        } else {
            // Username is available; proceed with registration
            $insertSql = "INSERT INTO login (email_id, username, password) VALUES (?, ?, ?)";

            if ($stmt = $conn->prepare($insertSql)) {
                $stmt->bind_param("sss", $email, $username, $password); // Bind the parameters
                if ($stmt->execute()) {
                    echo "<script> alert(\"Successfully Created account\");
                     window.location.href=\"Login-page.html\";</script>";
               
                $stmt->close();

                
            }
        }
        }
    }
    
    // Close the database connection
    $conn->close();
}
?>
