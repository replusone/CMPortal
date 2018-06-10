<img src="images/up.png">
<?php
include_once 'core/init.php';
if(logged_in() === false){
	echo '<center><h1><font color="red">404 ERROR!! <br>PAGE NOT FOUND!</font></h1></center>';
	exit();
}
if(isset($_POST['text']) && isset($_POST['text1'])){
	$vote = $_POST['text'];
	$poll_id = $_POST['text1'];
	if($vote === 'on'){
		upvote($user_data['user_id'], $poll_id);
	}
}
?>