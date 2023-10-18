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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
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

    // Assuming $uid is the user's ID, retrieved from the session or cookie
    $uid = $_COOKIE['my_cookie'];

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
