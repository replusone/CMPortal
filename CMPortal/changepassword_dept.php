<?php 
include_once 'core/init.php';
dept_protect_page();

if(empty($_POST) === false){
	$required_fields = array('current_password', 'password', 'password_again');
	foreach($_POST as $key => $value){
		if(empty($value) && in_array($key, $required_fields) === true){
			$errors[] = '<font color="red"> &nbsp;&nbsp;&nbsp;Fields marked with asteriks are required.</font>';
			break 1;
		}
	}
	if(md5($_POST['current_password']) === $dept_user_data['password'] && empty($errors) === true){
		if(trim($_POST['password']) !== trim($_POST['password_again'])){
			$errors[] = '<font color="red"> &nbsp;&nbsp;&nbsp;Your new passwords do not match.</font>';
		}else if(strlen($_POST['password']) < 6 || strlen($_POST['password_again']) < 6){
			$errors[] = '<font color="red"> &nbsp;&nbsp;&nbsp;Your new password must be at least 6 characters long.</font>';
		}else if(!preg_match("#[0-9]+#", $_POST['password']) || !preg_match("#[a-z]+#", $_POST['password']) || !preg_match("#[A-Z]+#", $_POST['password']) || !preg_match("#\W+#", $_POST['password'])){
			$errors[] = '<font color="red"> &nbsp;&nbsp;&nbsp;Password must contain at least one lowercase character, one uppercase character, one digit, one symbol.</font>';
		}
	}else if(md5($_POST['current_password']) !== $dept_user_data['password'] && empty($errors) === true){
		$errors[] = '<font color="red"> &nbsp;&nbsp;&nbsp;Your current password is incorrect.</font>';
	}
}
include 'includes/overall/overall_header.php'; ?>
<h1>Change password</h1>
<?php
if(isset($_GET['changed']) && empty($_GET['changed'])){
	echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Your password has been changed successfully';
}else{
	if((isset($_GET['force']) && empty($_GET['force'])) || $dept_user_data['password_recover'] == 1){
		echo '<font color="red"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;You must change your password now in order to complete password recovery</font>';
	}
	if(empty($_POST) === false && empty($errors) === true){
		dept_change_password($session_dept_user_id, $_POST['password']);
		header('Location: changepassword_dept.php?changed');	
		//exit();
	}else if(empty($_POST) === false && empty($errors) === false){
		echo output_errors($errors);
	}
?>
	<form action="" method="post">
		<div class="row">
            <div class="input-field col s3">
			    <i class="material-icons prefix">vpn_key</i>
                <input id="password" type="password" class="validate" name="current_password">
                <label for="password">Current Password*</label>
            </div>
            <div class="input-field col s3">
			    <i class="material-icons prefix">vpn_key</i>
                <input id="password" type="password" class="validate" name="password">
                <label for="password">New Password*</label>
            </div>
            <div class="input-field col s3">
			    <i class="material-icons prefix">vpn_key</i>
                <input id="password" type="password" class="validate" name="password_again">
                <label for="password">Retype New Password*</label>
            </div>
		    <div class="input-field col s3">
		        <input class="btn-large waves-effect waves-light left" type="submit" name="change_password_dept" value="Change Password">
			</div>
		</div>
	</form>
<?php
} ?>

<div class="class_footer">
<?php include 'includes/overall/overall_footer.php'; ?>
</div>

