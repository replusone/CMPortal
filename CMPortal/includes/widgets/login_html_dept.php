<?php 
logged_in_redirect();
?>
<div class="form">
	<a href="javascript:void(0)" onclick="toggle_visibility('popupBoxFourPosition');" id="closewindow"><i class="material-icons">close</i></a>
	<div>
	    <div>
			<div class="row">
				<form class="col s12" action="" method="post">
					<div class="row">
						<?php if(isset($_POST['login_dept']) && empty($errors[1]) === false){echo $errors[1].'<br>';}
							  if(isset($_POST['login_dept']) && empty($errors[2]) === false){echo $errors[2];} ?>
						<div class="input-field col s12">
							<input id="last_name" type="text" class="validate" name="username2" maxlength="32" value="<?php if(isset($username)){ echo $username; }?>">
							<label for="last_name">Username*</label>
						</div>
					</div>
					<div class="row">
						<div class="input-field col s12">
							<input id="password" type="password" class="validate" name="password2" maxlength="32" value="<?php if(isset($password)){ echo $password; }?>">
							<label for="password">Password*</label>
						</div>
					</div>
					<input type="submit" class="btn waves-effect waves-light teal" value="LOGIN" name="login_dept">
					<p class="forgot">&nbsp;&nbsp;&nbsp;Forget <a href="recover.php?mode=username"><font color="teal"> username </font></a> or <a href="recover.php?mode=password"><font color="teal"> password </font></a> ?</p>
				</form>
			</div>
		</div>
	</div>
</div>
<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
