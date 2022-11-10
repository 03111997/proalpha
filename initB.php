<?php
	require_once("model/Auth.php");
	//CheckLogin();
		
	$nom = ( !empty($_COOKIE['nom']) ? $_COOKIE['nom'] : null );
	$nbEcran = ( !empty($_COOKIE['nbEcran']) ? $_COOKIE['nbEcran'] : null );
	$docking = ( !empty($_COOKIE['docking']) ? $_COOKIE['docking'] : null );
	$id_ville = ( !empty($_COOKIE['id_ville']) ? $_COOKIE['id_ville'] : null );

	$OnSubmitForm = isset($_REQUEST['btGen']);
	if( $OnSubmitForm )
	{
		// les infos envoyées par formunaires prime sur les Cookies qui n'ont surement plus la même valeur
		$nom = ( !empty($_REQUEST['nom']) ? $_REQUEST['nom'] : null );
		$nbEcran = ( !empty($_REQUEST['nbEcran']) ? $_REQUEST['nbEcran'] : null );
		$docking = ( !empty($_REQUEST['docking']) ? $_REQUEST['docking'] : null );
		$id_ville = ( !empty($_COOKIE['id_ville']) ? $_COOKIE['id_ville'] : null );
		
		setcookie('nom', $nom, time() + 3600*4);	// conserver l'info pour 4h
		/*setcookie('nom', $nom, time() + 3600*12);	// conserver l'info pour 12h*/
	}

?>