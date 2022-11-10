<?php
	require_once("controleur/initB.php");
	require_once("Database.php");

	//CheckLogin();
	
	if( $OnSubmitForm )
	{
			//session_start();	// initialiser ou récupérer les infos $_SESSION 

		// récupération en SESSION si cela était fait précédement (uniquement la génération précédante)
		if( !empty($_SESSION['bureau']) &&( $_SESSION['nom']) &&( $_SESSION['nb_Ecran']) &&( $_SESSION['Docking']) &&( $_SESSION['site']))
		{
			echo "<b>		Récupération (SESSION) du bureau :</b>\n";
			print_r( $_SESSION['bureau'] );
		}
		else if( ($res = GetResult("bdproalpha", "bureau", "nom = '$nom'")) instanceof mysqli_result )
		{
			$nomBureau = GetElementFromResult($res, 'nom');
			Close_result( $res );
			
			echo "		<h1 style='color:green'>		the desk already exist :</h1>		$nomBureau<br/>";
			
			// Ré-Inscription de la dernière génération en SESSION
			$_SESSION['nom'] 		 = $nomBureau;
			$_SESSION['nb_Ecran'] = $nbEcran;
			$_SESSION['Docking']  = $docking;
			$_SESSION['site']  = $id_ville;
		}
		else
		{
			// Génération de la suite + affichage
			//echo "<b>Vous avez bien ajouté votre bureau:</b>";
			$nomBureau = $nom;
			echo "		$nomBureau<br/>";

			
						
			// inscription dans la BDD (uniquement si pas déjà réalisé)
			// étant donné la clé unique construit avec id, on peut se permettre de tenter un INSERT qui n'aboutira pas si ce dernier existe déjà
			$req = "INSERT INTO bureau (`nom`, `nbEcran`, `docking`, `id_ville`) VALUES ('$nomBureau', '$nbEcran', '$docking', $id_ville)";
			PerformeQueryOnly("bdproalpha", $req);
		}
	}

?>