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


		  </style>

	</head>
	<body>

				<!-- Main -->
					<div id="main">

						<!-- Featured Post -->
                                        <?php
										// Check if the "my_cookie" cookie is set
										if (isset($_COOKIE['my_cookie'])) {
											// Get the cookie value and split it into individual values
											$cookieValue = $_COOKIE['my_cookie'];
											$cookieValues = explode('|', $cookieValue);
                                            $did = $cookieValues[6];


											if ($did > 00000 && $did < 100000){
												echo "<p>You are allow to access this page</p>";
											}
										} else {
											// No cookie found, display a message
											echo "<p>You are NOT ALLOW to access this page</p>";
										}
										?>

							<section class="posts">
								<article>
									<header>
										<span class="date">Sept 7,2023</span>
										<h2><a href="#">About Us</a></h2>
									</header>
									<a href="#" class="image fit"><img src="images/pic02.jpg" alt="" /></a>
									<p>Learn about the Smark Air team</p>
									<ul class="actions special">
										<li><a href="#" class="button">Full Story</a></li>
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
										<li><a href="Registration.html" class="button">Registrate Here</a></li>
									</ul>
								</article>
								<article>
									<header>
										<span class="date">April 18, 2017</span>
										<h2><a href="#">Report 1</a></h2>
									</header>
									<a href="#" class="image fit"><img src="images/pic04.jpg" alt="" /></a>
									<p>Donec eget ex magna. Interdum et malesuada fames ac ante ipsum primis in faucibus. Pellentesque venenatis dolor imperdiet dolor mattis sagittis magna etiam.</p>
									<ul class="actions special">
										<li><a href="#" class="button">Full Story</a></li>
									</ul>
								</article>
								<article>
									<header>
										<span class="date">April 14, 2017</span>
										<h2><a href="#">Report 2 </a></h2>
									</header>
									<a href="#" class="image fit"><img src="images/pic05.jpg" alt="" /></a>
									<p>Donec eget ex magna. Interdum et malesuada fames ac ante ipsum primis in faucibus. Pellentesque venenatis dolor imperdiet dolor mattis sagittis magna etiam.</p>
									<ul class="actions special">
										<li><a href="#" class="button">Full Story</a></li>
									</ul>
								</article>
								<article>
									<header>
										<span class="date">April 11, 2017</span>
										<h2><a href="#">Report 3</a></h2>
									</header>
									<a href="#" class="image fit"><img src="images/pic06.jpg" alt="" /></a>
									<p>Donec eget ex magna. Interdum et malesuada fames ac ante ipsum primis in faucibus. Pellentesque venenatis dolor imperdiet dolor mattis sagittis magna etiam.</p>
									<ul class="actions special">
										<li><a href="#" class="button">Full Story</a></li>
									</ul>
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



	</body>
</html>