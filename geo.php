<!DOCTYPE HTML>
<!--
	Massively by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>
		<title>geo Stuff</title>
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
						<a href="index.html" class="logo">Smark Air</a>
					</header>

				<!-- Nav -->
					<nav id="nav">
						<ul class="links">
							<li><a href="index.php">This is Massively</a></li>
							<li class="active"><a href="Registration_new.php">Generic Page</a></li>
							<li><a href="elements.php">Elements Reference</a></li>
						</ul>
						<ul class="icons">
							<li><a href="#" class="icon brands fa-twitter"><span class="label">Twitter</span></a></li>
							<li><a href="#" class="icon brands fa-facebook-f"><span class="label">Facebook</span></a></li>
							<li><a href="#" class="icon brands fa-instagram"><span class="label">Instagram</span></a></li>
							<li><a href="#" class="icon brands fa-github"><span class="label">GitHub</span></a></li>
						</ul>
					</nav>

				<!-- Main -->
					<div id="main">

						<!-- Post -->
							<section class="post">
							<form method="GET">
								<h1 style="display: flex; justify-content: center; align-items: center;">Geodata</h1>
							<div id="map" style="height: 400px;">
								<script>
									function initMap() {
										let calgary = { lat:51.0456739840473,lng: -114.07124046380956};
										let map = new google.maps.Map(
											document.getElementById('map'), {zoom: 11, center: calgary}
										);
										
										<?php
										if (isset($index11) && isset($index12)) {
											?>
										let Depis = new google.maps.LatLng(<?php echo $index11; ?>, <?php echo $index12; ?>);


										let marker = new google.maps.Marker({
											position: Depis,
											map,
											title:"Bepis"
										});
										<?php
									}
									?>
								}
								</script>
							

							<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB344hVEEHLPkEXho59sWiTfxb_fH9d6e0&callback=initMap"></script>
							</div>
							</form>
							</section>

					</div>
				

				<?php

				if ($_SERVER["REQUEST_METHOD"] == "GET") {

				
				//    echo "Last Name: " . $last_name . "<br>";
				//    echo "First Name: " . $first_name . "<br>";
				//    echo "Email: " . $email . "<br>";
				//    echo "Password: " . $pw . "<br>";
				//    echo "Password: " . $cpw . "<br>";   
				//    echo "Device Serial Number: " . $dev_id . "<br>";
				//    echo "City: " . $location . "<br>";
				
				
				
				// Connection to the database
				$servername = "localhost";
				$username = "db_francci";
				$password = "6S#BN%5sfg";
				$dbname = "db_francci";
				
				$connection = mysqli_connect($servername, $username, $password, $dbname);

				$index11 = null;
				$index12 = null;



				if (!$connection) {
    				echo "<h1>There was a problem connecting to the database!</h1>";	
				}
				else{
					$sql = "SELECT * FROM ward1_record ORDER BY index11, index12 LIMIT 1";
					$output = $connection->query($sql);
					if($output->num_rows > 0){

						$row = $output->fetch_assoc();
							$index11 = $row['index11'];
        					$index12 = $row['index12'];
						
					}
				}
				
					
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
							<section>
								<h3>Social</h3>
								<ul class="icons alt">
									<li><a href="#" class="icon brands alt fa-twitter"><span class="label">Twitter</span></a></li>
									<li><a href="#" class="icon brands alt fa-facebook-f"><span class="label">Facebook</span></a></li>
									<li><a href="#" class="icon brands alt fa-instagram"><span class="label">Instagram</span></a></li>
									<li><a href="#" class="icon brands alt fa-github"><span class="label">GitHub</span></a></li>
								</ul>
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