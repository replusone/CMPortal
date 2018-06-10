
		    <!---------------------------------------------------------------PHP CODE FOR GENERAL------------------------------------------------------------------>

<?php
if(logged_in() === true){
	echo '<center><h1><font color="red">404 ERROR!! <br>PAGE NOT FOUND!</font></h1></center>';
	exit();
}
?>

            <!----------------------------------------------------------------PHP CODE FOR LOGIN-------------------------------------------------------------------->

<?php
if(isset($_POST['login']) === true){
	$username = $_POST['username1'];
	$password = $_POST['password1'];
	
	if(empty($username) === true || empty($password) === true){
		$errors[1] = '<font color="red"> You need to enter username and password</font>';
	}else if(user_exists($username) === false){
		$errors[1] = '<font color="red"> We can\'t find you! Have you registered?</font>';
		$username = '';
	    $password = '';
	}else if(user_active($username) === false){
		$errors[1] = '<font color="red"> You haven\'t activated your account! Activate first.</font>';
	    $username = '';
	    $password = '';
	}else if(strlen($password) > 32){
			$errors[2] = '<font color="red"> Password too long!</font>';
	        $password = '';
	}else{
		$login = login($username, $password);
		if($login === false){
			$errors[1] = '<font color="red"> Your username/password combination is incorrect!</font>';
			$username = '';
			$password = '';
			echo '<script type="text/javascript">visible(\'popupBoxThreePosition\');</script>';
		}else{
			if(isset($_POST['remember_me1']) === false){
				setcookie('username', '');
				setcookie('password', '');
			}else{
				setcookie('username', $username, time()+99999999);
				setcookie('password', $password, time()+99999999);
			}
			$_SESSION['user_id'] = $login;
			header('Location: index.php');
			exit();
		}
	}
if(isset($_POST['login']) && empty($errors) === false){
	echo '<script type="text/javascript">visible(\'popupBoxThreePosition\');</script>';
}}
?>

        <!-------------------------------------------------------------------PHP CODE FOR REGISTRATION--------------------------------------------------------------------->

