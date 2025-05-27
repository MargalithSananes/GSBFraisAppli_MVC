<?php

/**
 * Gestion de la connexion
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
    $uc = 'validerFrais';
}
switch ($action) {
    case 'choisirVisiteurMois':
        $lesVisiteurs = $pdo->getLesVisiteurs();
        $lesCles = array_keys($lesVisiteurs);
        $VisiteurASelectionner = $lesCles[0];
        $lesMois = getLesDouzeDerniersMois();
        include 'vues/v_choisirVisiteurMois.php';
        break;
    case 'Valider':
        $mois = filter_input(INPUT_POST, 'mois', FILTER_SANITIZE_SPECIAL_CHARS);
        $idVisiteur = filter_input(INPUT_POST, 'visiteur', FILTER_SANITIZE_SPECIAL_CHARS);
        $numMois = substr($mois, 4, 2);
        $numAnnee = substr($mois, 0, 4);
        $lesFraisForfait = $pdo->getLesFraisForfait($idVisiteur, $mois);
        $lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($idVisiteur, $mois);
        $lesVisiteurs = $pdo->getLesVisiteurs();
        $lesMois = getLesDouzeDerniersMois();
        $moisASelectionner = $mois;
        $visiteurASelectionner = $idVisiteur;
//var_dump($lesFraisForfait);
        if (empty($lesFraisForfait) && empty($lesFraisHorsForfait)) {
            ajouterErreur('Pas de fiche de frais pour ce visiteur ce mois');
            include 'vues/v_erreurs.php';
            include 'vues/v_choisirVisiteurMois.php';
        } else {
            include 'vues/v_validerFrais.php';
        }
        break;
    case 'corrigerMajFraisForfait':
        $mois = filter_input(INPUT_POST, 'mois', FILTER_SANITIZE_SPECIAL_CHARS);
        $idVisiteur = filter_input(INPUT_POST, 'visiteur', FILTER_SANITIZE_SPECIAL_CHARS);
        $lesFrais = filter_input(INPUT_POST, 'lesFrais', FILTER_DEFAULT, FILTER_FORCE_ARRAY);
//var_dump($mois, $idVisiteur, $lesFrais);
        $pdo->majFraisForfait($idVisiteur, $mois, $lesFrais);
//$pdo-> majFraisHorsForfait($idVisiteur, $mois, $lesFraisHorsForfait);
        $lesFraisForfait = $pdo->getLesFraisForfait($idVisiteur, $mois);
        $lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($idVisiteur, $mois);
        $lesVisiteurs = $pdo->getLesVisiteurs();
        $lesMois = getLesDouzeDerniersMois();
        $moisASelectionner = $mois;
        $visiteurASelectionner = $idVisiteur;
        include 'vues/v_validerFrais.php';
        break;
    case 'corrigerMajFraisHorsForfait':

        $idFrais = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_SPECIAL_CHARS);
        $idVisiteur = filter_input(INPUT_POST, 'visiteur', FILTER_SANITIZE_SPECIAL_CHARS);
        $mois = filter_input(INPUT_POST, 'mois', FILTER_SANITIZE_SPECIAL_CHARS);
        $date = filter_input(INPUT_POST, 'date', FILTER_SANITIZE_SPECIAL_CHARS);
        $libelle = filter_input(INPUT_POST, 'libelle', FILTER_SANITIZE_SPECIAL_CHARS);
        $montant = filter_input(INPUT_POST, 'montant', FILTER_VALIDATE_FLOAT);
        if (isset($_POST['Corriger'])) {
            var_dump($idFrais, $montant, $libelle, $idVisiteur, $mois, $date);
            $lesFraisForfait = $pdo->getLesFraisForfait($idVisiteur, $mois);
            $lesVisiteurs = $pdo->getLesVisiteurs();
            $lesMois = getLesDouzeDerniersMois();
            $moisASelectionner = $mois;
            $visiteurASelectionner = $idVisiteur;
            valideInfosFrais($date, $libelle, $montant);
            if (nbErreurs() != 0) {
                include 'vues/v_erreurs.php';
                include 'vues/v_validerFrais.php';
            } else {

                $pdo->majFraisHorsForfait($idVisiteur, $mois, $libelle, $date, $montant);
                $lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($idVisiteur, $mois);
                include 'vues/v_validerFrais.php';
            }
            break;
        }
        if (isset($_POST['Reporter'])) {
            var_dump($idFrais, $montant, $libelle = "Refuser" . $libelle, $idVisiteur, $mois, $date);
            $lesVisiteurs = $pdo->getLesVisiteurs();
            $lesMois = getLesDouzeDerniersMois();
            $moisASelectionner = $mois;
            $visiteurASelectionner = $idVisiteur;
            $lesFraisForfait = $pdo->getLesFraisForfait($idVisiteur, $mois);
            $lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($idVisiteur, $mois);

            if (nbErreurs() != 0) {
                include 'vues/v_erreurs.php';
                include 'vues/v_validerFrais.php';
            } else {
                if ($pdo->estPremierFraisMois($idVisiteur, $mois + 1)) {
                    $pdo->creeNouvellesLignesFrais($idVisiteur, $mois + 1);
                }

                $pdo->creeNouveauFraisHorsForfait($idVisiteur, $mois + 1, $libelle, $date, $montant);
                $pdo->majFraisHorsForfait($idVisiteur, $mois, $libelle, $date, $montant);
                $lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($idVisiteur, $mois);
                include 'vues/v_validerFrais.php';
            }
            break;
        }
        if (isset($_POST['Supprimer'])) {
            var_dump($idFrais);
            $moisASelectionner = $mois;
            $visiteurASelectionner = $idVisiteur;
            $lesFraisForfait = $pdo->getLesFraisForfait($idVisiteur, $mois);
            $lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($idVisiteur, $mois);
            $supprimerFraisHorsForfait = $pdo->supprimerFraisHorsForfait($idFrais);
        }

        include 'vues/v_validerfrais.php';
        break;
//fonction getnbjustificatif dans pdo qu on lapeel et affiche dans la vue dans case valider et tt les autre
    case'btnvalider':
        $idF = filter_input(INPUT_POST, 'idFHF', FILTER_SANITIZE_SPECIAL_CHARS);
        $mois2 = filter_input(INPUT_POST, 'lstMois', FILTER_SANITIZE_SPECIAL_CHARS);
        $idVisiteur = filter_input(INPUT_POST, 'lstv', FILTER_SANITIZE_SPECIAL_CHARS);
        $leMois = filter_input(INPUT_POST, 'lstMois', FILTER_SANITIZE_SPECIAL_CHARS);
//$montantfraisforfait=$pdo->montantfraisforfait($idVisiteur ,$mois2);
//$montanthorsforfait=$pdo->montanthorsforfait($idVisiteur ,$mois2);
        $montantfraisforfait = $pdo->montantFF($idVisiteur, $mois2);
        $montantfraishorsforfait = $pdo->montantHF($idVisiteur, $mois2);

        $mff = $montantfraisforfait[0][0];
        $mfhf = $montantfraishorsforfait[0][0];
        $montantotal = $mff + $mfhf;
        $visiteur = $pdo->getVisiteur($idVisiteur);
        $vstNom = $visiteur[0]['nom'];
        $vstPrenom = $visiteur[0]['prenom'];
        $pdo->total($idVisiteur, $mois2, $montantotal);
        $pdo->majEtatFicheFrais($idVisiteur, $mois2, "VA"); //passe l etats de cl a va
        include 'vues/v_valideravecsucces.php';
        break;
}



