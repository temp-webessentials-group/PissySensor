<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the results JSON from the POST data
    $resultsJson = $_POST["resultsJson"];

    // Decode the JSON to get the results array
    $results = json_decode($resultsJson, true);

    // Process the results and send an email
    $to = "waifrankie.ha@edu.sait.ca";
    $subject = "Air Quality Alert from SmarkAir";
    
    // Compose the email message based on the results
    $message = "Air quality alert for specified ward(s):\n\n";
    foreach ($results as $result) {
        $message .= "Ward " . $result['ward'] . ": Pm 2.5 = " . $result['index6'] . "\n";
    }

    // Additional headers
    $headers = "From: smarkair@groupalpha.ca";

    // Send the email
    $mailResult = mail($to, $subject, $message, $headers);

    // Output a response based on the email sending result
    if ($mailResult) {
        echo "Email sent successfully!";
    } else {
        echo "Error sending email!";
    }
} else {
    echo "Invalid request method!";
}
?>
