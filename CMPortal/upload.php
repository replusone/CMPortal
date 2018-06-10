<?php
include_once 'core/init.php';
protect_page();
header('Content-type: application/json');

$uploaded = [];
$allowed = ['mp4', 'mp3', 'jpg', 'jpeg', 'txt', 'pdf'];
$succeeded = [];
$failed = [];
$data = [];
if(!empty($_FILES['file'])){
	foreach($_FILES['file']['name'] as $key => $name){
		if($_FILES['file']['error'][$key] === 0){
			$temp = $_FILES['file']['tmp_name'][$key];
			$ext = explode('.', $name);
			$ext = strtolower(end($ext));
			$file = md5_file($temp).time().'.'.$ext;
			if(in_array($ext, $allowed) === true && move_uploaded_file($temp, "confidential data/{$file}") === true){
				$succeeded[] = array(
					'name' => $name,
					'file' => $file
				); 
				$data[$key] = 'confidential data/'.$file;
			}else{
				$failed[] = array(
					'name' => $name
				);
			}
		}
	}
	$data = implode(',', $data);
	$register_confidential_data = array(
		'source' => $data,
	);
	register_confidential_data($register_confidential_data);
	if(!empty($_POST['ajax'])){
		echo json_encode(array(
			'succeeded' => $succeeded,
			'failed'    => $failed
		));
	}
}else{
	$errors[40] = '<font color="red"> Please choose a file</font>';
}
?>