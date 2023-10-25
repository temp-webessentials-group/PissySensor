<?php
// MySQL database configuration
$host = "ls-5d65c83575404b171779b0657bc9f2f90f9cf69e.cjvvc5r4aih0.us-east-1.rds.amazonaws.com";
$username = "dbmasteruser";
$db_password = "{<g]+q6WsOLnzt].e4`Nb#g%[z<8Jnfa";
$dbname = "db_francci";

// Read the JSON data from the request body
$data = file_get_contents('php://input');
$jsonData = json_decode($data, true);

if ($jsonData !== null) {
    // Create a MySQL database connection
    $conn = new mysqli($host, $username, $db_password, $dbname);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Insert the data into the "testapi" table
    $index1 = $jsonData['index1'];
    $index2 = $jsonData['index2'];
    $index3 = $jsonData['index3'];
    $index4 = $jsonData['index4'];
    $index5 = $jsonData['index5'];

    $sql = "INSERT INTO testapi (index1, index2, index3, index4, index5) 
            VALUES ('$index1', '$index2', '$index3', '$index4', '$index5')";

    if ($conn->query($sql) === TRUE) {
        echo "Data inserted successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the database connection
    $conn->close();
} else {
    echo "Invalid JSON data received.";
}
?>
