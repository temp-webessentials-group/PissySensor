<?php
$host = "ls-5d65c83575404b171779b0657bc9f2f90f9cf69e.cjvvc5r4aih0.us-east-1.rds.amazonaws.com";
$username = "dbmasteruser";
$db_password = "{<g]+q6WsOLnzt].e4`Nb#g%[z<8Jnfa";
$dbname = "db_francci";

// Get email and password from the HTML form (assuming they are posted via a form with name attributes)
$email = $_POST["email"];
$password = $_POST["psw"];

// Create a database connection
$conn = new mysqli($host, $username, $db_password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare and execute a query to check if the email and password match
$sql = "SELECT * FROM user_info WHERE email = ? AND password = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $email, $password);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $fname = $row["first_name"];
    $lname = $row["last_name"];
    $mail = $row["email"];
    $loc = $row["loc"];
    $did = $row["dev_id"];
    // Email and password match
    $cookie_value = $uid . "|" . $password . "|" . $fname . "|" . $lname . "|" . $mail . "|" . $loc . "|" . $did;
    setcookie('my_cookie', $cookie_value, 0);

    echo "Your password is correct.";

    // Check the value of $did and redirect accordingly
    if ($did == "99999") {
        header("Location: admin.php");
    } else {
        header("Location: user.php");
    }    

} else {
    // Passwords do not match, display an alert and provide a button to go back to login.html
    echo "<script>
            alert('Login incorrect');
            window.location.href = 'login.html';
          </script>";
}

// Close the database connection
$conn->close();
?>
