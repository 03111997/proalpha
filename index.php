<?php

if(empty($_GET['page'])){
    require "controleur/tableauControleur.php";
} else {
    switch($_GET['page']){
        
        case "enregistrement" : require "controleur/tableauControleur.php";
        break;
        case "administration" : require "vue/login.php";
        break;
        case "enre" : require "controleur/tableauControleur.php";
        break;
        case "retour" : require "controleur/tableauControleur.php";
        break;
        case "deconexion" : require "controleur/logout.php";
        break;
        case "formDesk" : require "vue/FormBureau.php";
        break;
        case "gestion" : require "vue/gestion.php";
        break;
        case "city" : require "controleur/city.php";
        break;
        case "name" : require "controleur/name.php";
        break;


    }
}
?>
