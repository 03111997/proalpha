<?php
	if( session_status() === PHP_SESSION_NONE )
		session_start();
	
	if( isset($_GET['lapsTime']) && (intval($_GET['lapsTime']) == 0) )
	{
		require_once("model/Auth.php");
		logout();
	}
	
	$TimeLaps = 1000 * (( !empty($_GET['lapsTime']) && ( intval($_GET['lapsTime']) > 1) ) ? intval($_GET['lapsTime']) : 6);
?>

<!doctype html>
<html lang="fr">
	<head>
		<meta charset="utf-8">
		<title>Déconexion</title>
		<script>
			function redirection()
			{
				document.location = 'index.php';
			}
		</script>
	</head>
	<body onload='setTimeout(redirection, <?= $TimeLaps ?>);'>
		<div><?= ($_SESSION['msg'] ?? "Déconexion en cours..") ?></div>
	</body> 
</html>

<?php
	unset( $_SESSION['msg'] );
?>