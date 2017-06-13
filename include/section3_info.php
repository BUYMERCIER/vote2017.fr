<?php

$total = $connexion->query("SELECT votes_hommes FROM poll_data");
$total_hommes = "0";
while ($donnees = $total->fetch()) {
	$total_hommes = $total_hommes + $donnees['votes_hommes'];
}

$total = $connexion->query("SELECT votes_femmes FROM poll_data");
$total_femmes = "0";
while ($donnees = $total->fetch()) {
	$total_femmes = $total_femmes + $donnees['votes_femmes'];
}

$result_hommes = $total_hommes / $total_vote * 100;
$result_femmes = $total_femmes / $total_vote * 100;
$result_hommes_2 = 100 - $result_hommes;
$result_femmes_2 = 100 - $result_femmes;

?>

<div class="center" style="text-align: center; width: 60%; height: 150px;">
	<p>Taux de vote par sexe</p>
	<div style="float: left; height: 129px;">
		<img src="/img/h.png" style="height: 177px; width: 60px; z-index: 100; position: absolute; margin-left: -5px;">
		<div style="height: 162px; position: absolute;">
			<div style="background: rgb(255, 255, 255); width: 50px; z-index: 0; margin-top: 7px; height: <?php echo $result_hommes_2; ?>%;"></div>
			<div style="background: rgb(35, 255, 255); width: 50px; z-index: 0; height: <?php echo $result_hommes; ?>%;"></div>
			<div style="margin: 10px -200px 0 -200px;">Hommes: <?php echo $total_hommes; ?> votes</div>
		</div>
	</div>
	<div style="float: right; height: 129px;">
		<img src="/img/f.png" style="height: 177px; width: 60px; z-index: 100; position: absolute; margin-left: -5px;">
		<div style="height: 162px; position: absolute;">
			<div style="background: rgb(255, 255, 255); width: 50px; z-index: 0; margin-top: 7px; height: <?php echo $result_femmes_2; ?>%"></div>
			<div style="background: rgb(35, 255, 255); width: 50px; z-index: 0; height: <?php echo $result_femmes; ?>%;"></div>
			<div style="margin: 10px -200px 0 -200px;">Femmes: <?php echo $total_femmes; ?> votes</div>
		</div>
	</div>
</div>

<hr class="hr" style="margin: 120px auto 20px">