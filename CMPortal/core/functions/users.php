<?php
function user_data($user_id){
	$data = array();
	$user_id = (int)$user_id;
	
	$func_num_args = func_num_args();    //built in: returns no. of arguments passed to the function 
	$func_get_args = func_get_args();    //built in: returns the values of the passed arguments to the function

	if($func_num_args > 1){
		unset($func_get_args[0]);
		
		$fields = '`' . implode('`, `', $func_get_args) . '`';
		$data = mysql_fetch_assoc(mysql_query("SELECT $fields FROM `users` WHERE `user_id` = $user_id"));
		return $data;
	}
}

function missing_person_data($id){
	$data = array();
	
	$func_num_args = func_num_args();    //built in: returns no. of arguments passed to the function 
	$func_get_args = func_get_args();    //built in: returns the values of the passed arguments to the function

	if($func_num_args > 1){
		unset($func_get_args[0]);
		
		$fields = '`' . implode('`, `', $func_get_args) . '`';
		$data = mysql_fetch_assoc(mysql_query("SELECT $fields FROM `missing_person` WHERE `id`=$id"));
		return $data;
	}
}

function fir_data($complain_id){
	$data = array();
	$complain_id = sanitize($complain_id);
	
	$func_num_args = func_num_args();    //built in: returns no. of arguments passed to the function 
	$func_get_args = func_get_args();    //built in: returns the values of the passed arguments to the function

	if($func_num_args > 1){
		unset($func_get_args[0]);
		
		$fields = '`' . implode('`, `', $func_get_args) . '`';
		$data = mysql_fetch_assoc(mysql_query("SELECT $fields FROM `fir` WHERE `fir_no` = '$complain_id'"));
		return $data;
	}
}

function fir_data_from_fir_id($fir_id){
	$data = array();
	$fir_id = sanitize($fir_id);
	
	$func_num_args = func_num_args();    //built in: returns no. of arguments passed to the function 
	$func_get_args = func_get_args();    //built in: returns the values of the passed arguments to the function

	if($func_num_args > 1){
		unset($func_get_args[0]);
		
		$fields = '`' . implode('`, `', $func_get_args) . '`';
		$data = mysql_fetch_assoc(mysql_query("SELECT $fields FROM `fir` WHERE `fir_id` = '$fir_id'"));
		return $data;
	}
}

function poll_vote_data($user_id, $poll_id){
	$data = array();
	$user_id = (int)$user_id;
	$poll_id = (int)$poll_id;
	$func_num_args = func_num_args();    //built in: returns no. of arguments passed to the function 
	$func_get_args = func_get_args();    //built in: returns the values of the passed arguments to the function

	if($func_num_args > 2){
		unset($func_get_args[0]);
		unset($func_get_args[1]);
		$fields = '`' . implode('`, `', $func_get_args) . '`';
		$data = mysql_fetch_assoc(mysql_query("SELECT $fields FROM `poll_vote` WHERE `user_id` = $user_id AND `poll_id` = $poll_id"));
		return $data;
	}
}

function contact_data($contact_id){
	$data = array();
	$contact_id = (int)$contact_id;
	
	$func_num_args = func_num_args();    //built in: returns no. of arguments passed to the function 
	$func_get_args = func_get_args();    //built in: returns the values of the passed arguments to the function

	if($func_num_args > 1){
		unset($func_get_args[0]);
		
		$fields = '`' . implode('`, `', $func_get_args) . '`';
		$data = mysql_fetch_assoc(mysql_query("SELECT $fields FROM `contacts` WHERE `number` = $contact_id"));
		return $data;
	}
}

function register_user($register_data){
	array_walk($register_data, 'array_sanitize');
	$register_data['password'] = md5($register_data['password']);
	$fields = '`'.implode('`, `', array_keys($register_data)).'`';
    $data = '\''.implode('\', \'', $register_data).'\'';
	mysql_query("INSERT INTO `users`($fields) VALUES($data)");
	send_email($register_data['first_name'], $register_data['last_name'], $register_data['email'], 'Activate your account', 'Hi '. $register_data['first_name'].' '. $register_data['last_name'].'!<br><br>You need to activate your account. Use the link below:<br><br>Activation Link: <a href="http://localhost/CMPortal/activate.php?email='.$register_data['email'].'&code='.$register_data['active'].'">http://www.cmportal.com/activate.php</a><br><br>Thank you,<br><br> -enquirysquad');
}

