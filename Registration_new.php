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
									<h1>USER REGISTRATION</h1>
								</header>
						
                                <!-- Form -->
                                <form method="post" action="Registration.php">
										<label for="email"><b>Email Address</b></label>
										<input type="email" placeholder="Email" name="email" required>
								
										<label for="psw"><b>Password (at least 8 characters with ONE digits)</b></label>
										<input type="password" placeholder="Password" name="psw" id="password" required pattern="^(?=.*\d).{8,}$">
										<input type="password" placeholder="Confirm Password" name="cpsw" id="password" required pattern="^(?=.*\d).{8,}$">

										<label for="name"><b>Name</b></label>
										<input type="Name" placeholder="First Name" name="last_name" required>
										<input type="Name" placeholder="Last Name" name="first_name" required> 

										<label for="serialNumber">Device Serial Number:</label>
										<input type="text" id="serialNumber" name="dev_id">

                                        <label for="location">Ward: <a href="/images/map-min.jpg"><i>(Please click here for the information of Ward)</i></a></label>
                                        <select name="location" id="location" required>
                                            <option value="1">Ward 1</option>
                                            <option value="2">Ward 2</option>
                                            <option value="3">Ward 3</option>
                                            <option value="4">Ward 4</option>
                                            <option value="5">Ward 5</option>
                                            <option value="6">Ward 6</option>
                                            <option value="7">Ward 7</option>
                                            <option value="8">Ward 8</option>
                                            <option value="9">Ward 9</option>
                                            <option value="10">Ward 10</option>
                                            <option value="11">Ward 11</option>
                                            <option value="12">Ward 12</option>
                                            <option value="13">Ward 13</option>
                                            <option value="14">Ward 14</option>
                                        </select>
										<button id="SignUpButton" input type="submit" value="Registration">Sign Up</button>
									</form>
                                    By creating an account you agree to our Terms & Privacy.

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