<?php
	require_once("model/Auth.php");
	//CheckLogin();
		
	$nom = ( !empty($_COOKIE['nom']) ? $_COOKIE['nom'] : null );

	$OnSubmitForm = isset($_REQUEST['btGen']);
	if( $OnSubmitForm )
	{
		// les infos envoyées par formunaires prime sur les Cookies qui n'ont surement plus la même valeur
		$nom = ( !empty($_REQUEST['nom']) ? $_REQUEST['nom'] : null );
		
		setcookie('nom', $nom, time() + 3600*4);	// conserver l'info pour 4h
	}

?>