<?php 
include_once 'core/init.php';
dept_protect_page();
require_once 'image.compare.class.php';
include_once 'includes/overall/overall_header.php';

if(isset($_POST['report_missing'])){
	$full_name      = $_POST['full_name'];
	$place_of_birth = $_POST['place_of_birth'];
	$date_of_birth  = $_POST['date_of_birth'];
	$aadhaar_id     = $_POST['aadhaar_id'];
	$voter_id       = $_POST['voter_id'];
	$physical_desc  = $_POST['physical_desc'];
	$last_seen      = $_POST['last_seen'];
	$other_details  = $_POST['other_details'];
	
	$full_name_length      = strlen($full_name);
	$place_of_birth_length = strlen($place_of_birth);
	$date_of_birth_length  = strlen($date_of_birth);
	$aadhaar_id_length     = strlen($aadhaar_id);
	$voter_id_length       = strlen($voter_id);
	$physical_desc_length  = strlen($physical_desc);
	$last_seen_length      = strlen($last_seen);
	$other_details_length  = strlen($other_details);
	
	$required_fields = array('full_name', 'place_of_birth', 'date_of_birth', 'physical_desc', 'last_seen', 'voter_id', 'aadhaar_id');
	foreach($_POST as $key => $value){
		if(empty($value) && in_array($key, $required_fields) === true){
			$errors[1] = '<font color="red"> Fields marked with asteriks are required</font>';
			break 1;
		}
	}
	if(empty($errors) === true){
		if($full_name_length > 64){
			$errors[2] = '<font color="red"> Full name must be less than 64 characters long</font>';
			$full_name = '';
		}
		if($place_of_birth_length > 32){
			$errors[3] = '<font color="red"> Place of birth must be less than 33 characters long</font>';
			$place_of_birth='';
		}
		if(empty($date_of_birth) === true){
			$errors[4] = '<font color="red"> Please enter your date of birth</font>';
		}
		if($physical_desc_length > 1024){
			$errors[5] = '<font color="red"> Physical description must be less than 1025 characters long</font>';
			$physical_desc='';
		}
		if($last_seen_length > 512){
			$errors[6] = '<font color="red"> Last seen field must be less than 513 characters long</font>';
			$last_seen='';
		}
		if($other_details_length > 1024){
			$errors[7] = '<font color="red"> Other details must be less than 1025 characters long</font>';
			$other_details='';
		}
		if($aadhaar_id_length != 12){
			$errors[8] = '<font color="red"> Aadhaar card number must be 12 characters long</font>';
			$aadhaar_id='';
		}
		if(!preg_match("/^[0-9]*$/",$aadhaar_id)){
			$errors[8] = '<font color="red"> Invalid aadhaar card number</font>';
			$aadhaar_id = '';	
		}
		if($voter_id_length != 10){
			$errors[9] = '<font color="red"> Voter card number must be 10 characters long</font>';
			$voter_id='';
		}
		if(isset($_FILES['missing_image']) === true){
			if(empty($_FILES['missing_image']['name']) === true){
				$errors[10] = '<font color="red"> please choose a file</font>';
			}else{
				$allowed = array('jpg', 'jpeg');
				
				$file_name = $_FILES['missing_image']['name'];
				$file_size = $_FILES['missing_image']['size'];
				$file_extn = strtolower(end(explode('.', $file_name)));
				$file_temp = $_FILES['missing_image']['tmp_name'];
				
				if(in_array($file_extn, $allowed) === true){
					if($file_size > 2000000){
						$errors[10] = '<font color="red"> Image must be less than 2 MB</font>';
					}
				}else{
					$errors[10] = '<font color="red"> Incorrect file type. Allowed types: '.implode('/ ', $allowed).'</font>';
				}
			}
		}
	}
}
if(isset($_POST['report_missing']) && empty($errors) === true){
	$date_of_birth = format_date($date_of_birth);
	$file_path = 'images/missing/'.substr(md5(time()), 0, 10).'.'.$file_extn;
	move_uploaded_file($file_temp, $file_path);
	$register_missing_data = array(
		'full_name'      => $full_name,
		'place_of_birth' => $place_of_birth,
		'date_of_birth'  => $date_of_birth,
		'physical_desc'  => $physical_desc,
		'last_seen'      => $last_seen,
		'picture'        => $file_path,
		'voter_id'       => $voter_id,
		'aadhaar_id'     => $aadhaar_id,
		'other_details'  => $other_details,
		'user_email'     => $dept_user_data['email']
	);
	register_missing_person($register_missing_data);
	header('Location: manage.php?missing_record_registered');
	exit();
}

