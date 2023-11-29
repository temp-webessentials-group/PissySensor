<?php
$servername = "ls-5d65c83575404b171779b0657bc9f2f90f9cf69e.cjvvc5r4aih0.us-east-1.rds.amazonaws.com";
$username = "dbmasteruser";
$password = "{<g]+q6WsOLnzt].e4`Nb#g%[z<8Jnfa";
$dbname = "db_francci";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize an array to store results
$results = [];

// Loop through tables
for ($i = 1; $i <= 14; $i++) {
    $tableName = "ward" . $i . "_record";
    
    // Query to get the latest record of index 6 from each table
    $query = "SELECT * FROM $tableName ORDER BY index15 DESC, index16 DESC LIMIT 1";
    $result = $conn->query($query);
    
    // Check if the query was successful
    if ($result) {
        // Fetch the row
        $row = $result->fetch_assoc();

        // Check if index6 is larger than 100
        if ($row['index6'] > 100) {
            // Add the result to the array
            $results[] = [
                'ward' => $i,
                'index6' => $row['index6'],
//                'index15' => $row['index15'],
//                'index16' => $row['index16'],
            ];
        }
    } else {
        echo "Error: " . $query . "<br>" . $conn->error;
    }
}

// Close the database connection
$conn->close();

// Print the results
echo "Please be aware that the air quality may have an impact on your health in the specified ward(s):\n <br>";

foreach ($results as $result) {
    echo "Ward " . $result['ward'] . ": Pm 2.5 = " . $result['index6'] . "\n";
    echo "<br>";
}

// Convert the array to a JSON-encoded string
$resultsJson = json_encode($results);

// Redirect to another PHP page with the data
header("Location: http://groupalpha.ca/another_page.php?" . http_build_query(['results' => $resultsJson]));
exit();

?>
