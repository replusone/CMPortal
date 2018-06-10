<style>
	#popupBoxOnePosition{
		top: 0; 
		left: 0; 
		position: fixed; 
		width: 100%; 
		height: 100%;
		background-color: rgba(0,0,0,0.9); 
		display: none; 
		z-index: 1000;
	}
	.popupBoxWrapper{
		 z-index: 1000;
	}
	.popupBoxContent{
		 z-index: 1000;
	}
	.form {
		top: 200px;
	    background: #e6e6e6;/*rgba(19, 35, 47, 0.9)*/
	    padding: 40px;
	    max-width: 400px;
	    margin: 140px auto;
	    border-radius: 4px;
	    box-shadow: 0 4px 10px 4px rgba(19, 35, 47, 0.3);
	}
	#closewindow{
	    float: right;
	    text-decoration: none;
	    color: #ff8080;
	    -webkit-transition: .5s ease;
	    transition: .5s ease;
	    margin-top: -35px;
	    position: relative;
	    left: 7%;
        font-weight: 10;
    }
</style>

<script type="text/javascript">
	<!--
	function toggle_visibility(id) {
		var e = document.getElementById(id);
		if(e.style.display == 'block')
			e.style.display = 'none';
		else
			e.style.display = 'block';
	}
	//-->
</script>

			<!---------------------------------------------------------------SCRIPT FOR LOADING CITY------------------------------------------------------------------>

