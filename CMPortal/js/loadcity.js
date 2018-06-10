<!--
	function loadcity(){
		if(window.XMLHttpRequest){
			xmlhttp = new XMLHttpRequest();
		}else{
			xmlhttp = new ActiveXObject('Microsoft.XMLHTTP');
		}
		
		xmlhttp.onreadystatechange = function(){
			if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
				document.getElementById('cityname').innerHTML = xmlhttp.responseText;
				$(document).ready(function() {
                });
			}
		}
		
		parameters = 'text='+document.getElementById('state').value;
		//parameters = 'text='+val;
		
		xmlhttp.open('POST', 'loadcity.inc.php', true);
		xmlhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
		xmlhttp.send(parameters);
	    
	}
	-->