<?php
require_once("Database.php");

function isConected() : bool
{
	if( session_status() === PHP_SESSION_NONE )
		session_start();
	
	return !empty( $_SESSION['loged'] ) && (time() < $_SESSION['loged']);
}

function logout(string $page = "index") : void
{
	unset( $_SESSION['loged'] );
	session_destroy();
	header("location: $page.php");
	exit();
}

function isSuperAdmin() : bool
{
	return ($_POST['login'] === 'Admin') && ($_POST['pwd'] === '123');
}

function isUserAuthorized() : bool
{
	if( !empty($_POST['login']) && !empty($_POST['pwd']) )
		return RowExist('bdproalpha', 'utilisateurs', 'Nom = \''.$_POST['login'].'\' AND HashCode = \''.HashCode($_POST['pwd']).'\'');
	
	return false;
}

function HashCode(string $mdp) : string
{
	
	return hash('md4', hash('sha256', md5($mdp), false), false);
}

function login(string $page = "index") : bool
{
	if( isSuperAdmin() || isUserAuthorized() )
	{
		if( session_status() === PHP_SESSION_NONE )
			session_start();
		
		$_SESSION['loged'] = time() + 20;	// tenir la session 1 minute
		
		header("location: $page");
		return true;
	}
	
	return false;
}
?>