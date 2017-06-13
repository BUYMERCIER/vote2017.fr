<script>
	$(function() {
		var status = false;
		var message = "<div class='row'><div class='col-md-12'><form class='form-horizontal' id='leform' method='post' action='/include/validation.php'><div class='form-group'><label class='col-md-4 control-label' for='name'>Votre nom:</label><div class='col-md-7'><input id='q1' size='40' name='q1' type='text' class='form-control input-md' required></div></div><div class='form-group'><label class='col-md-4 control-label' for='mail'>Votre adresse e-mail:</label><div class='col-md-7'><input id='q2' size='40' name='q2' type='mail' class='form-control input-md' required></div></div><div class='form-group'><label class='col-md-4 control-label' for='message'>Votre message:</label><div class='col-md-7'><input id='q3' size='200' name='q3' type='message' class='form-control input-md' required></div></div><div class='modal-footer'></div><button type='submit' class='btnvote' style='padding:12px'>Envoyer</button></form></div></div>";

		<?php
		if(isset($_COOKIE['valid_cookie'])) {
			if ($info_Toast != "") {
				echo $form_part1, $remove_Toast, $form_part2, $add_Toast_part1, $info_Toast, $add_Toast_part2, $info_Toast;
			} else {
				echo $form_part1, $form_part2;
			}
		} else {
			
			echo "
			bootbox.dialog({
				title: 'Bienvenue sur le site vote2017.fr',
				message: 'Quel sera le futur pr&eacute;sident? Quel parti politique sera &agrave; la t&ecirc;te de la R&eacute;publique Fran&ccedil;aise? Vote2017 r&eacute;pondra &agrave; vos questions concernant les pr&eacute;sidentielles de 2017.<hr/> Notre site propose des statistiques, graphiques et cartes g&eacute;ographiques qui permettront d&apos;anticiper les &eacute;lections de 2017.	Bas&eacute; sur un syst&egrave;me de vote simple, ludique et ouvert &agrave; tout fran&ccedil;ais, vote2017.fr est le premier site d&apos;anticipation des pr&eacute;sidentielles. Votez, Anticipez.<hr/>En utilisant ce site, vous acceptez l&apos;installation et l&apos;utilisation de cookies sur votre appareil, permettant de vous proposer un service de meilleure qualit&eacute;',
				onEscape: function () {
					$('.bootbox.modal').modal('hide');
				},
				buttons: {
					success: {
						label: 'Valider',
						className: '',
						callback: function() {
							var date = new Date();
							date.setTime(date.getTime()+(315360000000));
							document.cookie = 'valid_cookie=1; expires='+date.toGMTString();";
							if ($info_Toast != "") {
								echo $form_part1, $remove_Toast, $form_part2, $add_Toast_part1, $info_Toast, $add_Toast_part2, "e = '2';";
							} else {
								echo $form_part1, $form_part2;
							}
						echo "}
					}
				}
			});";
		}
		if($can_vote == true) { ?>
			$(document).on('click', '.vote', function(e) {
				$().toastmessage('removeToast', infoToast);
				bootbox.dialog({
					title: 'Vote - &Eacute;tape 1 / 4',
					onEscape: function () {
						$('.bootbox.modal').modal('hide');
					},
					message: 'Quel parti voudriez-vous voter pour 2017?',
					buttons: {
						FG: {
							label: 'Front de Gauche',
							className: 'btn btn-primary',
							callback: function () {
								$(document).ready( function (e) {
									var vote_id = '1';
									var vote = 'Front de Gauche',
									status = true;
									etap2(vote, vote_id);
								});
							}
						},
						EELV: {
							label: 'Europe &Eacute;cologie Les Verts',
							className: 'btn btn-primary',
							callback: function () {
								$(document).ready( function (e) {
									var vote_id = '2';
									var vote = 'Europe &Eacute;cologie Les Verts',
									status = true;
									etap2(vote, vote_id);
								});
							}
						},
						PS: {
							label: 'Parti Socialiste',
							className: 'btn btn-primary',
							callback: function () {
								$(document).ready( function (e) {
									var vote_id = '3';
									var vote = 'Parti Socialiste',
									status = true;
									etap2(vote, vote_id);
								});
							}
						},
						CENTRE: {
							label: 'Centre',
							className: 'btn btn-primary',
							callback: function () {
								$(document).ready( function (e) {
									var vote_id = '4';
									var vote = 'Centre',
									status = true;
									etap2(vote, vote_id);
								});
							}
						},
						DLF: {
							label: 'Debout la France',
							className: 'btn btn-primary',
							callback: function () {
								$(document).ready( function (e) {
									var vote_id = '5';
									var vote = 'Debout la France',
									status = true;
									etap2(vote, vote_id);
								});
							}
						},
						LR: {
							label: 'Les R&eacute;publicains',
							className: 'btn btn-primary',
							callback: function () {
								$(document).ready( function (e) {
									var vote_id = '6';
									var vote = 'Les R&eacute;publicains',
									status = true;
									etap2(vote, vote_id);
								});
							}
						},
						FN: {
							label: 'Front National',
							className: 'btn btn-primary',
							callback: function () {
								$(document).ready( function (e) {
									var vote_id = '7';
									var vote = 'Front National',
									status = true;
									etap2(vote, vote_id);
								});
							}
						},
						Blanc: {
							label: 'Voter Blanc',
							className: 'btn btn-primary',
							callback: function () {
								$(document).ready( function (e) {
									var vote_id = '8';
									var vote = 'Voter Blanc',
									status = true;
									etap2(vote, vote_id);
								});
							}
						}
					}
				});
			});
			
			function etap2(vote, vote_id) {
				setTimeout(function() {
					$(document).ready( function(e) {
						$().toastmessage('removeToast', infoToast);
						bootbox.dialog({
							onEscape: function () {
								$('.bootbox.modal').modal('hide');
							},
							title: 'Vote - &Eacute;tape 2 / 4',
							message: 'Vous avez choisi ' + vote + '<br><br>&Ecirc;tes-vous un Homme ou une Femme?',
							buttons: {
								homme: {
									label: 'Je suis un Homme',
									className: 'btn btn-primary',
									callback: function () {
										$(document).ready( function (e) {
											var sexe = 'Homme';
											var sexe_id = 'hommes';
											status = true;
											etap3(vote, vote_id, sexe, sexe_id);
										});
									}
								},
								femme: {
									label: 'Je suis une Femme',
									className: 'btn btn-primary',
									callback: function() {
										$(document).ready( function (e) {
											var sexe = 'Femme';
											var sexe_id = 'femmes';
											status = true;
											etap3(vote, vote_id, sexe, sexe_id);
										});
									}
								}
							}
						});
					});
				}, 400);
			}
			
			function etap3(vote, vote_id, sexe, sexe_id) {
				setTimeout(function() {
					$(document).ready( function(e) {
						$().toastmessage('removeToast', infoToast);
						bootbox.dialog({
							onEscape: function () {
								$('.bootbox.modal').modal('hide');
							},
							title: 'Vote - &Eacute;tape 3 / 4',
							message: 'Vous avez choisi ' + vote + ' et ' + sexe + '<br><br>Quel &acirc;ge avez-vous?',
							buttons: {
								1: {
									label: 'Moins de 18 ans',
									className: 'btn btn-primary',
									callback: function () {
										$(document).ready( function (e) {
											var age = 'Moins de 18 ans';
											var age_id = '1';
											status = true;
											etap4(vote, vote_id, sexe, sexe_id, age, age_id);
										});
									}
								},
								2: {
									label: 'Entre 18 et 25 ans',
									className: 'btn btn-primary',
									callback: function () {
										$(document).ready( function (e) {
											var age = 'Entre 18 et 25 ans';
											var age_id = '2';
											status = true;
											etap4(vote, vote_id, sexe, sexe_id, age, age_id);
										});
									}
								},
								3: {
									label: 'Entre 26 et 35 ans',
									className: 'btn btn-primary',
									callback: function () {
										$(document).ready( function (e) {
											var age = 'Entre 26 et 35 ans';
											var age_id = '3';
											status = true;
											etap4(vote, vote_id, sexe, sexe_id, age, age_id);
										});
									}
								},
								4: {
									label: 'Entre 36 et 45 ans',
									className: 'btn btn-primary',
									callback: function () {
										$(document).ready( function (e) {
											var age = 'Entre 36 et 45 ans';
											var age_id = '4';
											status = true;
											etap4(vote, vote_id, sexe, sexe_id, age, age_id);
										});
									}
								},
								5: {
									label: 'Entre 46 et 60 ans',
									className: 'btn btn-primary',
									callback: function () {
										$(document).ready( function (e) {
											var age = 'Entre 46 et 60 ans';
											var age_id = '5';
											status = true;
											etap4(vote, vote_id, sexe, sexe_id, age, age_id);
										});
									}
								},
								6: {
									label: 'Entre 61 et 80 ans',
									className: 'btn btn-primary',
									callback: function () {
										$(document).ready( function (e) {
											var age = 'Entre 61 et 80 ans';
											var age_id = '6';
											status = true;
											etap4(vote, vote_id, sexe, sexe_id, age, age_id);
										});
									}
								},
								7: {
									label: 'Plus de 81 ans',
									className: 'btn btn-primary',
									callback: function () {
										$(document).ready( function (e) {
											var age = 'Plus de 81 ans';
											var age_id = '7';
											status = true;
											etap4(vote, vote_id, sexe, sexe_id, age, age_id);
										});
									}
								}
							}
						});
					});
				}, 400);
			}
			
			function etap4(vote, vote_id, sexe, sexe_id, age, age_id) {
				setTimeout(function() {
					$(document).ready( function(e) {
						$().toastmessage('removeToast', infoToast);
						bootbox.dialog({
							onEscape: function () {
								$('.bootbox.modal').modal('hide');
							},
							title: 'Vote - &Eacute;tape 4 / 4',
							message: 'Vous avez choisi ' + vote + ', ' + sexe + ', ainsi que ' + age + '<br><br>Quel est votre statut social?',
							buttons: {
								1: {
									label: 'Agriculteur/Exploitant',
									className: 'btn btn-primary',
									callback: function () {
										$(document).ready( function (e) {
											status = true;
											statut = '1';
											statut_id = 'Agriculteur/Exploitant';
											etap5(vote, vote_id, sexe, sexe_id, age, age_id, statut, statut_id);
										});
									}
								},
								2: {
									label: 'Artisan/Commer&ccedil;ant',
									className: 'btn btn-primary',
									callback: function () {
										$(document).ready( function (e) {
											status = true;
											statut = '2';
											statut_id = 'Artisan/Commer&ccedil;ant';
											etap5(vote, vote_id, sexe, sexe_id, age, age_id, statut, statut_id);
										});
									}
								},
								3: {
									label: 'Cadre/Chef d&apos;entreprise',
									className: 'btn btn-primary',
									callback: function () {
										$(document).ready( function (e) {
											status = true;
											statut = '3';
											statut_id = 'Cadre/Chef d&apos;entreprise';
											etap5(vote, vote_id, sexe, sexe_id, age, age_id, statut, statut_id);
										});
									}
								},
								4: {
									label: 'Profession interm&eacute;diaire/Technicien/Sant&eacute; et social',
									className: 'btn btn-primary',
									callback: function () {
										$(document).ready( function (e) {
											status = true;
											statut = '4';
											statut_id = 'Profession interm&eacute;diaire/Technicien/Sant&eacute; et social';
											etap5(vote, vote_id, sexe, sexe_id, age, age_id, statut, statut_id);
										});
									}
								},
								5: {
									label: 'Employ&eacute;/Fonctionnaire',
									className: 'btn btn-primary',
									callback: function () {
										$(document).ready( function (e) {
											status = true;
											statut = '5';
											statut_id = 'Employ&eacute;/Fonctionnaire';
											etap5(vote, vote_id, sexe, sexe_id, age, age_id, statut, statut_id);
										});
									}
								},
								6: {
									label: 'Ouvrier/Chauffeurs',
									className: 'btn btn-primary',
									callback: function () {
										$(document).ready( function (e) {
											status = true;
											statut = '6';
											statut_id = 'Ouvrier/Chauffeurs';
											etap5(vote, vote_id, sexe, sexe_id, age, age_id, statut, statut_id);
										});
									}
								},
								7: {
									label: 'Retrait&eacute;',
									className: 'btn btn-primary',
									callback: function () {
										$(document).ready( function (e) {
											status = true;
											statut = '7';
											statut_id = 'Retrait&eacute;';
											etap5(vote, vote_id, sexe, sexe_id, age, age_id, statut, statut_id);
										});
									}
								},
								8: {
									label: '&Eacute;tudiant',
									className: 'btn btn-primary',
									callback: function () {
										$(document).ready( function (e) {
											status = true;
											statut = '8';
											statut_id = '&Eacute;tudiant';
											etap5(vote, vote_id, sexe, sexe_id, age, age_id, statut, statut_id);
										});
									}
								},
								9: {
									label: 'Autre/Sans emploi',
									className: 'btn btn-primary',
									callback: function () {
										$(document).ready( function (e) {
											status = true;
											statut = '9';
											statut_id = 'Autre/Sans emploi';
											etap5(vote, vote_id, sexe, sexe_id, age, age_id, statut, statut_id);
										});
									}
								},

							}
						});
					});
				}, 400);
			}
			
			function etap5(vote, vote_id, sexe, sexe_id, age, age_id, statut, statut_id) {
				if(vote_id == 8) {
					setTimeout(function() {
						$(document).ready( function(e) {
							$().toastmessage('removeToast', infoToast);
							bootbox.dialog({
								onEscape: function () {
									$('.bootbox.modal').modal('hide');
								},
								title: 'Vote - &Eacute;tape Finale',
								message: 'Vous avez choisi ' + vote + ', ' + sexe + ', ' + age + ', ainsi que ' + statut_id + '<br><br>Vous avez choisi de voter blanc (1 vote blanc = 1 vote nul = 1 abstention).<br>Quel est la raison de ce choix?',
								buttons: {
									1: {
										label: 'D&eacute;saccord',
										className: 'btn btn-primary',
										callback: function () {
											$(document).ready( function (e) {
												status = true;
												choix = '1';
												etap6(vote_id, sexe_id, age_id, statut, choix);
											});
										}
									},
									2: {
										label: 'Incapacit&eacute; physique',
										className: 'btn btn-primary',
										callback: function () {
											$(document).ready( function (e) {
												status = true;
												choix = '2';
												etap6(vote_id, sexe_id, age_id, statut, choix);
											});
										}
									},
									3: {
										label: 'Autre raison',
										className: 'btn btn-primary',
										callback: function () {
											$(document).ready( function (e) {
												status = true;
												choix = '3';
												etap6(vote_id, sexe_id, age_id, statut, choix);
											});
										}
									},
									4: {
										label: 'Ignorer',
										className: 'btn btn-primary',
										callback: function () {
											$(document).ready( function (e) {
												status = true;
												choix = '3';
												etap6(vote_id, sexe_id, age_id, statut, choix);
											});
										}
									}
								}
							});
						});
					}, 400);
				} else {
					var date=new Date();
					date.setTime(date.getTime()+(3153600000000));
					document.cookie='accept_vote=1; expires='+date.toGMTString();
					document.location.href = 'vote.php?vote=' + vote_id + '&sexe=' + sexe_id + '&age=' + age_id + '&statut=' + statut;
				}
			}
			
			function etap6(vote_id, sexe_id, age_id, statut, choix) {
				var date=new Date();
				date.setTime(date.getTime()+(3153600000000));
				document.cookie='accept_vote=1; expires='+date.toGMTString();
				document.location.href = 'vote.php?vote=' + vote_id + '&sexe=' + sexe_id + '&age=' + age_id + '&statut=' + statut + '&choix=' + choix;
			}
		<?php }	?>
	});
</script>