<?php 
if(isset($_POST['signup'])){
	$username       = $_POST['username'];
	$password       = $_POST['password'];
	$first_name     = $_POST['first_name'];
	$last_name      = $_POST['last_name'];
	$date_of_birth  = $_POST['date_of_birth'];
	$email          = $_POST['email'];
	$phone          = $_POST['phone'];
	$address1       = $_POST['address1'];
	$address2       = $_POST['address2'];
	$address3       = $_POST['address3'];
	$pincode        = $_POST['pincode'];
	$captcha        = $_POST['captcha'];
    $captcha_verify = $_POST['captcha_verify'];
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
	
	$username_length   = strlen($username);
	$password_length   = strlen($password);
	$first_name_length = strlen($first_name);
	$last_name_length  = strlen($last_name);
	$email_length      = strlen($email);
	$phone_length      = strlen($phone);
	$address1_length   = strlen($address1);
	$address2_length   = strlen($address2);
	$address3_length   = strlen($address3);
	$pincode_length    = strlen($pincode);
	$captcha_length    = strlen($captcha);
	
	$required_fields = array('username', 'password', 'password_again', 'first_name', 'last_name', 'date_of_birth', 'gender', 'email', 'phone', 'state', 'city', 'pincode');
	foreach($_POST as $key => $value){
		if(empty($value) && in_array($key, $required_fields) === true){
			$errors[19] = '<font color="red"> Fields marked with asteriks are required</font>';
			break 1;
		}
	}
	if(empty($errors) === true){
		if(empty($captcha) === true){
		    $errors[18] = '<font color="red"> You need to prove that you are human</font>';
	    }else if($captcha != $captcha_verify){
			$errors[18] = '<font color="red"> You\'ve entered the wrong captcha, please try again!</font>';
		}else if(isset($_POST['agree_terms']) === false){
			$errors[20] = '<font color="red"> Please agree to the terms and conditions</font>';
		}
		if($username_length > 32){
			$errors[3] = '<font color="red"> Username must be less than 33 characters long</font>';
			$username = '';
		}
		if(user_exists($username) === true){
			$errors[3] = '<font color="red"> Sorry! The username \''.$_POST['username'].'\' is already taken</font>';
			$username = '';
		}
		if(preg_match("/\\s/", $username) == true){
			$errors[3] = '<font color="red"> Username must not contain any spaces</font>';
			$username = '';
		}
		if($password_length < 6){
			$errors[5] = '<font color="red"> Password must be at least 6 characters long.</font>';
		}
		if(!preg_match("#[0-9]+#", $password) || !preg_match("#[a-z]+#", $password) || !preg_match("#[A-Z]+#", $password) || !preg_match("#\W+#", $password)){
			$errors[5] = '<font color="red"> Password must contain at least one lowercase character, one uppercase character, one digit, one symbol.</font>';
		}
		if($password !== $_POST['password_again']){
			$errors[5] = '<font color="red"> Passwords do not match</font>';
		}
		if($first_name_length > 32){
			$errors[6] = '<font color="red"> Firstname must be less than 33 characters long</font>';
			$first_name='';
		}
		if($last_name_length > 32){
			$errors[7] = '<font color="red"> Lastname must be less than 33 characters long</font>';
			$last_name='';
		}
		if(empty($date_of_birth) === true){
			$errors[8] = '<font color="red"> Please enter your date of birth</font>';
		}
		if(isset($gender) === false){
			$errors[9] = '<font color="red"> Please select a gender</font>';
		}
		if(filter_var($email, FILTER_VALIDATE_EMAIL) === false){
			$errors[10] = '<font color="red"> Enter a valid email address</font>';
			$email = '';
		}
		if(email_exists($email) === true){
			$errors[10] = '<font color="red"> Sorry! The email id: \''.$email.'\' is already registered. Please provide another one!</font>';
			$email = '';
		}
		if($phone_length != 10){
			$errors[11] = '<font color="red"> Phone number must be a 10 digit number</font>';
			$phone='';
		}
		if(!preg_match("/^[0-9]*$/",$phone)){
			$errors[11] = '<font color="red"> Invalid phone number</font>';
			$phone = '';	
		}
		if(phone_exists($phone) === true){
			$errors[11] = '<font color="red"> Sorry! The phone number: \''.$phone.'\' is already registered. Please provide another one!</font>';
			$phone = '';
		}
		if($address1_length > 35){
			$errors[12] = '<font color="red"> Address line 1 must be less than 36 characters long</font>';
			$address1='';
		}
		if($address2_length > 35){
			$errors[13] = '<font color="red"> Address line 2 must be less than 36 characters long</font>';
			$address2='';
		}
		if($address3_length > 35){
			$errors[14] = '<font color="red"> Address line 3 must be less than 36 characters long</font>';
			$address3='';
		}
		if($pincode_length != 6){
			$errors[15] = '<font color="red"> Pincode must be a 6 digit number</font>';
			$pincode='';
		}
		if(!preg_match("/^[0-9]*$/",$pincode)){
			$errors[15] = '<font color="red"> Invalid pincode</font>';
			$pincode = '';	
		}
		if($state === ''){
			$errors[16] = '<font color="red"> Please select a state</font>';
		}
		if($city === ''){
			$errors[17] = '<font color="red"> Please select a city</font>';
		}
	}
}
if(isset($_GET['success']) === true && empty($_GET['success']) === true){
	
}else{
	if(isset($_POST['signup']) && empty($errors) === true){
		$date_of_birth = format_date($date_of_birth);
		$register_data = array(
			'username'      => $username,
			'password'      => $password,
			'active'        => md5(rand(1,99999) + microtime()),
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
		register_user($register_data);
		header('Location: activation_pending.php?success');
		exit();
	}else if(isset($_POST['signup']) && empty($errors)===false){
	    echo '<script type="text/javascript">visible(\'popupBoxThreePosition\');</script>';
	}
    include_once 'includes/widgets/login_signup_html.php';
}?>
