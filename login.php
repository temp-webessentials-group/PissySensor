<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve data from the form
    $email = $_POST["email"];
    $password = $_POST["psw"];

    $host = "localhost";
    $username = "db_francci";
    $db_password = "6S#BN%5sfg";
    $dbname = "db_francci";

    // Create a database connection
    $conn = new mysqli($host, $username, $db_password, $dbname);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and execute a query to check if the email exists in the database
    $sql = "SELECT * FROM user_info WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Email found, fetch user information
        $row = $result->fetch_assoc();
        $uid = $row["user_id"];
        $hashedPassword = $row["password"]; // Get the hashed password from the database

        echo $password. "<br>";
        echo $hashedPassword;

        // Verify the entered password against the hashed password
        if ($password == $hashedPassword) {
            // Passwords match, create a cookie with user information
            $fname = $row["first_name"];
            $lname = $row["last_name"];
            $mail = $row["email"];
            $loc = $row["loc"];
            $did = $row["dev_id"];

            $cookie_value = $uid . "|" . $pwd . "|" . $fname . "|" . $lname . "|" . $mail . "|" . $loc . "|" . $did;
            setcookie('my_cookie', $cookie_value, 0);

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
    } else {
        // Email not found, display an alert and provide a button to go back to login.html
        echo "<script>
                alert('Login incorrect');
                window.location.href = 'login.html';
              </script>";
    }

    // Close the database connection
    $conn->close();
} else {
    // If the form is not submitted, display an error message
    echo "<p>Form not submitted</p>";
}
?>
