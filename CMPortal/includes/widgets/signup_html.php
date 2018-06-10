
			<!---------------------------------------------------------------SCRIPT FOR LOADING CITY------------------------------------------------------------------>

<script type="text/javascript">
    <!--
	function loadcity(){
		var city = "<?php if(isset($city)){ echo $city; } ?>";
		if(window.XMLHttpRequest){
			xmlhttp = new XMLHttpRequest();
		}else{
			xmlhttp = new ActiveXObject('Microsoft.XMLHTTP');
		}
		
		xmlhttp.onreadystatechange = function(){
			if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
				document.getElementById('cityname').innerHTML = xmlhttp.responseText;
				$(document).ready(function() {
                $('select').material_select();
                });
			}
		}
		
		
		parameters = 'text='+document.getElementById('state').value+'&text1='+city;
		//parameters = 'text='+val;
		
		xmlhttp.open('POST', 'loadcity.inc.php', true);
		xmlhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
		xmlhttp.send(parameters);
	    
	}
	$(document).ready(function() {
    $('select').material_select();
    });
	$('select').material_select('destroy');
	-->
</script>

<!------------------------------------------------------------------HTML CODE FOR REGISTRATION----------------------------------------------------------------------->
		
<div id="signup">
	<div class="row">
		<form class="col s12" action="" method="post">
			<div class="row">
				<?php if(isset($_POST['signup']) && empty($errors[3]) === false){echo $errors[3].'<br>';}?>
				<?php if(isset($_POST['signup']) && empty($errors[4]) === false){echo $errors[4].'<br>';}?>
				<?php if(isset($_POST['signup']) && empty($errors[5]) === false){echo $errors[5].'<br>';}?>
				<?php if(isset($_POST['signup']) && empty($errors[6]) === false){echo $errors[6].'<br>';}?>
				<?php if(isset($_POST['signup']) && empty($errors[7]) === false){echo $errors[7].'<br>';}?>
				<?php if(isset($_POST['signup']) && empty($errors[8]) === false){echo $errors[8].'<br>';}?>
				<?php if(isset($_POST['signup']) && empty($errors[9]) === false){echo $errors[9].'<br>';}?>
				<?php if(isset($_POST['signup']) && empty($errors[10]) === false){echo $errors[10].'<br>';}?>
				<?php if(isset($_POST['signup']) && empty($errors[11]) === false){echo $errors[11].'<br>';}?>
				<?php if(isset($_POST['signup']) && empty($errors[12]) === false){echo $errors[12].'<br>';}?>
				<?php if(isset($_POST['signup']) && empty($errors[13]) === false){echo $errors[13].'<br>';}?>
				<?php if(isset($_POST['signup']) && empty($errors[14]) === false){echo $errors[14].'<br>';}?>
				<?php if(isset($_POST['signup']) && empty($errors[15]) === false){echo $errors[15].'<br>';}?>
				<?php if(isset($_POST['signup']) && empty($errors[16]) === false){echo $errors[16].'<br>';}?>
				<?php if(isset($_POST['signup']) && empty($errors[17]) === false){echo $errors[17].'<br>';}?>
				<?php if(isset($_POST['signup']) && empty($errors[18]) === false){echo $errors[18].'<br>';}?>
				<?php if(isset($_POST['signup']) && empty($errors[19]) === false){echo $errors[19];}?>
				<?php if(isset($_POST['signup']) && empty($errors[20]) === false){echo $errors[20].'<br>';}?>
				<div class="input-field col s12">
					<input id="last_name" type="text" class="validate" name="username" value="<?php if(isset($username)){ echo $username; }?>" maxlength="32">
					<label for="user_name">Username*</label>
				</div>
			</div>
			<div class="row">
				<div class="input-field col s6">
					<input id="last_name" type="text" class="validate" name="first_name" value="<?php if(isset($first_name)){ echo $first_name; }?>" maxlength="32">
					<label for="first_name">First Name*</label>
				</div>
				<div class="input-field col s6">
					<input id="last_name" type="text" class="validate" name="last_name" value="<?php if(isset($last_name)){ echo $last_name; }?>" maxlength="32">
					<label for="last_name">Last Name*</label>
				</div>
			</div>
			<div class="row">
				<div class="input-field col s12">
					<label>Date of Birth*</label>
					<input type="text" class="datepicker" name="date_of_birth" value="<?php if(isset($date_of_birth)){ echo $date_of_birth; }?>" maxlength="20">
				</div>
			</div>
			<p> 
				<label><font size=3em>&nbsp;&nbsp;&nbsp;Gender*&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font></label>
				<input class="with-gap" type="radio" id="test1" name="gender" value="male" <?php if(isset($gender) && $gender === 'male'){echo 'checked';} ?>/>
				<label for="test1">Male</label>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<input class="with-gap" type="radio" id="test2" name="gender" value="female" <?php if(isset($gender) && $gender === 'female'){echo 'checked';} ?>/>
				<label for="test2">Female</label>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<input class="with-gap" type="radio" id="test3" name="gender" value="other" <?php if(isset($gender) && $gender === 'other'){echo 'checked';} ?>/>
				<label for="test3">Other</label>
			</p>
			<div class="row">
				<div class="input-field col s12">
					<input id="email" type="email" class="validate" name="email" value="<?php if(isset($email)){ echo $email; }?>" maxlength="100">
					<label for="email">Email Address*</label>
				</div>
			</div>
			<div class="row">
				<div class="input-field col s12">
					<input id="tel" type="text" class="validate" name="phone" value="<?php if(isset($phone)){echo $phone;} ?>" maxlength="10">
					<label for="user_name">Phone Number*</label>
				</div>
			</div>
			<div class="row">
				<div class="input-field col s12">
					<input id="last_name" type="text" class="validate" name="address1" value="<?php if(isset($address1)){echo $address1;} ?>" maxlength="35">
					<label for="user_name">Address Line 1</label>
				</div>
			</div>
			<div class="row">
				<div class="input-field col s12">
					<input id="last_name" type="text" class="validate" name="address2" value="<?php if(isset($address2)){echo $address2;} ?>" maxlength="35">
					<label for="user_name">Address Line 2</label>
				</div>
			</div>
			<div class="row">
				<div class="input-field col s12">
					<input id="last_name" type="text" class="validate" name="address3" value="<?php if(isset($address3)){echo $address3;} ?>" maxlength="35">
					<label for="user_name">Address Line 3</label>
				</div>
			</div>
			<div class="row">
				<div class="input-field col s12">
					<input id="last_name" type="text" class="validate" name="pincode" value="<?php if(isset($pincode)){echo $pincode;} ?>" maxlength="6">
					<label for="user_name">Pincode*</label>
				</div>
			</div>
			<div class="row">
				<div class="input-field col s6">
					<label>State*</label>&nbsp;
					<select name="state" id="state" onchange="loadcity();">
						<option value="default" disabled selected>Select State</option>
						<option value="Andhra Pradesh" <?php if(isset($state) && $state === 'Andhra Pradesh'){echo 'selected';} ?>>Andhra Pradesh</option>
						<option value="Arunachal Pradesh" <?php if(isset($state) && $state === 'Arunachal Pradesh'){echo 'selected';} ?>>Arunachal Pradesh</option>
						<option value="Assam" <?php if(isset($state) && $state === 'Assam'){echo 'selected';} ?>>Assam</option>
						<option value="Bihar" <?php if(isset($state) && $state === 'Bihar'){echo 'selected';} ?>>Bihar</option>
						<option value="Chhattisgarh" <?php if(isset($state) && $state === 'Chhattisgarh'){echo 'selected';} ?>>Chhattisgarh</option>
						<option value="Goa" <?php if(isset($state) && $state === 'Goa'){echo 'selected';} ?>>Goa</option>
						<option value="Gujarat" <?php if(isset($state) && $state === 'Gujarat'){echo 'selected';} ?>>Gujarat</option>
						<option value="Haryana" <?php if(isset($state) && $state === 'Haryana'){echo 'selected';} ?>>Haryana</option>
						<option value="Himachal Pradesh" <?php if(isset($state) && $state === 'Himachal Pradesh'){echo 'selected';} ?>>Himachal Pradesh</option>
						<option value="Jammu and Kashmir" <?php if(isset($state) && $state === 'Jammu and Kashmir'){echo 'selected';} ?>>Jammu and Kashmir</option>
						<option value="Jharkhand" <?php if(isset($state) && $state === 'Jharkhand'){echo 'selected';} ?>>Jharkhand</option>
						<option value="Karnataka" <?php if(isset($state) && $state === 'Karnataka'){echo 'selected';} ?>>Karnataka</option>
						<option value="Kerala" <?php if(isset($state) && $state === 'Kerala'){echo 'selected';} ?>>Kerala</option>
						<option value="Madhya Pradesh" <?php if(isset($state) && $state === 'Madhya Pradesh'){echo 'selected';} ?>>Madhya Pradesh</option>
						<option value="Maharashtra" <?php if(isset($state) && $state === 'Maharashtra'){echo 'selected';} ?>>Maharashtra</option>
						<option value="Manipur" <?php if(isset($state) && $state === 'Manipur'){echo 'selected';} ?>>Manipur</option>
						<option value="Meghalaya" <?php if(isset($state) && $state === 'Meghalaya'){echo 'selected';} ?>>Meghalaya</option>
						<option value="Mizoram" <?php if(isset($state) && $state === 'Mizoram'){echo 'selected';} ?>>Mizoram</option>
						<option value="Nagaland" <?php if(isset($state) && $state === 'Nagaland'){echo 'selected';} ?>>Nagaland</option>
						<option value="Odisha" <?php if(isset($state) && $state === 'Odisha'){echo 'selected';} ?>>Odisha</option>
						<option value="Punjab" <?php if(isset($state) && $state === 'Punjab'){echo 'selected';} ?>>Punjab</option>
						<option value="Rajasthan" <?php if(isset($state) && $state === 'Rajasthan'){echo 'selected';} ?>>Rajasthan</option>
						<option value="Sikkim" <?php if(isset($state) && $state === 'Sikkim'){echo 'selected';} ?>>Sikkim</option>
						<option value="Tamil Nadu" <?php if(isset($state) && $state === 'Tamil Nadu'){echo 'selected';} ?>>Tamil Nadu</option>
						<option value="Telangana" <?php if(isset($state) && $state === 'Telangana'){echo 'selected';} ?>>Telangana</option>
						<option value="Tripura" <?php if(isset($state) && $state === 'Tripura'){echo 'selected';} ?>>Tripura</option>
						<option value="Uttar Pradesh" <?php if(isset($state) && $state === 'Uttar Pradesh'){echo 'selected';} ?>>Uttar Pradesh</option>
						<option value="Uttarakhand" <?php if(isset($state) && $state === 'Uttarakhand'){echo 'selected';} ?>>Uttarakhand</option>
						<option value="West Bengal" <?php if(isset($state) && $state === 'West Bengal'){echo 'selected';} ?>>West Bengal</option>
					</select>
				</div>
				<div class="input-field col s6" id="cityname">
					<label>City*</label>&nbsp;
					<select name="city" id="city">
						<option value="default" disabled selected>Select City</option>
					</select>
				</div>
			</div>
			<div class="row">
				<div class="input-field col s6">
					<input id="password" type="password" class="validate" name="password">
					<label for="password">Password*</label>
				</div>
				<div class="input-field col s6">
					<input id="password" type="password" class="validate" name="password_again">
					<label for="password">Confirm Password*</label>
				</div>
			</div>
			<div class="row">
				<div class="input-field col s6">
					<img class="captcha" src="includes/widgets/generate.php?code=<?php echo $code;?>"/>
				</div>
				<div class="input-field col s6">
					<input id="last_name" type="text" class="validate" name="captcha">
					<label for="user_name">Write the alpha-numeric code*</label>
				</div>
				<div class="input-field col s6">
					<textarea name="captcha_verify" rows="0" cols="0" id="textarea1" class="materialize-textarea" hidden><?php echo $code;?></textarea>
				</div>
			</div>
			<input type="submit" class="btn waves-effect waves-light teal" value="SIGN UP" name="signup">
			<p>
				&nbsp;&nbsp;
				<input type="checkbox" name="agree_terms" class="filled-in" id="filled-in-box" checked="checked" value="on"/>
				<label for="filled-in-box">I agree to all the <a href="terms.php"><font color="teal">terms and conditions</font></a>.</label>
			</p>
		</form>
	</div>
</div>
	
<!-------------------------------------------------------------------END OF HTML CODE FOR REGISTRATION------------------------------------------------------------->