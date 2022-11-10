<?php

//connexion à la BDD
$BDD=[];
$BDD['host']="localhost";
$BDD['user']="root";
$BDD['pass']="";
$BDD['base']="bdproalpha";
if(!$mysqli = mysqli_connect($BDD['host'],$BDD['user'],$BDD['pass'],$BDD['base'])){
	exit("SQL: Error to connect.");
}

?>
<!doctype html>
<html>
  <head>
    <meta charset="UTF-8"/>
    <title>proAlpha</title>
		<style>
		*{
			box-sizing:border-box;
			font-family:verdana,sans-serif;
			font-size:15px;
			line-height:1.7;
			letter-spacing:0.7px;
			color:#4e4e4e
		}
		body,html {
			margin: 0;
			padding: 0;
		}
		tr.header th{
			vertical-align:top;
		}
		tr.header th.jour{
			color:#fff;
			background-color:#004e86;
		}
		#tableau {
			width: 90%;
			overflow: auto;
			margin:30px auto;
			position: relative;
		}
		.choix_des_mois {
			display:flex;
			justify-content:space-between;
			position:  absolute;
			top: 0;
			right: 0;
			left: 0;
		}
		.case_a_cocher.cochee {
			background-color: #f9f9f9;
			color: #697f38;
			font-weight: bold;
			text-align: center;
		}
		td.senregistrer input{
			width:150px;
			display:block;
		}
		.total_case_ce_jour{
			text-align:center;
		}
		 td.prenom {
            text-align: right;
            padding-right: 15px;
        }
    td.senregistrer,td.prenom {
            position:sticky;
            left:0;
            background-color:#f9f9f9;
        }
		td.prenom a {
			font-size:10px;
			color:red;
		}
		.case_a_cocher {
			min-width: 70px;
			text-align: center;
		}
		.case_a_cocher.cochee a {
			text-decoration: none;
		}
		.tabulation { 
display: inline-block; 
margin-left: 70px; 
} 
		</style>
  </head>
<body>

<?php
$jours_fr = [
	1=>"Mon",//day",
	2=>"Tue",//sday",
	3=>"Wed",//nesday",
	4=>"Thu",//rsday",
	5=>"Fri",//day",
	6=>"Sat",//urday",
	7=>"Sun",//day,
];
$mois_fr = [
	1=> 'January',
	2=> 'February',
	3=> 'March',
	4=> 'April',
	5=> 'May',
	6=> 'June',
	7=> 'July',
	8=> 'August',
	9=> 'September',
	10=>'October',
	11=>'November',
	12=>'December',
];


//par defaut on affiche le mois actuel (n = Mois sans les zéros initiaux 1 à 12)
$GETmois=date("n");

//si on souhaite afficher un autre mois
if(isset($_GET['mois']) AND preg_match("#^[1-9]|[10-12]$#",$_GET['mois']))
  $GETmois=$_GET['mois'];


//par defaut on affiche l'année actuelle:
$GETannee=date("Y");
//mais si on souhaite afficher une autre année
if(isset($_GET['annee']) AND preg_match("#^[0-9]{4}$#",$_GET['annee']))
  $GETannee=$_GET['annee'];


//nombre de jour dans le mois
$NbrJrDsLeMois=date('t',mktime(1,1,1,$GETmois,1,$GETannee));

//fonction qui vérifie si la case est cochée
function caseCochee($id_prenom, $jour, $mois, $id_ville){
	global $mysqli;
	if(mysqli_num_rows(mysqli_query($mysqli,"SELECT * FROM cases_cochees WHERE id_prenom = $id_prenom AND jour = $jour AND mois = $mois AND id_ville = $id_ville")) == 1)
		return true;
	return false;
}



//on choisi une ville
$id_ville = false;

//on choisi une date, on cachera le tableau
$choix_date = false;

if(isset($_GET['id_ville'])){
	
	//on vérifi si la ville choisie existe
	$req = mysqli_query($mysqli,"SELECT * FROM site WHERE id = '". mysqli_real_escape_string($mysqli, $_GET['id_ville']) ."'");
	
	if(mysqli_num_rows($req) == 1)
		$id_ville = (INT) $_GET['id_ville'];
	
	$info_ville = mysqli_fetch_assoc($req);
	
	
}
	

	
	//choix d'une ville et affichjage du tableau suivant la ville choisie
	?>
	
	<form method="get">
		<select name="id_ville" class="tabulation">
			<option>Location</option>
		<?php
		$req = mysqli_query($mysqli,"SELECT * FROM site");
		while($info = mysqli_fetch_assoc($req)){
			?>
			<option  value="<?=$info['id']?>"><?=$info['nom']?></option>
			<?php
		}
		?>
		</select>
		<input type="submit" value="Submit">

	</form>
	<?php
	
