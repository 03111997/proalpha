<?php
	require_once( "init.php" );
	require_once( "vue/tableau.php" );
	//CheckLogin();
	
	$Title = "Proalpha";
	$CSS = "style.css";
	include( "vue/HTMLHead.php" );
	$BDD=[];
	$BDD['host']="localhost";
	$BDD['user']="root";
	$BDD['pass']="";
	$BDD['base']="bdproalpha";
	$mysqli = mysqli_connect($BDD['host'],$BDD['user'],$BDD['pass'],$BDD['base']);

	if(isset($_GET['supprimer'])){
		$id_prenom = (int) $_GET['supprimer'];
		
		if(mysqli_query($mysqli,"DELETE FROM employe WHERE id = $id_prenom ")){
			echo "<h1 style='color:green'>Delete successfully !</h1>";
			
			//on supprime aussi les cases qu'il a coché
			mysqli_query($mysqli,"DELETE FROM cases_cochees WHERE id_prenom = $id_prenom");
			
		}else
			echo "<h1 style='color:red'>An error has occurred !</h1>";
	}
	?>

<div style='background-color: #929292'>
		<div style='text-align: center;'><a href='gestion' style="font-size:20px;" class="btn btn-primary btn-block btn-large">Disconnect</a></div>
	</div>


<style>
	
#customers {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  align: center;
  width: 80%;
  margin-left: 70px; 
}

#customers td, #customers th {
  border: 1px solid #ddd;
  padding: 8px;
}

#customers tr:nth-child(even){background-color: #f2f2f2;}

#customers tr:hover {background-color: #ddd;}

#customers th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #004E86;
  color: white;
}

@import url(https://fonts.googleapis.com/css?family=Open+Sans);
.btn { display: inline-block; *display: inline; *zoom: 1; padding: 4px 10px 4px; margin-bottom: 0; font-size: 13px; line-height: 18px; color: #333333; text-align: center;text-shadow: 0 1px 1px rgba(255, 255, 255, 0.75); vertical-align: middle; background-color: #f5f5f5; background-image: -moz-linear-gradient(top, #ffffff, #e6e6e6); background-image: -ms-linear-gradient(top, #ffffff, #e6e6e6); background-image: -webkit-gradient(linear, 0 0, 0 100%, from(#ffffff), to(#e6e6e6)); background-image: -webkit-linear-gradient(top, #ffffff, #e6e6e6); background-image: -o-linear-gradient(top, #ffffff, #e6e6e6); background-image: linear-gradient(top, #ffffff, #e6e6e6); background-repeat: repeat-x; filter: progid:dximagetransform.microsoft.gradient(startColorstr=#ffffff, endColorstr=#e6e6e6, GradientType=0); border-color: #e6e6e6 #e6e6e6 #e6e6e6; border-color: rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.25); border: 1px solid #e6e6e6; -webkit-border-radius: 4px; -moz-border-radius: 4px; border-radius: 4px; -webkit-box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.2), 0 1px 2px rgba(0, 0, 0, 0.05); -moz-box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.2), 0 1px 2px rgba(0, 0, 0, 0.05); box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.2), 0 1px 2px rgba(0, 0, 0, 0.05); cursor: pointer; *margin-left: .3em; }
.btn:hover, .btn:active, .btn.active, .btn.disabled, .btn[disabled] { background-color: #e6e6e6; }
.btn-large { padding: 9px 14px; font-size: 15px; line-height: normal; -webkit-border-radius: 5px; -moz-border-radius: 5px; border-radius: 5px; }
.btn:hover { color: #333333; text-decoration: none; background-color: #e6e6e6; background-position: 0 -15px; -webkit-transition: background-position 0.1s linear; -moz-transition: background-position 0.1s linear; -ms-transition: background-position 0.1s linear; -o-transition: background-position 0.1s linear; transition: background-position 0.1s linear; }
.btn-primary, .btn-primary:hover { text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.25); color: #ffffff; }
.btn-primary.active { color: rgba(255, 255, 255, 0.75); }
.btn-primary { background-color: #004E86; background-image: -moz-linear-gradient(top, #004E86, #004E86); background-image: -ms-linear-gradient(top, #6eb6de, #004E86); background-image: -webkit-gradient(linear, 0 0, 0 100%, from(#6eb6de), to(#004E86)); background-image: -webkit-linear-gradient(top, #004E86, #004E86); background-image: -o-linear-gradient(top, #004E86, #004E86); background-image: linear-gradient(top, #6eb6de, #004E86); background-repeat: repeat-x; filter: progid:dximagetransform.microsoft.gradient(startColorstr=#6eb6de, endColorstr=#004E86, GradientType=0);  border: 1px solid #004E86; text-shadow: 1px 1px 1px rgba(0,0,0,0.4); box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.2), 0 1px 2px rgba(0, 0, 0, 0.5); }
.btn-primary:hover, .btn-primary:active, .btn-primary.active, .btn-primary.disabled, .btn-primary[disabled] { filter: none; background-color: #004E86; }
.btn-block { width: 100%; display:block; }
</style>
</head>
<body>

<h1 id="customers">Table of Name</h1>

<table id="customers">
  <tr>
    <th>Name</th>
	<th>Delete</th>
	
  </tr>
  <tr>
   <?php
	if($id_ville){			
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
						
						<td><?=$infos['prenom']?></td>
						<td><a href="?supprimer=<?=$infos['id']?>" onclick="return confirm('Are you sure ?')"><img src="vue/images/1"></a></td>
						
						<!-- les jours -->
						
				</tr>
				<?php
				}
			}
			?>
  </tr>
  
</table>




