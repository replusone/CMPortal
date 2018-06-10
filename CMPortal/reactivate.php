<?php 
include_once 'core/init.php';
logged_in_redirect();
include 'includes/overall/overall_header.php';
if(isset($_GET['reactivated']) === true && empty($_GET['reactivated']) === true){
    echo '<h2>An email has been sent to you. Check your email to activate your account</h2>';
}else{ 
	if(isset($_POST['activate'])){
		if(empty($_POST['email']) || empty($_POST['password'])){
			$errors[1] = '<font color="red"> Fields marked with asteriks are required</font>';
		}else{
			$email = $_POST['email'];
			$password = $_POST['password'];
			if(check_activation($email, $password, md5(rand(1,99999) + microtime())) === true){
				header('Location: reactivate.php?reactivated');
				exit();
			}else{
				$errors[1] = '<font color="red"> Wrong email id or password or both.</font>';
			}
		}
	}
?>
		<div class="row">
		    <h1>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Activate your account</h1>
		</div>
		<div class="class_reactivate">
			<div class="row">
				<form action="" method="post" class="col s12">
					<div class="row">
						<?php if(isset($errors[1])){ echo $errors[1]; }?>
					</div>
					<div class="row">
						<div class="input-field col s6">
							<i class="material-icons prefix">email</i>
							<input id="icon_prefix" type="email" class="validate" name="email">
							<label for="icon_prefix">Please enter your registered email address*</label>
						</div>
						<div class="input-field col s6">
							<i class="material-icons prefix">vpn_key</i>
							<input id="icon_prefix" type="password" class="validate" name="password">
							<label for="icon_prefix">Please enter your user account password*</label>
							<input class="btn waves-effect waves-light" type="submit" name="activate" value="ACTIVATE">
						</div>
					</div>
				</form>
			</div>
		</div>
		<?php } ?>
<div class="class_footer">
<?php include 'includes/overall/overall_footer.php'; ?>
</div>
