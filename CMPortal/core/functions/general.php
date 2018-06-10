<?php
function send_email($first_name, $last_name, $email, $subject, $body){
	require 'C:\xampp\htdocs\CMPortal\core\functions\PHPMailer-master\PHPMailerAutoload.php';
	$recipientname = $first_name.' '.$last_name;
	$recipientid = $email;
	$sender = 'enquirysquad@gmail.com';
	$mailsubject = $subject;
	$mailbody = $body;
	$mail = new PHPMailer;			
	$mail->isSMTP();                                      // Set mailer to use SMTP
	$mail->Host = 'smtp.gmail.com';                       // Specify main and backup SMTP servers
	$mail->SMTPAuth = true;                               // Enable SMTP authentication
	$mail->Username = 'enquirysquad@gmail.com';           // SMTP username
	$mail->Password = 'enquirysquad69';                   // SMTP password
	$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
	$mail->Port = 587;                                    // TCP port to connect to
    $mail->setFrom($sender, 'EnquirySquad');
	$mail->addAddress($recipientid, $recipientname);      // Add a recipient
	$mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = $mailsubject;
	$mail->Body    = $mailbody;
	$mail->AltBody = 'Your email id doesn\'t support the content of this email';
    if(!$mail->send()) {
		$var1 = 'MAIL SENT';
		$var2 = 'Mailer Error: ' . $mail->ErrorInfo;
	} else {	
		$var1 = 'MAIL NOT SENT';
	}
}

function send_sms($mobile_number, $message_body){
	$print1 = '';
	$print2 = '';
	$mno=$mobile_number;
	$message=$message_body;
	$ch = curl_init();
	$user="saha.sudip.4.9@gmail.com:Zelenics67";
	$receipientno=$mno; 
	$senderID="TEST SMS"; 
	$msgtxt=$message; 
	curl_setopt($ch,CURLOPT_URL,  "http://api.mVaayoo.com/mvaayooapi/MessageCompose");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, "user=$user&senderID=$senderID&receipientno=$receipientno&msgtxt=$msgtxt");
	$buffer = curl_exec($ch);
	if(empty ($buffer))
	{ 
		$print1 = " buffer is empty ";
		$print2 = 'message not sent'; 
	}
	else
	{ 
		$print1 = $buffer;
		$print2 = 'Message sent'; 
	} 
	curl_close($ch);
}

function logged_in_redirect(){
	if(logged_in() === true){
		header('Location: index.php');
		exit();
	}
}

function protect_page(){
	if(logged_in() === false && dept_logged_in() === false){
		header('Location: index.php?status=loggedout');
		exit();
	}
}

function dept_logged_in_redirect(){
	if(dept_logged_in() === true){
		header('Location: index.php');
		exit();
	}
}

function dept_protect_page(){
	if(dept_logged_in() === false){
		header('Location: index.php');
		exit();
	}
}

function admin_protect(){
	global $user_data;
	if($user_data['admin'] == 0){
		header('Location: index.php');
		exit();
	}
}

function sanitize($data){
	return htmlentities(strip_tags(mysql_real_escape_string(trim($data))));
}

function array_sanitize(&$item){
	$item = htmlentities(strip_tags(mysql_real_escape_string(trim($item))));
}

function output_errors($errors){
	/*THIS IS THE ALTERNATIVE FOR BETTER UNDERSTANDING
	$output = array();
	foreach($errors as $error){
		$output[] = '<li>' . $error . '</li>';
	}
	return '<ul>' . implode('', $output) . '</ul>';*/
	return '<ul><li>' . implode('</li><li>', $errors) . '</li></ul>';
}
?>