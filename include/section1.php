<?php

//Connexion à la BDD
try {
	@$connexion = new PDO("mysql:host=votefrypwxsql.mysql.db;dbname=votefrypwxsql;charset=utf8", "votefrypwxsql", "33stresS33", array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8", PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
} catch (PDOException $e) {
	echo 'Connexion &eacute;chou&eacute;e : ' . $e->getMessage();
}

if(!isset($_GET['draw'])) {
	include("header.php");
	echo "<div id='container'></div>";
}

?>

<script>

$(function () {
	Highcharts.setOptions({
        colors: ['#C0392B', '#0EAC51', '#EC87C0', '#BE90D4', '#7F8C8D', '#3498DB', '#2968D9']
    });
	Highcharts.getOptions().colors = Highcharts.map(Highcharts.getOptions().colors, function (color) {
        return {
            radialGradient: {
                cx: 0.5,
                cy: 0.3,
                r: 0.7
            },
            stops: [
                [0, color],
                [1, Highcharts.Color(color).brighten(-0.3).get('rgb')] // darken
            ]
        };
    });
	
    $('#container').highcharts({
		chart: {
            type: 'column',
			backgroundColor: '#F9F9F9',
            options3d: {
                enabled: true,
                alpha: 10,
                beta: 0,
                viewDistance: 25,
                depth: 40
            },
			spacingBottom: 10,
			spacingTop: 10,
            marginTop: 80,
            marginRight: 40
        },

        title: {
            text: 'Estimation nationale par parti politique'
        },

        xAxis: {
            categories: ['']
        },

        yAxis: {
            allowDecimals: false,
            min: 0,
            title: false,
            labels: {
                format: '{value} %'
            }
        },

        plotOptions: {
            column: {
                stacking: 'normal'
            },
			animation: {
				duration: 1000
			}
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

        series: [
		
		<?php
		$total = $connexion->query("SELECT votes FROM poll_data");
		$total_vote = "0";
		while ($donnees = $total->fetch()) {
			$total_vote = $total_vote + $donnees['votes'];
		}
		$total->closeCursor();
		$reponse = $connexion->query("SELECT * FROM poll_data WHERE id <= 7 ORDER BY id ASC");
		while ($donnees = $reponse->fetch()) {
			$option_text = $donnees['option_text'];
			$vote_count = $donnees['votes'];
			$vote_val = sprintf("%.1f",($vote_count * 100/$total_vote));
			$poll_color = $donnees['color'];
			echo "{
				name: '$option_text',
				data: [$vote_val],
				stack: '$option_text',
				tooltip: {
					headerFormat: '<b>$option_text</b><br>',
					pointFormat: 'Nombre de votes: $vote_count votes, soit {point.y}% des votes'
				},
			},";
		}
		$reponse->closeCursor(); ?>
		
		
		],
		
		exporting: {
			x:-4,
			width: 1920,
			filename: 'vote2017_graphique'
		}
    });
});

</script>
