<?php

try {
	@$connexion = new PDO("mysql:host=votefrypwxsql.mysql.db;dbname=votefrypwxsql;charset=utf8", "votefrypwxsql", "33stresS33", array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8", PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
} catch (PDOException $e) {
	echo 'Connexion &eacute;chou&eacute;e : ' . $e->getMessage();
}

function get_ip() {
	if (isset($_SERVER['HTTP_CLIENT_IP'])) {
		return $_SERVER['HTTP_CLIENT_IP'];
	}
	elseif (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
		return $_SERVER['HTTP_X_FORWARDED_FOR'];
	}
	else {
		return (isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : '');
	}
}
$ip = get_ip();
	
$voted = $connexion->query("SELECT COUNT(*) FROM poll_ip WHERE ip_addr=INET_ATON('$ip')")->fetchColumn();
$verif = $connexion->query("SELECT COUNT(*) FROM get_ip WHERE ip=INET_ATON('$ip') AND verif='2'")->fetchColumn();
if($voted == "0" && $verif == "0" && !isset($_COOKIE['Vote'][2017])) {
	if($_GET["lat"] == "" && $_GET["lon"] == "" && $_GET["acc"] == "") { ?>
		<script>
		getLocation();
		function getLocation() {
			if (navigator.geolocation) {
				navigator.geolocation.getCurrentPosition(successCallback, errorCallback, {enableHighAccuracy : true, timeout:10000, maximumAge:0});
			} else {
				header('location:index.php?gps=gps');
			}
		}

		function successCallback(position) {
			document.location.href = '?lat=' + position.coords.latitude + '&lon=' + position.coords.longitude + '&acc=' + position.coords.accuracy;
		}

		function errorCallback(error) {
			switch(error.code) {
				case error.PERMISSION_DENIED:
					document.location.href = 'index.php?gps=den';
					break;
				case error.POSITION_UNAVAILABLE:
					document.location.href = 'index.php?gps=una';
					break;
				case error.TIMEOUT:
					document.location.href = 'index.php?gps=tim';
					break;
			}
		};

		</script>
	<?php } else {
		
			$lat = $_GET["lat"];
			$lon = $_GET["lon"];
			$acc = $_GET["acc"];
			
			if($acc < "200") {
			
				$curl = curl_init();
								
				curl_setopt_array($curl, array(
					CURLOPT_URL => "https://montanaflynn-geocoder.p.mashape.com/reverse?latitude=".$lat."&longitude=".$lon,
					CURLOPT_RETURNTRANSFER => true,
					CURLOPT_ENCODING => "",
					CURLOPT_MAXREDIRS => 10,
					CURLOPT_TIMEOUT => 30,
					CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
					CURLOPT_CUSTOMREQUEST => "GET",
					CURLOPT_HTTPHEADER => array(
						"Authorization: Basic MTAzNzczOlVMaFRTNWFIazJhSQ==",
						"X-Mashape-Key: Y6XUWp8PV5mshbScaMXsjVlPcLJKp1PaU73jsnDgWA6zEoNOjZ",
						"Accept: application/json",
						"content-type: application/json"
					),
				));
				
				$response = curl_exec($curl);
				$err = curl_error($curl);
				curl_close($curl);
				
				if ($err) {
					echo "cURL Error #:" . $err;
				} else {
					$reponse = json_decode($response, true);
					$country = $reponse["country"];
					$number_verif = "1";
					if($country == "France") {
						$zip = substr($reponse["zip"], 0, 2);
						$connexion->query("UPDATE get_ip SET country='France', depart_num=$zip, verif=$number_verif WHERE ip=INET_ATON('$ip')");
						header('location:index.php?gps=ok');
					} else {
						$connexion->query("UPDATE get_ip SET country=$country, depart_num='0', verif=$number_verif WHERE ip=INET_ATON('$ip')");
						header('location:index.php?gps=ok');
					}
				}
			} else {
				header('location:index.php?gps=acc');
			}
		}
} else {
	header('location:index.php');
}

?>
