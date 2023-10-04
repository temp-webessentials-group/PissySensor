<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $last_name = $_POST["last_name"];
    $first_name = $_POST["first_name"];
    $dev_id = $_POST["dev_id"];
    $location = $_POST["location"];
    $psw = $_POST["psw"];
    $confirmpsw = $_POST["confirmpwd"];
    $email = $_POST["email"];



if($psw !== $confirmpsw){
    echo "Passwords do not match!";
    exit;

}


    echo "Last Name: " . $last_name . "<br>";
    echo "First Name: " . $first_name . "<br>";
    echo "Device Serial Number: " . $dev_id . "<br>";
    echo "City: " . $location . "<br>";
    

// Connection to the database
$servername = "localhost";
$username = "db_francci";
$password = "6S#BN%5sfg";
$dbname = "db_francci";

$connection = mysqli_connect($servername, $username, $password, $dbname);

if (!$connection) {
    echo "There was a problem connecting to the database!<br>"; } 
else {

        $sql = "SELECT * FROM device_info WHERE dev_serial='$dev_id'";
        $result = mysqli_query($connection, $sql);
        
        $row = mysqli_fetch_assoc($result);

        $devid = $row['dev_id'];
        echo $devid;

        if (mysqli_num_rows($result) == 0) {
            echo "Your device serial number is incorrect!!!";}
            else {

                $insertdata = "INSERT INTO user_info (first_name, last_name, loc, dev_id, psw, email) VALUES ('$first_name', '$last_name', '$location', '$dev_id', '$psw', '$confirmpsw', '$email')";
                    $result_insertdata = mysqli_query($connection, $insertdata);
                    if(!$result_insertdata)
                    {
                        echo mysqli_error($connection);
                        exit;
                    }
                    // close the connection
                    //mysqli_free_result($result_insertdata); 
                    mysqli_close($connection);
                    echo "<H1>Sales Record is updated</H1>";

            }
    }
}       

?>