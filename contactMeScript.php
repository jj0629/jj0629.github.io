<?php
    // Enable error handling.
    /*
    error_reporting(-1);
    ini_set('display_errors', 'On');
    set_error_handler("var_dump");
    */

    // If there has been a submit request, then run the script to send an email.
    if (isset($_POST["submit"])) {

        $recipient = "justinbn@me.com";

        // Sort out the text of what email this is from.
        if (isset($_POST["fromText"])) {
            $from = sanitize_string($_POST["fromText"]);
        }
        else {
            $from = "Unknown";
        }

        // Sort out the text of what this email's topic is.
        if (isset($_POST["topicText"])) {
            $topic = sanitize_string($_POST["topicText"]);
        }
        else {
            $topic = "None";
        }

        // Sort out the name of the email's sender.
        if (isset($_POST["fNameText"]) || isset($_POST["lNameText"])) {
            // This is a little roundabout, however I wanted to break down the name stirng's concatenation so that I could have an easier time finding any bugs.
            $name = "";
            $name .= sanitize_string($_POST["fNameText"]);
            $name .= " ";
            $name .= sanitize_string($_POST["lNameText"]);
        }
        else {
            $name = "";
        }
        
        // Sort out the main mmessage for the email.
        if (isset($_POST["messageText"])) {
            $message = sanitize_string($_POST["messageText"]);

            // Add the user's entered name to the ending of the message.
            $message .= "\n\n - $name";

            // Add in the from email.
            $message .= "\n\n From: $from";

            // Send the email.
            $sent = mail($recipient, $topic, $message, $topic);

            if ($sent) {
                echo "<p id='echo'> Message sent! <p>";
            }
            else {
                echo "<p id='echo'> Message not sent. <p>";
            }
        
        }
    }

    // Secures strings submitted to this website by trimming any malicious data from them.
    function sanitize_string($string) {
        $string = trim($string);
        $string = strip_tags($string);
        return $string;
    }
?>

<!DOCTYPE html>

<html lang='eng'>

<head>
    <meta charset="UTF-8">
    <title>Justin Neft - Contact</title>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-172091876-1"></script>
    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'UA-172091876-1');
    </script>
</head>
<body>
    
</body>
</html>