if(isset($_POST['find_person'])){
	if(isset($_FILES['search_person']) === true){
		if(empty($_FILES['search_person']['name']) === true){
			$errors[20] = '<font color="red"> please choose an image file</font>';
		}else{
			$allowed = array('jpg', 'jpeg');
			
			$file_name = $_FILES['search_person']['name'];
			$file_size = $_FILES['search_person']['size'];
			$file_extn = strtolower(end(explode('.', $file_name)));
			$file_temp = $_FILES['search_person']['tmp_name'];
			
			if(in_array($file_extn, $allowed) === true){
				if($file_size > 2000000){
					$errors[20] = '<font color="red"> Image must be less than 2 MB</font>';
				}
			}else{
				$errors[20] = '<font color="red"> Incorrect file type. Allowed types: '.implode('/ ', $allowed).'</font>';
			}
		}
	}if(isset($_POST['table_chosen']) === true){
		$table_chosen = $_POST['table_chosen'];
	}else{
		$errors[22] = '<font color="red"> Please choose any one of the tables</font>';
	}
	if(empty($errors) === true){
		$min  = 9999999;
		$min1 = 9999999;
		if($table_chosen === 'missing_parsons'){
			$count = missing_person_count();
			for($j=1;$j<=$count;$j++){
				$missing_person_data = missing_person_data($j, 'picture');
				$class = new compareImages;
				$check = $class->compare($file_temp,$missing_person_data['picture']);
				if($check < $min){
					$min = $check;
					$id1 = $j;
				}
			}
			$missing_person_data = missing_person_data($id1, 'full_name', 'date_of_birth', 'voter_id', 'aadhaar_id', 'physical_desc', 'last_seen', 'picture');
			$picture_suspect       = $missing_person_data['picture'];
			$full_name_suspect     = $missing_person_data['full_name'];
			$date_of_birth_suspect = $missing_person_data['date_of_birth'];
			$voter_id_suspect      = $missing_person_data['voter_id'];
			$aadhaar_id_suspect    = $missing_person_data['aadhaar_id'];
			$physical_desc_suspect = $missing_person_data['physical_desc'];
			$last_seen_suspect     = $missing_person_data['last_seen'];
			if($min <= 5){
				$match     = 'Perfect';
			}else if($min > 5 && $min <= 10){
				$match 	   = 'Good';
			}else if($min > 10 && $min <= 13){
				$match 	   = 'Poor';
			}else{
				$match     = 'Extremely Poor';
			}
		}else if($table_chosen === 'users'){
			$count = user_count();
			for($m=1;$m<=$count;$m++){
				$suspect_user_data = user_data($m, 'profile');
				if(empty($suspect_user_data['profile']) === false){
					$class = new compareImages;
					$check = $class->compare($file_temp,$suspect_user_data['profile']);
					if($check < $min1){
						$min1 = $check;
						$id2 = $m;
					}
				}else{
					continue;
				}
			}
			$suspect_user_data = user_data($id2, 'first_name', 'last_name', 'gender', 'date_of_birth', 'email', 'phone', 'address1', 'address2', 'address3', 'state', 'city', 'pincode', 'profile');
			$picture_suspect       = $suspect_user_data['profile'];
			$first_name_suspect    = $suspect_user_data['first_name'];
			$last_name_suspect     = $suspect_user_data['last_name'];
			$gender_suspect        = $suspect_user_data['gender'];
			$date_of_birth_suspect = $suspect_user_data['date_of_birth'];
			$email_suspect         = $suspect_user_data['email'];
			$phone_suspect         = $suspect_user_data['phone'];
			$address1_suspect      = $suspect_user_data['address1'];
			$address2_suspect      = $suspect_user_data['address2'];
			$address3_suspect      = $suspect_user_data['address3'];
			$state_suspect         = $suspect_user_data['state'];
			$city_suspect          = $suspect_user_data['city'];
			$pincode_suspect       = $suspect_user_data['pincode'];
			if($min1 <= 5){
				$match     = 'Perfect';
			}else if($min1 > 5 && $min1 <= 10){
				$match 	   = 'Good';
			}else if($min1 > 10 && $min1 <= 13){
				$match 	   = 'Poor';
			}else{
				$match     = 'Extremely Poor';
			}
		}
	}
}

