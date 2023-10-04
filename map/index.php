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
						<a href="index.html" class="logo">Smark Air</a>
					</header>

				<!-- Nav -->
					<nav id="nav">
						<ul class="links">
							<li class="active"><a href="index.php">Air Quality</a></li>
							<li><a href="generic.html">User Registration</a></li>
							<li><a href="elements.html">Documentation</a></li>
						</ul>
					</nav>

				<!-- Main -->
					<div id="main">

						<!-- Featured Post -->
							<article class="post featured">
								<header class="major">
									<h2><a href="#">Air Quality in Calgary</a></h2>
									<p>Aenean ornare velit lacus varius enim ullamcorper proin aliquam<br />
									facilisis ante sed etiam magna interdum congue. Lorem ipsum dolor<br />
									amet nullam sed etiam veroeros.</p>
								</header>
								<table>
									<tr>
									  <td class="left-cell">
										<table>
											<tr>
											  <td class="left-cell">
												<table>
													<tr>
														<td>Area</td>
														<td>Quality Index</td>
													</tr>

													<?php
									// An array of table names
									$tables = [
										'ward1_record',
										'ward2_record',
										'ward3_record',
										'ward4_record',
										'ward5_record',
										'ward6_record',
										'ward7_record',
										'ward8_record',
										'ward9_record',
										'ward10_record',
										'ward11_record',
										'ward12_record',
										'ward13_record',
										'ward14_record'
									];

									foreach ($tables as $table) {
										// SQL query to retrieve data from the current table
										$sql = "SELECT * FROM $table ORDER BY date DESC, time DESC LIMIT 1";

										// Execute the query
										$result = $conn->query($sql);

										// Check if any rows were returned
										if ($result->num_rows > 0) {
											// Output data for each row
											while ($row = $result->fetch_assoc()) {
												$index1 = $row["index1"];
												$index2 = $row["index2"];
												$index3 = $row["index3"];
												$index4 = $row["index4"];
												$date = $row["date"];
												$time = $row["time"];

												// Process and display data as needed
												echo "<tr>";
												echo "<td>$table</td>";
												echo "<td><div class='tooltip'>";

												if ($index1 < 51) {
													echo "<p style='color:green; font-weight: bold; text-align: center; margin-bottom: 0.2em;'>Good</p>";
												} else if ($index1 > 50 && $index1 < 81) {
													echo "<p style='color:orange; font-weight: bold; text-align: center; margin-bottom: 0.2em;'>Moderate</p>";
												} else if ($index1 > 80 ){
													echo "<p style='color:red; font-weight: bold; text-align: center; margin-bottom: 0.2em;'>Unhealthy</p>";
												}

												echo "<span class='tooltiptext'>";
												echo "Index 1: $index1<br>";
												echo "Index 2: $index2<br>";
												echo "Index 3: $index3<br>";
												echo "Index 4: $index4<br>";
												echo "</br><span style='font-size: smaller;'>Last Update: )</span>";
												echo "Data: $date<br>";
												echo "Time: $time<br>";
												echo "</span>";
												echo "</div></td></tr>";
											}
										} else {
											echo "No data found in table $table.<br>";
										}
									}

									// Close the database connection
									$conn->close();
									?>
												  </tr>
												</table> 
											  </td>
											</tr>
										  </table>

									  </td>
									  <td class="right-cell"><img src="images/map-min.jpg" alt="" /></td>
									</tr>
								  </table>
								
							</article>

							<section class="posts">
								<article>
									<header>
										<span class="date">Sept. 11, 2023</span>
										<h2><a href="#">About Us</a></h2>
									</header>
									<a href="#" class="image fit"><img src="images/pic02.jpg" alt="" /></a>
									<p>Donec eget ex magna. Interdum et malesuada fames ac ante ipsum primis in faucibus. Pellentesque venenatis dolor imperdiet dolor mattis sagittis magna etiam.</p>
									<ul class="actions special">
										<li><a href="#" class="button">Full Story</a></li>
									</ul>
								</article>
								<article>
									<header>
										<span class="date">April 22, 2017</span>
										<h2><a href="#">Primis eget<br />
										imperdiet lorem</a></h2>
									</header>
									<a href="#" class="image fit"><img src="images/pic03.jpg" alt="" /></a>
									<p>Donec eget ex magna. Interdum et malesuada fames ac ante ipsum primis in faucibus. Pellentesque venenatis dolor imperdiet dolor mattis sagittis magna etiam.</p>
									<ul class="actions special">
										<li><a href="#" class="button">Full Story</a></li>
									</ul>
								</article>
								<article>
									<header>
										<span class="date">April 18, 2017</span>
										<h2><a href="#">Ante mattis<br />
										interdum dolor</a></h2>
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
										<h2><a href="#">Tempus sed<br />
										nulla imperdiet</a></h2>
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
										<h2><a href="#">Odio magna<br />
										sed consectetur</a></h2>
									</header>
									<a href="#" class="image fit"><img src="images/pic06.jpg" alt="" /></a>
									<p>Donec eget ex magna. Interdum et malesuada fames ac ante ipsum primis in faucibus. Pellentesque venenatis dolor imperdiet dolor mattis sagittis magna etiam.</p>
									<ul class="actions special">
										<li><a href="#" class="button">Full Story</a></li>
									</ul>
								</article>
								<article>
									<header>
										<span class="date">April 7, 2017</span>
										<h2><a href="#">Augue lorem<br />
										primis vestibulum</a></h2>
									</header>
									<a href="#" class="image fit"><img src="images/pic07.jpg" alt="" /></a>
									<p>Donec eget ex magna. Interdum et malesuada fames ac ante ipsum primis in faucibus. Pellentesque venenatis dolor imperdiet dolor mattis sagittis magna etiam.</p>
									<ul class="actions special">
										<li><a href="#" class="button">Full Story</a></li>
									</ul>
								</article>
							</section>

						<!-- Footer -->
							<footer>
								<div class="pagination">
									<!--<a href="#" class="previous">Prev</a>-->
									<a href="#" class="page active">1</a>
									<a href="#" class="page">2</a>
									<a href="#" class="page">3</a>
								</div>
							</footer>

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