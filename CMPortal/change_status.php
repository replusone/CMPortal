<?php
include_once 'core/init.php';
if(dept_logged_in() === false){
	echo '<center><h1><font color="red">404 ERROR!! <br>PAGE NOT FOUND!</font></h1></center>';
	exit();
}
if(isset($_POST['text']) && isset($_POST['text1'])){
	$status = $_POST['text'];
	$id = $_POST['text1'];
	change_fir_status($id, $status);
}
?>