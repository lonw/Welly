<?php

$to = "admin@lonw.com";
$header = "From: {$to}";
$subject = "Hi!";
$body = "Hi,\n\nHow are you?";
if (mail($to, $subject, $body, $header)) {
echo("<p>Message successfully sent!</p>");
} else {
echo("<p>Message delivery failed...</p>");
}


?>