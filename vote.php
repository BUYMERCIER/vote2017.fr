<?php

header('Content-Type: text/html; charset=utf-8');
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

try {
	@$connexion = new PDO("mysql:host=votefrypwxsql.mysql.db;dbname=votefrypwxsql;charset=utf8", "votefrypwxsql", "33stresS33", array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8", PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
} catch (PDOException $e) {
	echo 'Connexion &eacute;chou&eacute;e : ' . $e->getMessage();
}

if (isset($_COOKIE['accept_vote']) AND isset($_GET['vote']) AND isset($_GET['sexe']) AND isset($_GET['age']) AND isset($_GET['statut']) AND !isset($_COOKIE['Vote'][2017])) {
	if(!empty($_GET['vote']) AND !empty($_GET['sexe']) AND !empty($_GET['age']) AND !empty($_GET['statut'])) {
		$nb_vote = $connexion->query("SELECT COUNT(*) FROM poll_ip WHERE ip_addr=INET_ATON('$ip')")->fetchColumn();
		if($nb_vote == "0") {
			$found_dep = $connexion->query("SELECT depart_num FROM get_ip WHERE ip=INET_ATON('$ip')");
			$donnees = $found_dep->fetch();
			$depart_num = $donnees['depart_num'];
			$vote = $_GET['vote'];
			$sexe = $_GET['sexe'];
			$age = $_GET['age'];
			$statut = $_GET['statut'];
			$connexion->query("UPDATE poll_dep SET op_$vote = op_$vote+1 WHERE id_dep='dep_$depart_num'");
			$connexion->query("INSERT INTO poll_ip (ip_addr) VALUES (INET_ATON('$ip'))");
			if(isset($_GET['choix']) AND !empty($_GET['choix'])) {
				$choix = $_GET['choix'];
				$choix_array = array();
				$choix_array["1"] = "option_text"; $choix_array["2"] = "min"; $choix_array["3"] = "color";
				$idd = $choix_array["$choix"];
				$connexion->query("UPDATE poll_data SET $idd = $idd + 1, votes = votes+1, votes_$sexe = votes_$sexe+1, votes_age_$age = votes_age_$age+1, votes_rang_$statut = votes_rang_$statut+1 WHERE id=8");
			} else {
				$connexion->query("UPDATE poll_data SET votes = votes+1, votes_$sexe = votes_$sexe+1, votes_age_$age = votes_age_$age+1, votes_rang_$statut = votes_rang_$statut+1 WHERE id=$vote");
			}
		}
		setcookie('Vote[2017]', '1', time() + 315360000000);
		unset($_COOKIE['accept_vote']);
		setcookie('accept_vote', '', time() - 3600);
	}
}

header('Location: http://vote2017.fr/');
exit();

?>