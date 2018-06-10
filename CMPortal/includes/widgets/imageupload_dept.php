<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/CMPortal/core/init.php';
if(dept_logged_in() === false){
	echo '<center><h1><font color="red">404 ERROR!! <br>PAGE NOT FOUND!</font></h1></center>';
	exit();
}
if(isset($_POST['profile_dept']) === true){
	if(empty($_POST['profile_dept']) === true){
		$errors[1] = '<font color="red"> please choose a file</font>';
	}else{
		$file_path = $_POST['profile_dept'];
		dept_change_profile_image($session_dept_user_id, $file_path);
		header('Location: '.$current_file);
	    exit();
	}
}
?>
<head>
    <meta name="viewport" content="width=device-width,initial-scale=1">
	<style>
	    .uploadcare-widget-button-open{
			background: #26a69a;
			border-radius: 3px;
			padding: 20px;
			text-transform: uppercase;
		}
		.uploadcare-widget-button-open:hover{
			background: #2bbbad;
		}
		.uploadcare-widget-dragndrop-area{
			min-height: 200%;
			top: 10%;
			left: -1.2em;
		}
		.uploadcare-widget-circle{
			color: #26a69a;
		}
	</style>
</head>
<div class="form1">
    <a href="javascript:void(0)" onclick="toggle_sidenav_visibility('popupBoxFivePosition');" id="closewindow"><i class="material-icons">close</i></a>
	<form action="" method="post" enctype="multipart/form-data">
		<div class="row">
		    <div class="col s12">
				<input 
					name="profile_dept"
					type="hidden" 
					role="uploadcare-uploader"
					data-crop="1:1"
					data-images-only="true" 
					data-clearable="true"
					data-image-shrink="400x400"
				/>
			</div>
		</div>
		<div class="row">
		    <div class="input-field col s12">
				<input type="submit" class="btn-large" name="upload_dept" value="UPLOAD"/><br>
			</div>
		</div>
		<div class="row">
		    <div class="input-field col s12">
			<?php 
				if(isset($errors[1])){
					echo '<style>#popupBoxTwoPosition{ display: block; }</style>';
					echo $errors[1]; 
				}
			?>
			</div>
		</div>
    </form>
</div>
<script>
    UPLOADCARE_LOCALE = "en";
    UPLOADCARE_TABS = "file url facebook gdrive dropbox instagram evernote flickr skydrive";
    UPLOADCARE_PUBLIC_KEY = "c84a47a4c93b9b13be1a";
</script>
<script charset="utf-8" src="//ucarecdn.com/libs/widget/2.10.3/uploadcare.full.min.js"></script>
