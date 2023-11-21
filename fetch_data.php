<?php
// Include your database connection code here if needed
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

// Initialize the table HTML
$tableHTML = "<table><tr><td class='left-cell'><table><tr><td class='left-cell'><table><tr><td>Area</td><td>Quality Index</td></tr>";

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

$wardNames = [
    'Ward 1',
    'Ward 2',
    'Ward 3',
    'Ward 4',
    'Ward 5',
    'Ward 6',
    'Ward 7',
    'Ward 8',
    'Ward 9',
    'Ward 10',
    'Ward 11',
    'Ward 12',
    'Ward 13',
    'Ward 14'
];

foreach ($tables as $key => $table) {
    // SQL query to retrieve data from the current table
    $sql = "SELECT * FROM $table ORDER BY index15 DESC, index16 DESC LIMIT 1";

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
            $index5 = $row["index5"];
            $index6 = $row["index6"];
            $index7 = $row["index7"];
            $index8 = $row["index8"];
            $index9 = $row["index9"];
            $index10 = $row["index10"];
            $index11 = $row["index11"];
            $index12 = $row["index12"];
            $index13 = $row["index13"];
            $index14 = $row["index14"];
            $index15 = $row["index15"];
            $index16 = $row["index16"];

            // Process and append data to the tableHTML
            $tableHTML .= "<tr>";
            // Add an onclick event to open a new popup window
            $tableHTML .= "<td><a href='javascript:void(0);' onclick=\"openPopup('/chart.php?ward=" . ($key + 1) . "')\">{$wardNames[$key]}</a></td>";
            $tableHTML .= "<td><div class='tooltip'>";

            if ($index6 < 51) {
                $tableHTML .= "<p style='color:green; font-weight: bold; text-align: center; margin-bottom: 0.2em;'>Good</p>";
            } elseif ($index6 > 50 && $index6 < 101) {
                $tableHTML .= "<p style='color:yellow; font-weight: bold; text-align: center; margin-bottom: 0.2em;'>Moderate</p>";
            } elseif ($index6 > 100 && $index6 < 151) {
                $tableHTML .= "<p style='color:orange; font-weight: bold; text-align: center; margin-bottom: 0.2em;'>Unhealthy for Sensitive Groups</p>";
            } elseif ($index6 > 150 && $index6 < 201) {
                $tableHTML .= "<p style='color:red; font-weight: bold; text-align: center; margin-bottom: 0.2em;'>Unhealthy</p>";
            } elseif ($index6 > 200 && $index6 < 301) {
                $tableHTML .= "<p style='color:purple; font-weight: bold; text-align: center; margin-bottom: 0.2em;'>Very Unhealthy</p>";
            } else {
                $tableHTML .= "<p style='color:brown; font-weight: bold; text-align: center; margin-bottom: 0.2em;'>Hazardous</p>";
            }

            $tableHTML .= "<span class='tooltiptext'>";
//            $tableHTML .= "Serial Number: $index1<br>";
            $tableHTML .= "Temperature: $index2<br>";
            $tableHTML .= "Pressure: $index3<br>";
            $tableHTML .= "Humidity: $index4<br>";
            $tableHTML .= "PM 1: $index5<br>";
            $tableHTML .= "PM 2.5: $index6<br>";
            $tableHTML .= "PM 10: $index7<br>";
            $tableHTML .= "Oxidising Gas: $index8<br>";
            $tableHTML .= "Reducing Gas: $index9<br>";
            $tableHTML .= "NH3: $index10<br>";
            $tableHTML .= "Latitude: $index11<br>";
            $tableHTML .= "Longitude: $index12<br>";
            $tableHTML .= "</br><span style='font-size: smaller;'>Last Update: $index15 $index16</span>";
            $tableHTML .= "</span>";
            $tableHTML .= "</div></td></tr>";
        }
    } else {
        $tableHTML .= "No data found in table $table.<br>";
    }
}


// Close the database connection
$conn->close();

// Complete the table HTML
$tableHTML .= "</tr></table></td></tr></table></td><td class='right-cell'><img src='images/map-min.jpg' alt='' /></td></tr></table>";

// Echo the generated HTML
echo $tableHTML;
?>

<script>
function openPopup(url) {
    // Specify the window features (size, position, etc.)
    var features = 'width=1200,height=600,location=no,menubar=no,status=no,toolbar=no,scrollbars=yes';

    // Open a new popup window
    var popupWindow = window.open(url, '_blank', features);
    if (popupWindow) {
        popupWindow.focus();
    }
}
</script>
