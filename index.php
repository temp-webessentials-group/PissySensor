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
		<title>Smark Air</title>
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

  			.right-cell img {
    		  display: block; /* Remove any potential inline spacing */
    		  width: 100%; /* Make the image fill the cell width */
    		  height: auto; /* Maintain the image's aspect ratio */
  			}

            .tooltip {
                position: relative;
                display: inline-block;
                cursor: pointer;
            }

            .tooltip .tooltiptext {
                visibility: hidden;
                width: 300px;
                background-color: #333;
                color: #fff;
                text-align: center;
                border-radius: 5px;
                padding: 5px;
                position: absolute;
                z-index: 1;
                bottom: 125%;
                left: 50%;
                transform: translateX(-50%);
                opacity: 0;
                transition: opacity 0.3s, visibility 0.3s;
            }

            .tooltip:hover .tooltiptext {
                visibility: visible;
                opacity: 1;
            }
		  </style>

	</head>
	<body class="is-preload">

		<!-- Wrapper -->
			<div id="wrapper" class="fade-in">

				<!-- Intro -->
					<div id="intro">
						<h1>This is<br />
						Smark Air</h1>
						<p>An air quality monitor sensor that is designed to measure various air pollutants in real-time 
							and provide users with accurate and relevant information to ensure the air quality around the user.</p>
						<ul class="actions">
							<li><a href="#header" class="button icon solid solo fa-arrow-down scrolly">Continue</a></li>
						</ul>
					</div>

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

						<!-- Featured Post -->
							<article class="post featured">
								<header class="major">
									<h2>Air Quality in Calgary</h2>
									<p>This is the current air quality found in the city of Calgary.This information is broken </br> 
									down into the city wards </p>
								</header>
						<div id="table-container">

								<!-- The table will be placed here -->
								
						</div>
								
							</article>

							<section class="posts">
								<article>
									<header>
										<span class="date">Sept 7,2023</span>
										<h2><a href="aboutus.php">About Us</a></h2>
									</header>
									<a href="aboutus.php" class="image fit"><img src="images/pic02.jpg" alt="" /></a>
									<p>Learn about the Smark Air team</p>
									<ul class="actions special">
										<li><a href="aboutus.php" class="button">Full Story</a></li>
									</ul>
								</article>
								<article>
									<header>
										<span class="date">Sept 7,2023</span>
										<h2><a href="#">Registration</a></h2>
									</header>
									<a href="#" class="image fit"><img src="images/pic03.jpg" alt="" /></a>
									<p>Registrate here for an account with Smark Air.</p>
									<ul class="actions special">
										<li><a href="Registration_new.php" class="button">Registrate Here</a></li>
									</ul>
								</article>
								<article>
									<header>
										<span class="date">Nov 26 2023</span>
										<h2><a href="#">Documentation</a></h2>
									</header>
									<a href="elements.php" class="image fit"><img src="images/pic04.jpg" alt="" /></a>
									<p>View all the documentation created throughout this course</p>
									<ul class="actions special">
										<li><a href="elements.php" class="button">Documents</a></li>
									</ul>
								</article>
								<article>
									<header>
										<span class="date">Nov 26 2023</span>
										<h2><a href="#">GitHub</a></h2>
									</header>
									<a href="https://github.com/temp-webessentials-group/smarkair" class="image fit"><img src="images/pic05.jpg" alt="" /></a>
									<p>View Our Gitbub Repository for the website and Raspberry Pi</p>
									<ul class="actions special">
										<li><a href="https://github.com/temp-webessentials-group/smarkair" class="button">GitHub</a></li>
									</ul>
								</article>
							</section>

					</div>

				<!-- Footer -->
					<footer id="footer">
						<section>
							<form method="post" action="http://groupalpha.ca/send_email.php">
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
			window.location.href = "https://smarkair.com/index.php";
			}
			</script>

			<script>
				function updateTable() {
					// Make an AJAX request to fetch the latest data from your server-side script
					$.ajax({
						url: 'fetch_data.php', // Replace with the URL of your server-side script
						type: 'GET',
						dataType: 'html',
						success: function (data) {
							// Update the table with the new data
							$('#table-container').html(data);
						},
					});
				}

				// Call the updateTable function every X milliseconds (e.g., 5000ms = 5 seconds)
				setInterval(updateTable, 5000); // Adjust the interval as needed
			</script>

	</body>
</html>