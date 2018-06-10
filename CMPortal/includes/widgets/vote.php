<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/CMPortal/core/init.php';
if(logged_in() === false){
	echo '<center><h1><font color="red">404 ERROR!! <br>PAGE NOT FOUND!</font></h1></center>';
	exit();
}
$poll_counts = poll_counts();
$poll_counts_by_region = poll_counts_by_region($user_data['state'], $user_data['city']);
$poll_active_counts_by_region = poll_active_counts_by_region($user_data['state'], $user_data['city']);
?>
<div class="form">
	<a href="javascript:void(0)" onclick="toggle_sidenav_visibility('popupBoxSixPosition');" id="closewindow"><i class="material-icons">close</i></a>
	<?php 
	if($poll_active_counts_by_region >= 1){
		for($i = 1; $i <= $poll_counts; $i++){
			$poll_data = poll_data($i, 'poll_topic', 'poll_state', 'poll_city', 'up_vote', 'down_vote', 'active');
			if($poll_data['active'] == 1 && $poll_data['poll_state'] == $user_data['state'] && $poll_data['poll_city'] == $user_data['city']){
				$poll_vote_data = poll_vote_data($user_data['user_id'], $i, 'vote');
				?>
				<form action="" method="post">
					<div class="divider"></div>
					<div class="row">
						<div class="input-field col s10">
							<a href="javascript:void(0)"><?php echo $poll_data['poll_topic']; ?></a>
						</div>
						<div class="input-field col s1">
							<a href="javascript:void(0)" id="like<?php echo $i; ?>" onclick="like(<?php echo $i; ?>);">
								<?php if($poll_vote_data['vote'] == 1){?>
								<img src="images/up.png">
								<?php }else{ ?>
								<img src="images/up_off.png">
								<?php } ?>
							</a>
						</div>
						<div class="input-field col s1">
							<a href="javascript:void(0)" id="dislike<?php echo $i; ?>" onclick="dislike(<?php echo $i; ?>);">
								<?php if($poll_vote_data['vote'] == -1){?>
								<img src="images/down.png">
								<?php }else{ ?>
								<img src="images/down_offf.png">
								<?php } ?>
							</a>
						</div>
					</div>
					<div class="divider"></div>
				</form>
				<?php 
			} 
		} 
	}else{ 
		echo 'There is no active poll running.'; 
	} 
	?>
</div>
<script type="text/javascript">
    <!--
	function like(c){
		//var city = "<?php if(isset($city)){ echo $city; } ?>";
		if(window.XMLHttpRequest){
			xmlhttp = new XMLHttpRequest();
		}else{
			xmlhttp = new ActiveXObject('Microsoft.XMLHTTP');
		}
		
		xmlhttp.onreadystatechange = function(){
			if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
				document.getElementById('like'+c).innerHTML = xmlhttp.responseText;
			}
		}
		
		
		parameters = 'text=on'+'&text1='+c;
		//parameters = 'text='+val;
		
		xmlhttp.open('POST', 'like.php', true);
		xmlhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
		xmlhttp.send(parameters);
	    document.getElementById('dislike'+c).innerHTML = '<img src="images/down_offf.png">';
	}
	function dislike(c){
		//var city = "<?php if(isset($city)){ echo $city; } ?>";
		if(window.XMLHttpRequest){
			xmlhttp = new XMLHttpRequest();
		}else{
			xmlhttp = new ActiveXObject('Microsoft.XMLHTTP');
		}
		
		xmlhttp.onreadystatechange = function(){
			if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
				document.getElementById('dislike'+c).innerHTML = xmlhttp.responseText;
			}
		}
		
		
		parameters = 'text=off'+'&text1='+c;
		//parameters = 'text='+val;
		
		xmlhttp.open('POST', 'dislike.php', true);
		xmlhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
		xmlhttp.send(parameters);
	    document.getElementById('like'+c).innerHTML = '<img src="images/up_off.png">';
	}
	-->
</script>