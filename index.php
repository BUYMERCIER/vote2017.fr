<?php include ("./include/init.php");
include ("./include/header.php");
include ("./include/bootbox.php");
?>
<div class="container">
	<header class="clearfix">
		<h1 class="animated bounceInDown">Vote 2017</h1>
	</header>	
	<div id="tabs" class="tabs">
		<nav>
			<ul>
				<li><a class="icon-graph"><span>Graphe</span></a></li>
				<li><a id="id_2" class="icon-carte"><span>Carte</span></a></li>
				<li><a id="id_3" class="icon-stats"><span>Stats</span></a></li>
				<li><a class="icon-contact"><span>Contact</span></a></li>
				<li><a class="icon-autre"><span>Actu</span></a></li>
			</ul>
		</nav>
		<div class="content">
			<section id="section-1">
				<div id="container"><div align="center">Chargement du graphique en cours...</div></div>
				<p class="center" style="color: black;" >Nombre total de votes : <b><?php echo $total_vote; ?></b></p>
				<?php if($can_vote == true) { ?>			
					<div class="btnvote vote" style="width: 102px; padding: 14px;">Voter</div>
				<?php } ?>
			</section>
			<section id="section-2">
				<div id="map"><div align="center">Chargement de la carte en cours...</div></div>
			</section>
			<section id="section-3">
				<?php include ("./include/section3_info.php") ?>
				<div id="popularite"><div align="center">Chargement du graphique en cours...</div></div>
				<p>Prochainement, des statistiques détaillées seront visibles sur cette page.</p>
			</section>
			<section id="section-4">
				<?php include("include/section4.php"); ?>
			</section>
			<section id="section-5">
				<?php include("include/section5.php"); ?>
			</section>
		</div>
		
	</div>
</div>

<script>
	$(document).ready(function() {
		setTimeout(function() {
			$('#container').load('./include/section1.php?draw');
		}, 1000);
	});
	var id_2 = "1";
	$("#id_2").click(function() {
		if(id_2 == "1") {
			$('#map').load('./include/section2.php?draw');
			id_2 = "0";
		}
	});
	var id_3 = "1";
	$("#id_3").click(function() {
		if(id_3 == "1") {
			$('#popularite').load('./include/section3.php?draw');
			id_3 = "0";
		}
	});
</script>
<?php include ("./include/footer.php"); ?>