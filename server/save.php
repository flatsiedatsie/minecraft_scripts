<?php

$password = $_POST['password'];

if($password == 'REDACTED_PASSWORD'){
	$lokaal_ip = $_POST['local_ip'];
	$internet_ip = $_SERVER['REMOTE_ADDR'];
	$state = $_POST['state'];
	
	$file = 'settings.json';
	$settings = '{"lokaal_ip_adres":"' . $lokaal_ip . '","internet_ip_adres":"' . $internet_ip . '","time":' . time() . ',"state":"' . $state . '"}';
	file_put_contents($file, $settings);
}

?>