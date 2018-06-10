<style>
	#popupBoxSixPosition{
		top: 0; left: 0; 
		position: fixed; 
		width: 100%; 
		height: 100%;
		background-color: rgba(250,250,250,0.8); 
		display: none; 
		z-index: 1000;
	}
	#popupBoxSevenPosition{
		top: 0; left: 0; 
		position: fixed; 
		width: 100%; 
		height: 100%;
		background-color: rgba(250,250,250,0.8); 
		display: none; 
		z-index: 1000;
	}
</style>
<?php if(logged_in() === false && dept_logged_in() === false){ ?>
	
	<div id="popupBoxFourPosition">
		<div class="popupBoxWrapper">
			<div class="popupBoxContent">
				<?php include 'includes/widgets/login_dept.php'; ?>
			</div>
		</div>
	</div>
	
	<div id="popupBoxSevenPosition">
		<div class="popupBoxWrapper">
			<div class="popupBoxContent">
				<div class="form">
					<a href="javascript:void(0)" onclick="toggle_sidenav_visibility('popupBoxSevenPosition');" id="closewindow"><i class="material-icons">close</i></a>
					<p>
						Your account has been deactivated successfully. If you want to reavail the services, then pese reactivate.
					</p>
				</div>
			</div>
		</div>
	</div>
	
<?php } if(logged_in() === false){ ?>
	
	<div id="popupBoxThreePosition">
		<div class="popupBoxWrapper">
			<div class="popupBoxContent">
				<?php include 'includes/widgets/login.php'; ?>
			</div>
		</div>
	</div>

<?php } if(logged_in() === true){ ?>
    
	<div id="popupBoxTwoPosition">
		<div class="popupBoxWrapper">
			<div class="popupBoxContent">
			    <?php include 'includes/widgets/imageupload.php'; ?>
			</div>
		</div>
	</div>
	
	<div id="popupBoxSixPosition">
		<div class="popupBoxWrapper">
			<div class="popupBoxContent">
			    <?php include 'includes/widgets/vote.php'; ?>
			</div>
		</div>
	</div>

	<ul id="slide-out" class="side-nav">
		<li>
			<div class="userView">
				<div class="background"><img src="images/cover5.jpg" height="100%" width="100%"></div>
				<div class="circle"><img id="profile_sky" src="<?php if(empty($user_data['profile']) === false){echo $user_data['profile'];}else{echo 'images/profile/avatar.jpg';} ?>" alt="<?php echo $user_data['username']; ?>'s profile picture"></div>
				<a href="javascript:void(0)" target="_blank"><span class="white-text name"><?php echo $user_data['first_name'].' '.$user_data['last_name']; ?></span></a>
				<a href="http://gmail.com" target="_blank"><span class="white-text email"><?php echo $user_data['email']; ?></span></a>
			</div>
		</li>
		<li><a class="waves-effect" href="javascript:void(0)" onclick="toggle_sidenav_visibility('popupBoxTwoPosition');"><i class="material-icons">add_a_photo</i>UPDATE PROFILE IMAGE</a></li>
		<li><div class="divider"></div></li>
		<li><a class="waves-effect" href="updateprofile.php"><i class="material-icons">settings</i>UPDATE PROFILE</a></li>
		<li><div class="divider"></div></li>
		<li><a class="waves-effect" href="changepassword.php"><i class="material-icons">vpn_key</i>UPDATE PASSWORD</a></li>
		<li><div class="divider"></div></li>
		<li><a class="waves-effect" href="javascript:void(0)" onclick="toggle_sidenav_visibility('popupBoxSixPosition');"><i class="material-icons">thumbs_up_down</i>VOTE FOR RUNNING POLLS</a></li>
		<li><div class="divider"></div></li>
		<li><a class="waves-effect" href="logout.php?deactivate=yes"><i class="material-icons">do_not_disturb_on</i>DEACTIVATE ACCOUNT</a></li>
		<li><div class="divider"></div></li>
		<li><a class="waves-effect" href="logout.php"><i class="material-icons">exit_to_app</i>LOGOUT</a></li>
		<li><div class="divider"></div></li>
	</ul>
	
	<div id="button_collapse">
		<a id="menu_slider" href="javascript:void(0)" data-activates="slide-out" class="button-collapse grey-text text-darken-1"><i class="material-icons">menu</i></a>
	</div>
	
<?php } if(dept_logged_in() === true) {?>
	
	<div>
		<ul id="dropdown1" class="dropdown-content">
			<li><a class="waves-effect" href="javascript:void(0)" onclick="toggle_visibility('popupBoxFivePosition');">UPLOAD PROFILE IMAGE</a></li>
			<li class="divider"></li>
			<li><a class="waves-effect" href="changepassword_dept.php">UPDATE PASSWORD</a></li>
			<li class="divider"></li>
			<li><a class="waves-effect" href="logout.php">LOGOUT</a></li>
		</ul>
	</div>
	
	<div id="popupBoxFivePosition">
		<div class="popupBoxWrapper">
			<div class="popupBoxContent">
				<?php include_once 'includes/widgets/imageupload_dept.php'; ?>
			</div>
		</div>
	</div>
	
<?php } ?>

