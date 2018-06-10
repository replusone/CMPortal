<?php 
include 'core/init.php';
logged_in_redirect();
include 'includes/overall/overall_header.php';

if(isset($_GET['activated']) && empty($_GET['activated'])){
	echo '<h2>&nbsp;&nbsp;&nbsp;your account has been activated.</h2>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Click <a href="index.php?status=loggedout" onclick="visible();"><font color="teal"> here </font></a> to log in.';
}else if(isset($_GET['email'], $_GET['code']) === true){
	$email = trim($_GET['email']);
	$code = trim($_GET['code']);
	
	if(email_exists($email) === false){
		$errors[] = 'Oops, something went wrong & we couldn\'t find the email address!';
	}else if(activate($email, $code) === false){
		$errors[] = 'We have problems activating your account!';
	}
	
	if(empty($errors) === false){
		echo '<h2>Oops!</h2>'.output_errors($errors);
	}else{
		header('Location: activate.php?activated');
		exit();
	}
}else{
	echo '<center><h1>404 ERROR!</h1></center>';
}
?>
<div class="class_footer">
<?php include 'includes/overall/overall_footer.php'; ?>
</div>