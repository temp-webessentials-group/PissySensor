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
?>

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
							<li><a href="Registration.html">User Registration</a></li>
							<li><a href="elements.html">Documentation</a></li>

							<?php
							if (isset($_COOKIE['my_cookie'])) {

								$cookieValue = $_COOKIE['my_cookie'];
								$cookieValues = explode('|', $cookieValue);
                                $uid = $cookieValues[0];
								$did = $cookieValues[6];

								if ($did == "99999") {
									echo '<li class="active"><a href="admin.php">Portal Page</a></li>'; 
								} else {
									echo '<li class="active"><a href="user.php">Portal Page</a></li>'; 
								}
								echo '<li><a href="#" onclick="logout()">Logout</a></li>';
							}
							else{
								echo '<li><a href="login.html">Login</a></li>';
							}
							?>
						</ul>
						
					</nav>

                    				<!-- Main -->
					<div id="main">

                    <!-- Post -->
                        <section class="post">
                            <header class="major">
                                <h1>Change Password</h1>
                            </header>

                                

							<?php

                            			// Check if the "my_cookie" cookie is set
										if (isset($_COOKIE['my_cookie'])) {
											// Get the cookie value and split it into individual values
											$cookieValue = $_COOKIE['my_cookie'];
											$cookieValues = explode('|', $cookieValue);


                                            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                                // Check if the form has been submitted via POST
    
                                                // Retrieve the values from the form fields
                                                $oldPassword = $_POST["old_password"];
                                                $newPassword = $_POST["new_password"];
                                                $confirmPassword = $_POST["confirm_password"];
    
                                                // Check if the "New Password" and "Confirm New Password" fields match
                                                if ($newPassword === $confirmPassword) {
    
                                                    $sql = "SELECT * FROM user_info where user_id = $uid AND password = '$oldPassword';";
    
                                                    $result = $conn->query($sql);
    
                                                    if ($result->num_rows > 0) {
                                                        
                                                        while ($row = $result->fetch_assoc()) {
    
                                                            $sql = "UPDATE `user_info` SET `password` = '$newPassword' WHERE user_id = '$uid'";
    
                                                            // Execute the query
                                                            if ($conn->query($sql) === TRUE) {
                                                                // Clear the cookie by setting its expiration date to the past
                                                                setcookie('my_cookie', '', time() - 3600, '/');
                                                                echo "Password updated successfully. Redirecting to login page in 5 seconds...";
                                                                echo '<script type="text/javascript">
                                                                    setTimeout(function () {
                                                                        window.location.href = "login.html";
                                                                    }, 5000); // 5000 milliseconds = 5 seconds
                                                                </script>';
                                                            } else {
                                                                echo "Error updating password: " . $conn->error;
                                                            }
    
                                                            // Close the database connection
                                                            $conn->close();
                                                        }
                                                    } else {
    
                                                        echo "You old password is incorrect.";
                                                    }
    
                                                    // Passwords match, you can proceed with updating the user's password in the database
    
                                                    // Make sure to securely hash the new password before saving it to the database
                                                    // For example, using password_hash() function
    
                                                    // Then, you can update the password in your database
                                                    // Example: $newHashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
                                                    // Update user's password with $newHashedPassword in the database
    
                                                   // echo "Password has been updated successfully.";
                                                } else {
                                                    // Passwords do not match, handle the error or provide feedback to the user
                                                    echo "New Password and Confirm Password do not match.";
                                                }
                                            }



                                            }
                                        else
                                        {
                                            echo "You are not allow to see this page";
                                        }
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
			<script>
				// JavaScript function to open a new window when the button is clicked
				document.getElementById("openNewWindowButton").addEventListener("click", function() {
					window.open("password.php", "_blank");
				});
			</script>

	</body>
</html>