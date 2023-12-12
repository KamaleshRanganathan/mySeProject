<?php

$conn = new mysqli('localhost', 'root', '', 'se');
// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Define a SQL query to retrieve data from your table
$sql = "SELECT * FROM feeds order by Dno desc limit 50";  // Change 'your_table' to the name of your table

// Execute the SQL query
$result = $conn->query($sql);

// Check if there are rows in the result
if ($result->num_rows > 0) {
    echo "<link rel=\"stylesheet\" href=\"https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css\">
    <style>

            body{
                background-color:lightblue;
            }
            table {
                border-collapse: collapse;
                width: 100%;
            }
            th, td {
                border: 1px solid #000;
                padding: 8px;
                text-align: left;
            }
            th {
                background-color: #0074cc;
                color: #fff;
            }
            </style>";
    echo "<h2 style=\"text-align:center\">Latest feeds</h2>";
    echo "<table border='1' class=\"animate__animated animate__fadeIn\">
            <tr>
                <th>EID</th>
                <th>Name</th>
                <th>Content</th>

            </tr>";

    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row["eId"] . "</td>
                <td>" . $row["name"] . "</td>
                <td>" . $row["content"] . "</td>
              </tr>";
    }

    echo "</table>";
} else {
    echo "No data found.";
}

// Close the database connection
$conn->close();
?>
