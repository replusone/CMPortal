<?php
include_once 'core/init.php';
if(isset($_POST['text'])){
	$state = $_POST['text'];
	if(!empty($state)){
		if(isset($_POST['text']) && !empty($_POST['text1'])){
			$city_selected = $_POST['text1'];
		}
		if($state === 'West Bengal'){
		    ?>
			<label>City*</label>&nbsp;
			<select name="city" id="city">
			    <option value="default" disabled selected>Select City</option>
				<option value="Kolkata" <?php if(logged_in() === true){if($user_data['city'] === 'Kolkata'){echo 'selected';}}else if(isset($city_selected) && $city_selected === 'Kolkata'){echo 'selected';}?>>Kolkata</option>
				<option value="Asansol" <?php if(logged_in() === true){if($user_data['city'] === 'Asansol'){echo 'selected';}}else if(isset($city_selected) && $city_selected === 'Asansol'){echo 'selected';}?>>Asansol</option>
				<option value="Siliguri" <?php if(logged_in() === true){if($user_data['city'] === 'Siliguri'){echo 'selected';}}else if(isset($city_selected) && $city_selected === 'Siliguri'){echo 'selected';}?>>Siliguri</option>
				<option value="Durgapur" <?php if(logged_in() === true){if($user_data['city'] === 'Durgapur'){echo 'selected';}}else if(isset($city_selected) && $city_selected === 'Durgapur'){echo 'selected';}?>>Durgapur</option>
				<option value="Bardhaman" <?php if(logged_in() === true){if($user_data['city'] === 'Bardhaman'){echo 'selected';}}else if(isset($city_selected) && $city_selected === 'Bardhaman'){echo 'selected';}?>>Bardhaman</option>
				<option value="English Bazar" <?php if(logged_in() === true){if($user_data['city'] === 'English Bazar'){echo 'selected';}}else if(isset($city_selected) && $city_selected === 'English Bazar'){echo 'selected';}?>>English Bazar</option>
				<option value="Baharampur" <?php if(logged_in() === true){if($user_data['city'] === 'Baharampur'){echo 'selected';}}else if(isset($city_selected) && $city_selected === 'Baharampur'){echo 'selected';}?>>Baharampur</option>
				<option value="Habra" <?php if(logged_in() === true){if($user_data['city'] === 'Habra'){echo 'selected';}}else if(isset($city_selected) && $city_selected === 'Habra'){echo 'selected';}?>>Habra</option>
				<option value="Kharagpur" <?php if(logged_in() === true){if($user_data['city'] === 'Kharagpur'){echo 'selected';}}else if(isset($city_selected) && $city_selected === 'Kharagpur'){echo 'selected';}?>>Kharagpur</option>
				<option value="Shantipur" <?php if(logged_in() === true){if($user_data['city'] === 'Shantipur'){echo 'selected';}}else if(isset($city_selected) && $city_selected === 'Shantipur'){echo 'selected';}?>>Shantipur</option>
				<option value="Dankuni" <?php if(logged_in() === true){if($user_data['city'] === 'Dankuni'){echo 'selected';}}else if(isset($city_selected) && $city_selected === 'Dankuni'){echo 'selected';}?>>Dankuni</option>
				<option value="Dhulian" <?php if(logged_in() === true){if($user_data['city'] === 'Dhulian'){echo 'selected';}}else if(isset($city_selected) && $city_selected === 'Dhulian'){echo 'selected';}?>>Dhulian</option>
				<option value="Ranaghat" <?php if(logged_in() === true){if($user_data['city'] === 'Ranaghat'){echo 'selected';}}else if(isset($city_selected) && $city_selected === 'Ranaghat'){echo 'selected';}?>>Ranaghat</option>
				<option value="Haldia" <?php if(logged_in() === true){if($user_data['city'] === 'Haldia'){echo 'selected';}}else if(isset($city_selected) && $city_selected === 'Haldia'){echo 'selected';}?>>Haldia</option>
				<option value="Raiganj" <?php if(logged_in() === true){if($user_data['city'] === 'Raiganj'){echo 'selected';}}else if(isset($city_selected) && $city_selected === 'Raiganj'){echo 'selected';}?>>Raiganj</option>
				<option value="Krishnanagar" <?php if(logged_in() === true){if($user_data['city'] === 'Krishnanagar'){echo 'selected';}}else if(isset($city_selected) && $city_selected === 'Krishnanagar'){echo 'selected';}?>>Krishnanagar</option>
				<option value="Nabadwip" <?php if(logged_in() === true){if($user_data['city'] === 'Nabadwip'){echo 'selected';}}else if(isset($city_selected) && $city_selected === 'Nabadwip'){echo 'selected';}?>>Nabadwip</option>
				<option value="Medinipur" <?php if(logged_in() === true){if($user_data['city'] === 'Medinipur'){echo 'selected';}}else if(isset($city_selected) && $city_selected === 'Medinipur'){echo 'selected';}?>>Medinipur</option>
				<option value="Jalpaiguri" <?php if(logged_in() === true){if($user_data['city'] === 'Jalpaiguri'){echo 'selected';}}else if(isset($city_selected) && $city_selected === 'Jalpaiguri'){echo 'selected';}?>>Jalpaiguri</option>
				<option value="Balurghat" <?php if(logged_in() === true){if($user_data['city'] === 'Balurghat'){echo 'selected';}}else if(isset($city_selected) && $city_selected === 'Balurghat'){echo 'selected';}?>>Balurghat</option>
				<option value="Basirhat" <?php if(logged_in() === true){if($user_data['city'] === 'Basirhat'){echo 'selected';}}else if(isset($city_selected) && $city_selected === 'Basirhat'){echo 'selected';}?>>Basirhat</option>
				<option value="Bankura" <?php if(logged_in() === true){if($user_data['city'] === 'Bankura'){echo 'selected';}}else if(isset($city_selected) && $city_selected === 'Bankura'){echo 'selected';}?>>Bankura</option>
				<option value="Chakdaha" <?php if(logged_in() === true){if($user_data['city'] === 'Chakdaha'){echo 'selected';}}else if(isset($city_selected) && $city_selected === 'Chakdaha'){echo 'selected';}?>>Chakdaha</option>
				<option value="Darjeeling" <?php if(logged_in() === true){if($user_data['city'] === 'Darjeeling'){echo 'selected';}}else if(isset($city_selected) && $city_selected === 'Darjeeling'){echo 'selected';}?>>Darjeeling</option>
				<option value="Alipurduar" <?php if(logged_in() === true){if($user_data['city'] === 'Alipurduar'){echo 'selected';}}else if(isset($city_selected) && $city_selected === 'Alipurduar'){echo 'selected';}?>>Alipurduar</option>
				<option value="Purulia" <?php if(logged_in() === true){if($user_data['city'] === 'Purulia'){echo 'selected';}}else if(isset($city_selected) && $city_selected === 'Purulia'){echo 'selected';}?>>Purulia</option>
				<option value="Jangipur" <?php if(logged_in() === true){if($user_data['city'] === 'Jangipur'){echo 'selected';}}else if(isset($city_selected) && $city_selected === 'Jangipur'){echo 'selected';}?>>Jangipur</option>
				<option value="Bongoan" <?php if(logged_in() === true){if($user_data['city'] === 'Bongoan'){echo 'selected';}}else if(isset($city_selected) && $city_selected === 'Bongoan'){echo 'selected';}?>>Bongoan</option>
				<option value="Cooch Behar" <?php if(logged_in() === true){if($user_data['city'] === 'Cooch Behar'){echo 'selected';}}else if(isset($city_selected) && $city_selected === 'Cooch Behar'){echo 'selected';}?>>Cooch Behar</option>
				<option value="Barrackpore" <?php if(logged_in() === true){if($user_data['city'] === 'Barrackpore'){echo 'selected';}}else if(isset($city_selected) && $city_selected === 'Barrackpore'){echo 'selected';}?>>Barrackpore</option>
				<option value="Ashoknagar" <?php if(logged_in() === true){if($user_data['city'] === 'Ashoknagar'){echo 'selected';}}else if(isset($city_selected) && $city_selected === 'Ashoknagar'){echo 'selected';}?>>Ashoknagar</option>
			    <option value="Barasat" <?php if(logged_in() === true){if($user_data['city'] === 'Barasat'){echo 'selected';}}else if(isset($city_selected) && $city_selected === 'Barasat'){echo 'selected';}?>>Barasat</option>
			</select>
			<?php
		}else if($state === 'Maharashtra'){
			?>
			<label>City*</label>&nbsp;
			<select name="city" id="city">
			    <option value="default" disabled selected>Select City</option>
				<option value="Mumbai" <?php if(logged_in() === true){if($user_data['city'] === 'Mumbai'){echo 'selected';}}else if(isset($city_selected) && $city_selected === 'Mumbai'){echo 'selected';}?>>Mumbai</option>
				<option value="Nagpur" <?php if(logged_in() === true){if($user_data['city'] === 'Nagpur'){echo 'selected';}}else if(isset($city_selected) && $city_selected === 'Nagpur'){echo 'selected';}?>>Nagpur</option>
				<option value="Pune" <?php if(logged_in() === true){if($user_data['city'] === 'Pune'){echo 'selected';}}else if(isset($city_selected) && $city_selected === 'Pune'){echo 'selected';}?>>Pune</option>
				<option value="Nashik" <?php if(logged_in() === true){if($user_data['city'] === 'Nashik'){echo 'selected';}}else if(isset($city_selected) && $city_selected === 'Nashik'){echo 'selected';}?>>Nashik</option>
				<option value="Thane" <?php if(logged_in() === true){if($user_data['city'] === 'Thane'){echo 'selected';}}else if(isset($city_selected) && $city_selected === 'Thane'){echo 'selected';}?>>Thane</option>
				<option value="Pimpri-Chinchwad" <?php if(logged_in() === true){if($user_data['city'] === 'Pimpri-Chinchwad'){echo 'selected';}}else if(isset($city_selected) && $city_selected === 'Pimpri-Chinchwad'){echo 'selected';}?>>Pimpri-Chinchwad</option>
				<option value="Kalyan-Dombivali" <?php if(logged_in() === true){if($user_data['city'] === 'Kalyan-Dombivali'){echo 'selected';}}else if(isset($city_selected) && $city_selected === 'Kalyan-Dombivali'){echo 'selected';}?>>Kalyan-Dombivali</option>
				<option value="Vasai-Virar" <?php if(logged_in() === true){if($user_data['city'] === 'Vasai-Virar'){echo 'selected';}}else if(isset($city_selected) && $city_selected === 'Vasai-Virar'){echo 'selected';}?>>Vasai-Virar</option>
				<option value="Aurangabad" <?php if(logged_in() === true){if($user_data['city'] === 'Aurangabad'){echo 'selected';}}else if(isset($city_selected) && $city_selected === 'Aurangabad'){echo 'selected';}?>>Aurangabad</option>
				<option value="Navi Mumbai" <?php if(logged_in() === true){if($user_data['city'] === 'Navi Mumbai'){echo 'selected';}}else if(isset($city_selected) && $city_selected === 'Navi Mumbai'){echo 'selected';}?>>Navi Mumbai</option>
				<option value="Solapur" <?php if(logged_in() === true){if($user_data['city'] === 'Solapur'){echo 'selected';}}else if(isset($city_selected) && $city_selected === 'Solapur'){echo 'selected';}?>>Solapur</option>
				<option value="Mira-Bhayandar" <?php if(logged_in() === true){if($user_data['city'] === 'Mira-Bhayandar'){echo 'selected';}}else if(isset($city_selected) && $city_selected === 'Mira-Bhayandar'){echo 'selected';}?>>Mira-Bhayandar</option>
				<option value="Bhiwandi-Nizampur" <?php if(logged_in() === true){if($user_data['city'] === 'Bhiwandi-Nizampur'){echo 'selected';}}else if(isset($city_selected) && $city_selected === 'Bhiwandi-Nizampur'){echo 'selected';}?>>Bhiwandi-Nizampur</option>
				<option value="Amravati" <?php if(logged_in() === true){if($user_data['city'] === 'Amravati'){echo 'selected';}}else if(isset($city_selected) && $city_selected === 'Amravati'){echo 'selected';}?>>Amravati</option>
				<option value="Nanded-Waghala" <?php if(logged_in() === true){if($user_data['city'] === 'Nanded-Waghala'){echo 'selected';}}else if(isset($city_selected) && $city_selected === 'Nanded-Waghala'){echo 'selected';}?>>Nanded-Waghala</option>
				<option value="Kolhapur" <?php if(logged_in() === true){if($user_data['city'] === 'Kolhapur'){echo 'selected';}}else if(isset($city_selected) && $city_selected === 'Kolhapur'){echo 'selected';}?>>Kolhapur</option>
				<option value="Panvel" <?php if(logged_in() === true){if($user_data['city'] === 'Panvel'){echo 'selected';}}else if(isset($city_selected) && $city_selected === 'Panvel'){echo 'selected';}?>>Panvel</option>
				<option value="Ulhasnagar" <?php if(logged_in() === true){if($user_data['city'] === 'Ulhasnagar'){echo 'selected';}}else if(isset($city_selected) && $city_selected === 'Ulhasnagar'){echo 'selected';}?>>Ulhasnagar</option>
				<option value="Sangli-Miraj & Kupwad" <?php if(logged_in() === true){if($user_data['city'] === 'Sangli-Miraj'){echo 'selected';}}else if(isset($city_selected) && $city_selected === 'Sangli-Miraj'){echo 'selected';}?>>Sangli-Miraj & Kupwad</option>
				<option value="Malegaon" <?php if(logged_in() === true){if($user_data['city'] === 'Malegaon'){echo 'selected';}}else if(isset($city_selected) && $city_selected === 'Malegaon'){echo 'selected';}?>>Malegaon</option>
				<option value="Jalgaon" <?php if(logged_in() === true){if($user_data['city'] === 'Jalgaon'){echo 'selected';}}else if(isset($city_selected) && $city_selected === 'Jalgaon'){echo 'selected';}?>>Jalgaon</option>
				<option value="Akola" <?php if(logged_in() === true){if($user_data['city'] === 'Akola'){echo 'selected';}}else if(isset($city_selected) && $city_selected === 'Akola'){echo 'selected';}?>>Akola</option>
				<option value="Latur" <?php if(logged_in() === true){if($user_data['city'] === 'Latur'){echo 'selected';}}else if(isset($city_selected) && $city_selected === 'Latur'){echo 'selected';}?>>Latur</option>
				<option value="Dhule" <?php if(logged_in() === true){if($user_data['city'] === 'Dhule'){echo 'selected';}}else if(isset($city_selected) && $city_selected === 'Dhule'){echo 'selected';}?>>Dhule</option>
				<option value="Ahmednagar" <?php if(logged_in() === true){if($user_data['city'] === 'Ahmednagar'){echo 'selected';}}else if(isset($city_selected) && $city_selected === 'Ahmednagar'){echo 'selected';}?>>Ahmednagar</option>
				<option value="Chandrapur" <?php if(logged_in() === true){if($user_data['city'] === 'Chandrapur'){echo 'selected';}}else if(isset($city_selected) && $city_selected === 'Chandrapur'){echo 'selected';}?>>Chandrapur</option>
				<option value="Parbhani" <?php if(logged_in() === true){if($user_data['city'] === 'Parbhani'){echo 'selected';}}else if(isset($city_selected) && $city_selected === 'Parbhani'){echo 'selected';}?>>Parbhani</option>
			</select>
			<?php
		}else{
			?>
			<label>City*</label>&nbsp;
			<select name="city" id="city">
			    <option value="default" disabled selected>Select City</option>
			</select>
			<?php
		}
	}else{
		?>
		<label>City*</label>&nbsp;
		<select name="city" id="city">
			<option value="default" disabled selected>Select City</option>
		</select>
		<?php
	}
}
?>