function register_missing_person($register_missing_data){
	array_walk($register_missing_data, 'array_sanitize');
	$fields = '`'.implode('`, `', array_keys($register_missing_data)).'`';
    $data = '\''.implode('\', \'', $register_missing_data).'\'';
	mysql_query("INSERT INTO `missing_person`($fields) VALUES($data)");
}

function register_fir($register_fir, $phone_number){
	array_walk($register_fir, 'array_sanitize');
	$fields = '`'.implode('`, `', array_keys($register_fir)).'`';
    $data = '\''.implode('\', \'', $register_fir).'\'';
	mysql_query("INSERT INTO `fir`($fields) VALUES($data)");
	send_email($register_fir['first_name'], $register_fir['last_name'], $register_fir['user_email'], 'User Copy of the First Informtion Report(F.I.R.)', 'Hi '. $register_fir['first_name'].' '. $register_fir['last_name'].'!<br><br>Here is the user copy of the First Information Report that you have regidtered recently:<br><br>Complain id: '.$register_fir['fir_no'].'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Date: '.$register_fir['date'].'<br><br><br><br><b>'.$register_fir['crime_main'].'</b><br><br><br><b>'.$register_fir['crime_sub'].'</b><br><br><br><br><b>Statement:</b> '.$register_fir['statement'].'<br><br>Please do not delete this email.<br><br>Thank you,<br><br> -enquirysquad');
	send_sms($phone_number, 'Your FIR has been lodged successfully with the FIR no. '.$register_fir['fir_no'].' on '.$register_fir['date'].'. You can track your FIR status anytime from our website.');
}

function register_confidential_data($register_confidential_data){
	array_walk($register_confidential_data, 'array_sanitize');
	$fields = '`'.implode('`, `', array_keys($register_confidential_data)).'`';
    $data = '\''.implode('\', \'', $register_confidential_data).'\'';
	mysql_query("INSERT INTO `confidential_data`($fields) VALUES($data)");
}

function contact_user($contact_data){
	array_walk($contact_data, 'array_sanitize');
	
	$fields = '`'.implode('`, `', array_keys($contact_data)).'`';
    $data = '\''.implode('\', \'', $contact_data).'\'';
	mysql_query("INSERT INTO `contacts`($fields) VALUES($data)");
	send_email($contact_data['first_name'], $contact_data['last_name'], $contact_data['email'], 'Query Submitted Successfully', 'Hi '. $contact_data['first_name'].' '. $contct_data['last_name'].'!<br><br>Your query about <b>'.$contact_data['subject'].'</b> has reached to us. We will reach you shortly.<br><br>Thank you for your patience,<br><br>If you\'ve not raised this query, ignore this mail.<br><br>&nbsp;&nbsp;&nbsp; -enquirysquad');
}

function login($username, $password){
	$user_id = user_id_from_username($username);
	$username = sanitize($username);
	$password = md5($password);
	$query = mysql_query("SELECT COUNT(`user_id`) FROM `users` WHERE `username` = '$username' AND `password` = '$password'");
	return (mysql_result($query, 0) == 1) ? $user_id : false;
}

function update_user($user_id, $update_data){
	$update = array();
	array_walk($update_data, 'array_sanitize');
	foreach($update_data as $fields => $data){
		$update[] = '`'.$fields.'` = \''.$data.'\''; 
	}
	mysql_query("UPDATE `users` SET " . implode(', ', $update) . " WHERE `user_id` = $user_id");
}

function change_password($user_id, $password){
	$user_id = (int)$user_id;
	$password = md5($password);
	mysql_query("UPDATE `users` SET `password` = '$password', `password_recover` = 0 WHERE `user_id` = $user_id");
}

