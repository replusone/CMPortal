<?php
include_once 'core/init.php';
if(isset($_GET['success']) === true && empty($_GET['success']) === true){
	include 'includes/overall/overall_header.php'
	?>
	<h2>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;You've been registered successfully!</h2>
	<h4>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;An email has been sent to your registered email id.<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Please <a class="teal-text text-lighten-1" href="http://www.gmail.com" target="_self"> check your email </a> to activate your account.</h4>
	<div class="class_footer">
	<?php include 'includes/overall/overall_footer.php'; ?>
	</div>
<?php 
}else{
	header('Location: test.php');
}?>
