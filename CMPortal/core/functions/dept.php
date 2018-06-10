<?php
function dept_change_profile_image($user_id, $file_path){
	mysql_query("UPDATE `department` SET `profile` = '$file_path' WHERE `user_id` = ".(int)$user_id);
}

function register_dept_user($register_dept_data){
	array_walk($register_dept_data, 'array_sanitize');
	$password = $register_dept_data['password'];
	$register_dept_data['password'] = md5($register_dept_data['password']);
	$fields = '`'.implode('`, `', array_keys($register_dept_data)).'`';
    $data = '\''.implode('\', \'', $register_dept_data).'\'';
	mysql_query("INSERT INTO `department`($fields) VALUES($data)");
	send_email($register_dept_data['first_name'], $register_dept_data['last_name'], $register_dept_data['email'], 'Account created successfully', 'Hi '. $register_dept_data['first_name'].' '. $register_dept_data['last_name'].'!<br><br>Your account has been created successfully with username: '.$register_dept_data['username'].' and password: '.$password.'. We insist you to change your password after first time login.<br><br>Thank you,<br><br> -enquirysquad');
}

function dept_recover($mode, $email){
	$mode = sanitize($mode);
	$email = sanitize($email);
	$user_id = dept_user_id_from_email($email);
	$dept_user_data = dept_user_data($user_id, 'user_id', 'username', 'first_name', 'last_name', 'email');
	
	if($mode === 'username'){
		send_email($dept_user_data['first_name'], $dept_user_data['last_name'], $dept_user_data['email'], 'Username Recovery', 'Hi '.$dept_user_data['first_name'].' '. $dept_user_data['last_name'].'!<br><br>Your username: '.$dept_user_data['username'].'<br><br>Thank you,<br><br> -enquirysquad');
	}else if($mode === 'password'){
		$generated_password = substr(md5(rand(1,9999)), 0, 8);
		dept_change_password($user_id, $generated_password);
		dept_update_user($dept_user_data['user_id'], array('password_recover' => 1));
		send_email($dept_user_data['first_name'], $dept_user_data['last_name'], $dept_user_data['email'], 'Password Recovery', 'Hi '.$dept_user_data['first_name'].' '. $dept_user_data['last_name'].'!<br><br>Your password has been reset.<br>Temporary Password: '.$generated_password.'<br><br>Login with this password to change it.<br><br>Thank you,<br><br> -enquirysquad');	
	}
}


function dept_change_password($user_id, $password){
	$user_id = (int)$user_id;
	$password = md5($password);
	mysql_query("UPDATE `department` SET `password` = '$password', `password_recover` = 0 WHERE `user_id` = $user_id");
}


function dept_update_user($user_id, $update_data){
	$update = array();
	array_walk($update_data, 'array_sanitize');
	foreach($update_data as $fields => $data){
		$update[] = '`'.$fields.'` = \''.$data.'\''; 
	}
	mysql_query("UPDATE `department` SET " . implode(', ', $update) . " WHERE `user_id` = $user_id");
}

function dept_user_data($user_id){
	$data = array();
	$user_id = (int)$user_id;
	
	$func_num_args = func_num_args();    //built in: returns no. of arguments passed to the function 
	$func_get_args = func_get_args();    //built in: returns the values of the passed arguments to the function

	if($func_num_args > 1){
		unset($func_get_args[0]);
		
		$fields = '`' . implode('`, `', $func_get_args) . '`';
		$data = mysql_fetch_assoc(mysql_query("SELECT $fields FROM `department` WHERE `user_id` = $user_id"));
		return $data;
	}
}

function dept_logged_in(){
	return (isset($_SESSION['dept_user_id'])) ? true : false;
}

function dept_user_exists($username){
	$username = sanitize($username);
	$query = mysql_query("SELECT COUNT(`user_id`) FROM `department` WHERE `username` = '$username'");
	return (mysql_result($query, 0) == 1) ? true : false;
}

function dept_email_exists($email){
	$email = sanitize($email);
	$query = mysql_query("SELECT COUNT(`user_id`) FROM `department` WHERE `email` = '$email'");
	return (mysql_result($query, 0) == 1) ? true : false;
}

function dept_phone_exists($phone){
	$phone = sanitize($phone);
	$query = mysql_query("SELECT COUNT(`user_id`) FROM `department` WHERE `phone` = '$phone'");
	return (mysql_result($query, 0) == 1) ? true : false;
}