<script type="text/javascript">
    <!--
	function loadcity(){
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
		
		parameters = 'text='+document.getElementById('state').value;
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
<script>
$(document).ready(function() {
  $("#city").load(loadcity());
})
</script>
<?php 
include 'core/init.php';
protect_page();
include 'includes/overall/overall_header.php'; 

if(isset($_POST['update'])){
	$first_name     = $_POST['first_name'];
	$last_name      = $_POST['last_name'];
	$date_of_birth  = $_POST['date_of_birth'];
	$email          = $_POST['email'];
	$phone          = $_POST['phone'];
	$address1       = $_POST['address1'];
	$address2       = $_POST['address2'];
	$address3       = $_POST['address3'];
	$pincode        = $_POST['pincode'];
	if(isset($_POST['password'])){
	    $password   = $_POST['password'];
	}
	if(isset($_POST['state'])){
		$state      = $_POST['state'];
	}else{
		$state      = '';
	}
	if(isset($_POST['city'])){
		$city       = $_POST['city'];
	}else{
		$city       = '';
	}
	if(isset($_POST['gender']) === true){
		$gender     = $_POST['gender'];
	}
	
	$first_name_length = strlen($first_name);
	$last_name_length  = strlen($last_name);
	$email_length      = strlen($email);
	$phone_length      = strlen($phone);
	$address1_length   = strlen($address1);
	$address2_length   = strlen($address2);
	$address3_length   = strlen($address3);
	$pincode_length    = strlen($pincode);
	
	$required_fields = array('first_name', 'last_name', 'gender', 'date_of_birth', 'email', 'phone', 'state', 'city', 'pincode');
	foreach($_POST as $key => $value){
		if(empty($value) && in_array($key, $required_fields) === true){
			$errors[1] = '<font color="red"> &nbsp;&nbsp;&nbsp;Fields marked with asteriks are required</font>';
			break 1;
		}
	}
	if(empty($errors) === true){
		if($first_name_length > 32){
			$errors[2] = '<font color="red"> Firstname must be less than 33 characters long</font>';
			$first_name='';
		}
		if($last_name_length > 32){
			$errors[3] = '<font color="red"> Lastname must be less than 33 characters long</font>';
			$last_name='';
		}
		if(empty($date_of_birth) === true){
			$errors[4] = '<font color="red"> Please enter your date of birth</font>';
		}
		if(isset($_POST['gender']) === false){
			$errors[5] = '<font color="red"> Please select a gender</font>';
		}
		if(filter_var($email, FILTER_VALIDATE_EMAIL) === false){
			$errors[6] = '<font color="red"> Enter a valid email address</font>';
			$email = '';
		}else if(email_exists($email) === true && $user_data['email'] !== $email){
			$errors[6] = '<font color="red"> Sorry! The email id: \''.$email.'\' is already in use</font>';
		}
		if($phone_length != 10){
			$errors[7] = '<font color="red"> Phone number must be a 10 digit number</font>';
			$phone='';
		}
		if(!preg_match("/^[0-9]*$/",$phone)){
			$errors[7] = '<font color="red"> Invalid phone number</font>';
			$phone = '';	
		}else if(phone_exists($phone) === true && $user_data['phone'] !== $phone){
			$errors[7] = '<font color="red"> Sorry! The phone number: \''.$phone.'\' is already in use</font>';
		}
		if($address1_length > 35){
			$errors[8] = '<font color="red"> Address line 1 must be less than 36 characters long</font>';
			$address1='';
		}
		if($address2_length > 35){
			$errors[9] = '<font color="red"> Address line 2 must be less than 36 characters long</font>';
			$address2='';
		}
		if($address3_length > 35){
			$errors[10] = '<font color="red"> Address line 3 must be less than 36 characters long</font>';
			$address3='';
		}
		if($pincode_length != 6){
			$errors[11] = '<font color="red"> Pincode must be a 6 digit number</font>';
			$pincode='';
		}
		if(!preg_match("/^[0-9]*$/",$pincode)){
			$errors[11] = '<font color="red"> Invalid pincode</font>';
			$pincode = '';	
		}
		if($state === ''){
			$errors[12] = '<font color="red"> Please select a state</font>';
		}
		if($city === ''){
			$errors[13] = '<font color="red"> Please select a city</font>';
		}
		if(empty($_POST['password']) === true){
			$errors[14] = '<font color="red"> You need to type your current password in order to update your profile</font>';
		}else if(md5($password) !== $user_data['password']){
		    $errors[14] = '<font color="red"> You typed the wrong password. Try again!</font>';
		}
		
	}
}
?>
<h2>Update Profile</h2>
<?php
if(isset($_GET['updated']) === true && empty($_GET['updated']) === true){
	echo '&nbsp;&nbsp;&nbsp;Your profile has been updated successfully.<br><br><br><br><br><br><br><br><br><br><br>';
}else{
	if(empty($_POST) === false && empty($errors) === true){
		$date_of_birth = format_date($date_of_birth);
		$update_data = array(
			'first_name'    => $first_name,
			'last_name'     => $last_name,
			'gender'        => $gender,
			'date_of_birth' => $date_of_birth,
			'email'         => $email,
			'phone'         => $phone,
			'address1'      => $address1,
			'address2'      => $address2,
			'address3'      => $address3,
			'state'         => $state,
			'city'          => $city,
			'pincode'       => $pincode
		);
		
		update_user($session_user_id, $update_data);
		header('Location: updateprofile.php?updated');
		exit();
	}else if(empty($_POST) === false && empty($errors[1]) === false){
		echo $errors[1];
	} 
	?>
    
	<form action="" method="post" class="col s10">
	    <div class="row">
            <div class="input-field col s5">
                <input id="first_name" type="text" class="validate" name="first_name" value="<?php echo $user_data['first_name']; ?>" maxlength="32"><?php if(isset($errors[2])){ echo $errors[2]; }?>
                <label for="first_name">First Name*</label>
            </div>
			<div class="input-field col s5">
                <input id="last_name" type="text" class="validate" name="last_name" value="<?php echo $user_data['last_name']; ?>"  maxlength="32"><?php if(isset($errors[3])){ echo $errors[3]; }?>
                <label for="last_name">Last Name*</label>
            </div>
        </div>
		<div class="row">
		    <div class="input-field col s5">
			    <input type="text" class="datepicker" name="date_of_birth" value="<?php echo format_date_revert($user_data['date_of_birth']); ?>" maxlength="20"/><?php if(isset($errors[4])){ echo $errors[4]; }?>
		        <label for="last_name">Date of Birth*</label>
			</div>
			<p>
				<label><font size=3em>&nbsp;&nbsp;&nbsp;Gender*&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font></label>
				<input class="with-gap" type="radio" id="test1" name="gender" value="male" <?php if($user_data['gender'] === 'male'){echo 'checked';}?>/>
				<label for="test1">Male</label>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<input class="with-gap" type="radio" id="test2" name="gender" value="female"  <?php if($user_data['gender'] === 'female'){echo 'checked';}?>/>
				<label for="test2">Female</label>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<input class="with-gap" type="radio" id="test3" name="gender" value="other" <?php if($user_data['gender'] === 'other'){echo 'checked';}?>/>
				<label for="test3">Other</label>
			</p><?php if(isset($errors[5])){ echo $errors[5]; }?>
		</div>
		<div class="row">
            <div class="input-field col s5">
                <input id="email" type="text" class="validate" name="email" value="<?php echo $user_data['email']; ?>" maxlength="100"><?php if(isset($errors[6])){ echo $errors[6]; }?>
                <label for="email">Email Address*</label>
            </div>
			<div class="input-field col s5">
                <input id="phone" type="text" class="validate" name="phone" value="<?php echo $user_data['phone']; ?>" maxlength="10"><?php if(isset($errors[7])){ echo $errors[7]; }?>
                <label for="last_name">Phone Number*</label>
            </div>
        </div>
		<div class="row">
		    <div class="input-field col s5">
                <input id="address1" type="text" name="address1" value="<?php echo $user_data['address1']; ?>" maxlength="35"><?php if(isset($errors[8])){ echo $errors[8]; }?>
                <label for="address1">Address Line 1</label>
            </div>
			<div class="input-field col s5">
                <input id="address2" type="text" name="address2" value="<?php echo $user_data['address2']; ?>" maxlength="35"><?php if(isset($errors[9])){ echo $errors[9]; }?>
                <label for="email">Address Line 2</label>
            </div>
		</div>
		<div class="row">
			<div class="input-field col s5">
                <input id="address3" type="text" name="address3" value="<?php echo $user_data['address3']; ?>" maxlength="35"><?php if(isset($errors[10])){ echo $errors[10]; }?>
                <label for="address3">Address Line 3</label>
            </div>
			<div class="input-field col s5">
                <input id="pincode" type="text" name="pincode" value="<?php echo $user_data['pincode']; ?>" maxlength="6"><?php if(isset($errors[11])){ echo $errors[11]; }?>
                <label for="pincode">Pincode*</label>
            </div>
		</div>
		<div class="row">
			<div class="input-field col s5">
			    <label>State*</label>&nbsp;
				<select name="state" id="state" onchange="loadcity();">
				    <option value="default" disabled selected>Select State</option>
				    <option value="Andhra Pradesh" <?php if($user_data['state'] === 'Andhra Pradesh'){echo 'selected';}?>>Andhra Pradesh</option>
				    <option value="Arunachal Pradesh" <?php if($user_data['state'] === 'Arunachal Pradesh'){echo 'selected';}?>>Arunachal Pradesh</option>
				    <option value="Assam" <?php if($user_data['state'] === 'Assam'){echo 'selected';}?>>Assam</option>
				    <option value="Bihar" <?php if($user_data['state'] === 'Bihar'){echo 'selected';}?>>Bihar</option>
					<option value="Chhattisgarh" <?php if($user_data['state'] === 'Chhattisgarh'){echo 'selected';}?>>Chhattisgarh</option>
					<option value="Goa" <?php if($user_data['state'] === 'Goa'){echo 'selected';}?>>Goa</option>
					<option value="Gujarat" <?php if($user_data['state'] === 'Gujarat'){echo 'selected';}?>>Gujarat</option>
					<option value="Haryana" <?php if($user_data['state'] === 'Haryana'){echo 'selected';}?>>Haryana</option>
					<option value="Himachal Pradesh" <?php if($user_data['state'] === 'Himachal Pradesh'){echo 'selected';}?>>Himachal Pradesh</option>
					<option value="Jammu and Kashmir" <?php if($user_data['state'] === 'Jammu and Kashmir'){echo 'selected';}?>>Jammu and Kashmir</option>
					<option value="Jharkhand" <?php if($user_data['state'] === 'Jharkhand'){echo 'selected';}?>>Jharkhand</option>
					<option value="Karnataka" <?php if($user_data['state'] === 'Karnataka'){echo 'selected';}?>>Karnataka</option>
					<option value="Kerala" <?php if($user_data['state'] === 'Kerala'){echo 'selected';}?>>Kerala</option>
					<option value="Madhya Pradesh" <?php if($user_data['state'] === 'Madhya Pradesh'){echo 'selected';}?>>Madhya Pradesh</option>
					<option value="Maharashtra" <?php if($user_data['state'] === 'Maharashtra'){echo 'selected';}?>>Maharashtra</option>
					<option value="Manipur" <?php if($user_data['state'] === 'Manipur'){echo 'selected';}?>>Manipur</option>
					<option value="Meghalaya" <?php if($user_data['state'] === 'Meghalaya'){echo 'selected';}?>>Meghalaya</option>
					<option value="Mizoram" <?php if($user_data['state'] === 'Mizoram'){echo 'selected';}?>>Mizoram</option>
					<option value="Nagaland" <?php if($user_data['state'] === 'Nagaland'){echo 'selected';}?>>Nagaland</option>
					<option value="Odisha" <?php if($user_data['state'] === 'Odisha'){echo 'selected';}?>>Odisha</option>
					<option value="Punjab" <?php if($user_data['state'] === 'Punjab'){echo 'selected';}?>>Punjab</option>
					<option value="Rajasthan" <?php if($user_data['state'] === 'Rajasthan'){echo 'selected';}?>>Rajasthan</option>
					<option value="Sikkim" <?php if($user_data['state'] === 'Sikkim'){echo 'selected';}?>>Sikkim</option>
					<option value="Tamil Nadu" <?php if($user_data['state'] === 'Tamil Nadu'){echo 'selected';}?>>Tamil Nadu</option>
					<option value="Telangana" <?php if($user_data['state'] === 'Telangana'){echo 'selected';}?>>Telangana</option>
					<option value="Tripura" <?php if($user_data['state'] === 'Tripura'){echo 'selected';}?>>Tripura</option>
					<option value="Uttar Pradesh" <?php if($user_data['state'] === 'Uttar Pradesh'){echo 'selected';}?>>Uttar Pradesh</option>
					<option value="Uttarakhand" <?php if($user_data['state'] === 'Uttarakhand'){echo 'selected';}?>>Uttarakhand</option>
					<option value="West Bengal" <?php if($user_data['state'] === 'West Bengal'){echo 'selected';}?>>West Bengal</option>
				</select><?php if(isset($errors[12])){ echo $errors[12]; }?>
			</div>
			<div class="input-field col s5"><div id="cityname">
			    <select name="city" id="city">
				    <option value="default" disabled selected>Select City</option>\
				</select>
				<label>City*</label></div><?php if(isset($errors[13])){ echo $errors[13]; }?>
			</div>
		</div>
		<div class="row">
		    <div class="input-field col s10">
		        <a class="btn-large teal right" href="javascript:void(0)" onclick=" toggle_visibility('popupBoxOnePosition');">UPDATE PROFILE</a>
			</div>
	    </div>
		<div id="popupBoxOnePosition">
			<div class="popupBoxWrapper">
				<div class="popupBoxContent">
					<div class="form">
						<a href="javascript:void(0)" onclick="toggle_visibility('popupBoxOnePosition');" id="closewindow"><i class="material-icons">close</i></a>
						<div class="row">
							<div class="input-field col s12">
							    <i class="material-icons prefix">vpn_key</i>
								<input id="password" type="password" class="validate" name="password">
								<?php 
								    if(isset($errors[14])){
										echo '<style>#popupBoxOnePosition{ display: block; }</style>';
								        echo $errors[14]; 
									}
								?>
								<label for="password">Current Password*</label>
							</div>
						</div>
						<div class="row">
							<div class="input-field col s12">
								<input class="btn-large" type="submit" name="update" value="UPDATE">
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</form>
	
	<?php
}?>
<div>
<?php include 'includes/overall/overall_footer.php'; ?>
</div>
<script type="text/javascript">
	<!--
	$('.datepicker').pickadate({
	selectMonths: true, // Creates a dropdown to control month
	selectYears: 250 // Creates a dropdown of 15 years to control year
	});
	-->
</script>