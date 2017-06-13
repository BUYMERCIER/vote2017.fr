<?php
if(isset($_POST) && isset($_POST['q1']) && isset($_POST['q2']) && isset($_POST['q3'])) {
	if(!empty($_POST['q1']) && !empty($_POST['q2']) && !empty($_POST['q3'])) {
		$destinataire = "contact@vote2017.fr";
		$sujet = "Contact vote2017";	
		$message = "Nom : ".$_POST['q1']."    "."Adresse email : ".$_POST['q2']."    "."Message : ".$_POST['q3']."\r\n";		
		$entete = 'From: '.'contact@vote2017.fr'."\r\n".
        	'Reply-To: '.$_POST['q2']."\r\n".
			'X-Mailer: PHP/'.phpversion();		
		
		if (mail($destinataire,$sujet,$message,$entete)) {
			header("Location: ./../index.php?mail=ok");
			exit();
		} else {
			header("Location: ./../index.php?mail=err");
			exit();
		}
	}
}
?>