function dept_badge_no_exists($badge_no){
	$badge_no = sanitize($badge_no);
	$query = mysql_query("SELECT COUNT(`user_id`) FROM `department` WHERE `badge_no` = '$badge_no'");
	return (mysql_result($query, 0) == 1) ? true : false;
}

function dept_user_id_from_username($username){
	$username = sanitize($username);
	$query = mysql_query("SELECT `user_id` FROM `department` WHERE `username` = '$username'");
	return mysql_result($query, 0, 'user_id');
}

function dept_user_id_from_email($email){
	$email = sanitize($email);
	$query = mysql_query("SELECT `user_id` FROM `department` WHERE `email` = '$email'");
	return mysql_result($query, 0, 'user_id');
}

function dept_login($username, $password){
	$user_id = dept_user_id_from_username($username);
	$username = sanitize($username);
	$password = md5($password);
	$query = mysql_query("SELECT COUNT(`user_id`) FROM `department` WHERE `username` = '$username' AND `password` = '$password'");
	return (mysql_result($query, 0) == 1) ? $user_id : false;
}

function register_poll($register_poll){
	array_walk($register_poll, 'array_sanitize');
	$fields = '`'.implode('`, `', array_keys($register_poll)).'`';
    $data = '\''.implode('\', \'', $register_poll).'\'';
	mysql_query("INSERT INTO `poll`($fields) VALUES($data)");
}

function poll_counts(){
	$query = mysql_query("SELECT COUNT(`poll_id`) FROM `poll`");
	return mysql_result($query, 0);
}

function poll_counts_by_region($state, $city){
	$state = sanitize($state);
	$city  = sanitize($city);
	$query = mysql_query("SELECT COUNT(`poll_id`) FROM `poll` WHERE `poll_state` = '$state' AND `poll_city` = '$city'");
	return mysql_result($query, 0);
}

function poll_active_counts_by_region($state, $city){
	$state = sanitize($state);
	$city  = sanitize($city);
	$query = mysql_query("SELECT COUNT(`poll_id`) FROM `poll` WHERE `poll_state` = '$state' AND `poll_city` = '$city' AND `active` = 1");
	return mysql_result($query, 0);
}

function poll_data($id){
	$data = array();
	$id    = (int)$id;
	$func_num_args = func_num_args();    //built in: returns no. of arguments passed to the function 
	$func_get_args = func_get_args();    //built in: returns the values of the passed arguments to the function

	if($func_num_args > 1){
		unset($func_get_args[0]);
		$fields = '`' . implode('`, `', $func_get_args) . '`';
		$data = mysql_fetch_assoc(mysql_query("SELECT $fields FROM `poll` WHERE `poll_id` = $id"));
		return $data;
	}
}

function delete_poll($poll_id){
	$poll_id = (int)$poll_id;
	mysql_query("UPDATE `poll` SET `active` = 0 WHERE `poll_id` = $poll_id");
	mysql_query("DELETE FROM `poll_vote` WHERE `poll_id` = $poll_id");
}

function update_vote($poll_id){
	$poll_id = (int)$poll_id;
	$upvote = mysql_result(mysql_query("SELECT COUNT(*) FROM `poll_vote` WHERE `poll_id` = $poll_id AND `vote` = 1"), 0);
	$downvote = mysql_result(mysql_query("SELECT COUNT(*) FROM `poll_vote` WHERE `poll_id` = $poll_id AND `vote` < 1"), 0);
	$upvote = (int)$upvote;
	$downvote = (int)$downvote;
	mysql_query("UPDATE `poll` SET `up_vote` = $upvote, `down_vote` = $downvote WHERE `poll_id` = $poll_id");
}

function change_fir_status($fir_id, $fir_status){
	$fir_id = (int)$fir_id;
	mysql_query("UPDATE `fir` SET `status` = '$fir_status' WHERE `fir_id` = $fir_id");
}

function fir_initiated(){
	$query = mysql_query("SELECT COUNT(`fir_id`) FROM `fir` WHERE `status` = 0");
	return mysql_result($query, 0);
}

function fir_processing(){
	$query = mysql_query("SELECT COUNT(`fir_id`) FROM `fir` WHERE `status` = 1");
	return mysql_result($query, 0);
}

function fir_verified(){
	$query = mysql_query("SELECT COUNT(`fir_id`) FROM `fir` WHERE `status` = 2");
	return mysql_result($query, 0);
}

function dept_user_count(){
	$query = mysql_query("SELECT COUNT(`user_id`) FROM `department`");
	return mysql_result($query, 0);
}
?>