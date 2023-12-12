<?php
// Retrieve the data from the request
$data = json_decode(file_get_contents('php://input'), true);

// Access the data
$name = $data['name'];
$eId = $data['eId'];
$content = $data['content'];
$req = 0;
$conn = new mysqli('localhost', 'root', '', 'se');
if ($conn->connect_error) {
    die('Connection Failed: ' . $conn->connect_error);
}
$insertSql = "INSERT INTO feeds (eId,name,content) VALUES ( ?, ?, ?)";


if ($stmt = $conn->prepare($insertSql)) {
    $stmt->bind_param("sss",$eId, $name,$content);
    if ($stmt->execute()) {
    echo "Successfully sent";
    }
    else{
        echo "Failed";
    }
}

// Close the database connection
$conn->close();
?>
