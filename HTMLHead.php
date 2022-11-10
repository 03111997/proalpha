<!doctype html>
<html lang="fr">
	<head>
		<meta charset="utf-8">
		<title><?= $Title ?></title>
	<?php
	if( !empty($CSS) )
		echo "\t<link href=\"$CSS\" rel=\"stylesheet\" type=\"text/css\">\n";
	if( !empty($JS) )
		echo "\t\t<script src=\"$JS.js\"></script>\n";
	?>
	</head>
	<body>
