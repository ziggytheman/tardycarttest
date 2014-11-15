<?php
  $from    = 'tardycartnhs@gmail.com';
  $to      = 'anthony_hillier@dpsk12.org';

  $subject = 'Test Subject';
  $message = 'Hello. Testing email.';
  $headers =
    'From: ' . $from . "\r\n" .
    'Reply-To: ' . $from . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

  if(mail($to, $subject, $message, $headers))
    echo 'Mail function returned successfully. Mail has probably been sent.';
  else
    echo 'Error! Mail function failed. Mail NOT sent.';
?>