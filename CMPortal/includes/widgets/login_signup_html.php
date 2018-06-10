<?php 
logged_in_redirect();
?>
<div class="form">
	<a href="javascript:void(0)" onclick="toggle_visibility('popupBoxThreePosition');" id="closewindow"><i class="material-icons">close</i></a>
	<ul class="tab-group-exchange">
		<?php if(isset($_POST['login']) && empty($errors) === false){?>
			<li class="tab"><a href="#signup">Sign Up</a></li>
			<li class="tab active"><a href="#login">Log In</a></li>
		<?php }else{?>
			<li class="tab active"><a href="#signup">Sign Up</a></li>
			<li class="tab"><a href="#login">Log In</a></li>
		<?php }?>
	</ul>
	<div class="tab-content">
		<?php if(isset($_POST['login']) && empty($errors) === false){
			include 'includes/widgets/login_html.php';
			include 'includes/widgets/signup_html.php';
		}else{
			include 'includes/widgets/signup_html.php';
			include 'includes/widgets/login_html.php';
		}?>
	</div>
</div>
<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
