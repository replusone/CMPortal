<body onload="loadcrime();">
<?php 
include_once 'core/init.php';
protect_page();
include_once 'includes/overall/overall_header.php'; 

if(isset($_POST['lodge'])){
	if(isset($_POST['crime_main'])){
		$crime_main = $_POST['crime_main'];
	}else{
		$crime_main = '';
	}
	if(isset($_POST['crime_sub'])){
		$crime_sub  = $_POST['crime_sub'];
	}else{
	    $crime_sub  = '';
	}
	$first_name     = $_POST['first_name'];
	$last_name      = $_POST['last_name'];
	$aadhaar_id     = $_POST['aadhaar_id'];
	$statement      = $_POST['statement'];
	
	$first_name_length = strlen($first_name);
	$last_name_length  = strlen($last_name);
	$aadhaar_id_length = strlen($aadhaar_id);
	$statement_length  = strlen($statement);
	
	$required_fields = array('crime_main', 'crime_sub', 'first_name', 'last_name', 'aadhaar_id', 'statement');
	foreach($_POST as $key => $value){
		if(empty($value) && in_array($key, $required_fields) === true){
			$errors[1] = '<font color="red"> Fields marked with asteriks are required</font>';
			break 1;
		}
	}
	if(empty($errors) === true){
		if($first_name_length > 32){
			$errors[2] = '<font color="red"> First name must be less than 32 characters long</font>';
			$first_name = '';
		}
		if($last_name_length > 32){
			$errors[3] = '<font color="red"> Last name must be less than 32 characters long</font>';
			$last_name = '';
		}
		if($aadhaar_id_length != 12){
			$errors[4] = '<font color="red"> Aadhaar card number must be 12 characters long</font>';
			$aadhaar_id='';
		}
		if(!preg_match("/^[0-9]*$/",$aadhaar_id)){
			$errors[4] = '<font color="red"> Invalid aadhaar card number</font>';
			$aadhaar_id = '';	
		}
		if($statement_length > 2048){
			$errors[5] = '<font color="red"> Statement must be less than 2049 characters long</font>';
			$statement='';
		}
	}
}
if(isset($_POST['lodge']) && empty($errors) === true){
	$register_fir = array(
	    'fir_no'     => 'FIR'.time(),
		'crime_main' => $crime_main,
		'crime_sub'  => $crime_sub,
		'first_name' => $first_name,
		'last_name'  => $last_name,
		'aadhaar_id' => $aadhaar_id,
		'statement'  => $statement,
		'user_email' => $user_data['email'],
		'user_state' => $user_data['state'],
		'user_city'  => $user_data['city'],
		'date'       => date("Y/m/d")
	);
	register_fir($register_fir, $user_data['phone']);
	header('Location: report.php?fir_registered');
	exit();
}

		    
if(isset($_POST['check_status']) === true){
	if(strlen($_POST['complain_id']) < 1){
		$errors[11] = '<font color="red"> Please provide your complain id</font>';
	}else{
		$complain_id = $_POST['complain_id'];
		if(fir_exists_by_id($complain_id) === false){
			$errors[11] = '<font color="red"> Invalid complain id</font>';
		}else{
			$fir_data = fir_data($complain_id, 'fir_id', 'crime_main', 'crime_sub', 'statement', 'status');
		}
	}
}
			
