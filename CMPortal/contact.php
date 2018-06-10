<?php 
include_once 'core/init.php';
include_once 'includes/overall/overall_header.php';
if(isset($_POST['contact_us'])){
	$first_name     = $_POST['first_name'];
	$last_name      = $_POST['last_name'];
	$email          = $_POST['email'];
	$phone          = $_POST['phone'];
	$subject        = $_POST['subject'];
	$message        = $_POST['message'];
	
	$first_name_length = strlen($first_name);
	$last_name_length  = strlen($last_name);
	$email_length      = strlen($email);
	$phone_length      = strlen($phone);
	$subject_length    = strlen($subject);
	$message_length    = strlen($message);
	
	$required_fields = array('first_name', 'last_name','email', 'phone', 'subject', 'message');
	foreach($_POST as $key => $value){
		if(empty($value) && in_array($key, $required_fields) === true){
			$errors[1] = '<font color="red"> All the fields are required</font>';
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
		if(filter_var($email, FILTER_VALIDATE_EMAIL) === false){
			$errors[4] = '<font color="red"> Enter a valid email address</font>';
			$email = '';
		}
		if($email_length > 100){
			$errors[4] = '<font color="red"> Email address must be less than 100 characters long</font>';
			$email = '';
		}
		if($phone_length != 10){
			$errors[5] = '<font color="red"> Phone number must be a 10 digit number</font>';
			$phone='';
		}
		if(!preg_match("/^[0-9]*$/",$phone)){
			$errors[5] = '<font color="red"> Invalid phone number</font>';
			$phone = '';	
		}
		if($subject_length > 32){
			$errors[6] = '<font color="red"> Subject can be at most 32 characters long</font>';
			$subject = '';
		}
		if($message_length > 1024){
			$errors[7] = '<font color="red"> Message too big!</font>';
			$message = '';
		}
	}
}
if(isset($_GET['submitted']) === true && empty($_GET['submitted']) === true){
	echo 'You\'r message has been submitted successfully. <br>We will reach you as soon as possible. <br>Thank you for your patience. <br>Click <a href="contact.php" target="_self"> here </a> to raise another query<br><br><br><br><br><br><br><br><br><br><br><br><br>';
}else{
	if(isset($_POST['contact_us']) && empty($errors) === true){
		$contact_data = array(
			'first_name'    => $first_name,
			'last_name'     => $last_name,
			'email'         => $email,
			'phone'         => $phone,
			'subject'       => $subject,
			'message'       => $message
		);
		contact_user($contact_data);
		header('Location: contact.php?submitted');
		exit();
	}
?>




<div class="form">
    <form class="col s12" action="" method="post">
	    <div class="row">
		    <?php if(isset($errors[1])){echo $errors[1];}?>
		</div>
		<div class="row">
			<div class="input-field col s6">
			    <i class="material-icons prefix">account_box</i>
			    <input id="first_name" type="text" class="validate" name="first_name" maxlength="32" value="<?php if(isset($first_name)){ echo $first_name; }?>"><?php if(isset($errors[2])){echo $errors[2];}?>
			    <label for="first_name">First Name (Required)</label>
			</div>
			<div class="input-field col s6">
			    <i class="material-icons prefix">account_box</i>
			    <input id="last_name" type="text" class="validate" name="last_name" maxlength="32" value="<?php if(isset($last_name)){ echo $last_name; }?>"><?php if(isset($errors[3])){echo $errors[3];}?>
			    <label for="last_name">Last Name (Required)</label>
			</div>
		</div>
		<div class="row">
		    <div class="input-field col s6">
				<i class="material-icons prefix">email</i>
			    <input id="email" type="text" class="validate" name="email" maxlength="100" value="<?php if(isset($email)){ echo $email; }?>"><?php if(isset($errors[4])){echo $errors[4];}?>
			    <label for="email">Email Address (Required)</label>
			</div>
			<div class="input-field col s6">
				<i class="material-icons prefix">phone</i>
			    <input id="phone" type="text" class="validate" name="phone" maxlength="10" value="<?php if(isset($phone)){echo $phone;} ?>"><?php if(isset($errors[5])){echo $errors[5];}?>
			    <label for="phone">Phone Number (Required)</label>
			</div>
		</div>
		<div class="row">
		    <div class="input-field col s12">
			    <i class="material-icons prefix">subject</i>
			    <input id="subject" type="text" class="validate" name="subject" maxlength="32" value="<?php if(isset($subject)){echo $subject;} ?>"><?php if(isset($errors[6])){echo $errors[6];}?>
			    <label for="subject">Subject (Required)</label>
			</div>
		</div>
		<div class="row">
            <div class="input-field col s12">
			    <i class="material-icons prefix">message</i>
                <textarea id="textarea1" class="materialize-textarea" name="message" maxlength="1024"><?php if(isset($message)){echo $message;} ?></textarea><?php if(isset($errors[7])){echo $errors[7];}?>
                <label for="textarea1">Message (Required)</label>
            </div>
        </div>
		<div class="row">
			<div class="input-field col s12">
				<input type="submit" class="waves-effect waves-light btn right" name="contact_us" value="Submit">
			</div>
		</div>
	</form>
</div>

<?php } ?>
<div class="fixed-action-btn">
    <a class="btn-floating btn-large red">
        <i class="large material-icons">cast_connected</i>
    </a>
    <ul>
        <li><a class="btn-floating indigo darken-1" href="https://www.facebook.com/replusone" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
        <li><a class="btn-floating cyan" href="https://twitter.com/replusone46" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
        <li><a class="btn-floating red darken-2" href="https://plus.google.com/+SudipSahareplusone" target="_blank"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
    </ul>
</div>

<?php include_once 'includes/overall/overall_footer.php'; ?>
