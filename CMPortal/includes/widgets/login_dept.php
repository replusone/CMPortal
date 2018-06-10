
		    <!---------------------------------------------------------------PHP CODE FOR GENERAL------------------------------------------------------------------>

<?php
if(dept_logged_in() === true){
	echo '<center><h1><font color="red">404 ERROR!! <br>PAGE NOT FOUND!</font></h1></center>';
	exit();
}
?>

            <!----------------------------------------------------------------PHP CODE FOR LOGIN-------------------------------------------------------------------->

<?php
if(isset($_POST['login_dept']) === true){
	$username = $_POST['username2'];
	$password = $_POST['password2'];
	
	if(empty($username) === true || empty($password) === true){
		$errors[1] = '<font color="red"> You need to enter username and password</font>';
	}else if(dept_user_exists($username) === false){
		$errors[1] = '<font color="red"> We can\'t find you! Have you registered?</font>';
		$username = '';
	    $password = '';
	}else if(strlen($password) > 32){
			$errors[2] = '<font color="red"> Password too long!</font>';
	        $password = '';
	}else{
		$login = dept_login($username, $password);
		if($login === false){
			$errors[1] = '<font color="red"> Your username/password combination is incorrect!</font>';
			$username = '';
			$password = '';
			echo '<script type="text/javascript">visible(\'popupBoxFourPosition\');</script>';
		}else{
			$_SESSION['dept_user_id'] = $login;
			header('Location: manage.php');
			exit();
		}
	}
if(isset($_POST['login_dept']) && empty($errors) === false){
	echo '<script type="text/javascript">visible(\'popupBoxFourPosition\');</script>';
}}
include_once 'includes/widgets/login_html_dept.php';
?>

