<?php
	require_once("controleur/init.php");
	require_once("Database.php");
	//CheckLogin();
	
	if( $OnSubmitForm )
	{
		if( session_status() === PHP_SESSION_NONE )
			session_start();	// initialiser ou récupérer les infos $_SESSION (uniquement pour la génération de site)
		
		// récupération en SESSION si cela était fait précédement (uniquement la génération précédante)
		if( !empty($_SESSION['lieu']) &&( $_SESSION['nom'] === $nom))
		{
			echo "<b>		Récupération (SESSION) :</b>\n";
			print_r( $_SESSION['lieu'] );
		}
		else if( ($res = GetResult("bdproalpha", "site", "nom = '$nom'")) instanceof mysqli_result )
		{
			$nomSite = GetElementFromResult($res, 'nom');
			Close_result( $res );
			
			echo "<h1 style='color:red'>		the location $nom already exist </h1><br/>		";
			
			// Ré-Inscription de la dernière génération en SESSION
			$_SESSION['nom'] 		 = $nomSite;
		}
		else
		{
			// Génération de la suite + affichage
			echo "<h1>	you have create a location in $nom </h1>";
			$nomSite = $nom;
			//echo "		$nomSite<br/>";

			
			
			// inscription dans la BDD (uniquement si pas déjà réalisé)
			// étant donné la clé unique construit id, on peut se permettre de tenter un INSERT qui n'aboutira pas si ce dernier existe déjà
			$req = "INSERT INTO site (`nom`) VALUES ('$nomSite')";
			PerformeQueryOnly("bdproalpha", $req);
		}
	}
?>
