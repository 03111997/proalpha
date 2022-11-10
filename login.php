<?php
	require_once("model/Auth.php");

	$Title = "Authentification";
	$CSS = "style.css";
	include( "HTMLHead.php" );
	
	if( !isset($_POST['auth']) )
		echo " ";
	else 
	{
		$LoginEmpty = empty($_POST['login']);
		$MdpEmpty	= empty($_POST['pwd']);
		
		// concerver le dernier login en mémoire (COOKIE) si renseigné, pas le mdp !
		if( !$LoginEmpty )
			setcookie('login', $_POST['login'], time() + 3600);
		
		// formulaire en erreur + ou déclanchement du login en échec
		if( $LoginEmpty || $MdpEmpty )
			echo "<b><i>wrong ID (".($LoginEmpty && $MdpEmpty? 'Username And Password' : ($LoginEmpty ? 'login' : 'mot de passe') )." empty)!</i></b><br/><br/>";
		else if( !$LoginEmpty && !$MdpEmpty && !login('gestion') )
			echo "<b><i> incorrect identifier!</i></b><br/><br/>";
	}
	
?>

	<fieldset style='width: 280px;'>
	<form method='post' class='gridSpace' >
		<p>Welcome</p>
		<input name='login' type='text' placeholder="UserName" value='<?= ($_POST['login'] ?? '') ?>'/>
		
		<input name='pwd' type='password' placeholder="password"/>
		
		<input name='auth' type='submit' value="submit">

		<button><a href='retour' style="font-size:30px; color: #929292;">Back</a></button>
		
	</form>
	<div class="container">
  

  <div class="drop drop-1"></div>
  <div class="drop drop-2"></div>
  <div class="drop drop-3"></div>
  <div class="drop drop-4"></div>
  <div class="drop drop-5"></div>
</div>
<style type="text/css">
body {
  background: linear-gradient(45deg, #929292, #697f38);
  height: 100vh;
  font-family: arial, sans-serif;
  display: flex;
  align-items: center;
  justify-content: center;
}

.container {
  position: relative;
}

form {
  background: rgba(255, 255, 255, .3);
  padding: 3rem;
  height: 320px;
  border-radius: 20px;
  border-left: 1px solid rgba(255, 255, 255, .3);
  border-top: 1px solid rgba(255, 255, 255, .3);
  backdrop-filter: blur(10px);
  -webkit-backdrop-filter: blur(10px);
  -moz-backdrop-filter: blur(10px);
  box-shadow: 20px 20px 40px -6px rgba(0, 0, 0, .2);
  text-align: center;
}

p {
  color: white;
  font-weight: 500;
  opacity: .7;
  font-size: 1.4rem;
  margin-bottom: 60px;
  text-shadow: 2px 2px 4px rgba(0, 0, 0, .2);
}
  
a {
  text-decoration: none;
  color: #ddd;
  font-size: 12px;
}

a:hover {
  text-shadow: 2px 2px 6px #00000040;
}

a:active {
  text-shadow: none;
}

input {
  background: transparent;
  border: none;
  border-left: 1px solid rgba(255, 255, 255, .3);
  border-top: 1px solid rgba(255, 255, 255, .3);
  padding: 1rem;
  width: 200px;
  border-radius: 50px;
  backdrop-filter: blur(5px);
  -webkit-backdrop-filter: blur(5px);
  -moz-backdrop-filter: blur(5px);
  box-shadow: 4px 4px 60px rgba(0, 0, 0, .2);
  color: white;
  font-weight: 500;
  text-shadow: 2px 2px 4px rgba(0, 0, 0, .2);
  transition: all .3s;
  margin-bottom: 2em;
}

input:hover,
input[type="email"]:focus,
input[type="password"]:focus{
  background: rgba(255,255,255,0.1);
  box-shadow: 4px 4px 60px 8px rgba(0,0,0,0.2);
}
    
input[type="button"] {
  margin-top: 10px;
  width: 150px;
  font-size: 1rem;
  cursor: pointer;
}

::placeholder {
  color: #fff;
}

.drop {
  background: rgba(255, 255, 255, .3);
  backdrop-filter: blur(10px);
  -webkit-backdrop-filter: blur(10px);
  border-radius: 10px;
  border-left: 1px solid rgba(255, 255, 255, .3);
  border-top: 1px solid rgba(255, 255, 255, .3);
  box-shadow: 10px 10px 60px -8px rgba(0,0,0,0.2);
  position: absolute;
  transition: all 0.2s ease;
}

.drop-1 {
  height: 80px; width: 80px;
  top: -20px; left: -40px;
  z-index: -1;
}

.drop-2 {
  height: 80px; width: 80px;
  bottom: -30px; right: -10px;
}

.drop-3 {
  height: 100px; width: 100px;
  bottom: 120px; right: -50px;
  z-index: -1;
}

.drop-4 {
  height: 120px; width: 120px;
  top: -60px; right: -60px;
}

.drop-5 {
  height: 60px; width: 60px;
  bottom: 170px; left: 90px;
  z-index: -1;
}
</style>
	

	</fieldset>
	
