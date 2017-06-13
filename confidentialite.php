		<?php include("include/header.php") ?>

		<div class="container" style="padding: 20px 50px 0 50px;">
			<br><h1 class="center animated bounceInDown">Mentions légales</h1> <br>

			<br><h2>Confidentialit&eacute;</h2>

			<p>Les informations recueillies font l’objet d’un traitement informatique destin&eacute; à &eacute;tablir des statistiques, principalement en relation avec les &eacute;lections pr&eacute;sidentielles françaises de 2017. Les destinataires des donn&eacute;es sont les webmasters du site.<br />
			Les informations enregistr&eacute;es sont r&eacute;serv&eacute;es à l’usage du service concern&eacute; et ne peuvent être communiqu&eacute;es qu’aux destinataires suivants : Messieurs MERCIER et LAFEYCHINE.<br />
			Conform&eacute;ment à la loi « informatique et libert&eacute;s » du 6 janvier 1978 modifi&eacute;e en 2004, vous b&eacute;n&eacute;ficiez d’un droit d’accès et de rectification aux informations qui vous concernent, que vous pouvez exercer en vous adressant à <a class="alert" style="color:blue;">mercier@vote2017.fr</a><br/><br />
			Vous pouvez &eacute;galement, pour des motifs l&eacute;gitimes, vous opposer au traitement des donn&eacute;es vous concernant.
			Nous utilisons diff&eacute;rents cookies sur le site pour am&eacute;liorer nos services. En vue d’adapter le site aux demandes de ses visiteurs, nous mesurons le nombre de visites, le nombre de pages vues ainsi que de l'activit&eacute; des visiteurs sur le site et leur fr&eacute;quence de retour.<br/><br />
			Nous collectons votre adresse IP, afin d’&eacute;tablir des statistiques pr&eacute;cises en admettant un seul vote par IP, ainsi que pour d&eacute;terminer le d&eacute;partement depuis lequel vous vous connectez. Vote2017 ne peut donc en aucun cas remonter par ce biais à une personne physique.<br/><br />
			NOUS NE DIVULGONS PAS VOS INFORMATIONS PERSONNELLES.</p>
			<br>
			<h2>G&eacute;olocalisation</h2>

			<p>Nous collectons &eacute;galement votre g&eacute;olocalisation afin d’&eacute;tablir des statistiques pr&eacute;cises en d&eacute;terminant  le d&eacute;partement dans lequel votre adresse IP est localis&eacute;e. Ces informations restent confidentielles et nous ne pouvons en aucun cas remonter par ce biais à une personne physique. Cette localisation intervient uniquement dans l’onglet « carte » du site.<br/><br />
			NOUS NE DIVULGONS PAS VOTRE LOCALISATION.<br><br>
			Conform&eacute;ment aux articles 39 et suivants de la loi n° 78-17 du 6 janvier 1978 modifi&eacute;e en 2004 relative à l’informatique, aux fichiers et aux libert&eacute;s, toute personne peut obtenir communication et, le cas &eacute;ch&eacute;ant, rectification ou suppression des informations la concernant, en s’adressant au service <a class="alert" style="color:blue;">contact@vote2017.fr</a>.</p>
			<br>
			<h2>Remerciements</h2>
			<p>Nous remercions le service <a href="http://maxmind.com" target=" _blank">MaxMind</a> pour sa géolocalisation, ainsi que le service <a href="http://highcharts.com/" target=" _blank">Highcharts</a> pour ses graphiques. De même pour le site <a href="http://tympanus.net/codrops/" target=" _blank">Codrops</a> qui nous a inspiré pour le design du site.</p>

			<br><a href="http://vote2017.fr"><p class="center">Revenir au site</p></a>
		</div>
		
		<script>
			$(function() {
				$(document).on('click', '.alert', function(e) {
				bootbox.dialog({title: 'Envoyer un message', onEscape: function () { $('.bootbox.modal').modal('hide');	}, message: '<div class=row><div class=col-md-12><form class=form-horizontal id=leform method=post autocomplete= action=include/validation.php><div class=form-group><label class=col-md-4 control-label for=name>Votre nom:</label><div class=col-md-7><input id=q1 size=40 name=q1 type=text class=form-control input-md required/></div></div><div class=form-group><label class=col-md-4 control-label for=mail>Votre adresse e-mail:</label><div class=col-md-7><input id=q2 size=40 name=q2 type=mail class=form-control input-md required/></div></div><div class=form-group><label class=col-md-4 control-label for=message>Votre message:</label><div class=col-md-7><input id=q3 size=200 name=q3 type=message class=form-control input-md required/></div></div><div class=modal-footer></div><button data-bb-handler=ok type=submit class=btnvote style=padding:12px 24px;margin:0 0 15px>Envoyer</button></form></div></div>' }); });
			});
		</script>
	</body>
</html>