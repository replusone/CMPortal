<?php
ob_start();
session_start();
//error_reporting(0); //not to reveal any directory structure to public

include 'database/connect.php';
include 'functions/general.php';
include 'functions/users.php';
include 'functions/dept.php';

$current_file = explode('/', $_SERVER['SCRIPT_NAME']);
$current_file = end($current_file);

if(logged_in() === true){
	$session_user_id = $_SESSION['user_id'];
	$user_data = user_data($session_user_id, 'user_id', 'username', 'password', 'password_recover', 'active','first_name', 'last_name', 'gender', 'date_of_birth', 'email', 'phone', 'address1', 'address2', 'address3', 'state', 'city', 'pincode', 'profile', 'admin');
	if(user_active($user_data['username']) === false){
		session_destroy();
		header('Location: index.php');
		exit();
	}
	if($current_file !== 'changepassword.php' && $current_file !== 'logout.php' && $user_data['password_recover'] == 1){
		header('Location: changepassword.php?force');
		exit();
	}
}
if(dept_logged_in() === true){
	$session_dept_user_id = $_SESSION['dept_user_id'];
	$dept_user_data = dept_user_data($session_dept_user_id, 'user_id', 'username', 'password', 'password_recover', 'first_name', 'last_name', 'email', 'state', 'city', 'profile', 'admin');
    if($current_file !== 'changepassword_dept.php' && $current_file !== 'logout.php' && $dept_user_data['password_recover'] == 1){
		header('Location: changepassword_dept.php?force');
		exit();
	}
}
$errors = array();
$code = substr(md5(rand(1000,9999)), 4, 8);
?>