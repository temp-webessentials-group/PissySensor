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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $uid = $_POST["uid"];
    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $email = $_POST["email"];
    $loc = $_POST["loc"];
    $dev_id = $_POST["dev_id"];

    // Basic email format validation
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email address. Please enter a valid email address.";
        exit; // Stop further processing if the email is invalid
    }

    // Update the user's profile
    $sql = "UPDATE user_info SET first_name='$fname', last_name='$lname', email='$email', loc='$loc' WHERE user_id='$uid'";

    if ($conn->query($sql) === TRUE) {
        // Clear the cookie by setting its expiration date to the past
        setcookie('my_cookie', '', time() - 3600, '/');
    
        // Output a success message
        echo "Profile updated successfully. Redirecting to login page...";
    
        // Redirect to login.php after 5 seconds
        echo '<script type="text/javascript">
                setTimeout(function () {
                    window.location.href = "login.html";
                }, 5000); // Redirect after 5 seconds
              </script>';
    } else {
        echo "Error updating profile: " . $conn->error;
    }

    // Close the database connection
    $conn->close();
}
?>
