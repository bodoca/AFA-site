<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $receiving_email_address = 'info@agapefinancialadministrators.co.za';

  $to = $receiving_email_address;
  $from_name = strip_tags(trim($_POST["name"]));
  //$from_name = str_replace(array("\r","\n"),array(" "," "),$form_name);
  $from_email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
  $subject = 'Website Message :'.strip_tags(trim($_POST["subject"]));
  $message = trim($_POST["message"]);

	$headers = "MIME-Version: 1.0" . "\r\n";
	$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

	// More headers
	$headers .= 'From: '.$from_email. "\r\n";
  //$headers .= 'Cc: myboss@example.com' . "\r\n";
  
  // Build the email content.
  $email_content = "Name: " . $from_name . "<br>";
  $email_content .= "Email: " . $from_email . "<br>";
  $email_content .= "Message:<br> " . $message . "<br>";

  // Send the email.
  if (mail($to,$subject,$email_content,$headers)) {
    // Set a 200 (okay) response code.
    http_response_code(200);
    echo "Thank You! Your message has been sent.";
  } else {
    // Set a 500 (internal server error) response code.
    http_response_code(500);
    echo "Oops! Something went wrong and we couldn't send your message.";
  }

  
  } else {
  // Not a POST request, set a 403 (forbidden) response code.
  http_response_code(403);
  echo "There was a problem with your submission, please try again.";
  }
  
?>
