<div style="background-color: #F9F9F9;">
	<br><hr class="hr"><br>
	<div class="compteur"></div>
	<p class="center grey">restants avant le premier tour des élections présidentielles françaises.</p>
	<br>
	<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- Vote 2017 -->
<div style="text-align:center;">
<ins class="adsbygoogle"
     style="display:inline-block;width:320px;height:100px"
     data-ad-client="ca-pub-4409895193591774"
     data-ad-slot="9265638644"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>
</div>
</div>
<div style="margin-top: -9px;">
	<hr>
	<div>
		<p style="text-align: center;color:grey;text-decoration:none;font-size:80%;" class="footert">&copy; <a class="iframe cboxElement" style="color:grey;" href="/confidentialite.php">MENTIONS L&Eacute;GALES</a>  |  <a class="alert">CONTACT</a></p>
	</div>
</div>
<?php
	
	//Confirmation de l'envoi du vote
	if($_GET["vote"] == "send") { ?>
		<script>
			$(document).ready(function() {
				$().toastmessage('showToast', {
					text: 'Votre vote a bien &eacute;t&eaucte; compatabilis&eacute;',
					type: 'success'
				});
				history.pushState("vote2017.fr", "Vote2017.fr", "index.php");
			})
		</script>
	<?php }
	
	//Messages du GPS
	if($info_gps == true) { ?>
		<script>
			$(document).ready(function() {
				$().toastmessage('showToast', {
					text: '<?php echo $text_gps ?>',
					type: '<?php echo $text_color_gps ?>'
				});
				history.pushState("vote2017.fr", "Vote2017.fr", "index.php");
			})
		</script>
	<?php }
	
	//Affichage des Toasts (Mail)
	if($info_mail == true) { ?>
		<script>
			$(document).ready(function() {
				$().toastmessage('showToast', {
					text: '<?php echo $text_mail ?>',
					type: '<?php echo $text_color_mail ?>'
				});
				history.pushState("vote2017.fr", "Vote2017.fr", "index.php");
			})
		</script>
	<?php }	?>

	<script src="/script/onglets.js"></script>
	<script>
		new Onglets( document.getElementById( 'tabs' ) );
		(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

		ga('create', 'UA-64573939-1', 'auto');
		ga('send', 'pageview');
	</script>
	<script type="text/javascript" src="/script/timer.js" async></script>
	<script type="text/javascript" src="/script/scroll.js" async></script>
	</body>
</html>