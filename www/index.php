<?php
/**
 * Index du projet GSB
 *
 * PHP Version 7
 *
 * @category  PPE
 * @package   GSB
 * @author    Réseau CERTA  <contact@reseaucerta.org>
 * @author    José GIL <jgil@ac-nice.fr>
 * @copyright 2017 Réseau  
 * @license   Réseau CERTA
 * @version   GIT: <0>
 * @link      http://www.reseaucerta.org Contexte « Laboratoire GSB »
 */

require_once 'includes/fct.inc.php'; //On appelle la page des fonctions (mais on reste sur l'index) et elle doit forcément s'ouvrir(appel obligatoire)
require_once 'includes/class.pdogsb.inc.php';
session_start(); //fonction php qui lance la superglobale session
$pdo = PdoGsb::getPdoGsb(); //fonction de la classe PdoGsb
$estConnecte = estConnecteV()|| estConnecteC (); //on affecte le résultat de la fonction estConnecte a la variable estConnecte
$estConnecteV = estConnecteV();
$estConnecteC = estConnecteC();
//var_dump($estConnecteC, $estConnecteV);
require 'vues/v_entete.php'; //on fait appel a la vue entete
$uc = filter_input(INPUT_GET, 'uc', FILTER_SANITIZE_SPECIAL_CHARS); 
if ($uc && !$estConnecte) {
    $uc = 'connexion';
} elseif (empty($uc)) {
    $uc = 'accueil';
}
switch ($uc) {
case 'connexion':
    include 'controleurs/c_connexion.php';
    break;
case 'accueil':
    include 'controleurs/c_accueil.php';
    break;
case 'gererFrais':
    include 'controleurs/c_gererFrais.php';
    break;
case 'etatFrais':
    include 'controleurs/c_etatFrais.php';
    break;
case 'deconnexion':
    include 'controleurs/c_deconnexion.php';
    break;
case 'validerFrais':
    include 'controleurs/c_validerFrais.php';
    break;
}
require 'vues/v_pied.php';