?>
	<div class="report_holder">
		<ul class="collapsible" data-collapsible="accordion" id="report">
			
			<li>
				<div class="collapsible-header <?php if((isset($_POST['lodge']) && empty($errors)===false) || (isset($_GET['fir_registered']) === true && empty($_GET['fir_record_registered']) === true)){ echo 'active'; } ?>"><i class="material-icons">description</i>Lodge F.I.R.(First Information Report)</div>
				<div class="collapsible-body">
					<?php if(isset($_GET['fir_registered']) === true && empty($_GET['fir_registered']) === true){ echo 'Your data has been successfully registered into our database. The user copy has been sent to you through your registered email id. If you have not receive any email regarding the user copy of the F.I.R., please mail us to \'enquirysquad@gmail.com\''; }else{ ?>
					<div class="row">
						<?php if(isset($_POST['lodge']) && empty($errors[1]) === false){echo $errors[1];}?>
						<form class="col s12" method="post" action="">
							<div class="row">
								<div class="input-field col s6">
									<select name="crime_main" id="crime_main" onchange="loadcrime();">
										<option value="" disabled selected>Choose a crime category</option>
										<option value="Personal Crimes" <?php if(isset($crime_main) && $crime_main === 'Personal Crimes'){echo 'selected';} ?>>Personal Crimes</option>
										<option value="Property Crimes" <?php if(isset($crime_main) && $crime_main === 'Property Crimes'){echo 'selected';} ?>>Property Crimes</option>
										<option value="Inchoate Crimes" <?php if(isset($crime_main) && $crime_main === 'Inchoate Crimes'){echo 'selected';} ?>>Inchoate Crimes</option>
										<option value="Statutory Crimes" <?php if(isset($crime_main) && $crime_main === 'Statutory Crimes'){echo 'selected';} ?>>Statutory Crimes</option>
									</select>
									<label>Crime Category</label>
								</div>
								<div class="input-field col s6" id="load_crime">
									<select name="crime_sub" id="crime_sub">
										<option value="" disabled selected>Choose a crime sub-category</option>
									</select>
									<label>Crime Sub-category</label>
								</div>
							</div>
							<div class="row">
								<div class="input-field col s6">
									<input id="last_name" type="text" class="validate" name="first_name" value="<?php if(isset($first_name)){ echo $first_name; }?>" maxlength="32"><?php if(isset($_POST['lodge']) && empty($errors[2]) === false){echo $errors[2];}?>
									<label for="first_name">First Name*</label>
								</div>
								<div class="input-field col s6">
									<input id="last_name" type="text" class="validate" name="last_name" value="<?php if(isset($last_name)){ echo $last_name; }?>" maxlength="32"><?php if(isset($_POST['lodge']) && empty($errors[3]) === false){echo $errors[3];}?>
									<label for="last_name">Last Name*</label>
								</div>
							</div>
							<div class="row">
								<div class="input-field col s12">
									<input id="aadhaar_id" type="text" class="validate" name="aadhaar_id" value="<?php if(isset($aadhaar_id)){ echo $aadhaar_id; }?>" maxlength="12"><?php if(isset($_POST['lodge']) && empty($errors[4]) === false){echo $errors[4];}?>
									<label for="aadhaar_id">Aadhaar Card Number*</label>
								</div>
							</div>
							<div class="row">
								<div class="input-field col s12">
									<textarea id="textarea2" class="materialize-textarea" name="statement" maxlength="2048"><?php if(isset($statement)){echo $statement;} ?></textarea><?php if(isset($_POST['lodge']) && empty($errors[5]) === false){echo $errors[5];}?>
									<label for="textarea2">Statement*</label>
								</div>
							</div>
							<div class="row">
								<div class="input-field col s1">
									<button class="waves-effect waves-light btn-large" name="lodge" type="submit">SUBMIT</button>
								</div>
							</div>
						</form>
					</div>
					<?php } ?>
				</div>
			</li>
			
			<?php if(fir_exists($user_data['email']) === true){?>
			<li>
				<div class="collapsible-header <?php if(isset($_POST['check_status']) === true){ echo 'active'; }?>"><i class="material-icons">receipt</i>View F.I.R.(First Information Report) Status</div>
				<div class="collapsible-body">
					<form class="col s12" action="" method="post">
						<div class="row">
							<div class="input-field col s10">
								<input id="complain" type="text" class="validate" name="complain_id" maxlength="13">
								<label for="complain">Complain ID</label>
							</div>
							<div class="input-field col s2">
								<button class="waves-effect waves-light btn-large" name="check_status" type="submit">CHECK</button>
							</div>
						</div>
					</form>
					<?php if(isset($_POST['check_status']) === true && empty($errors) === true){?>
					<table class="striped">
						<thead>
							<tr class="teal lighten-2 white-text">
								<th data-field="fir_id">Complain No.</th>
								<th data-field="crime_main">Crime Division</th>
								<th data-field="crime_sub">Crime Sub-division</th>
								<th data-field="statement">Statement</th>
								<th data-field="status">Status</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td><?php echo $complain_id; ?></td>
								<td><?php echo $fir_data['crime_main']; ?></td>
								<td><?php echo $fir_data['crime_sub']; ?></td>
								<td><p id="statement"><?php echo $fir_data['statement']; ?></p></td>
								<td><?php if($fir_data['status'] == 0){ echo 'Initiated';}else if($fir_data['status'] == 1){ echo 'Processing';}else if($fir_data['status'] == 2){ echo 'Verified';} ?></td>
							</tr>
						</tbody>
					</table>
					<?php }else if(isset($errors[11]) === true){
						echo $errors[11];
					} ?>
				</div>
			</li>
			<?php } ?>
			
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
								<div class="col s2">
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
								<!--
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
								-->
							</script>
						</form>
					</div>
				</div>
			</li>

			<li>
				<div class="collapsible-header"><i class="material-icons">person</i>List of Missing Persons</div>
				<div class="carousel">
					<?php 
						$id = missing_person_count();
						for($i=1;$i<=$id;$i++){
							$missing_person_data = missing_person_data($i, 'full_name', 'date_of_birth', 'picture');
							echo '<a class="carousel-item" href="javascript:void(0)"><img src="'.$missing_person_data['picture'].'"><font color="black">'.$missing_person_data['full_name'].'<br>Date of Birth: '.$missing_person_data['date_of_birth'].'</font></a>';
						}
					?>
				</div>
			</li>
		</ul>
	</div>
</body>
<div class="foot_report">
<?php include_once 'includes/overall/overall_footer.php'; ?>
</div>
<script type="text/javascript">
	<!--
	function loadcrime(){
		var crime_sub = "<?php if(isset($crime_sub)){ echo $crime_sub; } ?>";
		if(window.XMLHttpRequest){
			xmlhttp = new XMLHttpRequest();
		}else{
			xmlhttp = new ActiveXObject('Microsoft.XMLHTTP');
		}
		
		xmlhttp.onreadystatechange = function(){
			if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
				document.getElementById('load_crime').innerHTML = xmlhttp.responseText;
				$(document).ready(function() {
                $('select').material_select();
                });
			}
		}
		
		
		parameters = 'text='+document.getElementById('crime_main').value+'&text1='+crime_sub;
		//parameters = 'text='+val;
		
		xmlhttp.open('POST', 'loadcrime.inc.php', true);
		xmlhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
		xmlhttp.send(parameters);
	    
	}
	$(document).ready(function(){
        $('.collapsible').collapsible();
    });
	$('#textarea1').val('New Text');
    $('#textarea1').trigger('autoresize');
	$(document).ready(function() {
        $('select').material_select();
    });
	$('select').material_select('destroy');
	$(document).ready(function(){
        $('.carousel').carousel();
    });
	$('.carousel').carousel('set', 4);
    -->
</script>