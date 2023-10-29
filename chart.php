<!DOCTYPE html>
<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        // Create a data table
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Date');
        data.addColumn('number', 'Average Data');

        <?php
        // Your PHP code for the database query
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

        // Calculate the date 30 days ago from the current date
        $thirtyDaysAgo = date('Y-m-d', strtotime('-30 days'));

        $sql = "SELECT date, AVG(index1) AS average_data
                FROM ward1_record
                WHERE date >= '$thirtyDaysAgo'
                GROUP BY date
                ORDER BY date";

        // Execute the query
        $result = $conn->query($sql);

        // Check if the query was successful
        if ($result === false) {
            die("Query failed: " . $conn->error);
        }

        while ($row = $result->fetch_assoc()) {
            $date = $row['date'];
            $average_data = $row['average_data'];

            // Add the data to the JavaScript data table
            echo "data.addRow(['$date', $average_data]);";
        }

        // Close the database connection
        $conn->close();
        ?>
        
        var options = {
          title: 'The air condition record for the last 30 days',
          hAxis: {title: 'Date',  titleTextStyle: {color: '#333'}},
          vAxis: {minValue: 0}
        };

        var chart = new google.visualization.AreaChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
    </script>
  </head>
  <body>
    <div id="chart_div" style="width: 100%; height: 500px;"></div>
  </body>
</html>
