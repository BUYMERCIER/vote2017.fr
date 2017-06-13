<?php

header('Content-Type: text/html; charset=utf-8');

//check_tor : __utmhs ; no_tor : __utmsa ; maybe_tor : __utmfq ; tor : __utmwf

//Connexion à la BDD
try {
	@$connexion = new PDO("mysql:host=votefrypwxsql.mysql.db;dbname=votefrypwxsql;charset=utf8", "votefrypwxsql", "33stresS33", array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8", PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
} catch (PDOException $e) {
	echo 'Connexion &eacute;chou&eacute;e : ' . $e->getMessage();
}

//Affichage de la checkbox pour l'envoi d'un message
$info_mail = false;
if($_GET["mail"] == "ok") {
	$info_mail = true;
	$text_mail = "Le message a bien &eacute;t&eacute; envoy&eacute;";
	$text_color_mail = "success";
} elseif($_GET["mail"] == "err") {
	$info_mail = true;
	$text_mail = "Le message n'a pas pu &ecirc;tre envoy&eacute;";
	$text_color_mail = "error";
}

$info_gps = false;

if(isset($_GET["gps"]) AND !empty($_GET["gps"])) {
	if($_GET["gps"] == "ok") {
		$info_gps = true;
		$text_gps = "Votre position a bien &eacute;t&eacute; r&eacute;cup&eacute;r&eacute;e";
		$text_color_gps = "success";
	} elseif($_GET["gps"] == "gps") {
		$info_gps = true;
		$text_gps = "Votre position n&apos;a pas pu &ecirc;tre d&eacute;termin&eacute;<br>> Requ&ecirc;te annul&eacute;e";
		$text_color_gps = "error";
	} elseif($_GET["gps"] == "den") {
		$info_gps = true;
		$text_gps = "Votre position n&apos;a pas pu &ecirc;tre d&eacute;termin&eacute;,<br>car l&apos;acc&egrave;s &agrave; votre localisation a &eacute;t&eacute; refus&eacute;e<br>> Requ&ecirc;te annul&eacute;e";
		$text_color_gps = "error";
	} elseif($_GET["gps"] == "una") {
		$info_gps = true;
		$text_gps = "Votre position n&apos;a pas pu &ecirc;tre d&eacute;termin&eacute;,<br>car le service de localisation n&apos;a pas pu<br>donner suite &agrave; votre localisation<br>> Requ&ecirc;te annul&eacute;e";
		$text_color_gps = "error";
	} elseif($_GET["gps"] == "tim") {
		$info_gps = true;
		$text_gps = "Votre position n&apos;a pas pu &ecirc;tre d&eacute;termin&eacute;,<br>car le service de localisation n&apos;a pas r&eacute;pondu<br>> Requ&ecirc;te annul&eacute;e";
		$text_color_gps = "error";
	} elseif($_GET["gps"] == "acc") {
		$info_gps = true;
		$text_gps = "Votre position n&apos;a pas pu &ecirc;tre<br>d&eacute;termin&eacute; assez pr&eacute;cis&eacute;ment<br>> Requ&ecirc;te annul&eacute;e";
		$text_color_gps = "error";
	}
}

//Détection des robots
$crawlers = array(
    'Google'=>'Google',
    'MSN' => 'msnbot',
    'Rambler'=>'Rambler',
    'Yahoo'=> 'Yahoo',
    'AbachoBOT'=> 'AbachoBOT',
    'accoona'=> 'Accoona',
    'AcoiRobot'=> 'AcoiRobot',
    'ASPSeek'=> 'ASPSeek',
    'CrocCrawler'=> 'CrocCrawler',
    'Dumbot'=> 'Dumbot',
    'FAST-WebCrawler'=> 'FAST-WebCrawler',
    'GeonaBot'=> 'GeonaBot',
    'Gigabot'=> 'Gigabot',
    'Lycos spider'=> 'Lycos',
    'MSRBOT'=> 'MSRBOT',
    'Altavista robot'=> 'Scooter',
    'AltaVista robot'=> 'Altavista',
    'ID-Search Bot'=> 'IDBot',
    'eStyle Bot'=> 'eStyle',
    'Scrubby robot'=> 'Scrubby',
);
 
function crawlerDetect($USER_AGENT) {
    $crawlers_agents = 'Google|msnbot|Rambler|Yahoo|AbachoBOT|accoona|AcioRobot|ASPSeek|CocoCrawler|Dumbot|FAST-WebCrawler|GeonaBot|Gigabot|Lycos|MSRBOT|Scooter|AltaVista|IDBot|eStyle|Scrubby';
    if (strpos($crawlers_agents , $USER_AGENT) === false)
       return false;
}

$crawler = crawlerDetect($_SERVER['HTTP_USER_AGENT']);

if ($crawler) {
	
	$can_vote = false;
	
} else {

	if(!isset($_COOKIE["check_cookie"])) {		
		if(strstr($_SERVER['REQUEST_URI'], '?cookie')) {
			?>
			<script>
			if (navigator.cookieEnabled) {
				document.location.href = "index.php";
				location.reload();
			}
			</script>
			<?
			$cookie = "no";
		} else {
			$cookie = "no" ?>
			<script>
			document.cookie = 'check_cookie=1';
			if (!navigator.cookieEnabled) {
				document.location.href = "index.php?cookie";
			} else {
				location.reload();
			}
			</script>
			<?
		}
	} else {
		if (!isset($_COOKIE['check_mobile'])) {
			$useragent = $_SERVER['HTTP_USER_AGENT'];
			if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4))) {
				setcookie("is_mobile", "0");
				setcookie("check_mobile", "0");
				header('Location: '.$_SERVER['PHP_SELF']);
				exit();
			} else {
				setcookie("is_pc", "0");
				setcookie("check_mobile", "0");
				header('Location: '.$_SERVER['PHP_SELF']);
				exit();
			}
		} elseif (isset($_COOKIE['is_pc'])) {
			if(!isset($_COOKIE['__utmhs'])) {
				include ("script/tor/index.php");
				if ($is__utmwf < 0) {
					setcookie("__utmfq", "0");
					setcookie("__utmhs", "0");
					header('Location: '.$_SERVER['PHP_SELF']);
					exit();
				} elseif ($is__utmwf) {
					setcookie("__utmwf", "0");
					setcookie("__utmhs", "0");
					header('Location: '.$_SERVER['PHP_SELF']);
					exit();
				} else {
					if(strstr($_SERVER['REQUEST_URI'], '?try')) {
						setcookie("__utmsa", "0");
						setcookie("__utmhs", "0");
						header('Location: '.$_SERVER['PHP_SELF']);
						exit();
					} else {
						header('Location: '.$_SERVER['PHP_SELF'].'?try');
						exit();
					}
				}
			} else {
				if(!isset($_COOKIE['__utmwf'])) {
					if(!isset($_COOKIE['__utmfq'])) {
						if(!isset($_COOKIE['__utmsa'])) {
							unset($_COOKIE['__utmhs']);
							setcookie ("__utmhs", NULL, time() - 3600);
							header('Location: '.$_SERVER['PHP_SELF']);
							exit();
						}
					}
				}
			}
		} else if(isset($_COOKIE['is_mobile'])) {
			if(!isset($_COOKIE['connect_mobile'])) { ?>
				<script>
				var connection = window.navigator.connection || window.navigator.mozConnection || null;
				if (connection === null) {
					document.cookie = 'maybe_conn=0';
					document.cookie = 'connect_mobile=0';
					location.reload();
				} else if ('metered' in connection) {
				} else {
					var typeValue = document.getElementById('t-value');
					[].slice.call(document.getElementsByClassName('new-api')).forEach(function(element) {
						element.classList.remove('hidden');
					});
					connection.addEventListener('typechange', function (event) {
						if (connection.type == 'wifi') {
							document.cookie = 'mobile_wifi=0';
							document.cookie = 'connect_mobile=0';
							location.reload();
						}
					});
					connection.dispatchEvent(new Event('typechange'));
				}
				</script>
	<?php 	}
		} else {
			//Erreur
		}
	}
	
	//Création des variables pour le formulaire de contact et pour le formulaire de vote
	$form_part1 = "$(document).on('click', '.alert', function(e) {";
	$form_part2 = "bootbox.dialog({	title: 'Envoyer un message', onEscape: function () { $('.bootbox.modal').modal('hide');	}, message: message }); });";
	$remove_Toast = "$().toastmessage('removeToast', infoToast);";
	$add_Toast_part1 = "$(document).on('hidden.bs.modal', '.bootbox.modal', function (e) {callback();}); function callback() {if (status == false) {onClose();} else {status = false;}} function onClose() {";				
	$add_Toast_part2 = "} var ";
	
	//Trouver l'adresse IP
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
	
	//Nombre total de votes
	$total = $connexion->query("SELECT votes FROM poll_data");
	$total_vote = "0";
	while ($donnees = $total->fetch()) {
		$total_vote = $total_vote + $donnees['votes'];
	}
	
	//Intégration des stats dans la BDD
	$year = date("Y");
	$month = date("m");
	$day = date("d");
	$req_stats = $connexion->query("SELECT COUNT(*) FROM get_stats WHERE year='$year' AND month='$month' AND day='$day'")->fetchColumn();
	if($req_stats == "0") {
		function pourcentage($nombre, $total) {
			$pourcentage = $nombre * 100 / $total;
			$pourcentage = number_format($pourcentage, 2);
			return $pourcentage;
		}
		$get_vote = $connexion->query("SELECT votes FROM poll_data ORDER BY id");
		while ($req_vote = $get_vote->fetch()) {
			$req_max = $req_max + $req_vote['votes'];
			$get_op_arr[] = $req_vote['votes'];
		}
		$get_vote->closeCursor();
		$get_vote_1 = pourcentage($get_op_arr[0], $req_max);
		$get_vote_2 = pourcentage($get_op_arr[1], $req_max);
		$get_vote_3 = pourcentage($get_op_arr[2], $req_max);
		$get_vote_4 = pourcentage($get_op_arr[3], $req_max);
		$get_vote_5 = pourcentage($get_op_arr[4], $req_max);
		$get_vote_6 = pourcentage($get_op_arr[5], $req_max);
		$get_vote_7 = pourcentage($get_op_arr[6], $req_max);
		
		$insert_stats = $connexion->prepare("INSERT INTO get_stats (year, month, day, op_1, op_2, op_3, op_4, op_5, op_6, op_7) VALUES (:year, :month, :day, :op_1, :op_2, :op_3, :op_4, :op_5, :op_6, :op_7)");
		$insert_stats->bindParam(':year', $year);
		$insert_stats->bindParam(':month', $month);
		$insert_stats->bindParam(':day', $day);
		$insert_stats->bindParam(':op_1', $get_vote_1);
		$insert_stats->bindParam(':op_2', $get_vote_2);
		$insert_stats->bindParam(':op_3', $get_vote_3);
		$insert_stats->bindParam(':op_4', $get_vote_4);
		$insert_stats->bindParam(':op_5', $get_vote_5);
		$insert_stats->bindParam(':op_6', $get_vote_6);
		$insert_stats->bindParam(':op_7', $get_vote_7);
		$insert_stats->execute();
	}

	//Liste des départements français
	$depts = array();
	$depts["01"] = "Ain"; $depts["02"] = "Aisne"; $depts["03"] = "Allier"; $depts["04"] = "Alpes-de-Haute-Provence"; $depts["05"] = "Hautes-Alpes"; $depts["06"] = "Alpes-Maritimes"; $depts["07"] = "Ard&egrave;che"; $depts["08"] = "Ardennes"; $depts["09"] = "Ari&egrave;ge"; $depts["10"] = "Aube"; $depts["11"] = "Aude"; $depts["12"] = "Aveyron"; $depts["13"] = "Bouches-du-Rh&ocirc;ne"; $depts["14"] = "Calvados"; $depts["15"] = "Cantal"; $depts["16"] = "Charente"; $depts["17"] = "Charente-Maritime"; $depts["18"] = "Cher"; $depts["19"] = "Corr&egrave;ze"; $depts["2A"] = "Corse du Sud"; $depts["2B"] = "Haute Corse"; $depts["21"] = "C&ocirc;te-d'Or"; $depts["22"] = "C&ocirc;tes-d'Armor"; $depts["23"] = "Creuse"; $depts["24"] = "Dordogne"; $depts["25"] = "Doubs"; $depts["26"] = "Dr&ocirc;me"; $depts["27"] = "Eure"; $depts["28"] = "Eure-et-Loir"; $depts["29"] = "Finist&egrave;re"; $depts["30"] = "Gard"; $depts["31"] = "Haute-Garonne"; $depts["32"] = "Gers"; $depts["33"] = "Gironde"; $depts["34"] = "H&eacute;rault"; $depts["35"] = "Ille-et-Vilaine"; $depts["36"] = "Indre"; $depts["37"] = "Indre-et-Loire"; $depts["38"] = "Is&egrave;re"; $depts["39"] = "Jura"; $depts["40"] = "Landes"; $depts["41"] = "Loir-et-Cher"; $depts["42"] = "Loire"; $depts["43"] = "Haute-Loire"; $depts["44"] = "Loire-Atlantique"; $depts["45"] = "Loiret"; $depts["46"] = "Lot"; $depts["47"] = "Lot-et-Garonne"; $depts["48"] = "Loz&egrave;re"; $depts["49"] = "Maine-et-Loire"; $depts["50"] = "Manche"; $depts["51"] = "Marne"; $depts["52"] = "Haute-Marne"; $depts["53"] = "Mayenne"; $depts["54"] = "Meurthe-et-Moselle"; $depts["55"] = "Meuse"; $depts["56"] = "Morbihan"; $depts["57"] = "Moselle"; $depts["58"] = "Ni&egrave;vre"; $depts["59"] = "Nord"; $depts["60"] = "Oise"; $depts["61"] = "Orne"; $depts["62"] = "Pas-de-Calais"; $depts["63"] = "Puy-de-D&ocirc;me"; $depts["64"] = "Pyr&eacute;n&eacute;es-Atlantiques"; $depts["65"] = "Hautes-Pyr&eacute;n&eacute;es"; $depts["66"] = "Pyr&eacute;n&eacute;es-Orientales"; $depts["67"] = "Bas-Rhin"; $depts["68"] = "Haut-Rhin"; $depts["69"] = "Rh&ocirc;ne"; $depts["70"] = "Haute-Sa&ocirc;ne"; $depts["71"] = "Sa&ocirc;ne-et-Loire"; $depts["72"] = "Sarthe"; $depts["73"] = "Savoie"; $depts["74"] = "Haute-Savoie"; $depts["75"] = "Paris"; $depts["76"] = "Seine-Maritime"; $depts["77"] = "Seine-et-Marne"; $depts["78"] = "Yvelines"; $depts["79"] = "Deux-S&egrave;vres"; $depts["80"] = "Somme"; $depts["81"] = "Tarn"; $depts["82"] = "Tarn-et-Garonne"; $depts["83"] = "Var"; $depts["84"] = "Vaucluse"; $depts["85"] = "Vend&eacute;e"; $depts["86"] = "Vienne"; $depts["87"] = "Haute-Vienne"; $depts["88"] = "Vosges"; $depts["89"] = "Yonne"; $depts["90"] = "Territoire de Belfort"; $depts["91"] = "Essonne"; $depts["92"] = "Hauts-de-Seine"; $depts["93"] = "Seine-Saint-Denis"; $depts["94"] = "Val-de-Marne"; $depts["95"] = "Val-d'Oise";

	if(isset($_COOKIE['__utmsa']) || isset($_COOKIE['mobile_wifi']) || isset($_COOKIE['maybe_conn'])) {
		
		$nb_vote = $connexion->query("SELECT COUNT(*) FROM poll_ip WHERE ip_addr=INET_ATON('$ip')")->fetchColumn();
		if($nb_vote == "0") {
			
			if(isset($_COOKIE['Vote'][2017])) {
				$info_Toast = "infoToast = $().toastmessage('showToast', {
					text: 'Merci d&apos;avoir vot&eacute; sur vote2017.fr,<br>nous vous en sommes reconnaissants',
					type: 'notice',
					sticky: true
				});";
				$can_vote = false;
			} else {
			
				//Démarrage du système de stockage
				$nb_ip = $connexion->query("SELECT COUNT(*) FROM get_ip WHERE ip=INET_ATON('$ip')")->fetchColumn();
				$req_1_insert = $connexion->prepare("INSERT INTO get_ip(ip,country,depart_num) VALUES(INET_ATON(:ip), :country, :depart_num)");
				$req_2_insert = $connexion->prepare("INSERT INTO get_ip(ip,country) VALUES(INET_ATON(:ip), :country)");
				$req_3_insert = $connexion->prepare("INSERT INTO get_ip(ip,country,verif) VALUES(INET_ATON(:ip), :country, :verif)");
				//Système de protection
				if($nb_ip >= "2") {
					$connexion->query("DELETE FROM get_ip WHERE ip=INET_ATON('$ip')");
					$nb_ip = $connexion->query("SELECT COUNT(*) FROM get_ip WHERE ip=INET_ATON('$ip')")->fetchColumn();
				}

				if($nb_ip == "0") {
					//Géolocalisation de la personne
					$curl = curl_init();
					
					curl_setopt_array($curl, array(
						CURLOPT_URL => "https://community-maxmind-geoip2.p.mashape.com/city/".$ip,
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
						$country = $reponse["country"]["names"]["fr"];
						if($country == "France") {
							$isp = $reponse["traits"]["isp"];
							if($isp == "Free Mobile SAS" || $isp == "Caisse Federale de Credit Mutuel SA" || $isp == "Bouygues Mobile") {
								$number_verif = "10";
								$req_3_insert->execute(array(':ip'=>$ip, ':country'=>"France", ':verif'=>$number_verif));
							} else {
								$depart_num = substr($reponse["postal"]["code"], 0, 2);
								if($depart_num != "") {
									$req_1_insert->execute(array(':ip'=>$ip, ':country'=>"France", ':depart_num'=>$depart_num));
								} else {
									$req_2_insert->execute(array(':ip'=>$ip, ':country'=>"France"));
								}
							}
						} else {
							$req_2_insert->execute(array(':ip'=>$ip, ':country'=>$country));
						}
					}
					$nb_ip = $connexion->query("SELECT COUNT(*) FROM get_ip WHERE ip=INET_ATON('$ip')")->fetchColumn();
				}
				
				if($nb_ip == "1") {
					$found_dep = $connexion->query("SELECT * FROM get_ip WHERE ip=INET_ATON('$ip')");
					$donnees = $found_dep->fetch();
					$depart_num = $donnees['depart_num'];
					$depart_verif = $donnees['verif'];
					$country = $donnees['country'];
					if($depart_verif == "0") {
						if($country == "France") {
							if($depart_num != "0") {
								$can_vote = true;
								$info_Toast = "infoToast = $().toastmessage('showToast', {
									text: 'Vous avez &eacute;t&eacute; g&eacute;olocalis&eacute dans le d&eacute;partement: ".$depts["$depart_num"]."<br><a href=gps.php>Mauvaise g&eacute;olocalisation?</a><hr/><a href=/confidentialite.php>Quelle est l&apos;utilit&eacute;?',
									type: 'notice',
									sticky: true
								});";
							} else {
								$can_vote = false;
								$info_Toast = "infoToast = $().toastmessage('showToast', {
									text: 'Vous n&apos;avez pas pu &ecirc;tre g&eacute;olocalis&eacute<br><a href=gps.php>Se g&eacute;olocaliser par GPS</a><hr/><a href=/confidentialite.php>Quelle est l&apos;utilit&eacute;?',
									type: 'notice',
									sticky: true
								});";
							}	
						} else {
							$can_vote = false;
							$info_Toast = "infoToast = $().toastmessage('showToast', {
								text: 'Vous avez &eacute;t&eacute; g&eacute;olocalis&eacute; hors de la France<br>Vous ne pouvez donc pas voter sur ce site<br><a href=gps.php>Mauvaise g&eacute;olocalisation?</a><hr/><a href=/confidentialite.php>Quelle est l&apos;utilit&eacute;?',
								type: 'notice',
								sticky: true
							});";
						}
					} elseif ($depart_verif == "1") {
						if($country == "France") {
							if($depart_num != "0") {
								$can_vote = true;
								$info_Toast = "infoToast = $().toastmessage('showToast', {
									text: 'Vous avez &eacute;t&eacute; g&eacute;olocalis&eacute par GPS dans le d&eacute;partement: ".$depts["$depart_num"]."<hr/><a href=/confidentialite.php>Quelle est l&apos;utilit&eacute;?',
									type: 'notice',
									sticky: true
								});";
							} else {
								//Impossible
							}	
						} else {
							$can_vote = false;
							$info_Toast = "infoToast = $().toastmessage('showToast', {
								text: 'Vous avez &eacute;t&eacute; g&eacute;olocalis&eacute; par GPS hors de la France<br>Vous ne pouvez donc pas voter sur ce site<hr/><a href=/confidentialite.php>Quelle est l&apos;utilit&eacute;?',
								type: 'notice',
								sticky: true
							});";
						}
					} elseif ($depart_verif == "10") {
						$can_vote = false;
						$info_Toast = "infoToast = $().toastmessage('showToast', {
							text: 'Votre connexion indique que vous utilisez une connexion cellulaire<br>Veuillez vous connecter &agrave; votre box personnelle<hr/><a href=/confidentialite.php>Quelle est l&apos;utilit&eacute;?',
							type: 'notice',
							sticky: true
						});";
					} else {
						//Erreur
					}
				} else {
					//Erreur
				}
			}	
		} else {
			
			$info_Toast = "infoToast = $().toastmessage('showToast', {
					text: 'Merci d&apos;avoir vot&eacute; sur vote2017.fr,<br>nous vous en sommes reconnaissants',
					type: 'notice',
					sticky: true
				});";
			$can_vote = false;

		}
	} elseif(isset($_COOKIE['__utmfq'])) {
		$can_vote = false;
	} elseif(isset($_COOKIE['__utmwf'])) {
		$can_vote = true;
		$info_Toast = "infoToast = $().toastmessage('showToast', {
					text: 'Notre syst&egrave;me a d&eacute;tect&eacute; que <br>vous utilisez un proxy anonyme<br><br>Vous ne pouvez donc pas acc&eacute;der <br>&agrave; certaines fonctionnalit&eacute;s du site<hr/><a href=>En savoir plus...',
					type: 'error',
					sticky: true
				});";
	} elseif($cookie == "no") {
		$info_Toast = "infoToast = $().toastmessage('showToast', {
					text: 'Afin de pouvoir voter, il est n&eacute;cessaire d&apos;avoir au__utmwfis&eacute; le stockage de cookie sur votre syst&egrave;me<hr/><a href=>Comment faire?',
					type: 'error',
					sticky: true
				});";
		$can_vote = false;
	}
}

?>
