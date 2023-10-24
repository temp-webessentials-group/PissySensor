<!DOCTYPE HTML>
<!--
	Massively by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>
		<title>User Portal</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/main.css" />
		<noscript><link rel="stylesheet" href="assets/css/noscript.css" /></noscript>
		<style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        td {
            border: 1px solid black;
            padding: 10px;
            margin: 0;
        }

        .left-cell {
            width: 30%;
            padding: 0;
            vertical-align: top;
        }

        .left-cell table {
            width: 100%;
            border-collapse: collapse;
        }

        .left-cell td {
            padding: 5px;
            margin: 0;
        }

        .right-cell {
            width: 70%;
            max-width: 100%;
            overflow: hidden;
            vertical-align: top;
        }

        table.centered {
            width: 70%;
            margin: 0 auto;
        }

		table.centered th {
			text-align: center;
		}

		.button-container {
			text-align: center;
		}
    </style>
	</head>
	<body class="is-preload">

		<!-- Wrapper -->
			<div id="wrapper">

				<!-- Header -->
					<header id="header">
						<a href="index.php" class="logo">Smark Air</a>
					</header>

					<!-- Nav -->
					<nav id="nav">
						<ul class="links">
							<li><a href="index.php">Air Quality</a></li>
							<li><a href="Registration_new.php">User Registration</a></li>
							<li><a href="elements.php">Documentation</a></li>

							<?php
							if (isset($_COOKIE['my_cookie'])) {

								$cookieValue = $_COOKIE['my_cookie'];
								$cookieValues = explode('|', $cookieValue);
								$did = $cookieValues[6];

								if ($did == "99999") {
									echo '<li class="active"><a href="admin.php">Portal Page</a></li>'; 
								} else {
									echo '<li class="active"><a href="user.php">Portal Page</a></li>'; 
								}
								echo '<li><a href="#" onclick="logout()">Logout</a></li>';
							}
							else{
								echo '<li><a href="login_new.php">Login</a></li>';
							}
							?>
						</ul>
						
					</nav>

				<!-- Main -->
					<div id="main">

						<!-- Post -->
							<section class="post">
								<header class="major">
								</header>

<?php

if (isset($_COOKIE['my_cookie'])) {
    // Decode the cookie value (if it's JSON, for example)
    $cookieData = json_decode($_COOKIE['my_cookie'], true);
    
    // Check if the decoding was successful
    if ($cookieData !== null) {
        // Iterate through and echo the data
        foreach ($cookieData as $key => $value) {
            echo "$key: $value<br>";
        }
    } else {
       // Redirect to profileupdate.php
	   header("Location: profileupdate.php");
	   exit;
    }
} else {
	echo '<div style="text-align:center; margin-top: 50px;"><H2>Please login.</H2></div>';
}


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
    $oldPassword = $_POST["old_password"];
    $newPassword = $_POST["new_password"];
    $confirmPassword = $_POST["confirm_password"];

    // Verify that the new password matches the confirm password
    if ($newPassword != $confirmPassword) {
		echo '<div style="text-align:center; margin-top: 50px;"><H2>New password and confirm password do not match.  Please try again.</H2></div>';
		echo '<div style="text-align:center; margin-top: 50px;"><a href="#" onclick="goBack()">Back</a></div>';
    } else {
        // Sanitize and validate user inputs (e.g., check for length, format, etc.)

        // Use prepared statements for better security
        $sql = "SELECT * FROM user_info WHERE user_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $uid);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if ($row["password"] == $oldPassword) {
                // Update the user's password in the database
                $updateSql = "UPDATE user_info SET password = ? WHERE user_id = ?";
                $updateStmt = $conn->prepare($updateSql);
                $updateStmt->bind_param("ss", $newPassword, $uid);

				if ($updateStmt->execute()) {
					// Display "Password change success" in the middle of the page
					echo '<div style="text-align:center; margin-top: 50px;"><H2>Password change success.</H2><br> You will be redirect to the main page in 5 seconds...</div>';

					// Reset the "my_cookie" using JavaScript
					echo '<script>
							setTimeout(function() {
								document.cookie = "my_cookie=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
								window.location.href = "index.php";
							}, 5000); // 5 seconds
						</script>';
				} else {
					echo '<div style="text-align:center; margin-top: 50px;"><H2>Failed to update the password.</H2></div>';
				}

                $updateStmt->close();
            } else {
				echo '<div style="text-align:center; margin-top: 50px;"><H2>Your old password is incorrect. Please try again.</H2></div>';
				echo '<div style="text-align:center; margin-top: 50px;"><a href="#" onclick="goBack()">Back</a></div>';
            }
        } else {
			echo '<div style="text-align:center; margin-top: 50px;"><H2>No data found in the user_info table.</H2></div>';
        }

        $stmt->close(); // Close the prepared statement
    }
}

// Close the database connection
$conn->close();
?>

</div>

<!-- Footer -->
	<footer id="footer">
		<section>
			<form method="post" action="#">
				<div class="fields">
					<div class="field">
						<label for="name">Name</label>
						<input type="text" name="name" id="name" />
					</div>
					<div class="field">
						<label for="email">Email</label>
						<input type="text" name="email" id="email" />
					</div>
					<div class="field">
						<label for="message">Message</label>
						<textarea name="message" id="message" rows="3"></textarea>
					</div>
				</div>
				<ul class="actions">
					<li><input type="submit" value="Send Message" /></li>
				</ul>
			</form>
		</section>
		<section class="split contact">
			<section class="alt">
				<h3>Address</h3>
				<p>1234 Somewhere Road #87257<br />
				Nashville, TN 00000-0000</p>
			</section>
			<section>
				<h3>Phone</h3>
				<p><a href="#">(000) 000-0000</a></p>
			</section>
			<section>
				<h3>Email</h3>
				<p><a href="#">info@untitled.tld</a></p>
			</section>
		</section>
	</footer>

<!-- Copyright -->
	<div id="copyright">
		<ul><li>&copy; Untitled</li><li>Design: <a href="https://html5up.net">HTML5 UP</a></li></ul>
	</div>

</div>

<!-- Scripts -->
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/jquery.scrollex.min.js"></script>
<script src="assets/js/jquery.scrolly.min.js"></script>
<script src="assets/js/browser.min.js"></script>
<script src="assets/js/breakpoints.min.js"></script>
<script src="assets/js/util.js"></script>
<script src="assets/js/main.js"></script>
<script>
function logout() {
// Delete the cookie by setting its expiration date to the past
document.cookie = "my_cookie=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";

// Redirect the user to index.php
window.location.href = "index.php";
}
</script>
<script>
function goBack() {
// Use the history object to go back one page in the browsing history
window.history.back();
}
</script>

</body>
</html>