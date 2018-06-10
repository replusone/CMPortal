<?php 
include_once 'core/init.php';
include 'includes/overall/overall_header.php';
include 'includes/overall/overall_body.php';
include 'includes/overall/overall_footer.php';
if(isset($_GET['status']) && $_GET['status'] === 'loggedout'){
	echo '<script type="text/javascript">visible(\'popupBoxThreePosition\');</script>';
}
if(isset($_SESSION['dept_user_id']) && $_SESSION['dept_user_id'] !== null){
	header('Location: manage.php');
}
if(isset($_GET['deactivated']) && $_GET['deactivated'] === ''){
	echo '<script type="text/javascript">toggle_visibility(\'popupBoxSevenPosition\');</script>';
}
?>
<script type="text/javascript">
	<!--
	function toggle_visibility(id) {
		var e = document.getElementById(id);
		if(e.style.display == 'block')
			e.style.display = 'none';
		else
			e.style.display = 'block';
	}
	//-->
</script>

