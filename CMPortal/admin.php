<?php 
include 'core/init.php';
protect_page();
admin_protect();
include 'includes/overall/overall_header.php';
$fir_total      = fir_count();
if($fir_total == 0){
	$fir_initiated  = 0;
	$fir_processing = 0;
	$fir_verified   = 0;
}else{
	$fir_initiated  = (fir_initiated())/$fir_total*100;
	$fir_processing = (fir_processing())/$fir_total*100;
	$fir_verified   = (fir_verified())/$fir_total*100;
}
if(isset($_POST['add_dept_user'])){
	$dept_username       = $_POST['dept_username'];
	$dept_first_name     = $_POST['dept_first_name'];
	$dept_last_name      = $_POST['dept_last_name'];
	$dept_email          = $_POST['dept_email'];
	$dept_phone          = $_POST['dept_phone'];
	$dept_badge_no       = $_POST['dept_badge_no'];
	if(isset($_POST['dept_state'])){
		$dept_state      = $_POST['dept_state'];
	}else{
		$dept_state      = '';
	}
	if(isset($_POST['city'])){
		$dept_city       = $_POST['city'];
	}else{
	    $dept_city       = '';
	}
	
	$dept_username_length   = strlen($dept_username);
	$dept_first_name_length = strlen($dept_first_name);
	$dept_last_name_length  = strlen($dept_last_name);
	$dept_email_length      = strlen($dept_email);
	$dept_phone_length      = strlen($dept_phone);
	$dept_badge_no_length   = strlen($dept_badge_no);
	
	$required_fields = array('dept_username', 'dept_first_name', 'dept_last_name', 'dept_email', 'dept_phone', 'dept_badge_no', 'dept_state', 'dept_city');
	foreach($_POST as $key => $value){
		if(empty($value) && in_array($key, $required_fields) === true){
			$errors[1] = '<font color="red"> Fields marked with asteriks are required</font>';
			break 1;
		}
	}
	if(empty($errors) === true){
		if($dept_username_length > 32){
			$errors[2] = '<font color="red"> Username must be less than 33 characters long</font>';
			$dept_username = '';
		}
		if(dept_user_exists($dept_username) === true){
			$errors[2] = '<font color="red"> Sorry! The username \''.$_POST['username'].'\' is already taken</font>';
			$dept_username = '';
		}
		if(preg_match("/\\s/", $dept_username) == true){
			$errors[2] = '<font color="red"> Username must not contain any spaces</font>';
			$dept_username = '';
		}
		if($dept_first_name_length > 32){
			$errors[3] = '<font color="red"> Firstname must be less than 33 characters long</font>';
			$dept_first_name='';
		}
		if($dept_last_name_length > 32){
			$errors[4] = '<font color="red"> Lastname must be less than 33 characters long</font>';
			$dept_last_name='';
		}
		if(filter_var($dept_email, FILTER_VALIDATE_EMAIL) === false){
			$errors[5] = '<font color="red"> Enter a valid email address</font>';
			$dept_email = '';
		}
		if(dept_email_exists($dept_email) === true){
			$errors[5] = '<font color="red"> Sorry! The email id: \''.$dept_email.'\' is already registered. Please provide another one!</font>';
			$dept_email = '';
		}
		if($dept_phone_length != 10){
			$errors[6] = '<font color="red"> Phone number must be a 10 digit number</font>';
			$dept_phone='';
		}
		if(!preg_match("/^[0-9]*$/",$dept_phone)){
			$errors[6] = '<font color="red"> Invalid phone number</font>';
			$dept_phone = '';	
		}
		if(dept_phone_exists($dept_phone) === true){
			$errors[6] = '<font color="red"> Sorry! The phone number: \''.$dept_phone.'\' is already registered. Please provide another one!</font>';
			$dept_phone = '';
		}
		if($dept_badge_no_length != 12){
			$errors[7] = '<font color="red"> Badge number must be 12 characters long</font>';
			$dept_badge_no = '';
		}
		if(dept_badge_no_exists($dept_badge_no) === true){
			$errors[7] = '<font color="red"> Sorry! The badge number \''.$_POST['dept_badge_no'].'\' already exists</font>';
			$dept_badge_no = '';
		}
		if(preg_match('/[^A-Z\0-9]/', $dept_badge_no)){
			$errors[7] = '<font color="red"> Badge number only contains characters from [A-Z] and digits from [0-9].</font>';
			$dept_badge_no = '';
		}
		if($dept_state === ''){
			$errors[8] = '<font color="red"> Please select a state</font>';
		}
		if($dept_city === ''){
			$errors[9] = '<font color="red"> Please select a city</font>';
		}
	}
}
if(isset($_GET['dept_user_added']) === true && empty($_GET['dept_user_added']) === true){
	$dept_user_registered = 'One department user has been added to the database successfully.';
}else{
	if(isset($_POST['add_dept_user']) && empty($errors) === true){
		$register_dept_data = array(
			'username'         => $dept_username,
			'password'         => substr(md5(microtime()), 5, 8),
			'password_recover' => 1,
			'first_name'       => $dept_first_name,
			'last_name'        => $dept_last_name,
			'email'            => $dept_email,
			'phone'            => $dept_phone,
			'badge_no'         => $dept_badge_no,
			'state'            => $dept_state,
			'city'             => $dept_city
		);
		register_dept_user($register_dept_data);
		header('Location: admin.php?dept_user_added');
		exit();
	}
}
?> 
<style>
	#user_card, #dept_card, #dept_user_add_card, #contact_card{
		position: relative;
		height: 65vh;
	}
	.user_table_content, .dept_table_content, .dept_user_add_content, .contact_table_content, .dept_user_edit_content{
		height: 50vh;
		overflow: auto;
	}
	table {
		border-collapse: collapse;
	}
	table, th, td {
		border: 1px solid black;
		text-align: center;
	}
	tr:nth-child(even){
		background-color: #ccc
	}
	table.user_table, table.dept_table{
		width: 150%;
	}
	.subject{
		position: relative;
		text-align: center;
	}
	#subject{
		position: relative;
		text-align: center;
		overflow-y: auto;
	} 
	#message{
		position: relative;
		text-align: justify;
		overflow-y: auto;
	}
	#popupBoxEightPosition{
	top: 0; left: 0; 
	position: fixed; 
	width: 100%; 
	height: 100%;
	background-color: rgba(250,250,250,0.8); 
	display: none; 
	z-index: 1000;
}
</style>
<div class="row">
	<div class="col s12 m6">
		<div class="card blue-grey lighten-5">
			<div class="icon-block">
				<h1 class="center grey-text"><i class="large material-icons">group</i></h1>
				<h5 class="center">Total Users</h5>
				<h3 class="center"><?php echo user_count(); ?></h3>
			</div>
		</div>
	</div>

	<div class="col s12 m6">
		<div class="card blue-grey lighten-5">	
			<div class="icon-block">
				<h1 class="center grey-text"><i class="large material-icons">verified_user</i></h1>
				<h5 class="center">Active Users</h5>
				<h3 class="center"><?php echo user_active_count(); ?></h3>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col s12 m6">
		<div class="card blue-grey lighten-5">
			<div class="icon-block">
				<h1 class="center grey-text"><i class="large material-icons">chrome_reader_mode</i></h1>
				<h5 class="center">Total FIR Lodged</h5>
				<h4 class="center"><?php echo fir_count(); ?></h4>
			</div><br><br><br><br><br><br>
		</div>
	</div>
	<div class="col s12 m6">
		<div class="card blue-grey lighten-5">
			<div class="icon-block">
				<h1 class="center grey-text"><i class="large material-icons">subject</i></h1>
				<h5 class="center">FIR Status</h5>
				<div class="row">
					<div class="col s2">Initiated</div>
					<div class="col s9">
						<p>
							<div class="progress">
								<div class="determinate" style="width: <?php echo $fir_initiated.'%'; ?>"></div>
							</div>
						</p>
					</div>
					<div class="col s1"><?php echo $fir_initiated.'%'; ?></div>
				</div>
				<div class="row">
					<div class="col s2">Processing</div>
					<div class="col s9">
						<p>
							<div class="progress">
								<div class="determinate green" style="width: <?php echo $fir_processing.'%'; ?>"></div>
							</div>
						</p>
					</div>
					<div class="col s1"><?php echo $fir_processing.'%'; ?></div>
				</div>
				<div class="row">
					<div class="col s2">Verified</div>
					<div class="col s9">
						<p>
							<div class="progress">
								<div class="determinate red" style="width: <?php echo $fir_verified.'%'; ?>"></div>
							</div>
						</p>
					</div>
					<div class="col s1"><?php echo $fir_verified.'%'; ?></div>
				</div>
				<font size="4.5"><br></font>
			</div>
		</div>
	</div>
