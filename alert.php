<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Form</title>
</head>
<body>

<?php
// Set the data to be sent
$name = 'Alert from SmarkAir';
$email = 'alert@smarkair.com';
$message = 'Testing from SmarkAir';

// Set the URL of your PHP script
$url = 'http://groupalpha.ca/send_email.php';

// Create an associative array with the data
$data = array(
    'name' => $name,
    'email' => $email,
    'message' => $message
);

// Use cURL to make a POST request to the PHP script
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// Execute the cURL request
$response = curl_exec($ch);

// Close cURL session
curl_close($ch);

// Display the response (you can remove this in a production environment)
echo $response;
?>

</body>
</html>
