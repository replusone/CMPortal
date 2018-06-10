<?php
include_once 'core/init.php';
if(logged_in() === false || $user_data['admin'] === 0 || dept_logged_in() === true){
	echo '<center><h1><font color="red">404 ERROR!! <br>PAGE NOT FOUND!</font></h1></center>';
	exit();
}
if(isset($_POST['text'])){
	$contact_id = $_POST['text'];
	resolve_contact($contact_id);
}
?>