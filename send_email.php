<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $message = $_POST["message"];

    // Set the recipient email address
    $to = "waifrankie.ha@edu.sait.ca";

    // Set the subject of the email
    $subject = "Contact Form Submission from $name";

    // Compose the email message
    $message_body = "Name: $name\n";
    $message_body .= "Email: $email\n\n";
    $message_body .= "Message:\n$message";

    // Additional headers
    $headers = "From: $email";

    // Send the email
    if (mail($to, $subject, $message_body, $headers)) {
        // Display a success message
        echo "Your message has been sent successfully. You will be redirect to previous page in 3 seconds.";
    } else {
        echo "Sorry, there was an error sending your message. You will be redirect to previous page in 3 seconds.";
    }
}
?>

<script type="text/javascript">
    setTimeout(function () {
        window.location.href = 'https://smarkair.com';
    }, 3000); // Redirect after 3 seconds (adjust as needed)
</script>

