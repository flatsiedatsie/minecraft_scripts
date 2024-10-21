<html>
<head>
	<meta http-equiv="refresh" content="20">
	<title>Funky Minecraft Server</title>
	<style>
		body{
			padding:4rem;
			background-color:#27bc6d;
			font-family: Helvetica,Arial,sans-serif;
		}
		strong{
			letter-spacing: .1rem;
		}
		
		button{
			background-color:blue;
			color:white;
			border-radius:.5rem;
			padding:.5rem 1rem;
			font-size:120%;
		}
		
	</style>
</head>
<body>
<img src="cat.svg" width="200" alt="Get funky!"/>
<h1>Funky Minecraft server</h1>

<?php

date_default_timezone_set('Europe/Amsterdam');

$raw_settings = file_get_contents('./settings.json');
$settings=json_decode($raw_settings, true);
#var_dump(json_decode($settings, true));

echo '<br>';
#echo '<h2><strong style="color:purple">' . $settings["state"] . '</strong></h2>';

echo '<h2><em>Lokaal IP adres:</em> <strong style="color:white">' . $settings["lokaal_ip_adres"] . '</strong> (minecraft.local)</h2>';
echo '<h2><em>Internet IP adres:</em> <strong style="color:white">' . $settings["internet_ip_adres"] . '</strong></h2>';



$nice_date = date('H:i:s m/d/Y', ($settings["time"]));
echo '<p><em>Last started:</em> ' . $nice_date  . '</p>';


# TODO: dynamic DNS via dreamhost: https://shang-lin.com/blog/2017/03/16/Dynamic-DNS-with-Dreamhost

?>

<button onClick="window.location.reload();">Refresh</button>

<br>
<br>
<br>
<br>
<br>

<p>Server details:</p>
<ul>
	<!--<li><?php echo '<strong style="color:purple">' . $settings["state"] . '</strong>';   ?></li>-->
	<li>Java 21</li>
	<li>Spigot 1.21.1</li>
	<li><a href="https://www.reddit.com/r/admincraft/" target="_blank">AdminCraft</a></li>
</ul>
</body>
</html>