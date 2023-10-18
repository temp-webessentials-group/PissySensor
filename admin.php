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
								echo '<li><a href="login_new.php">Login</a></li>';
							}
							?>
						</ul>
						
					</nav>

				<!-- Main -->
					<div id="main">

						<!-- Post -->
								<article class="post featured">
								<header class="major">
									<h1>Welcome</h1>
									<h2>Temp Page for Admins</h2>
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
												echo "<p>You are allow to access this page</p>";
												
											}
											else {
												echo "<p>You are NOT ALLOWED to access this page</p>";
											}
										}
											
									?>

									<h2>Reporting</h2>
									<p>graphs and readings will go here: Template image from Enviro Page</p>
									<img src="images/screenshot-darkTheme.jpg" alt="Placeholder" style="width:800px;height:800px;">
										
									<h2>Inventory</h2>
									<button id="toggleButton">View Table</button><br>
									<?php
										$sql = "SELECT * FROM `device_info` ORDER BY `dev_id`";
										$result = $conn->query($sql);
										if ($result->num_rows > 0) {
											echo"<br>";
											echo "<table id='deviceTable' style='display: none;'>";
											echo "<tr><th>Device ID</th><th>Device Serial Number</th></tr>";
												while ($row = $result->fetch_assoc()) {
													echo "<tr>";
													echo "<td>" . $row["dev_id"] . "</td>";
													echo "<td>" . $row["dev_serial"] . "</td>";
													echo "</tr>";
													}
											echo "</table>";
											}											
											else {
												echo "No records found";
											}		
										?>

									<h2>Geolocation Data: </h2>
									<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2507.3766087946556!2d-114.09183072340633!3d51.064597571715964!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x53716f927202bf3f%3A0x16877e49fcc8dbcb!2sStan%20Grad%20Centre!5e0!3m2!1sen!2sca!4v1696447569696!5m2!1sen!2sca" width="400" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>

									</header>

								</article>

									<section class="posts">
										<article>
											<header>
												<h2><a href="#">User Administration</a></h2>
											</header>
											<a href="#"><img src="images/administrator.jpg" alt="" /></a>
									<?php
										$sql = "SELECT COUNT(*) as count FROM user_info";
												$result = $conn->query($sql);
												if ($result) {
													$row = $result->fetch_assoc();
													$rowCount = $row['count'];
													echo"<p> </p><br> ";
													echo"Number of Users: " . $rowCount - 1 . "<br>";
												}												
												else {
													echo "No Users  " . $conn->error;
												}
									?>
									<ul class="actions special">
										<li><a href="useradmin.php" class="button primary">User Portal</a></li>
									</ul>
								</article>
								<article>
									<header>
										<h2><a href="#">Device Management</a></h2>
									</header>
									<a href="#" ><img src="images/air-quality.jpg" alt="" /></a>
									<?php
										$sql = "SELECT COUNT(*) as count FROM device_info";
												$result = $conn->query($sql);
												if ($result) {
													$row = $result->fetch_assoc();
													$rowCount = $row['count'];
													echo"<p> </p><br> ";
													echo"Number of Devices: " . $rowCount - 1 . "<br>";
												}												
												else {
													echo "No Users  " . $conn->error;
												}
									?>
									<ul class="actions special">
										<li><a href="#" class="button primary">Device Management</a></li>
									</ul>
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
				// Hide or show the table when the button is clicked
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