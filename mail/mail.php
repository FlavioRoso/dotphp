<?php


	$name = $_REQUEST['name'];
	$email = $_REQUEST['email'];
	$subject = $_REQUEST['subject'];
	$message = $_REQUEST['message'];

	$to = "info@lenafit.de";
	$from = "info@lenafit.de";


	$headers = "From: $from";
	$headers = "From: " . $from . "\r\n";
	$headers .= "Reply-To: ". $email . "\r\n";
	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

    $logo = 'https://melodesigner.de/images/logobl.png';
    $link = 'https://lenafit.de';


    ob_start();
    
    require_once("template.php");
 
    $body = ob_get_contents();
    
    ob_end_clean();


	if(mail($to, $subject, $body, $headers)){
		header('Location: http://getfit.melodesigner.de/kontakt');
		exit();
	}else{
		echo('Send mail fail');
	}
?>