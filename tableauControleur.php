<?php

require_once("vue/pointage.php");
$BDD=[];
$BDD['host']="localhost";
$BDD['user']="root";
$BDD['pass']="";
$BDD['base']="bdproalpha";
$mysqli = mysqli_connect($BDD['host'],$BDD['user'],$BDD['pass'],$BDD['base']);
$GETmois=date("n");
$GETannee=date("Y");
$NbrJrDsLeMois=date('t',mktime(1,1,1,$GETmois,1,$GETannee));


if($id_ville){
				
	if(!$choix_date){
		?>

		<div id="tableau">
			
			<table>
				
				<!-- choix des mois -->
				<tr>
					
					<!-- vide pour les prénoms -->
					<th></th>
					
					<th colspan="<?=$NbrJrDsLeMois?>" style="height: 40px;">
						
							

							<div class="actuel">
								<?=$mois_fr[$GETmois].' '.$GETannee?>
							</div>
							
						
					</th>
				</tr>
				
				<!-- header -->
				<tr class="header">
					
					<!-- vide pour les prénoms -->
					<th></th>
					
					<!-- les jours -->
					<?php
					for($chiffreJour=1;$chiffreJour<=$NbrJrDsLeMois;$chiffreJour++){
						echo '<th class="jour">';
						
						echo $jours_fr[date('N',mktime(1,1,1,$GETmois,$chiffreJour,$GETannee))].'.<br/>'.$chiffreJour;
						
						echo '</th>';
					}
					?>
					
				</tr>
				
				<!-- s'enregistrer -->
				<tr>
					<td class="senregistrer">
						<form method="post">
							<input type="text" name="prenom" placeholder="Your name"/>
							<input type="submit" name="enre" value="To register"/>
						</form>
					</td>
				</tr>
				
				
				<!-- prénoms et cases à cocher -->
				<?php
				
				$array_jours = [];
				//while des prenoms enregistrés
				$nb_prenoms = 0;
				$req = mysqli_query($mysqli,"SELECT * FROM employe WHERE idSite = $id_ville ORDER BY prenom ASC");
				while($infos = mysqli_fetch_assoc($req)){
					$nb_prenoms ++;
					
					$bg = $nb_prenoms % 2 == 1 ? '#eeecf0;' : '#f7f7f7;';
					
					?>
					<tr class="cases_a_cocher" style="background-color: <?=$bg?>">
						
						<!-- les prénoms et les cases -->
						
						<td class="prenom"><?=$infos['prenom']?></a></td>
						
						<!-- les jours -->
						<?php
						for($chiffreJour=1; $chiffreJour <= $NbrJrDsLeMois; $chiffreJour++){
							
							
							//on vérifi si cet utilisateur à coché cette case
							if(caseCochee($infos['id'], $chiffreJour, $GETmois, $id_ville)){
								echo '<td class="case_a_cocher cochee">';
								echo '<a href="?cocher=0&id_prenom='. $infos['id'] .'&jour='. $chiffreJour .'&mois='. $GETmois .'&id_ville='. $id_ville .'"><img src="vue/images/k"/></a>';
								//on comptabilise
								if(isset($array_jours[$chiffreJour]))
									$array_jours[$chiffreJour] ++;
								else
									$array_jours[$chiffreJour] = 1;
									
							}else{
								echo '<td class="case_a_cocher">';
								echo '<a href="?cocher=1&id_prenom='. $infos['id'] .'&jour='. $chiffreJour .'&mois='. $GETmois .'&id_ville='. $id_ville .'"><img src="vue/images/0"/></a>';
							}
							
							
							echo '</td>';

						}
						?>
						
					</tr>
					<?php
				}
				?>
				
				<!-- totaux -->
				<tr>
					
					<!-- les prénoms -->
					<td class="prenom"><?=$nb_prenoms?></td>
					
					<!-- les cases cochées -->
					<?php
					for($chiffreJour=1; $chiffreJour <= $NbrJrDsLeMois; $chiffreJour++){
						
						echo '<td class="total_case_ce_jour">';
						
						if(isset($array_jours[$chiffreJour]))
							echo $array_jours[$chiffreJour];
						
						echo '</td>';
					}
					?>
					
				</tr>
			</table>
		</div>
		<?php
	}
}
?>