<!------------------------------------------------------------------------------------HTML CODE FOR LOGIN-------------------------------------------------------------------------------->
			
<div id="login">
	<div class="row">
		<form class="col s12" action="" method="post">
			<div class="row">
				<?php if(isset($_POST['login']) && empty($errors[1]) === false){echo $errors[1].'<br>';}
				      if(isset($_POST['login']) && empty($errors[2]) === false){echo $errors[2];} ?>
				<div class="input-field col s12">
					<input id="last_name" type="text" class="validate" name="username1" maxlength="32" value="<?php if(isset($_COOKIE['username'])){echo $_COOKIE['username'];}else if(isset($username)){ echo $username; }?>">
					<label for="last_name">Username*</label>
				</div>
			</div>
			<div class="row">
				<div class="input-field col s12">
					<input id="password" type="password" class="validate" name="password1" maxlength="32" value="<?php if(isset($_COOKIE['username'])){echo $_COOKIE['password'];}else if(isset($password)){ echo $password; }?>">
					<label for="password">Password*</label>
				</div>
			</div>
			<input type="submit" class="btn waves-effect waves-light teal" value="LOGIN" name="login">
			<p>
				&nbsp;&nbsp;
				<input type="checkbox" name="remember_me1" class="filled-in" id="filled-in-box1" checked="checked" value="on"/>
				<label for="filled-in-box1">Remember me</label>
			</p><br>
			<p class="forgot">&nbsp;&nbsp;&nbsp;Forget <a href="recover.php?mode=username"><font color="teal"> username </font></a> or <a href="recover.php?mode=password"><font color="teal"> password </font></a> ?</p>
			<p class="activate">&nbsp;&nbsp;&nbsp;<a href="reactivate.php"><font color="teal">Activate</font></a> your account.</p>
		</form>
	</div>
</div>
	
<!-----------------------------------------------------------------------------------END OF HTML CODE FOR LOGIN-------------------------------------------------------------------------->