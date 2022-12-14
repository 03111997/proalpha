<?php
	require_once( "controleur/initB.php" );
	require_once( "vue/tableau.php" );
	//CheckLogin();
	$BDD=[];
	$BDD['host']="localhost";
	$BDD['user']="root";
	$BDD['pass']="";
	$BDD['base']="bdproalpha";
	$mysqli = mysqli_connect($BDD['host'],$BDD['user'],$BDD['pass'],$BDD['base']);

	if(isset($_GET['supprimer'])){
	$id_prenom = (int) $_GET['supprimer'];
	
	if(mysqli_query($mysqli,"DELETE FROM bureau WHERE id = $id_prenom")){
		echo "	<h1 style='color:green'>  Delete successfully !</h1>";
		
	}else
		echo "	<h1 style='color:red'>  An error has occurred !</h1>";
}

?>
	<script src="javascript.js"></script>
	

	<div class="login">
  <h1 style="color: blue;">create a new desk :</h1>
    <form action='formDesk' method='get'>
      <label for='bureau' >Select a location from the drop-down list above and click submit, then fill in the remaining information on the form</label><br/></br>
		<label >Name</label><input name='nom' id='nom' type='text' placeholder="name" 		value='<?= $nom ?>'/></br>
		<label >Number of screens</label><input name='nbEcran'  id='nbEcran'	 type='number'  placeholder="0" min='0' value='<?= $nbEcran  ?>'/></br>
		<label >Docking</label><input name='docking' id='docking' type='number'  	min='0'	max="1" placeholder="0" value='<?= $docking ?>'/></br>
		<label >City identifier</label><input name='id_ville' id='id_ville' type='number' value='<?= $id_ville ?>'/><br/>
        <button name='btGen' type='submit' class="btn btn-primary btn-block btn-large">Add</button>
    </form>
</div>
	<br/>
	<div style='background-color:#697f38'>
		<div style='text-align: right'><a href='gestion?lapsTime=0' style="font-size:20px;" class="btn btn-primary btn-block btn-large">Disconnect</a></div>
	</div>
	<br/>
	<style type="text/css">
	.tabulation { 
	display: inline-block; 
	margin-left: 70px; 
	} 
	</style>
	<table class="tabulation">
	<th> Name</th>
	<th> Number of Screens</th>
	<th> Docking</th>
	<th> Delete</th>
	
	<?php 
	if($id_ville){ 
		$sql="SELECT * From bureau WHERE id_ville= $id_ville";
		$result= mysqli_query($mysqli,$sql);

		while ($row=mysqli_fetch_assoc($result)) {
			echo "<tr><td>"
               .$row["nom"]."</td><td>"
               .$row["nbEcran"]."</td><td>"
               .$row["docking"]."</td>"
               ?>
			<td class="bureau"><a href="?supprimer=<?=$row['id']?>" style='color:red' onclick="return confirm('Are you sure ?')"><img src="vue/images/1"></a></td>
		<?php }
		} ?>
	
	</table>

	<pre><?php include( "model/ActionBureau.php" ); ?></pre>
<?php include( "vue/HTMLEnd.php" ); ?>

