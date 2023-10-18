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

<script>
	function populateForm() {
	var select = document.getElementById("user_select");
	var form = document.getElementById("edit_form");

	var selectedOption = select.options[select.selectedIndex];
	var userId = selectedOption.value;
	var firstName = selectedOption.getAttribute("data-firstname");
	var lastName = selectedOption.getAttribute("data-lastname");
	form.querySelector("#edit_user_id").value = userId;
	form.querySelector("#edit_first_name").value = firstName;
	form.querySelector("#edit_last_name").value = lastName;
	// Populate other user information fields as needed
	}
</script>

<!DOCTYPE HTML>
<!--
	Massively by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>
		<title>User Admin</title>
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
							<section class="post">
								<header class="major">
									<h1>User Reset Portal</h1>
								</header>

								<!-- Text stuff -->
									<h2>Choose a User to edit: </h2>
								<!-- Form -->
								<?php
								

								$sql = "SELECT first_name, last_name FROM user_info";
								$result = $conn->query($sql);
								if (!$result) {
									die("Error: " . $conn->error);
								}
								?>
								
								<select name="user_info" id="user_id" onchange="populateForm()">
									<?php
										while ($row = $result->fetch_assoc()) {
										echo '<option value="' . $row['user_id'] . '" data-firstname="' . $row['first_name'] . '" data-lastname="' . $row['last_name'] . '">' . $row['first_name'] . ' ' . $row['last_name'] . '</option>';
									}
									?>

								</select>

								<form id="edit_form">
									<input type="hidden" name="user_id" id="edit_user_id">
									<label for="edit_first_name">First Name:</label>
									<input type="text" name="edit_first_name" id="edit_first_name"><br>
									<label for="edit_last_name">Last Name:</label>
									<input type="text" name="edit_last_name" id="edit_last_name"><br>
									<label for="edit_email_address">Email Address:</label>
									<input type="email" name="edit_email_address" id="edit_email_address"><br>
								<!-- Add other user information fields here -->
								<input type="submit" value="Update User Information">
								</form>

								<?php
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

	</body>
</html>