function recover($mode, $email){
	$mode = sanitize($mode);
	$email = sanitize($email);
	$user_id = user_id_from_email($email);
	$user_data = user_data($user_id, 'user_id', 'username', 'first_name', 'last_name', 'email');
	
	if($mode === 'username'){
		send_email($user_data['first_name'], $user_data['last_name'], $user_data['email'], 'Username Recovery', 'Hi '.$user_data['first_name'].' '. $user_data['last_name'].'!<br><br>Your username: '.$user_data['username'].'<br><br>Thank you,<br><br> -enquirysquad');
	}else if($mode === 'password'){
		$generated_password = substr(md5(rand(1,9999)), 0, 8);
		change_password($user_id, $generated_password);
		update_user($user_data['user_id'], array('password_recover' => 1));
		send_email($user_data['first_name'], $user_data['last_name'], $user_data['email'], 'Password Recovery', 'Hi '.$user_data['first_name'].' '. $user_data['last_name'].'!<br><br>Your password has been reset.<br>Temporary Password: '.$generated_password.'<br><br>Login with this password to change it.<br><br>Thank you,<br><br> -enquirysquad');	
	}
}

function activate($email, $code){
	$email = sanitize($email);
	$code = sanitize($code);
	
	$query = mysql_query("SELECT COUNT(`user_id`) FROM `users` WHERE `email` = '$email' AND `active` = '$code'");
	if(mysql_result($query, 0) == 1){
		mysql_query("UPDATE `users` SET `active` = 1, `deactivate_date` = '0000-00-00' WHERE `email` = '$email'");
		return true;
	}else{
		return false;
	}
}

function check_activation($email, $password, $code){
	$email = sanitize($email);
	$password = md5(sanitize($password));
	$code = sanitize($code);
	$user_id = user_id_from_email($email);
	$user_data = user_data($user_id, 'first_name', 'last_name');
	
	$query = mysql_query("SELECT COUNT(`user_id`) FROM `users` WHERE `email` = '$email' AND `password` = '$password' AND `active` != 1");
	if(mysql_result($query, 0) == 1){
		mysql_query("UPDATE `users` SET `active` = '$code' WHERE `email` = '$email' AND `password` = '$password'");
		send_email($user_data['first_name'], $user_data['last_name'], $email, 'Activate your account', 'Hi '. $user_data['first_name'].' '. $user_data['last_name'].'!<br><br>Activate your account.<br><br>Activation Link: <a href="http://localhost/CMPortal/activate.php?email='.$email.'&code='.$code.'">http://www.cmportal.com/activate.php</a><br><br>Thank you,<br><br>If you did not initiate this reactivtion request, then skip this mail and do not click the above link<br><br> -enquirysquad');
		return true;
	}else{
		return false;
	}
}

function deactivate($user_id){
	$user_id = (int)$user_id;
	$date = date("Y/m/d");
	mysql_query("UPDATE `users` SET `active` = 0, `deactivate_date` = '$date' WHERE `user_id` = $user_id");
}

function format_date($date){
	$day = substr($date, 0, 2);
	$find_day = array('1 ','2 ','3 ','4 ','5 ','6 ','7 ','8 ','9 ');
	$replace_day = array('01 ','02 ','03 ','04 ','05 ','06 ','07 ','08 ','09 ');
	$day = str_ireplace($find_day, $replace_day, $day);
	$find_month = array('January,','February,','March,','April,','May,','June,','July,','August,','September,','October,','November,','December,');
    $replace_month = array('01','02','03','04','05','06','07','08','09','10','11','12');
	$new_date = str_ireplace($find_month, $replace_month, $date);
	$month = substr($new_date, 3, 2);
	$year = strrev(substr(strrev($new_date), 0, 4));
	$date = $year.'-'.$month.'-'.$day;
	return $date;
}

function format_date_revert($date){ 
	$day = substr($date, 8, 2);
	$find_day = array('01','02','03','04','05','06','07','08','09');
	$replace_day = array('1','2','3','4','5','6','7','8','9');
	$day = str_ireplace($find_day, $replace_day, $day);
	$month = substr($date, 5, 2);
	$find_month = array('01','02','03','04','05','06','07','08','09','10','11','12');
    $replace_month = array('January','February','March','April','May','June','July','August','September','October','November','December');
	$month = str_ireplace($find_month, $replace_month, $month);
	$year = substr($date, 0, 4);
	$date = $day.' '.$month.', '.$year;
	return $date;
}

function user_active($username){
	$username = sanitize($username);
	$query = mysql_query("SELECT COUNT(`user_id`) FROM `users` WHERE `username` = '$username' AND `active` = 1");
	return (mysql_result($query, 0) == 1) ? true : false;
}

