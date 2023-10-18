<?php
$host = "localhost";
$username = "db_francci";
$password = "6S#BN%5sfg";
$dbname = "db_francci";

// Create a database connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the request is a POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Read the POST data
    $post_data = file_get_contents("php://input");

    // Parse the JSON data
    $data = json_decode($post_data, true);

    if ($data === null) {
        // JSON parsing failed
        http_response_code(400); // Bad Request
        echo json_encode(array("message" => "Invalid JSON data"));
    } else {
        // Data received successfully
        // Access the ammonia and particulate data
        $ammonia = $data['ammonia'];
        $particulate = $data['particulate'];

        // Insert data into the 'testapi' table
        $insert_query = "INSERT INTO testapi (ammonia, particulate) VALUES (?, ?)";
        $stmt = $conn->prepare($insert_query);
        $stmt->bind_param("dd", $ammonia, $particulate);

        if ($stmt->execute()) {
            // Data inserted successfully
            http_response_code(200); // OK
            echo json_encode(array("message" => "Data received and inserted into the database"));
        } else {
            // Error inserting data
            http_response_code(500); // Internal Server Error
            echo json_encode(array("message" => "Error inserting data into the database"));
        }
        
        $stmt->close();
    }
} else {
    // Invalid request method
    http_response_code(405); // Method Not Allowed
    echo json_encode(array("message" => "Method not allowed"));
}

// Close the database connection
$conn->close();
?>