</div>
<div class="row" id="user_card">
	<div class="col s12">
		<div class="card grey lighten-4">
			<div class="card-content black-text">
				<span class="card-title">Users</span>
				<div class="user_table_content">
					<table class="user_table">
						<thead>
							<tr>
								<th>USER ID</th>
								<th>USERNAME</th>
								<th>FIRST NAME</th>
								<th>LAST NAME</th>
								<th>GENDER</th>
								<th>DATE OF BIRTH</th>
								<th>EMAIL</th>
								<th>PHONE</th>
								<th>STATE</th>
								<th>CITY</th>
								<th>PINCODE</th>
								<th>PROFILE PHOTO</th>
								<th>PROFILE STATUS</th>
							</tr>
						</thead>
						<tbody>
							<?php 
							for($u = 1; $u <= user_count(); $u++){
								$user_profile_data = user_data($u, 'user_id', 'username', 'active', 'first_name', 'last_name', 'gender', 'date_of_birth', 'email', 'phone', 'state', 'city', 'pincode', 'profile');
								if($user_profile_data['active'] == 1){
									$user_profile_data['active'] = 'ACTIVATED';
								}else if($user_profile_data['active'] == 0){
									$user_profile_data['active'] = 'DEACTIVATED';
								}
								if(empty($user_profile_data['profile']) === true){
									$user_profile_data['profile'] = 'images/profile/avatar.jpg';
								}
								echo '<tr>';
								echo '<td>'.$user_profile_data['user_id'].'</td>';
								echo '<td>'.$user_profile_data['username'].'</td>';
								echo '<td>'.$user_profile_data['first_name'].'</td>';
								echo '<td>'.$user_profile_data['last_name'].'</td>';
								echo '<td>'.strtoupper($user_profile_data['gender']).'</td>';
								echo '<td>'.$user_profile_data['date_of_birth'].'</td>';
								echo '<td id="extend">'.$user_profile_data['email'].'</td>';
								echo '<td>'.$user_profile_data['phone'].'</td>';
								echo '<td>'.$user_profile_data['state'].'</td>';
								echo '<td>'.$user_profile_data['city'].'</td>';
								echo '<td>'.$user_profile_data['pincode'].'</td>';
								echo '<td><a href="'.$user_profile_data['profile'].'" target="_blank">CLICK HERE</a></td>';
								echo '<td>'.$user_profile_data['active'].'</td>';
								echo '</tr>';
							}							
							?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="row" id="dept_card">
	<div class="col s12">
		<div class="card grey lighten-4">
			<div class="card-content black-text">
				<span class="card-title">Department Users</span>
				<div class="dept_table_content">
					<table class="dept_table">
						<thead>
							<tr>
								<th>USER ID</th>
								<th>USERNAME</th>
								<th>FIRST NAME</th>
								<th>LAST NAME</th>
								<th>BADGE NUMBER</th>
								<th>EMAIL</th>
								<th>PHONE</th>
								<th>STATE</th>
								<th>CITY</th>
								<th>PROFILE PHOTO</th>
							</tr>
						</thead>
						<tbody>
							<?php 
							for($d = 1; $d <= dept_user_count(); $d++){
								$dept_profile_data = dept_user_data($d, 'user_id', 'username', 'first_name', 'last_name', 'email', 'phone', 'badge_no', 'state', 'city', 'profile');
								if(empty($dept_profile_data['profile']) === true){
									$dept_profile_data['profile'] = 'images/profile/avatar.jpg';
								}
								echo '<tr>';
								echo '<td>'.$dept_profile_data['user_id'].'</td>';
								echo '<td>'.$dept_profile_data['username'].'</td>';
								echo '<td>'.$dept_profile_data['first_name'].'</td>';
								echo '<td>'.$dept_profile_data['last_name'].'</td>';
								echo '<td>'.$dept_profile_data['badge_no'].'</td>';
								echo '<td>'.$dept_profile_data['email'].'</td>';
								echo '<td>'.$dept_profile_data['phone'].'</td>';
								echo '<td>'.$dept_profile_data['state'].'</td>';
								echo '<td>'.$dept_profile_data['city'].'</td>';
								echo '<td><a href="'.$dept_profile_data['profile'].'" target="_blank">CLICK HERE</a></td>';
								echo '</tr>';
							}							
							?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="row" id="dept_user_add_card">
	<div class="col s12">
		<div class="card grey lighten-4">
			<div class="card-content black-text">
				<span class="card-title">Add Department Users</span>
				<div class="dept_user_add_content">
					<form class="col s12" action="" method="post">
						<div class="row">
							<div class="col s12">
								<?php
								if(isset($dept_user_registered) && !empty($dept_user_registered)){
									echo $dept_user_registered;
									$dept_user_registered = '';
								}
								if(isset($_POST['add_dept_user']) && empty($errors[1]) === false){echo $errors[1].'<br>';}
								if(isset($_POST['add_dept_user']) && empty($errors[2]) === false){echo $errors[2].'<br>';}
								if(isset($_POST['add_dept_user']) && empty($errors[3]) === false){echo $errors[3].'<br>';}
								if(isset($_POST['add_dept_user']) && empty($errors[4]) === false){echo $errors[4].'<br>';}
								if(isset($_POST['add_dept_user']) && empty($errors[5]) === false){echo $errors[5].'<br>';}
								if(isset($_POST['add_dept_user']) && empty($errors[6]) === false){echo $errors[6].'<br>';}
								if(isset($_POST['add_dept_user']) && empty($errors[7]) === false){echo $errors[7].'<br>';}
								if(isset($_POST['add_dept_user']) && empty($errors[8]) === false){echo $errors[8].'<br>';}
								if(isset($_POST['add_dept_user']) && empty($errors[9]) === false){echo $errors[9].'<br>';}
								?>
							</div>
						</div>
						<div class="row">
							<div class="input-field col s12">
								<input id="last_name" type="text" class="validate" name="dept_username" value="<?php if(isset($dept_username)){ echo $dept_username; }?>" maxlength="32">
								<label for="user_name">Username*</label>
							</div>
						</div>
						<div class="row">
							<div class="input-field col s6">
								<input id="last_name" type="text" class="validate" name="dept_first_name" value="<?php if(isset($dept_first_name)){ echo $dept_first_name; }?>" maxlength="32">
								<label for="first_name">First Name*</label>
							</div>
							<div class="input-field col s6">
								<input id="last_name" type="text" class="validate" name="dept_last_name" value="<?php if(isset($dept_last_name)){ echo $dept_last_name; }?>" maxlength="32">
								<label for="last_name">Last Name*</label>
							</div>
						</div>
						<div class="row">
							<div class="input-field col s12">
								<input id="badge" type="text" class="validate" name="dept_badge_no" value="<?php if(isset($dept_badge_no)){echo $dept_badge_no;} ?>" maxlength="12">
								<label for="user_name">Badge Number*</label>
							</div>
						</div>
						<div class="row">
							<div class="input-field col s12">
								<input id="email" type="email" class="validate" name="dept_email" value="<?php if(isset($dept_email)){ echo $dept_email; }?>" maxlength="100">
								<label for="email">Email Address*</label>
							</div>
						</div>
						<div class="row">
							<div class="input-field col s12">
								<input id="tel" type="text" class="validate" name="dept_phone" value="<?php if(isset($dept_phone)){echo $dept_phone;} ?>" maxlength="10">
								<label for="user_name">Phone Number*</label>
							</div>
						</div>
						<div class="row">
							<div class="input-field col s6">
								<label>State*</label>&nbsp;
								<select name="dept_state" id="dept_state" onchange="loadcity();">
									<option value="default" disabled selected>Select State</option>
									<option value="Andhra Pradesh" <?php if(isset($dept_state) && $dept_state === 'Andhra Pradesh'){echo 'selected';} ?>>Andhra Pradesh</option>
									<option value="Arunachal Pradesh" <?php if(isset($dept_state) && $dept_state === 'Arunachal Pradesh'){echo 'selected';} ?>>Arunachal Pradesh</option>
									<option value="Assam" <?php if(isset($dept_state) && $dept_state === 'Assam'){echo 'selected';} ?>>Assam</option>
									<option value="Bihar" <?php if(isset($dept_state) && $dept_state === 'Bihar'){echo 'selected';} ?>>Bihar</option>
									<option value="Chhattisgarh" <?php if(isset($dept_state) && $dept_state === 'Chhattisgarh'){echo 'selected';} ?>>Chhattisgarh</option>
									<option value="Goa" <?php if(isset($dept_state) && $dept_state === 'Goa'){echo 'selected';} ?>>Goa</option>
									<option value="Gujarat" <?php if(isset($dept_state) && $dept_state === 'Gujarat'){echo 'selected';} ?>>Gujarat</option>
									<option value="Haryana" <?php if(isset($dept_state) && $dept_state === 'Haryana'){echo 'selected';} ?>>Haryana</option>
									<option value="Himachal Pradesh" <?php if(isset($dept_state) && $dept_state === 'Himachal Pradesh'){echo 'selected';} ?>>Himachal Pradesh</option>
									<option value="Jammu and Kashmir" <?php if(isset($dept_state) && $dept_state === 'Jammu and Kashmir'){echo 'selected';} ?>>Jammu and Kashmir</option>
									<option value="Jharkhand" <?php if(isset($dept_state) && $dept_state === 'Jharkhand'){echo 'selected';} ?>>Jharkhand</option>
									<option value="Karnataka" <?php if(isset($dept_state) && $dept_state === 'Karnataka'){echo 'selected';} ?>>Karnataka</option>
									<option value="Kerala" <?php if(isset($dept_state) && $dept_state === 'Kerala'){echo 'selected';} ?>>Kerala</option>
									<option value="Madhya Pradesh" <?php if(isset($dept_state) && $dept_state === 'Madhya Pradesh'){echo 'selected';} ?>>Madhya Pradesh</option>
									<option value="Maharashtra" <?php if(isset($dept_state) && $dept_state === 'Maharashtra'){echo 'selected';} ?>>Maharashtra</option>
									<option value="Manipur" <?php if(isset($dept_state) && $dept_state === 'Manipur'){echo 'selected';} ?>>Manipur</option>
									<option value="Meghalaya" <?php if(isset($dept_state) && $dept_state === 'Meghalaya'){echo 'selected';} ?>>Meghalaya</option>
									<option value="Mizoram" <?php if(isset($dept_state) && $dept_state === 'Mizoram'){echo 'selected';} ?>>Mizoram</option>
									<option value="Nagaland" <?php if(isset($dept_state) && $dept_state === 'Nagaland'){echo 'selected';} ?>>Nagaland</option>
									<option value="Odisha" <?php if(isset($dept_state) && $dept_state === 'Odisha'){echo 'selected';} ?>>Odisha</option>
									<option value="Punjab" <?php if(isset($dept_state) && $dept_state === 'Punjab'){echo 'selected';} ?>>Punjab</option>
									<option value="Rajasthan" <?php if(isset($dept_state) && $dept_state === 'Rajasthan'){echo 'selected';} ?>>Rajasthan</option>
									<option value="Sikkim" <?php if(isset($dept_state) && $dept_state === 'Sikkim'){echo 'selected';} ?>>Sikkim</option>
									<option value="Tamil Nadu" <?php if(isset($dept_state) && $dept_state === 'Tamil Nadu'){echo 'selected';} ?>>Tamil Nadu</option>
									<option value="Telangana" <?php if(isset($dept_state) && $dept_state === 'Telangana'){echo 'selected';} ?>>Telangana</option>
									<option value="Tripura" <?php if(isset($dept_state) && $dept_state === 'Tripura'){echo 'selected';} ?>>Tripura</option>
									<option value="Uttar Pradesh" <?php if(isset($dept_state) && $dept_state === 'Uttar Pradesh'){echo 'selected';} ?>>Uttar Pradesh</option>
									<option value="Uttarakhand" <?php if(isset($dept_state) && $dept_state === 'Uttarakhand'){echo 'selected';} ?>>Uttarakhand</option>
									<option value="West Bengal" <?php if(isset($dept_state) && $dept_state === 'West Bengal'){echo 'selected';} ?>>West Bengal</option>
								</select>
							</div>
							<div class="input-field col s6" id="dept_cityname">
								<label>City*</label>&nbsp;
								<select name="city" id="city">
									<option value="default" disabled selected>Select City</option>
								</select>
							</div>
						</div>
						<input type="submit" class="btn waves-effect waves-light teal" value="ADD" name="add_dept_user">
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="row" id="contact_card">
	<div class="col s12">
		<div class="card grey lighten-4">
			<div class="card-content black-text">
				<span class="card-title">Queries Raised</span>
				<div class="contact_table_content">
					<table class="contact_table">
						<thead>
							<tr>
								<th>NAME</th>
								<th>SUBJECT</th>
								<th>EMAIL ADDRESS</th>
								<th>PHONE NUMBER</th>
								<th>STATUS</th>
							</tr>
						</thead>
						<tbody>
						<?php
						for($c = 1; $c <= contact_count(); $c++){
							$contact_data = contact_data($c, 'number', 'first_name', 'last_name', 'email', 'phone', 'subject', 'message', 'status');
							if($contact_data['status'] == 0){?>
							<tr>
								<td><?php echo $contact_data['first_name'].' '.$contact_data['last_name']; ?></td>
								<td><p id="subject"><a class="waves-effect" href="javascript:void(0)" onclick="toggle_visibility('popupBoxEightPosition');"><?php echo $contact_data['subject']; ?></a></p></td>
								<td><?php echo $contact_data['email']; ?></td>
								<td><?php echo $contact_data['phone']; ?></td>
								<td>UNRESOLVED</td>
								<div id="popupBoxEightPosition">
									<div class="popupBoxWrapper">
										<div class="popupBoxContent">
											<div class="form">
												<a href="javascript:void(0)" onclick="toggle_visibility('popupBoxEightPosition');" id="closewindow"><i class="material-icons">close</i></a>
												<div class="row">
													<span class="subject"><h5><?php echo strtoupper($contact_data['subject']); ?></h5></span>
												</div><div class="divider"></div>
												<div class="row">
													<div class="col s12" id="message">
														<?php echo $contact_data['message']; ?>
													</div>
												</div><div class="divider"></div><br>
												<div class="row">
													<a class="waves-effect waves-light btn" onclick="resolve(<?php echo $contact_data['number']; ?>)" href="mailto:<?php echo $contact_data['email']; ?>" target="_top">RESOLVE</a>
												</div>
											</div>
										</div>
									</div>
								</div>
							</tr>
						<?php } } ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<?php include 'includes/overall/overall_footer.php'; ?>
