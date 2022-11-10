<?php 
//require_once "modele/Employe.php";
ob_start() 
?>


    
    	<td class="align-middle"><?php require "tableau.php" ?></td>

        


<?php
    $content= ob_get_clean();
    
    require "template.php";


 ?>