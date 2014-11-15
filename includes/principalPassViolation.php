<?php
$to      = 'anthony_hillier@dpsk12.org';
$subject = $studentName .' Principal Pass Violation';

$headers = 'From: ziggytheman@gmail.com' . "\r\n" .
    'Reply-To: anthony_hillier@dpsk12.org' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();
	

$message = "";
$message = $studentName .' ' .$sId .' was late on ' .date('Y-m-d') .' at ' .date("H:i:s");
$sendMail = false;

if(!(isEligiblePrincipalPass($dbSelected, $sId) )) {
	$message .= "\r\n\r\n Student was not eligible for Principal Pass";
	$sendMail = true;
} 

if(isInViolation($dbSelected, $sId)) {
	$message .= "\r\n\r\n Student was just issued their 4th tardy";
	$sendMail = true;
}

if($sendMail){
	mail($to, $subject, $message, $headers);
}
?>