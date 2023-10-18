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
<!--									<h1>Welcome</h1>
-->

<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $last_name = $_POST["last_name"];
    $first_name = $_POST["first_name"];
    $email = $_POST["email"];
    $pw = $_POST["psw"];
    $cpw = $_POST["cpsw"];
    $dev_id = $_POST["dev_id"];
    $location = $_POST["location"];

//    echo "Last Name: " . $last_name . "<br>";
//    echo "First Name: " . $first_name . "<br>";
//    echo "Email: " . $email . "<br>";
//    echo "Password: " . $pw . "<br>";
//    echo "Password: " . $cpw . "<br>";   
//    echo "Device Serial Number: " . $dev_id . "<br>";
//    echo "City: " . $location . "<br>";

    if ($pw != $cpw)
    {
        echo "<h1>Your password is not the same.  Please try again.</h1>";
        echo '<button onclick="goBack()">Go Back</button>';
    }
    else
    {


// Connection to the database
$servername = "localhost";
$username = "db_francci";
$password = "6S#BN%5sfg";
$dbname = "db_francci";

$connection = mysqli_connect($servername, $username, $password, $dbname);

if (!$connection) {
    echo "<h1>There was a problem connecting to the database!</h1>";
} 
else {

    $dev_id = mysqli_real_escape_string($connection, $dev_id); // Sanitize input

    $sql = "SELECT * FROM device_info WHERE dev_serial=?";
    $stmt = mysqli_prepare($connection, $sql);
    
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, 's', $dev_id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
    
        if ($row = mysqli_fetch_assoc($result)) {
            $devid = htmlspecialchars($row['dev_id'], ENT_QUOTES, 'UTF-8'); // Encode for safe output
//            echo $devid;

            $sql = "SELECT * FROM user_info WHERE dev_id=?";
            $stmt = mysqli_prepare($connection, $sql);
            
            if ($stmt) {
                mysqli_stmt_bind_param($stmt, 's', $devid);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
            
                if (mysqli_num_rows($result) > 0) {
                    echo "<h1>Your device is registered by someone already. Please check the serial number and try again.</h1>";
                    echo '<button onclick="goBack()">Go Back</button>';
                } else {

                    $insertdata = "INSERT INTO user_info (password, first_name, last_name, email, loc, dev_id) VALUES (?, ?, ?, ?, ?, ?)";
                    $stmt = mysqli_prepare($connection, $insertdata);
                    
                    if ($stmt) {
                        mysqli_stmt_bind_param($stmt, 'ssssss', $pw, $first_name, $last_name, $email, $location, $devid);
                        mysqli_stmt_execute($stmt);

                        // Registration completed
                        echo "<h1>Registration is completed. You will be redirect to main page in 5 seconds...</h1>";

                        // Delay for 5 seconds and then redirect to index.php
                        echo '<meta http-equiv="refresh" content="5;url=index.php">';
                        exit; // Make sure to exit to prevent further execution of the script
                        
                    } else {
                        echo "Error in the SQL statement: " . mysqli_error($connection);
                        exit;
                    }
                    
                    echo '<button onclick="goBack()">Go Back</button>';
                }
            } else {
                echo "<h1>Error in the SQL statement: </h1>" . mysqli_error($connection);
            }


        } else {
            echo "<h1>The serial number that you entered is not valid.  Please confirm the serial number and try again.</h1>";
            echo '<button onclick="goBack()">Go Back</button>';
        }
    } else {
        echo "<h1>Error in the SQL statement: </h1>" . mysqli_error($connection);
    }
    
}

//        if (mysqli_num_rows($result) == 0) {
//            echo "Your device serial number is incorrect!!!";}
//            else {

//                $insertdata = "INSERT INTO user_info (first_name, last_name, loc, dev_id) VALUES ('$first_name', '$last_name', '$location', '$devid')";
//                    $result_insertdata = mysqli_query($connection, $insertdata);
//                    if(!$result_insertdata)
//                    {
//                        echo mysqli_error($connection);
//                        exit;
//                    }
                    // close the connection
                    //mysqli_free_result($result_insertdata); 
//                    mysqli_close($connection);
//                    echo "<H1>Sales Record is updated</H1>";

//            }
    }      
}
?>
</header>
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