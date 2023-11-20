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

    if ($did > 00000 && $did < 100000) {
        $tableName = 'ward' . $loc . '_record';

        // Define the number of records per page
        $recordsPerPage = 25;

        // Get the current page number from the query parameter
        $currentPage = isset($_GET['page']) ? intval($_GET['page']) : 1;

        // Calculate the OFFSET for pagination
        $offset = ($currentPage - 1) * $recordsPerPage;

        // Prepare and execute a SELECT statement with LIMIT and OFFSET for pagination
        $sql = "SELECT * FROM $tableName WHERE index14 = $did ORDER BY index15 DESC, index16 DESC LIMIT $recordsPerPage OFFSET $offset";
        $result = $conn->query($sql);

        // Check if there are any rows returned.
        if ($result->num_rows > 0) {
            // Start a div container with CSS styles for centering.
            echo "<div style='text-align: center;'>";
            echo "<H2>Welcome, " . $fname . "</H2>";
            echo "<H3>Here are the records from your device in Ward".$loc."</H3>";
            // Start an HTML table.
            echo "<table class='centered' border='1' style='font-size: 14px;'>";
            echo "<tr><th>Temperature</th><th>Pressure</th><th>Humidity</th><th>PM 1</th><th>PM 2.5</th><th>PM 10</th><th>Oxidising Gas</th><th>Reducing Gas</th><th>NH3</th><th>Latitude</th><th>Longitude</th><th>Date</th><th>Time</th></tr>";

            // Output data of each row in an HTML table row.
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["index2"] . "</td>";
                echo "<td>" . $row["index3"] . "</td>";
                echo "<td>" . $row["index4"] . "</td>";
                echo "<td>" . $row["index5"] . "</td>";
                echo "<td>" . $row["index6"] . "</td>";
                echo "<td>" . $row["index7"] . "</td>";
                echo "<td>" . $row["index8"] . "</td>";
                echo "<td>" . $row["index9"] . "</td>";
                echo "<td>" . $row["index10"] . "</td>";
                echo "<td>" . $row["index11"] . "</td>";
                echo "<td>" . $row["index12"] . "</td>";
                echo "<td>" . $row["index15"] . "</td>";
                echo "<td>" . $row["index16"] . "</td>";			
                echo "</tr>";
            }

            // Close the HTML table.
            echo "</table>";

            // Calculate the total number of pages
//            $sqlCount = "SELECT COUNT(*) as count FROM $tableName";
            $sqlCount = "SELECT COUNT(*) as count FROM $tableName WHERE index14 = $did";
            $resultCount = $conn->query($sqlCount);
            $rowCount = $resultCount->fetch_assoc()['count'];
            $totalPages = ceil($rowCount / $recordsPerPage);

	        // Define $prevPage and $nextPage
		   	$prevPage = $currentPage - 1;
			$nextPage = $currentPage + 1;

            // Add pagination links (Previous, Page Numbers, and Next)
            echo "<div style='text-align: center;'>";
            if ($prevPage > 0) {
                echo "<a href='recordcheck.php?page=$prevPage'>Previous</a> ";
            }
            for ($i = 1; $i <= $totalPages; $i++) {
                if ($i == $currentPage) {
                    echo "<strong>$i</strong> ";
                } else {
                    echo "<a href='recordcheck.php?page=$i'>$i</a> ";
                }
            }
            if ($result->num_rows == $recordsPerPage) {
                echo "<a href='recordcheck.php?page=$nextPage'>Next</a>";
            }
            echo "</div>";

            echo '<div class="button-container">';
            echo "<br>";
            echo '<a href="user.php">Back to Portal Page</a>';
            echo '</div>';
            
			// Close the div container.
			echo "</div>";

        } else {
            echo "No data found in the table.";
        }

        // Close the database connection.
        $conn->close();
    }
} else {
    // No cookie found, display a message
    echo "<p>You are NOT ALLOWED to access this page</p>";
}
?>


    </div>

    <!-- Footer -->
    <footer id="footer">
        <!-- Your footer content goes here -->
    </footer>

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