function user_exists($username){
	$username = sanitize($username);
	$query = mysql_query("SELECT COUNT(`user_id`) FROM `users` WHERE `username` = '$username'");
	return (mysql_result($query, 0) == 1) ? true : false;
}

function email_exists($email){
	$email = sanitize($email);
	$query = mysql_query("SELECT COUNT(`user_id`) FROM `users` WHERE `email` = '$email'");
	return (mysql_result($query, 0) == 1) ? true : false;
}

function phone_exists($phone){
	$phone = sanitize($phone);
	$query = mysql_query("SELECT COUNT(`user_id`) FROM `users` WHERE `phone` = '$phone'");
	return (mysql_result($query, 0) == 1) ? true : false;
}

function fir_exists($email){
	$email = sanitize($email);
	$query = mysql_query("SELECT COUNT(`fir_id`) FROM `fir` WHERE `user_email` = '$email'");
	return (mysql_result($query, 0) >= 1) ? true : false;
}

function fir_exists_by_id($complain_id){
	$complain_id = sanitize($complain_id);
	$query = mysql_query("SELECT COUNT(*) FROM `fir` WHERE `fir_no` = '$complain_id'");
	return (mysql_result($query, 0) == 1) ? true : false;
}

function user_id_from_username($username){
	$username = sanitize($username);
	$query = mysql_query("SELECT `user_id` FROM `users` WHERE `username` = '$username'");
	return mysql_result($query, 0, 'user_id');
}

function user_id_from_email($email){
	$email = sanitize($email);
	$query = mysql_query("SELECT `user_id` FROM `users` WHERE `email` = '$email'");
	return mysql_result($query, 0, 'user_id');
}

function user_count(){
	$query = mysql_query("SELECT COUNT(`user_id`) FROM `users`");
	return mysql_result($query, 0);
}

function user_active_count(){
	$query = mysql_query("SELECT COUNT(`user_id`) FROM `users` WHERE `active` = 1");
	return mysql_result($query, 0);
}

function missing_person_count(){
	return mysql_result(mysql_query("SELECT COUNT(*) FROM `missing_person`"),0);
}

function fir_count(){
	return mysql_result(mysql_query("SELECT COUNT(*) FROM `fir`"),0);
}

function contact_count(){
	$query = mysql_query("SELECT COUNT(`number`) FROM `contacts`");
	return mysql_result($query, 0);
}

function resolve_contact($contact_id){
	$contact_id = (int)$contact_id;
	mysql_query("UPDATE `contacts` SET `status` = 1 WHERE `number` = $contact_id");
}

function logged_in(){
	return (isset($_SESSION['user_id'])) ? true : false;
}

function change_profile_image($user_id, $file_path){
	mysql_query("UPDATE `users` SET `profile` = '$file_path' WHERE `user_id` = ".(int)$user_id);
}

function user_voted($user_id, $poll_id){
	$query = mysql_query("SELECT COUNT(`user_id`) FROM `poll_vote` WHERE `user_id` = $user_id AND `poll_id` = $poll_id");
	return (mysql_result($query, 0) == 1) ? true : false;
}

function upvote($user_id, $poll_id){
	$user_id = (int)$user_id;
	$poll_id = (int)$poll_id;
	if(user_voted($user_id, $poll_id) === true){
		mysql_query("UPDATE `poll_vote` SET `vote` = 1 WHERE `user_id` = $user_id AND `poll_id` = $poll_id");
	}else{	
		mysql_query("INSERT INTO `poll_vote`(`user_id`, `poll_id`, `vote`) VALUES($user_id, $poll_id, 1)");
	}
}

function downvote($user_id, $poll_id){
	$user_id = (int)$user_id;
	$poll_id = (int)$poll_id;
	if(user_voted($user_id, $poll_id) === true){
		mysql_query("UPDATE `poll_vote` SET `vote` = -1 WHERE `user_id` = $user_id AND `poll_id` = $poll_id");
	}else{	
		mysql_query("INSERT INTO `poll_vote`(`user_id`, `poll_id`, `vote`) VALUES($user_id, $poll_id, -1)");
	}
}

//Works with database image(BLOB) upload
/*function upload_image($user_id, $image){
	mysql_query("UPDATE `users` SET `image` = '$image' WHERE `user_id` = $user_id");
}*/

?>