<style >
	
	@import url(https://fonts.googleapis.com/css?family=Open+Sans);
.btn { display: inline-block; *display: inline; *zoom: 1; padding: 4px 10px 4px; margin-bottom: 0; font-size: 13px; line-height: 18px; color: #333333; text-align: center;text-shadow: 0 1px 1px rgba(255, 255, 255, 0.75); vertical-align: middle; background-color: #f5f5f5; background-image: -moz-linear-gradient(top, #ffffff, #e6e6e6); background-image: -ms-linear-gradient(top, #ffffff, #e6e6e6); background-image: -webkit-gradient(linear, 0 0, 0 100%, from(#ffffff), to(#e6e6e6)); background-image: -webkit-linear-gradient(top, #ffffff, #e6e6e6); background-image: -o-linear-gradient(top, #ffffff, #e6e6e6); background-image: linear-gradient(top, #ffffff, #e6e6e6); background-repeat: repeat-x; filter: progid:dximagetransform.microsoft.gradient(startColorstr=#ffffff, endColorstr=#e6e6e6, GradientType=0); border-color: #e6e6e6 #e6e6e6 #e6e6e6; border-color: rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.25); border: 1px solid #e6e6e6; -webkit-border-radius: 4px; -moz-border-radius: 4px; border-radius: 4px; -webkit-box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.2), 0 1px 2px rgba(0, 0, 0, 0.05); -moz-box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.2), 0 1px 2px rgba(0, 0, 0, 0.05); box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.2), 0 1px 2px rgba(0, 0, 0, 0.05); cursor: pointer; *margin-left: .3em; }
.btn:hover, .btn:active, .btn.active, .btn.disabled, .btn[disabled] { background-color: #e6e6e6; }
.btn-large { padding: 9px 14px; font-size: 15px; line-height: normal; -webkit-border-radius: 5px; -moz-border-radius: 5px; border-radius: 5px; }
.btn:hover { color: #333333; text-decoration: none; background-color: #e6e6e6; background-position: 0 -15px; -webkit-transition: background-position 0.1s linear; -moz-transition: background-position 0.1s linear; -ms-transition: background-position 0.1s linear; -o-transition: background-position 0.1s linear; transition: background-position 0.1s linear; }
.btn-primary, .btn-primary:hover { text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.25); color: #ffffff; }
.btn-primary.active { color: rgba(255, 255, 255, 0.75); }
.btn-primary { background-color: #004E86; background-image: -moz-linear-gradient(top, #6eb6de, #004E86); background-image: -ms-linear-gradient(top, #6eb6de, #004E86); background-image: -webkit-gradient(linear, 0 0, 0 100%, from(#6eb6de), to(#004E86)); background-image: -webkit-linear-gradient(top, #6eb6de, #004E86); background-image: -o-linear-gradient(top, #004E86, #004E86); background-image: linear-gradient(top, #6eb6de, #004E86); background-repeat: repeat-x; filter: progid:dximagetransform.microsoft.gradient(startColorstr=#6eb6de, endColorstr=#004E86, GradientType=0);  border: 1px solid #004E86; text-shadow: 1px 1px 1px rgba(0,0,0,0.4); box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.2), 0 1px 2px rgba(0, 0, 0, 0.5); }
.btn-primary:hover, .btn-primary:active, .btn-primary.active, .btn-primary.disabled, .btn-primary[disabled] { filter: none; background-color: #004E86; }
.btn-block { width: 100%; display:block; }

* { -webkit-box-sizing:border-box; -moz-box-sizing:border-box; -ms-box-sizing:border-box; -o-box-sizing:border-box; box-sizing:border-box; }

html { width: 100%; height:100%; overflow:hidden; }

body { 
  width: 100%;
  height:100%;
  font-family: 'Open Sans', sans-serif;
 background: linear-gradient(45deg, #929292, #F0F0F0);
  background: linear-gradient(45deg, #929292, #F0F0F0);
  background: linear-gradient(45deg, #929292, #F0F0F0);
  background: linear-gradient(45deg, #929292, #F0F0F0);
  background: linear-gradient(45deg, #929292, #F0F0F0);
  background: linear-gradient(45deg, #929292, #F0F0F0);
  filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#3E1D6D', endColorstr='#092756',GradientType=1 );
}
.login { 
  position: absolute;
  top: 50%;
  left: 50%;
  margin: -150px 0 0 -150px;
  width:300px;
  height:300px;
}
.login h1 { color: #fff; text-shadow: 0 0 10px rgba(0,0,0,0.3); letter-spacing:1px; text-align:center; }

input { 
  width: 100%; 
  margin-bottom: 10px; 
  background: rgba(0,0,0,0.3);
  border: none;
  outline: none;
  padding: 10px;
  font-size: 13px;
  color: #fff;
  text-shadow: 1px 1px 1px rgba(0,0,0,0.3);
  border: 1px solid rgba(0,0,0,0.3);
  border-radius: 4px;
  box-shadow: inset 0 -5px 45px rgba(100,100,100,0.2), 0 1px 1px rgba(255,255,255,0.2);
  -webkit-transition: box-shadow .5s ease;
  -moz-transition: box-shadow .5s ease;
  -o-transition: box-shadow .5s ease;
  -ms-transition: box-shadow .5s ease;
  transition: box-shadow .5s ease;
}
input:focus { box-shadow: inset 0 -5px 45px rgba(100,100,100,0.4), 0 1px 1px rgba(255,255,255,0.2); }
</style>

