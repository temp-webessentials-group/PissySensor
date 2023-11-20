<?php
$host = "ls-5d65c83575404b171779b0657bc9f2f90f9cf69e.cjvvc5r4aih0.us-east-1.rds.amazonaws.com";
$username = "dbmasteruser";
$password = "{<g]+q6WsOLnzt].e4`Nb#g%[z<8Jnfa";
$dbname = "db_francci";

// Create a database connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Define an SQL query to retrieve all data from the 'testapi' table
$sql = "SELECT * FROM ward1_record";

// Execute the query
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data in a table format
    echo "<table border='1'>";
    echo "<tr><th>Serial Number</th><th>Temperature</th><th>Pressure</th><th>Humidity</th><th>PM 1</th><th>Pm 2.5</th><th>PM 10</th><th>Oxidising Gas</th><th>Reducing Gas</th><th>NH3</th><th>Latitude</th><th>Longitude</th><th>User ID</th><th>Device ID</th><th>Ward ID</th><th>Date Time</th></tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['index1'] . "</td>";
        echo "<td>" . $row['index2'] . "</td>";
        echo "<td>" . $row['index3'] . "</td>";
        echo "<td>" . $row['index4'] . "</td>";
        echo "<td>" . $row['index5'] . "</td>";
        echo "<td>" . $row['index6'] . "</td>";
        echo "<td>" . $row['index7'] . "</td>";
        echo "<td>" . $row['index8'] . "</td>";
        echo "<td>" . $row['index9'] . "</td>";
        echo "<td>" . $row['index10'] . "</td>";
        echo "<td>" . $row['index11'] . "</td>";
        echo "<td>" . $row['index12'] . "</td>";
        echo "<td>" . $row['index13'] . "</td>";
        echo "<td>" . $row['index14'] . "</td>";
        echo "<td>" . $row['index15'] . "</td>";
        echo "<td>" . $row['index16'] . "</td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "No data found in the 'testapi' table.";
}

// Close the connection
$conn->close();
?>
