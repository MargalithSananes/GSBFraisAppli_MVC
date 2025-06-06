<?php

/**
 * Gestion de la déconnexion
 *
 * PHP Version 7
 *
 * @category  PPE
 * @package   GSB
 * @author    Réseau CERTA <contact@reseaucerta.org>
 * @author    José GIL <jgil@ac-nice.fr>
 * @copyright 2017 Réseau CERTA
 * @license   Réseau CERTA
 * @version   GIT: <0>
 * @link      http://www.reseaucerta.org Contexte « Laboratoire GSB »
 */
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_SPECIAL_CHARS);
if (!$uc) {
    $uc = 'demandeconnexion';
}

switch ($action) {
    case 'demandeDeconnexion':
        include 'vues/v_deconnexion.php';
        break;
    case 'valideDeconnexion':
        if (estConnecte() && estConnecteComptable()) {
            include 'vues/v_deconnexion.php';
        } else {
            ajouterErreur("Vous n'êtes pas connecté");
            include 'vues/v_erreurs.php';
            include 'vues/v_connexion.php';
        }
        break;
    default:
        include 'vues/v_connexion.php';
        break;
}
