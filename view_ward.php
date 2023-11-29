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
		<title>Administrator Portal</title>
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
      		  padding: 5px; /* Adjust as needed */
			  margin: 0;
    		}
		
			.right-cell {
    		  width: 70%;
    		  max-width: 100%;
    		  overflow: hidden;
    		  vertical-align: top; /* Align the cell content to the top */
  			}

			table.centered {
			width: 70%; /* Adjust the width as needed */
			margin: 0 auto;
			}

			table.centered th {
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
								echo '<li><a href="login.html">Login</a></li>';
							}
							?>
						</ul>
						
					</nav>

				<!-- Main -->
				<div id="main">

<!-- Featured Post -->
				<?php
				// Check if the "my_cookie" cookie is set
				if (isset($_GET['table'])) {
					$selected_table = $_GET['table'];
					

					// Prepare and execute a SELECT statement to fetch all data from the dynamic table.
					$sql = "SELECT * FROM " . $selected_table . " LIMIT 20";
					$result = $conn->query($sql);

					// Check if there are any rows returned.
					if ($result->num_rows > 0) {
						// Start a div container with CSS styles for centering.
    					echo "<div style='text-align: center;'>";
						echo "<h2>Last 20 Readings in '$selected_table':</h2>";
						// Start an HTML table.
						echo "<table class='centered' border='1' style='font-size: 14px;'>";
						echo "<tr><th>Device ID</th><th>Temperature</th><th>Pressure</th><th>Humidity</th><th>PM 1</th><th>PM 2.5</th><th>PM 10</th><th>NH3</th><th>Latitude</th><th>Longitude</th><th>Date</th><th>Time</th></tr>";

						// Output data of each row in an HTML table row.
						while ($row = $result->fetch_assoc()) {
							echo "<tr>";
							echo "<td>" . $row["index1"] . "</td>";
							echo "<td>" . $row["index2"] . "</td>";
							echo "<td>" . $row["index3"] . "</td>";
							echo "<td>" . $row["index4"] . "</td>";
							echo "<td>" . $row["index5"] . "</td>";
							echo "<td>" . $row["index6"] . "</td>";
							echo "<td>" . $row["index7"] . "</td>";
							echo "<td>" . $row["index10"] . "</td>";
							echo "<td>" . $row["index11"] . "</td>";
							echo "<td>" . $row["index12"] . "</td>";
							echo "<td>" . $row["index15"] . "</td>";
							echo "<td>" . $row["index16"] . "</td>";			
							echo "</tr>";
						}

						// Close the HTML table.
						echo "</table>";
						// Close the div container.
    					echo "</div>";
					}
					else {
						echo "No data found in the table.";
					}

					// Close the database connection.
					$conn->close();
				} 
				else {
					// No cookie found, display a message
					echo "<p>You are NOT ALLOW to access this page</p>";
				}

				?>
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