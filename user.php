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
							<li><a href="registration.html">User Registration</a></li>
							<li><a href="elements.html">Documentation</a></li>
							<li><a href="#" onclick="logout()">Logout</a></li>
						</ul>
					</nav>

				<!-- Main -->
				<div id="main">

<!-- Featured Post -->
				<?php
				// Check if the "my_cookie" cookie is set
				if (isset($_COOKIE['my_cookie'])) {
					// Get the cookie value and split it into individual values
					$cookieValue = $_COOKIE['my_cookie'];
					$cookieValues = explode('|', $cookieValue);
					$uid = $cookieValues[0];
					$fname = $cookieValues[2];
					$loc = $cookieValues[5];
					$did = $cookieValues[6];


					if ($did > 00000 && $did < 100000){
					$tableName = 'ward' . $loc . '_record';

					// Prepare and execute a SELECT statement to fetch all data from the dynamic table.
					$sql = "SELECT * FROM $tableName ORDER BY date DESC, time DESC LIMIT 10";
					$result = $conn->query($sql);

					// Check if there are any rows returned.
					if ($result->num_rows > 0) {
						// Start a div container with CSS styles for centering.
    					echo "<div style='text-align: center;'>";
						echo "<H2>Welcome, " . $fname ."</H2>";
						echo "<H3>Here is the last 10 records from your device</H3>";
						// Start an HTML table.
						echo "<table class='centered' border='1' style='font-size: 14px;'>";
						echo "<tr><th>Index 1</th><th>Index 2</th><th>Index 3</th><th>Index 4</th><th>Date</th><th>Time</th></tr>";

						// Output data of each row in an HTML table row.
						while ($row = $result->fetch_assoc()) {
							echo "<tr>";
							echo "<td>" . $row["index1"] . "</td>";
							echo "<td>" . $row["index2"] . "</td>";
							echo "<td>" . $row["index3"] . "</td>";
							echo "<td>" . $row["index4"] . "</td>";
							echo "<td>" . $row["date"] . "</td>";
							echo "<td>" . $row["time"] . "</td>";							
							echo "</tr>";
						}

						// Close the HTML table.
						echo "</table>";
						echo '<a href="recordcheck.php">Click for More</a>';
						// Close the div container.
    					echo "</div>";
					} else {
						echo "No data found in the table.";
					}

					// Close the database connection.
					$conn->close();}
				} else {
					// No cookie found, display a message
					echo "<p>You are NOT ALLOW to access this page</p>";
				}

				?>

					<section class="posts">
						<article>
							<a href="profileupdate.php"><img src="images/my-profile-icon.jpg"></a>
							</ul>
						</article>
						<article>
							<a href="recordcheck.php"><img src="images/airqualityrecord.jpg"></a>
						</article>
						
					</section>
					

				<!-- Footer 
					<footer>
						<div class="pagination">
							<a href="#" class="previous">Prev</a>
							<a href="#" class="page active">1</a>
							<a href="#" class="page">2</a>
							<a href="#" class="page">3</a>
							<a href="#" class="next">Next</a>
						</div>
					</footer>
					//-->
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
						<h3>Team Member</h3>
						<p>Sam Nixon<br/>Curtis Ellenton<br/>Nathon Anderson<br/>Jordan Caraiman<br/>John Narte<br/>Wai Frankie Ha								</p>
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
			document.cookie = "your_cookie_name=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";

			// Redirect the user to index.php
			window.location.href = "index.php";
			}
			</script>

	</body>
</html>