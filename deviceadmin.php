<?php
$host = "ls-5d65c83575404b171779b0657bc9f2f90f9cf69e.cjvvc5r4aih0.us-east-1.rds.amazonaws.com";
$username = "dbmasteruser";
$db_password = "{<g]+q6WsOLnzt].e4`Nb#g%[z<8Jnfa";
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
		<title>Administrator Portal</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/main.css" />
		<noscript><link rel="stylesheet" href="assets/css/noscript.css" /></noscript>
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
								echo '<li><a href="login.html">Login</a></li>';
							}
							?>
						</ul>
					</nav>

				<!-- Main -->
					<div id="main">

						<!-- Post -->
								<article class="post featured">
								<header class="major">
									<h1>Device Administration</h1>
									
								</header>

									<?php										
										// Check if the "my_cookie" cookie is set
										if (isset($_COOKIE['my_cookie'])) {
											// Get the cookie value and split it into individual values
											$cookieValue = $_COOKIE['my_cookie'];
											$cookieValues = explode('|', $cookieValue);
											$did = $cookieValues[6];

											if ($did == "99999"){
												// Allow access to the page
												echo "<h2>Inventory</h2>";
												$sql = "SELECT d.dev_id, d.dev_serial, 
													CASE 
													WHEN u.dev_id IS NOT NULL THEN 'Registered' 
													ELSE 'Not Registered' 
													END AS registration_status 
													FROM device_info AS d 
													LEFT JOIN user_info AS u 
													ON d.dev_id = u.dev_id 
													ORDER BY d.dev_id";
										$result = $conn->query($sql);

									if ($result->num_rows > 0) {
										echo "<table>";
										echo "<tr><th>Device ID</th><th>Device Serial Number</th><th>Registration Status</th></tr>";
										while ($row = $result->fetch_assoc()) {
											echo "<tr>";
											echo "<td>" . $row["dev_id"] . "</td>";
											echo "<td>" . $row["dev_serial"] . "</td>";
											echo "<td>" . $row["registration_status"] . "</td>";
											echo "</tr>";
										}
										echo "</table>";
										} 
										else {
											echo "No records found";
										}
												
											}
											else {
												echo "<p>You are NOT ALLOWED to access this page</p>";
											}
										}
											
									?>



									</header>

								</article>

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
			<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
			<script>

				$(document).ready(function() {
				 Hide or show the table when the button is clicked
				$("#toggleButton").click(function() {
				$("#deviceTable").toggle();
			});
			});
			function logout() {
			// Delete the cookie by setting its expiration date to the past
			document.cookie = "my_cookie=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";

			// Redirect the user to index.php
			window.location.href = "index.php";
			}
			</script>

	</body>
</html>
