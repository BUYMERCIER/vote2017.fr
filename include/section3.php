<?php

//Connexion à la BDD
try {
	@$connexion = new PDO("mysql:host=votefrypwxsql.mysql.db;dbname=votefrypwxsql;charset=utf8", "votefrypwxsql", "33stresS33", array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8", PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
} catch (PDOException $e) {
	echo 'Connexion &eacute;chou&eacute;e : ' . $e->getMessage();
}

if(!isset($_GET['draw'])) {
	include("header.php");
	echo "<div id='popularite'></div>";
}

?>

<script>

$(function () {

	$('#popularite').highcharts({
		chart: {
			zoomType: 'x',
			type: 'areaspline',
			backgroundColor: '#F9F9F9'
		},
		
		title: {
			text: 'Popularit\351 des partis politiques'
		},
		
		subtitle: {
			text: document.ontouchstart === undefined ?
					'Cliquez et balayez pour zoomer' : 'Pincez pour zoomer'
		},
		
		xAxis: {
			categories: [
			
			<?php
			
			$reponse = $connexion->query("SELECT * FROM get_stats");
				while ($donnees = $reponse->fetch()) {
					$id = $donnees['id'];
					$year = $donnees['year'];
					$xx_year = substr($donnees['year'], 2, 4);
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
		
		tooltip: {
			shared: true,
			valueSuffix: ' %'
		},
		
		plotOptions: {
			areaspline: {
				fillOpacity: 0.1,
			},
		},
		
		legend: {
            align: 'center',
            backgroundColor: '#F9F9F9'
        },
		
		navigation: {
			buttonOptions: {
				theme: {
					'stroke-width': 1,
					stroke: 'silver',
					r: 0,
					fill: '#F0F0F0',
                    states: {
                        select: {
                            stroke: '#F0F0F0'
                        }
                    }
                }
			}
		},
		

	   series: [{
		    name: 'FG',
			color: '#C0392B',
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
			color: '#0EAC51',
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
			color: '#EC87C0',
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
			color: '#BE90D4',
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
			color: '#7F8C8F',
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
			color: '#3498DB',
			data: [
			<?php
			
				$reponse = $connexion->query("SELECT op_6 FROM get_stats");
				while ($donnees = $reponse->fetch()) {
					$op = $donnees['op_6'];
					echo "$op,";
				}
				
			?>
			]
		},{
			name: 'FN',
			color: '#2968B9',
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