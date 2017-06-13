<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js" type="text/javascript"></script>
<script src="http://code.highcharts.com/highcharts.js"></script>
<script src="http://code.highcharts.com/modules/exporting.js"></script>

<div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>

<script charset="UTF-8">

$(function () {

	$('#container').highcharts({
		chart: {
			zoomType: 'x',
			type: 'areaspline',
		},
		title: {
			text: 'Popularit\351'
		},
		subtitle: {
			text: document.ontouchstart === undefined ?
					'Cliquez et balayez pour zoomer' : 'Pincez pour zoomer'
		},
		xAxis: {
			categories: [
			
			<?php
			
				try {
					@$connexion = new PDO("mysql:host=votefrypwxsql.mysql.db;dbname=votefrypwxsql;charset=utf8", "votefrypwxsql", "33stresS33", array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8", PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
				} catch (PDOException $e) {
					echo 'Connexion &eacute;chou&eacute;e : ' . $e->getMessage();
				}

				$reponse = $connexion->query("SELECT * FROM get_stats");
				while ($donnees = $reponse->fetch()) {
					$id = $donnees['id'];
					$year = $donnees['year'];
					$xx_year = substr($donnees['year'], 0, 2);
					$month = $donnees['month'];
					$day = $donnees['day'];
					echo "'$day/$month/$xx_year',";
				}
			
			?>
			
			]
		},
		yAxis: {
			title: {
				text: 'Taux de popularit\351'
			}
		},
		legend: {
			enabled: false
		},
		
		tooltip: {
			shared: true,
			valueSuffix: ' units'
		},
		plotOptions: {
			areaspline: {
				fillOpacity: 0.1,

			},
		 },
		
		

	   series: [{
		    name: 'FG',
			data: [
			<?php
			   
				$reponse = $connexion->query("SELECT op_1 FROM get_stats");
				while ($donnees = $reponse->fetch()) {
					$op = $donnees['op_1'];
					echo "$op,";
				}
				
			?>
			]
		}, {
			name: 'EELV',
			data: [
			<?php
			
				$reponse = $connexion->query("SELECT op_2 FROM get_stats");
				while ($donnees = $reponse->fetch()) {
					$op = $donnees['op_2'];
					echo "$op,";
				}
				
			?>
			]
		},{
			name: 'PS',
			data: [
			<?php
			
				$reponse = $connexion->query("SELECT op_3 FROM get_stats");
				while ($donnees = $reponse->fetch()) {
					$op = $donnees['op_3'];
					echo "$op,";
				}
				
			?>
			]
		},{
			name: 'CENTRE',
			data: [
			<?php
			
				$reponse = $connexion->query("SELECT op_4 FROM get_stats");
				while ($donnees = $reponse->fetch()) {
					$op = $donnees['op_4'];
					echo "$op,";
				}
				
			?>
			]
		},{
			name: 'DLF',
			data: [
			<?php
			
				$reponse = $connexion->query("SELECT op_5 FROM get_stats");
				while ($donnees = $reponse->fetch()) {
					$op = $donnees['op_5'];
					echo "$op,";
				}
				
			?>
			]
		},{
			name: 'LR',
			data: [
			<?php
			
				$reponse = $connexion->query("SELECT op_6 FROM get_stats");
				while ($donnees = $reponse->fetch()) {
					$op = $donnees['op_6'];
					echo "$op,";
				}
				
			?>
			]
		}, {
			name: 'FN',
			data: [
			<?php
			
				$reponse = $connexion->query("SELECT op_7 FROM get_stats");
				while ($donnees = $reponse->fetch()) {
					$op = $donnees['op_7'];
					echo "$op,";
				}
				
			?>
			]
		}]
	});
});
	
</script>

<div id="container_2" style="min-width: 310px; height: 400px; margin: 0 auto"></div>

<script>

$(function () {

	$('#container_2').highcharts({
		chart: {
			zoomType: 'x',
			type: 'areaspline',
		},
		title: {
			text: 'Statistiques'
		},
		subtitle: {
			text: document.ontouchstart === undefined ?
					'Cliquez et balayez pour zoomer' : 'Pincez pour zoomer'
		},
		xAxis: {
			categories: [
			
			<?php
			
				try {
					@$connexion = new PDO("mysql:host=votefrypwxsql.mysql.db;dbname=votefrypwxsql;charset=utf8", "votefrypwxsql", "33stresS33", array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8", PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
				} catch (PDOException $e) {
					echo 'Connexion &eacute;chou&eacute;e : ' . $e->getMessage();
				}

				$reponse = $connexion->query("SELECT * FROM get_stats");
				while ($donnees = $reponse->fetch()) {
					$id = $donnees['id'];
					$year = $donnees['year'];
					$xx_year = substr($donnees['year'], 0, 2);
					$month = $donnees['month'];
					$day = $donnees['day'];
					echo "'$day/$month/$xx_year',";
				}
			
			?>
			
			]
		},
		yAxis: {
			title: {
				text: 'Exchange rate'
			}
		},
		legend: {
			enabled: false
		},
		
		tooltip: {
			shared: true,
			 valueSuffix: ' units'
		},
		plotOptions: {
			areaspline: {
				fillOpacity: 1,

			},
		 },
		
		

	   series: [{
		    name: 'FG',
			data: [
			<?php
			   
				$reponse = $connexion->query("SELECT * FROM get_stats");
				while ($donnees = $reponse->fetch()) {
					$op = $donnees['op_7'] + $donnees['op_6'] + $donnees['op_5'] + $donnees['op_4'] + $donnees['op_3'] + $donnees['op_2'] + $donnees['op_1'];
					echo "$op,";
				}
				
			?>
			]
		}, {
			name: 'EELV',
			data: [
			<?php
			
				$reponse = $connexion->query("SELECT * FROM get_stats");
				while ($donnees = $reponse->fetch()) {
					$op = $donnees['op_7'] + $donnees['op_6'] + $donnees['op_5'] + $donnees['op_4'] + $donnees['op_3'] + $donnees['op_2'];
					echo "$op,";
				}
				
			?>
			]
		},{
			name: 'PS',
			data: [
			<?php
			
				$reponse = $connexion->query("SELECT * FROM get_stats");
				while ($donnees = $reponse->fetch()) {
					$op = $donnees['op_7'] + $donnees['op_6'] + $donnees['op_5'] + $donnees['op_4'] + $donnees['op_3'];
					echo "$op,";
				}
				
			?>
			]
		},{
			name: 'CENTRE',
			data: [
			<?php
			
				$reponse = $connexion->query("SELECT * FROM get_stats");
				while ($donnees = $reponse->fetch()) {
					$op = $donnees['op_7'] + $donnees['op_6'] + $donnees['op_5'] + $donnees['op_4'];
					echo "$op,";
				}
				
			?>
			]
		},{
			name: 'DLF',
			data: [
			<?php
			
				$reponse = $connexion->query("SELECT * FROM get_stats");
				while ($donnees = $reponse->fetch()) {
					$op = $donnees['op_7'] + $donnees['op_6'] + $donnees['op_5'];
					echo "$op,";
				}
				
			?>
			]
		},{
			name: 'LR',
			data: [
			<?php
			
				$reponse = $connexion->query("SELECT * FROM get_stats");
				while ($donnees = $reponse->fetch()) {
					$op = $donnees['op_7'] + $donnees['op_6'];
					echo "$op,";
				}
				
			?>
			]
		},{
			name: 'FN',
			data: [
			<?php
			
				$reponse = $connexion->query("SELECT * FROM get_stats");
				while ($donnees = $reponse->fetch()) {
					$op = $donnees['op_7'];
					echo "$op,";
				}
				
			?>
			]
		}]
	});
});
	
</script>