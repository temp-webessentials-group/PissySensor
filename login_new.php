<!DOCTYPE HTML>
<!--
	Massively by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>
		<title>Login</title>
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

					<div id="main">
						<!-- Post -->
						<section class="post">
							<header class="major">
								<h1>Login</h1>
								<!-- Add the form element with action attribute -->
								<form method="post" action="login.php" onsubmit="return validateForm()">
									<div>
										<label for="email"><b>Email Address</b></label>
										<input type="text" placeholder="Email" name="email" id="email" required>
					
										<label for="psw"><b>Password</b></label>
										<input type="password" placeholder="Password" name="psw" required>
					
										<br />
										<!-- Change the button type to "submit" -->
										<button type="submit" class="signupbtn">Login</button>
									</div>
								</form>
							</header>
						</section>
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
				function validateForm() {
					var email = document.getElementById("email").value;
					var atposition = email.indexOf("@");
					var dotposition = email.lastIndexOf(".");
			
					if (atposition < 1 || dotposition < atposition + 2 || dotposition + 2 >= email.length) {
						alert("Please enter a valid email address");
						return false;
					}
					return true;
				}
			</script>

	</body>
</html>