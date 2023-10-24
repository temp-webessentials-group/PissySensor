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
									<h1>Welcome</h1>
								</header>

									
										<?php
										// Check if the "my_cookie" cookie is set
										if (isset($_COOKIE['my_cookie'])) {
											// Get the cookie value and split it into individual values
											$cookieValue = $_COOKIE['my_cookie'];
											$cookieValues = explode('|', $cookieValue);
											$uid = $cookieValues[0];
											$did = $cookieValues[6];


											if ($did > 00000 && $did < 100000){
//												echo "<p>You are allow to access this page</p>";
												
												$sql = "SELECT * FROM user_info join device_info on user_info.dev_id = device_info.dev_id where device_info.dev_id = $did;";
												$result = $conn->query($sql);

												if ($result->num_rows > 0) {
													
													while ($row = $result->fetch_assoc()) {
//														echo "<tr>";
//														echo "<td>" . $row["user_id"] . "</td>";
//														echo "<td>" . $row["password"] . "</td>";
//														echo "<td>" . $row["first_name"] . "</td>";
//														echo "<td>" . $row["last_name"] . "</td>";
//														echo "<td>" . $row["email"] . "</td>";
//														echo "<td>" . $row["loc"] . "</td>";
//														echo "<td>" . $row["dev_id"] . "</td>";
//														echo "<td>" . $row["dev_serial"] . "</td>";
//														echo "</tr>";

								echo '<header>';
									echo '<h2>Hi '.$row["first_name"].', This is your profile page</h2>';
								echo '</header>';

														echo '<form method="post" action="profileupdate_check.php">';
																echo '<input type="hidden" name="uid" value="' .$row["user_id"] . '">';
																echo '<div class="field">';
																	echo '<label for="fname">First Name</label>';
																	echo '<input type="text" name="fname" id="fname" value=' .$row["first_name"] . '>';
																echo '</div>';
																echo '<div class="field">';
																	echo '<label for="lname">Last Name</label>';
																	echo '<input type="text" name="lname" id="lname" value=' .$row["last_name"] . '>';
																echo '</div>';
																echo '<div class="field">';
																	echo '<label for="email">Email</label>';
																	echo '<input type="text" name="email" id="email" value=' .$row["email"] . '>';
																echo '</div>';
																echo '<div class="field">';
																	echo '<label for="loc">Ward</label>';
																	echo '<select name="loc" id="loc">';
																	for ($i = 1; $i <= 14; $i++) {
																		echo '<option value="' . $i . '"';
																		if ($i == $row["loc"]) {
																			echo ' selected';
																			}
																		echo '>' . $i . '</option>';
																	}
																	echo '</select>';
																echo '</div>';
																echo '<div class="field">';
																	echo '<label for="dev_id">Device Serial Number</label>';
																	echo '<input type="text" name="dev_id" id="dev_id" value="' . $row["dev_serial"] . '" readonly style="color: grey;">';
																echo '</div>';																		
																echo '<div class="button-container">';
																echo '</br>';
																echo '<input type="submit" value="Change" style="margin-right: 30px;" />';
																echo '<input type="button" value="Back" onclick="goBack()" />';
																echo '</div>';

														echo '</form>';

														echo '<header>';
															echo '<br>';
															echo '<h2>Password change is here !!!</h2>';
														echo '</header>';

														echo '<form method="post" action="password.php">';
														echo '<label for="old_password">Old Password:</label>';
														echo '<input type="password" name="old_password" id="old_password" required>';
												
														echo '<label for="new_password">New Password (at least 8 characters with ONE digits):</label>';
														echo '<input type="password" name="new_password" id="new_password" required pattern="^(?=.*\d).{8,}$">';
														echo '<!-- pattern="^(?=.*\d).{8,}$" enforces at least 8 characters or digits -->';
												
														echo '<label for="confirm_password">Confirm New Password:</label>';
														echo '<input type="password" name="confirm_password" id="confirm_password" required>';
												
														echo '<div class="button-container">';
														echo '<br>';
														echo '<input type="submit" value="Change Password" style="margin-right: 30px;" />';
														echo '</div>';
														echo '</form>';

													}

												} else {
													echo "No Record";
												}

											}
										} else {
											// No cookie found, display a message
											echo "<p>You are NOT ALLOW to access this page</p>";
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

	</body>
</html>