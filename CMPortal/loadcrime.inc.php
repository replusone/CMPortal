<?php
include_once 'core/init.php';
if(isset($_POST['text'])){
	$crime_main = $_POST['text'];
	if(!empty($crime_main)){
		if(isset($_POST['text']) && !empty($_POST['text1'])){
			$crime_selected = $_POST['text1'];
		}
		if($crime_main === 'Personal Crimes'){
		    ?>
			<select name="crime_sub" id="crime_sub">
			    <option value="default" disabled selected>Choose a crime sub-category</option>
				<option value="Assault" <?php if(logged_in() === true && isset($crime_selected) && $crime_selected === 'Assault'){echo 'selected';}?>>Assault</option>
				<option value="Battery" <?php if(logged_in() === true && isset($crime_selected) && $crime_selected === 'Battery'){echo 'selected';}?>>Battery</option>
				<option value="False Imprisonment" <?php if(logged_in() === true && isset($crime_selected) && $crime_selected === 'False Imprisonment'){echo 'selected';}?>>False Imprisonment</option>
				<option value="Kidnapping" <?php if(logged_in() === true && isset($crime_selected) && $crime_selected === 'Kidnapping'){echo 'selected';}?>>Kidnapping</option>
				<option value="Homicide" <?php if(logged_in() === true && isset($crime_selected) && $crime_selected === 'Homicide'){echo 'selected';}?>>Homicide</option>
				<option value="Statutory Rape" <?php if(logged_in() === true && isset($crime_selected) && $crime_selected === 'Statutory Rape'){echo 'selected';}?>>Statutory Rape</option>
			</select>
			<label>Crime Sub-category</label>
			<?php
		}else if($crime_main === 'Property Crimes'){
			?>
			<select name="crime_sub" id="crime_sub">
			    <option value="default" disabled selected>Choose a crime sub-category</option>
				<option value="Larceny" <?php if(logged_in() === true && isset($crime_selected) && $crime_selected === 'Larceny'){echo 'selected';}?>>Larceny</option>
				<option value="Robbery" <?php if(logged_in() === true && isset($crime_selected) && $crime_selected === 'Robbery'){echo 'selected';}?>>Robbery</option>
				<option value="Burglary (penalties for burglary)" <?php if(logged_in() === true && isset($crime_selected) && $crime_selected === 'Burglary (penalties for burglary)'){echo 'selected';}?>>Burglary (penalties for burglary)</option>
				<option value="Arson" <?php if(logged_in() === true && isset($crime_selected) && $crime_selected === 'Arson'){echo 'selected';}?>>Arson</option>
				<option value="Embezzlement" <?php if(logged_in() === true && isset($crime_selected) && $crime_selected === 'Embezzlement'){echo 'selected';}?>>Embezzlement</option>
				<option value="Forgery" <?php if(logged_in() === true && isset($crime_selected) && $crime_selected === 'Forgery'){echo 'selected';}?>>Forgery</option>
				<option value="False Pretenses" <?php if(logged_in() === true && isset($crime_selected) && $crime_selected === 'False Pretenses'){echo 'selected';}?>>False Pretenses</option>
				<option value="Receipt of Stolen Goods" <?php if(logged_in() === true && isset($crime_selected) && $crime_selected === 'Receipt of Stolen Goods'){echo 'selected';}?>>Receipt of Stolen Goods</option>
			</select>
			<label>Crime Sub-category</label>
			<?php
		}else if($crime_main === 'Inchoate Crimes'){
			?>
			<select name="crime_sub" id="crime_sub">
			    <option value="default" disabled selected>Choose a crime sub-category</option>
				<option value="Attempt" <?php if(logged_in() === true && isset($crime_selected) && $crime_selected === 'Attempt'){echo 'selected';}?>>Attempt</option>
				<option value="Solicitation" <?php if(logged_in() === true && isset($crime_selected) && $crime_selected === 'Solicitation'){echo 'selected';}?>>Solicitation</option>
				<option value="Conspiracy" <?php if(logged_in() === true && isset($crime_selected) && $crime_selected === 'Conspiracy'){echo 'selected';}?>>Conspiracy</option>
			</select>
			<label>Crime Sub-category</label>
			<?php
		}else if($crime_main === 'Statutory Crimes'){
			?>
			<select name="crime_sub" id="crime_sub">
			    <option value="default" disabled selected>Choose a crime sub-category/option>
				<option value="Drug Crimes" <?php if(logged_in() === true && isset($crime_selected) && $crime_selected === 'Drug Crimes'){echo 'selected';}?>>Drug Crimes</option>
				<option value="Drunk Driving (DUI)" <?php if(logged_in() === true && isset($crime_selected) && $crime_selected === 'Drunk Driving (DUI)'){echo 'selected';}?>>Drunk Driving (DUI)</option>
				<option value="Selling Alcohol/Drugs to Minors" <?php if(logged_in() === true && isset($crime_selected) && $crime_selected === 'Selling Alcohol/Drugs to Minors'){echo 'selected';}?>>Selling Alcohol/Drugs to Minors</option>
			</select>
			<label>Crime Sub-category</label>
			<?php
		}else{
			?>
			<select name="crime_sub" id="crime_sub">
			    <option value="default" disabled selected>Choose a crime category first</option>
			</select>
			<label>Crime Sub-category</label>
			<?php
		}
	}else{
		?>
		<select name="crime_sub" id="crime_sub">
			<option value="default" disabled selected>Choose a crime category first</option>
		</select>
		<label>Crime Sub-category</label>
		<?php
	}
}
?>