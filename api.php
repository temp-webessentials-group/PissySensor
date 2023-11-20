<?php
// Get the POST data from the Python script or testing page
$data = json_decode(file_get_contents("php://input"), true);

// Database connection details
$host = "ls-5d65c83575404b171779b0657bc9f2f90f9cf69e.cjvvc5r4aih0.us-east-1.rds.amazonaws.com";
$username = "dbmasteruser";
$password = "{<g]+q6WsOLnzt].e4`Nb#g%[z<8Jnfa";
$dbname = "db_francci";

// Create connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Extract data
$serialNumber = $data['Serial Number'];
$temperature = $data['Temperature °C'];
$pressure = $data['Pressure kPa'];
$humidity = $data['Humidity %'];
$pm1 = $data['PM 1.0 μg/m3'];
$pm25 = $data['PM 2.5 μg/m3'];
$pm10 = $data['PM 10 μg/m3'];
$oxidising = $data['Oxidising Gas ohms'];
$reducing = $data['Reducing Gas ohms'];
$nh3 = $data['NH3 ohms'];
$latitude = $data['Latitude'];
$longitude = $data['Longitude'];

// Set the timezone to GMT-7
date_default_timezone_set('America/Denver');

// Get the current date and time in GMT-7
$currentDateTime = date('Y-m-d H:i:s');

// Separate into $Date and $Time
$Date = date('Y-m-d', strtotime($currentDateTime));
$Time = date('H:i:s', strtotime($currentDateTime));

// Check if $serialNumber exists in 'device_info' table
$query = "SELECT user_info.user_id, device_info.dev_id, user_info.loc
          FROM user_info
          INNER JOIN device_info ON user_info.dev_id = device_info.dev_id
          WHERE device_info.dev_serial = '$serialNumber'";

$result = $conn->query($query);

// Check if the serial number exists and get user_id and dev_id
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $user_id = $row['user_id'];
    $dev_id = $row['dev_id'];
	$loc = $row['loc'];

    // Insert data into the 'testapi' table, including the current date and time
//    $sql = "INSERT INTO testapi (index1, index2, index3, index4, index5, index6, index7, index8, index9, index10, index11, index12, index13, index14, index15, index16)
//            VALUES ('$serialNumber', '$temperature', '$pressure', '$humidity', '$pm1', '$pm25', '$pm10', '$oxidising', '$reducing', '$nh3', '$latitude', '$longitude', '$user_id', '$dev_id', '$loc','$currentDateTime')";
        
    $sql = "INSERT INTO ward{$loc}_record (index1, index2, index3, index4, index5, index6, index7, index8, index9, index10, index11, index12, index13, index14, index15, index16)
            VALUES ('$serialNumber', '$temperature', '$pressure', '$humidity', '$pm1', '$pm25', '$pm10', '$oxidising', '$reducing', '$nh3', '$latitude', '$longitude', '$user_id', '$dev_id', '$Date', '$Time')";


    if ($conn->query($sql) === TRUE) {
        echo "Data inserted successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    echo "Error: Serial Number not found in device_info";
}

// Close the database connection
$conn->close();
?>