if($id_ville){
	
	echo '<h1 class="tabulation" style="color:#697f38;">City : '. $info_ville['nom'] .'</h1>';

	//si on souhaite s'enregistrer
	if(isset($_POST['prenom']) && trim($_POST['prenom']) != ''){
		if(mysqli_query($mysqli,"INSERT INTO employe SET prenom = '". mysqli_real_escape_string($mysqli, $_POST['prenom']) ."', idSite = $id_ville"))
			echo "<h1 style='color:green'>successfully registered !</h1>";
		else
			echo "<h1 style='color:red'>An error has occurred !</h1>";
	}


	//si on souhaite cocher
	if(isset($_GET['cocher'],$_GET['id_prenom'],$_GET['jour'],$_GET['mois'])){
		
		$jour = (int) $_GET['jour'];
		$mois = (int) $_GET['mois'];
		$id_prenom = (int) $_GET['id_prenom'];
		$cocher = (int) $_GET['cocher'];
		
		$url = '?cocher='. $cocher .'&id_prenom='. $id_prenom .'&jour='. $jour .'&mois='. $mois .'&id_ville='. $id_ville;
		
		
		if(($jour > 0 && $jour < 32) && ($mois > 0 && $mois < 13) && $id_prenom > 0){
			
			//on coche
			if($cocher == 1){
				//vérifi si elle existe pas
				if(mysqli_num_rows(mysqli_query($mysqli,"SELECT * FROM cases_cochees WHERE id_prenom = $id_prenom AND jour = $jour AND mois = $mois AND id_ville = $id_ville")) == 0){
					
					//on fait choisir un bureau
					$id_bureau = false;
					
					$choix_date = true;
					
					?>
					<p><a href="?id_ville=<?=$id_ville?>" class="tabulation" style="color:red; font-size:20px;">Return to the registration table</a></p><br/>
					<h1 class="tabulation" style="color:#697f38; font-size:30px;">Select an office</h1></br><br/>
					
					<?php
					
					$req = mysqli_query($mysqli,"SELECT * FROM bureau WHERE id_ville= $id_ville");
					while($info = mysqli_fetch_assoc($req)){
						
						//on l'affiche pas si il est pas dispo mais on laisse par sécurité la vérification plus bas pour éviter de laisser les personnes mal intentionnées sélectionner plusieurs fois le même bureau
						if(mysqli_num_rows(mysqli_query($mysqli,"SELECT * FROM cases_cochees WHERE id_ville = $id_ville AND jour = $jour AND mois = $mois AND id_prenom = $id_prenom AND id_bureau = ". $info['id'])) == 0)
							echo '<a href="'. $url .'&id_bureau='. $info['id'] .'" class="tabulation">'. $info['nom'] .' '. $info['nbEcran'] .' Ecran '. $info['docking'] .' Docking</a><br/><br/>';
						else
							echo "deja pris";
					}
					
					if(isset($_GET['id_bureau'])){
						//on vérifi si le bureau choisi existe et qu'il est dispo
						$req = mysqli_query($mysqli,"SELECT * FROM bureau WHERE id = '". mysqli_real_escape_string($mysqli,$_GET['id_bureau']) ."'");
						
						if(mysqli_num_rows($req) == 1)
							$id_bureau = (INT) $_GET['id_bureau'];
					}
					
					if($id_bureau){
						
						//on vérifi si le bureau est dispo
						if(mysqli_num_rows(mysqli_query($mysqli,"SELECT * FROM cases_cochees WHERE id_ville = $id_ville AND jour = $jour AND mois = $mois AND id_bureau = $id_bureau")) != 0){
							
							echo "<h1 style='color:red' class='tabulation'>Office already taken, choose another one!</h1>";
					
						}else{
						
							//on coche la case
							if(mysqli_query($mysqli,"INSERT INTO cases_cochees SET id_prenom = $id_prenom, jour = $jour, mois = $mois, id_ville = $id_ville, id_bureau = $id_bureau")){
								echo "<h1 style='color:green' class='tabulation'>Booked successfully !</h1></br>";
								echo '<a href="?id_ville='. $id_ville .'" style="color:#697f38; font-size:30px;" class="tabulation">Back to table</a>';
								
							}else
								echo "<h1 style='color:red'>Une erreur s'est produite !</h1>";
					
						}
						
					}
					
				}else{
					//echo "<h1 style='color:red'>Déjà cochée !</h1>";
				}
			}else{
				if(mysqli_query($mysqli,"DELETE FROM cases_cochees WHERE id_prenom = $id_prenom AND jour = $jour AND mois = $mois AND id_ville = $id_ville"))
					echo " ";
				else
					echo "<h1 style='color:red'>An error has occurred !</h1>";
			}
		}
	}
	
	
		
}//id_ville
?>
</body>
</html>
