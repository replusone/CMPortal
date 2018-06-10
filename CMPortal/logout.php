<?php
include_once 'core/init.php';
if(isset($_GET['deactivate']) && $_GET['deactivate'] === 'yes' && logged_in() === true){
	deactivate($user_data['user_id']);
	session_destroy();
	header('Location: index.php?deactivated');
}else{
	session_destroy();
	header('Location: index.php');	
}
?>