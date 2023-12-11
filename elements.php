<!DOCTYPE HTML>
<!--
	Massively by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>
		<title>Documentation - Smark Air</title>
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
								<header>
									<h1>Documentation</h1>
								</header>
								<ul class="fit">
								<br />
								<li><a href="/Documents/Business%20Canvas%20Template.docx">Business Canvas</a></li>
								<li><a href="/Documents/Assignment%20-%20Project%20Plan.docx">Project Plan</a></li>
								<li><a href="/Documents/Gantt.pdf">Gantt Chart</a></li>
								<!-- <li><a href="/Documents/"></a></li>
								<li><a href="/Documents/"></a></li> -->
								<li><a href="/Documents/Smark%20Air%20Capstone%20Presentation.pptx">Final presenation</a></li>
								</ul>


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