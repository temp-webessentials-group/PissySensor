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
	function populateUserInfoForm() {
    var select = document.getElementById("user_select");
    var form = document.getElementById("edit_form");

    var selectedOption = select.options[select.selectedIndex];
    var userId = selectedOption.value;
    var firstName = selectedOption.getAttribute("data-firstname");
    var lastName = selectedOption.getAttribute("data-lastname");
    var email = selectedOption.getAttribute("data-email");

    form.querySelector("#edit_user_id").value = userId;
    form.querySelector("#edit_first_name").value = firstName;
    form.querySelector("#edit_last_name").value = lastName;
    form.querySelector("#edit_email").value = email;
}
function populatePasswordChangeForm() {
    var passSelect = document.getElementById("pass_select");
    var adminUserIdField = document.getElementById("admin_password_user_id");

    var selectedOption = passSelect.options[passSelect.selectedIndex];
    var selectedUserId = selectedOption.value;

    adminUserIdField.value = selectedUserId;
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
							<li><a href="registration.html">User Registration</a></li>
							<li><a href="elements.html">Documentation</a></li>
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
								$sql = "SELECT * FROM user_info";
								$result = $conn->query($sql);
								if (!$result) {
									die("Error: " . $conn->error);
								}
								?>
							<div>
								<select name="user_id" id="user_select" onchange="populateUserInfoForm()">
									<?php
										while ($row = $result->fetch_assoc()) {
											echo '<option value="' . $row['user_id'] . '" data-firstname="' . $row['first_name'] . '" data-lastname="' . $row['last_name'] . '" data-email="' . $row['email'] . '">' . $row['first_name'] . ' ' . $row['last_name'] . ' </option>';
										}
									?>
								</select>
							</div>
							

								<form method = "post" id="edit_form">
									<input type="hidden" name="user_id" id="edit_user_id">
									<label for="edit_first_name">First Name:</label>
									<input type="text" name="edit_first_name" id="edit_first_name"><br>
									<label for="edit_last_name">Last Name:</label>
									<input type="text" name="edit_last_name" id="edit_last_name"><br>
									<label for="edit_email">Email:</label>
									<input type="email" name="edit_email" id="edit_email"><br>
									
								<!-- Add other user information fields here -->
								<input type="submit" value="Update User Information">
								</form>

							<?php
								$sql = "SELECT * FROM user_info";
								$result = $conn->query($sql);
								if (!$result) {
									die("Error: " . $conn->error);
								}
							?>
								
							<h2> Change User Password Here</h2>
							<h2>Choose a User to edit: </h2>

							<div>
								<select name="user_id" id="pass_select" onchange="populatePasswordChangeForm()">
									<?php
										while ($row = $result->fetch_assoc()) {
											echo '<option value="' . $row['user_id'] . '" data-firstname="' . $row['first_name'] . '" data-lastname="' . $row['last_name'] . '" data-password="' . $row['password'] . '">' . $row['first_name'] . ' ' . $row['last_name'] . ' </option>';
										}
									?>
								</select>

							</div>
							<div id="password_change_section">
								<form method="post" action="adminpassword.php">
								<input type="hidden" name="user_id" id="admin_password_user_id">
								<label for="admin_new_password">New Password:</label>
								<input type="password" name="admin_new_password" id="admin_new_password">
								<input type="submit" name="submit" value="Change User Password">
							</form>

							</div>
								<?php
								if ($_SERVER["REQUEST_METHOD"] == "POST") {
									$user_id = $_POST["user_id"];
										$new_first_name = $_POST["edit_first_name"];
										$new_last_name = $_POST["edit_last_name"];
										$new_email = $_POST["edit_email"];

									// Update user information in the database
									$sql = "UPDATE user_info SET first_name=?, last_name=?, email=? WHERE user_id=?";
									$stmt = $conn->prepare($sql);
									$stmt->bind_param("sssi", $new_first_name, $new_last_name, $new_email, $user_id);

								if ($stmt->execute()) {
									echo "User information updated successfully.";
								} 
								else {
									echo "Error updating user information: " . $stmt->error;
								}

								$stmt->close();
								}

								?>
								



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