<nav class="grey lighten-4" role="navigation">
    <div class="nav-wrapper container">
        <div class="icon-block">
		    <?php if(dept_logged_in() === true){ ?>
				<a id="logo-container" href="manage.php" class="brand-logo tooltipped" data-position="right" data-delay="500" data-tooltip="Online Crime Management Portal"><i class="material-icons">local_activity</i></a>
			<?php }else{ ?>
				<a id="logo-container" href="index.php" class="brand-logo tooltipped" data-position="right" data-delay="500" data-tooltip="Online Crime Management Portal"><i class="material-icons">local_activity</i></a>
			<?php } ?>
		</div>
        
		<ul class="right hide-on-med-and-down">
		    <?php if(dept_logged_in() === true){ ?>
				<li><a href="manage.php">HOME</a></li>
				<li><a href="forum.php">FORUM</a></li>
				<li><a id="badge" href="#" class="dropdown grey-text text-darken-1" data-activates="dropdown1"><div class="menu_dept" id="menu"><img id="profile_sky" src="<?php if(empty($dept_user_data['profile']) === false){echo $dept_user_data['profile'];}else{echo 'images/profile/avatar.jpg';} ?>" alt="<?php echo $dept_user_data['username']; ?>'s profile picture"></div></a></li>
			<?php }else{ ?>
				<li><a href="index.php">HOME</a></li>
				<li><a href="report.php">REPORT & CHECK</a></li>
				<li><a href="forum.php#disqus_thread">FORUM</a></li>
			<?php global $user_data; if($user_data['admin'] == 1){ ?>
				<li><a href="admin.php">ADMIN SPACE</a></li>
			<?php }else{ ?>
				<li><a href="contact.php">GRIEVANCE REDRESSAL</a></li>
			<?php } if(logged_in() === false){ ?>
				<li><a href="javascript:void(0)" onclick="toggle_visibility('popupBoxThreePosition');">LOGIN | SIGN UP</a></li>
			<?php } } ?>
        </ul>
        
		<!--PASTE MOBILE VERSION CODE FROM ORIGINAL TEMPLATE HERE-->
		<!--<ul id="nav-mobile" class="side-nav">
			<?php if(dept_logged_in() === true){ ?>
				<li><a href="manage.php">HOME</a></li>
				<li><div class="divider"></div></li>
				<li><a href="forum.php">FORUM</a></li>
				<li><div class="divider"></div></li>
				<li><a id="badge" href="#" class="dropdown grey-text text-darken-1" data-activates="dropdown1"><div class="menu_dept" id="menu"><img id="profile_sky" src="<?php if(empty($dept_user_data['profile']) === false){echo $dept_user_data['profile'];}else{echo 'images/profile/avatar.jpg';} ?>" alt="<?php echo $dept_user_data['username']; ?>'s profile picture"></div></a></li>
			<?php }else{ ?>
				<li><a href="index.php">HOME</a></li>
				<li><div class="divider"></div></li>
				<li><a href="report.php">REPORT & CHECK</a></li>
				<li><div class="divider"></div></li>
				<li><a href="forum.php#disqus_thread">FORUM</a></li>
				<li><div class="divider"></div></li>
			<?php global $user_data; if($user_data['admin'] == 1){ ?>
				<li><a href="admin.php">ADMIN SPACE</a></li>
				<li><div class="divider"></div></li>
			<?php }else{ ?>
				<li><a href="contact.php">GRIEVANCE REDRESSAL</a></li>
				<li><div class="divider"></div></li>
			<?php } if(logged_in() === false){ ?>
				<li><a href="javascript:void(0)" onclick="toggle_visibility('popupBoxThreePosition');">LOGIN | SIGN UP</a></li>
			<?php } } ?>
		</ul>
		<a href="#" data-activates="nav-mobile" class="button-collapse"><i class="material-icons">menu</i></a>-->
	</div>
</nav>

<script type="text/javascript">
	<!--
	function toggle_sidenav_visibility(id) {
		var e = document.getElementById(id);
		if(e.style.display == 'block'){
			e.style.display = 'none';
		    $('.button-collapse').sideNav('show');
	    }
		else{
			e.style.display = 'block';
		    $('.button-collapse').sideNav('hide');
		}
	}
	function toggle_visibility(id) {
		var e = document.getElementById(id);
		if(e.style.display == 'block')
			e.style.display = 'none';
		else
			e.style.display = 'block';
	}
	//-->
</script>