<?php 
include_once 'core/init.php';
logged_in_redirect();
include 'includes/overall/overall_header.php';
if(isset($_GET['success']) === true && !empty($_GET['success']) === true){
    echo '<h2>Check your email to recover/reset your '.$_GET['success'].'</h2>';
}else{
	$mode_allowed = array('username', 'password');
	if(isset($_GET['mode']) === true && in_array($_GET['mode'], $mode_allowed) === true){
		if(isset($_POST['email']) === true && empty($_POST['email']) === false){
			if(email_exists($_POST['email']) === true){
				recover($_GET['mode'], $_POST['email']);
				header('Location: recover.php?success='.$_GET['mode']);
				exit();
			}else if(dept_email_exists($_POST['email']) === true){
				dept_recover($_GET['mode'], $_POST['email']);
				header('Location: recover.php?success='.$_GET['mode']);
				exit();
			}else{
				$errors[1] = '<font color="red"> Oops! we couldn\'t find this email address.</font>';
			}
		}else if(isset($_POST['email']) === true && empty($_POST['email']) === true){
			$errors[1] = '<font color="red"> *Enter your registered email address</font>';
		}
		?>
		<div class="row">
		    <h1>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Recover <?php if(isset($_GET['mode'])){ echo $_GET['mode']; } ?></h1>
		</div>
		<div class="class_recover">
			<div class="row">
				<form action="" method="post" class="col s12">
					<div class="row">
						<div class="input-field col s12">
							<i class="material-icons prefix">email</i>
							<input id="icon_prefix" type="email" class="validate" name="email">
							<label for="icon_prefix">Please enter your registered email address to verify</label>
							<?php if(isset($errors[1])){ echo $errors[1]; }?>
							<input class="btn waves-effect waves-light" type="submit" name="action" value="RECOVER">
						</div>
					</div>
				</form>
			</div>
		</div>
		<?php
	}else{
		header('Location: index.php');
		exit();
	}
}
?>
<div class="class_footer">
<?php include 'includes/overall/overall_footer.php'; ?>
</div>