if(isset($_POST['create_poll'])){
	if(empty($_POST['poll_topic']) === true){
		$errors[21] = '<font color="red"> Please write a poll topic</font>';
	}else if(strlen($_POST['poll_topic']) > 255){
		$errors[21] = '<font color="red"> Poll topic must be less than 255 characters long</font>';
	}else{
		$register_poll = array(
			'poll_topic' => $_POST['poll_topic'],
			'poll_state' => $dept_user_data['state'],
			'poll_city'  => $dept_user_data['city']
		);
		register_poll($register_poll);
		header('Location: manage.php?poll_created');
		exit();
	}
}

$poll_counts = poll_counts();
$poll_counts_by_region = poll_counts_by_region($dept_user_data['state'], $dept_user_data['city']);
$poll_active_counts_by_region = poll_active_counts_by_region($dept_user_data['state'], $dept_user_data['city']);
for($poll_del_id = 1; $poll_del_id <= $poll_counts; $poll_del_id++){
	$delete = 'delete_poll'.$poll_del_id;
	if(isset($_POST[$delete])){
		delete_poll($poll_del_id);
		header('Location: manage.php?poll_deleted');
	}
}
?>

<div class="report_holder">
	<ul class="collapsible" data-collapsible="accordion" id="report">
		
		<li>
			<div class="collapsible-header"><i class="material-icons">description</i>Manage Criminal Data</div>
			<div class="collapsible-body">
				<table class="striped">
					<thead>
						<tr class="teal lighten-2 white-text">
							<th data-field="fir_id">Complain No.</th>
							<th data-field="crime_main">Crime Division</th>
							<th data-field="crime_sub">Crime Sub-division</th>
							<th data-field="full_name">Users' Name</th>
							<th data-field="aadhaar_id">Users' Aadhaar Card No.</th>
							<th data-field="user_email">Users' Email Id</th>
							<th data-field="issue_date">Issue Date</th>
							<th data-field="statement">Statement</th>
							<th data-field="status">Status</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$fir_count = fir_count();
						for($l = 1;$l <= $fir_count;$l++){
							$fir_data_from_fir_id = fir_data_from_fir_id($l, 'fir_no', 'crime_main', 'crime_sub', 'first_name', 'last_name', 'aadhaar_id', 'statement', 'user_email', 'user_state', 'user_city', 'date', 'status');
							if($dept_user_data['state'] === $fir_data_from_fir_id['user_state'] && $dept_user_data['city'] === $fir_data_from_fir_id['user_city']){
						    ?>
							<tr>
								<td><?php echo $fir_data_from_fir_id['fir_no']; ?></td>
								<td><?php echo $fir_data_from_fir_id['crime_main']; ?></td>
								<td><?php echo $fir_data_from_fir_id['crime_sub']; ?></td>
								<td><?php echo $fir_data_from_fir_id['first_name'].' '.$fir_data_from_fir_id['last_name']; ?></td>
								<td><?php echo $fir_data_from_fir_id['aadhaar_id']; ?></td>
								<td><?php echo $fir_data_from_fir_id['user_email']; ?></td>
								<td><?php echo $fir_data_from_fir_id['date']; ?></td>
								<td><p id="statement"><?php echo $fir_data_from_fir_id['statement']; ?></p></td>
								<td>
									<select name="fir_status<?php echo $l; ?>" id="fir_status<?php echo $l; ?>" onchange="change_status(<?php echo $l; ?>);">
										<option value="0" <?php if($fir_data_from_fir_id['status'] == 0){ echo 'selected';} ?>>Initiated</option>
										<option value="1" <?php if($fir_data_from_fir_id['status'] == 1){ echo 'selected';} ?>>Processing</option>
										<option value="2" <?php if($fir_data_from_fir_id['status'] == 2){ echo 'selected';} ?>>Verified</option>
									</select>
								</td>
							</tr>
						<?php } } ?>
					</tbody>
				</table>
			</div>
		</li>
		
		<li>
			<div class="collapsible-header <?php if((isset($picture_suspect) && empty($picture_suspect) === false) || (isset($_POST['find_person']) && (isset($errors[20]) || isset($errors[22])))){ echo 'active'; } ?> "><i class="material-icons">search</i>Searching for a Suspect</div>
			<div class="collapsible-body">
				<form class="col s12" action="" method="post" enctype="multipart/form-data">
					<div class="row">
						<div class="file-field input-field col s10">
							<div class="btn">
								<span>UPLOAD IMAGE</span>
								<input type="file" name="search_person">
							</div>
							<div class="file-path-wrapper">
								<input class="file-path validate" type="text" placeholder="Upload a picture of the person">
							</div>
						</div>
						<div class="input-field col s1">
							<button class="waves-effect waves-light btn-large" name="find_person" type="submit">FIND</button>
						</div>
					</div>
					<div class="row">
						<div class="col s12">
							<label><font size=3em>CHOOSE A TABLE&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font></label>
							<input class="with-gap" type="radio" id="test9" name="table_chosen" value="missing_parsons"/>
							<label for="test9">MISSING PERSONS</label>
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<input class="with-gap" type="radio" id="test10" name="table_chosen" value="users"/>
							<label for="test10">USERS</label>
						</div>
					</div>
				</form>
				<div class="row">
					<?php if(isset($errors[20])){ echo $errors[20]; } ?>
					<?php if(isset($errors[22])){ echo '<br>'.$errors[22]; } ?>
				</div>
				<?php if(isset($picture_suspect)){ ?>
				<div class="row" style="border: 1px solid #ccc">
					<div class="input-field col s3">
						<img src="<?php echo $picture_suspect; ?>" width="200px" height="200px" border="1px solid"/>
					</div>
					<div class="input-field col s9">
					    <?php 
						if($min <= $min1){
							echo 'Match: '.$match.'<hr>Name: '.$full_name_suspect.'<br>Date of Birth: '.$date_of_birth_suspect.'<br>Voter Card No.: '.$voter_id_suspect.'<br>Aadhaar Card No.: '.$aadhaar_id_suspect.'<br>Physical Description: '.$physical_desc_suspect.'<br>Last Seen: '.$last_seen_suspect; 
						}else{
							echo 'Match: '.$match.'<hr>Name: '.$first_name_suspect.' '.$last_name_suspect.'<br>Gender: '.$gender_suspect.'<br>Date of Birth: '.$date_of_birth_suspect.'<br>Email Address: '.$email_suspect.'<br>Contact Number: '.$phone_suspect.'<br>Address Line1: '.$address1_suspect.'<br>Address Line2: '.$address2_suspect.'<br>Address Line3: '.$address3_suspect.'<br>State: '.$state_suspect.'<br>State: '.$state_suspect.'<br>Pincode: '.$pincode_suspect;
						}
						?>
					</div>
				</div>
				<?php } ?>
			</div>
		</li>
		
		<li>
			<div class="collapsible-header <?php if((isset($_POST['report_missing']) && empty($errors)===false) || (isset($_GET['missing_record_registered']) === true && empty($_GET['missing_record_registered']) === true)){ echo 'active'; } ?> "><i class="material-icons">person</i>Report Missing Person</div>
			<div class="collapsible-body">
			    <?php if(isset($_GET['missing_record_registered']) === true && empty($_GET['missing_record_registered']) === true){ echo 'Your data has been successfully registered into our database. You will recieve update through your registered email id.'; }else{ ?>
				<div class="row">
					<?php if(isset($_POST['report_missing']) && empty($errors[1]) === false){echo $errors[1].'<br>';}?>
					<form class="col s12" action="" method="post" enctype="multipart/form-data">
						<div class="row">
							<div class="input-field col s12">
								<input id="full_name" type="text" class="validate" name="full_name" maxlength="64" value="<?php if(isset($full_name)){ echo $full_name; }?>"><?php if(isset($_POST['report_missing']) && empty($errors[2]) === false){echo $errors[2].'<br>';}?>
								<label for="full_name">Full Name*</label>
							</div>
						</div>
						<div class="row">
							<div class="input-field col s6">
								<input id="place_of_birth" type="text" class="validate" name="place_of_birth" maxlength="32" value="<?php if(isset($place_of_birth)){ echo $place_of_birth; }?>"><?php if(isset($_POST['report_missing']) && empty($errors[3]) === false){echo $errors[3].'<br>';}?>
								<label for="place_of_birth">Place of Birth*</label>
							</div>
							<div class="input-field col s6">
								<label>Date of Birth*</label>
								<input type="text" class="datepicker" class="validate" name="date_of_birth" maxlength="20" value="<?php if(isset($date_of_birth)){ echo $date_of_birth; }?>"><?php if(isset($_POST['report_missing']) && empty($errors[4]) === false){echo $errors[4].'<br>';}?>
							</div>
						</div>
						<div class="row">
							<div class="input-field col s6">
								<input id="aadhaar_id" type="text" class="validate" name="aadhaar_id" maxlength="12" value="<?php if(isset($aadhaar_id)){ echo $aadhaar_id; }?>"><?php if(isset($_POST['report_missing']) && empty($errors[8]) === false){echo $errors[8].'<br>';}?>
								<label for="aadhaar_id">Aadhaar Card Number*</label>
							</div>
							<div class="input-field col s6">
								<input id="voter_id" type="text" class="validate" name="voter_id" maxlength="10" value="<?php if(isset($voter_id)){ echo $voter_id; }?>"><?php if(isset($_POST['report_missing']) && empty($errors[9]) === false){echo $errors[9].'<br>';}?>
								<label for="voter_id">Voter Card Number*</label>
							</div>
						</div>
						<div class="row">
							<div class="input-field col s12">
								<textarea id="textarea2" class="materialize-textarea" name="physical_desc" maxlength="1024"><?php if(isset($physical_desc)){echo $physical_desc;} ?></textarea><?php if(isset($_POST['report_missing']) && empty($errors[5]) === false){echo $errors[5].'<br>';}?>
								<label for="textarea2">Physical Description*</label>
							</div>
						</div>
						<div class="row">
							<div class="input-field col s12">
								<textarea id="textarea2" class="materialize-textarea" name="last_seen" maxlength="512"><?php if(isset($last_seen)){echo $last_seen;} ?></textarea><?php if(isset($_POST['report_missing']) && empty($errors[6]) === false){echo $errors[6].'<br>';}?>
								<label for="textarea2">Last Seen*</label>
							</div>
						</div>
						<div class="row">
							<div class="input-field col s12">
								<textarea id="textarea2" class="materialize-textarea" name="other_details" maxlength="1024"><?php if(isset($other_details)){echo $other_details;} ?></textarea><?php if(isset($_POST['report_missing']) && empty($errors[7]) === false){echo $errors[7].'<br>';}?>
								<label for="textarea2">Other Details</label>
							</div>
						</div>
						<div class="row">
							<div class="file-field input-field col s10">
								<div class="btn">
									<span>UPLOAD</span>
									<input type="file" name="missing_image">
								</div>
								<div class="file-path-wrapper">
									<input class="file-path validate" type="text" placeholder="Upload a picture of the person">
								</div><?php if(isset($_POST['report_missing']) && empty($errors[10]) === false){echo $errors[10].'<br>';}?>
							</div>
							<div class="input-field col s1">
								<button class="waves-effect waves-light btn-large" name="report_missing" type="submit">SUBMIT</button>
							</div>
						</div>
					</form>
				</div>
				<?php } ?>
			</div>
		</li>
		
		<li>
			<div class="collapsible-header"><i class="material-icons">unarchive</i>Submit Confidential Data</div>
			<div class="collapsible-body">
				<div class="row">
					<form class="col s12" action="upload.php" method="post" enctype="multipart/form-data" id="upload">
						<div class="row">
							<div class="file-field input-field col s10">
								<div class="btn red">
									<span>SELECT FILE(S)</span>
									<input type="file" multiple id="file" name="file[]" required>
								</div>
								<div class="file-path-wrapper">
									<input class="file-path validate" type="text" placeholder="Upload one or more files">
								</div>
							</div>
							<div class="input-field col s1">
								<input class="btn-large red" name="submit" type="submit" id="submit" value="UPLOAD">
							</div>
						</div>
						<div class=row">
						    <div class="input-field col s10">
								<div class="progress">
									<div class="determinate" id="pb"></div>
								</div>
							</div>
							<div class="input-field col s2">
								<span id="pt">0%</span>&nbsp;&nbsp;completed
							</div>
						</div>
						<div class=row">
							<div clss="uploads" id="uploads">
								<div class="input-field col s6" id="success">
								</div>
								<div class="input-field col s6" id="fail">
								</div>
							</div>
						</div>
						<script src="js/upload.js"></script>
						<script>
						    document.getElementById('submit').addEventListener('click', function(e){
								e.preventDefault();
								var f = document.getElementById('file'),
									pb = document.getElementById('pb'),
									pt = document.getElementById('pt');
								app.uploader({
									files: f,
									progressBar: pb,
									progressText: pt,
									processor: 'upload.php',
									finished: function(data){
										//console.log(data);
										var uploads = document.getElementById('uploads'),
										    succeeded = document.getElementById('success'),
											failed = document.getElementById('fail'),
											anchor,
											span,
											x;
											if(data.failed.length){
												failed.style.display = 'block';
												failed.innerHTML = '<p><b>Unable to upload(Bad file type or extention)</b></p>'
											}
											if(data.succeeded.length){
												succeeded.style.display = 'block';
												succeeded.innerHTML = '<p><b>Successfully uploaded</b></p>';
											}
											uploads.innerText = '';
											for(x = 0; x < data.succeeded.length; x = x + 1){
												anchor = document.createElement('a');
												anchor.href = 'confidential data/' + data.succeeded[x].file;
												anchor.innerText = data.succeeded[x].name;
												anchor.target = '_blank';
												succeeded.appendChild(anchor);
											}
											for(x = 0; x < data.failed.length; x = x + 1){
												span = document.createElement('span');
												span.innerText = data.failed[x].name;
												failed.appendChild(span);
											}
											uploads.appendChild(succeeded);
											uploads.appendChild(failed);
									},
									error: function(){
										console.log('Not Working');
									}
								});
							});
						</script>
					</form>
				</div>
			</div>
		</li>
		
		<li>
			<div class="collapsible-header <?php if((isset($_POST['create_poll']) && empty($errors[21])===false) || (isset($_GET['poll_created']) === true && empty($_GET['poll_created']) === true) || (isset($_GET['poll_deleted']) === true && empty($_GET['poll_deleted']) === true)){ echo 'active'; }?> "><i class="material-icons">poll</i>Run a Poll</div>
			<div class="collapsible-body">
				<form class="col s12" action="" method="post">
					<div class="row">
						<div class="file-field input-field col s10">
							<textarea id="textarea1" class="materialize-textarea" name="poll_topic" maxlength="255" required></textarea>
							<label for="textarea1">Poll Topic</label>
						</div>
						<div class="file-field input-field col s2">
							<input type="submit" class="waves-effect waves-light btn-large" name="create_poll" value="CREATE POLL">
						</div>
					</div>
				</form>
				<?php 
					if($poll_active_counts_by_region >= 1){ 
				?>
					<div class="row">
						<table class="striped1">
							<thead>
								<tr class="teal lighten-2 white-text">
									<th data-field="poll_topic">Poll Topic</th>
									<th data-field="up_vote"><i class="material-icons">thumb_up</i></th>
									<th data-field="down_vote"><i class="material-icons">thumb_down</i></th>
									<th data-field="delete_poll"><i class="material-icons">delete_forever</i></th>
								</tr>
							</thead>
							<tbody>
				<?php 
					for($poll_id = 1; $poll_id <= $poll_counts; $poll_id++){
						update_vote($poll_id);
						$poll_data = poll_data($poll_id, 'poll_topic', 'poll_state', 'poll_city', 'up_vote', 'down_vote', 'active');
						if($poll_data['active'] == 1 && $poll_data['poll_state'] == $dept_user_data['state'] && $poll_data['poll_city'] == $dept_user_data['city']){
						?>
							<tr>
								<td><?php echo $poll_data['poll_topic']; ?></td>
								<td><?php echo $poll_data['up_vote']; ?></td>
								<td><?php echo $poll_data['down_vote']; ?></td>
								<td>
									<form action="" method="post">
									<input class="btn waves-effect waves-light red left" type="submit" name="delete_poll<?php echo $poll_id;?>" value="DELETE">
									</form>
								</td>
							</tr>
						<?php } } } ?>
						</table>
					</div>
			</div>
		</li>

	</ul>
</div>
<div class="foot_report"><br><br>
<?php include_once 'includes/overall/overall_footer.php'; ?>
</div>
<script type="text/javascript">
	<!--
	function change_status(c){
		if(window.XMLHttpRequest){
			xmlhttp = new XMLHttpRequest();
		}else{
			xmlhttp = new ActiveXObject('Microsoft.XMLHTTP');
		}
		xmlhttp.onreadystatechange = function(){
			if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
				document.getElementById('fir_status'+c).innerHTML = xmlhttp.responseText;
			}
		}
		parameters = 'text='+document.getElementById('fir_status'+c).value+'&text1='+c;
		xmlhttp.open('POST', 'change_status.php', true);
		xmlhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
		xmlhttp.send(parameters);
	}
	$(document).ready(function(){
        $('.collapsible').collapsible();
    });
	$('#textarea1').val('New Text');
    $('#textarea1').trigger('autoresize');
    -->
</script>