<script type="text/javascript">
    <!--
	function resolve(r){
		if(window.XMLHttpRequest){
			xmlhttp = new XMLHttpRequest();
		}else{
			xmlhttp = new ActiveXObject('Microsoft.XMLHTTP');
		}
		xmlhttp.onreadystatechange = function(){
			if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
				document.getElementById('popupBoxEightPosition').style.display = 'none';
				location.reload(true);
			}
		}
		parameters = 'text='+r;
		xmlhttp.open('POST', 'resolve_contact.php', true);
		xmlhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
		xmlhttp.send(parameters);
	}
	function loadcity(){
		var city = "<?php if(isset($dept_city)){ echo $dept_city; } ?>";
		if(window.XMLHttpRequest){
			xmlhttp = new XMLHttpRequest();
		}else{
			xmlhttp = new ActiveXObject('Microsoft.XMLHTTP');
		}
		xmlhttp.onreadystatechange = function(){
			if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
				document.getElementById('dept_cityname').innerHTML = xmlhttp.responseText;
				$(document).ready(function() {
                $('select').material_select();
                });
			}
		}
		parameters = 'text='+document.getElementById('dept_state').value+'&text1='+city;
		xmlhttp.open('POST', 'loadcity.inc.php', true);
		xmlhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
		xmlhttp.send(parameters);
	}
	$(document).ready(function(){
    $('select').material_select();
    });
	$('select').material_select('destroy');
	-->
</script>