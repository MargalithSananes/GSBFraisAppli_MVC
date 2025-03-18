<?php
require_once 'modele/bdd.php';
$BDD = new BDD();//objet de la class bdd jpeux app toutes les methodes de la classe
$ts= $BDD-> recupererTypesServices() ;
var_dump($ts);
include'vues/v_entete.php';
$page = filter_input(INPUT_GET,"page", FILTER_SANITIZE_SPECIAL_CHARS)??'acceuil'; //recuperer la donnée en GET (la page vers qui on veut aller)
switch ($page) {
    case "accueil":
        require_once 'controleurs/c_accueil.php';
        break;
    default:
        require_once 'controleurs/c_accueil.php';
        break;
    case "demande":
        require_once 'controleurs/c_envoyer_demande.php';
        break;
   
    } 

