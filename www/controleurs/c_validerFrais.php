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
            var_dump($id, $montant, $libelle = "Refuser". $libelle, $idVisiteur, $mois, $date);
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
    case 'ValiderFrais':
//        $pdo->majNbJustificatifs($idVisiteur, $mois, $nbJustificatifs);
        include 'vues/v_validerFrais.php';
        break;
}

//Ajouter les fonctions pour recuperer les mois et visiteur dans reporter 
//Ajouter un input avec value = id de type hiden dans v_validerfrais
// Concaténer libelle pour ajouter refuser devant dans le isset post reporter
// Dans creer nouveaufraishorsforfait , rajouter +1 a mois
// Faire appel a EstPremierFraisMois et CreerNouvelleLigneFrais avt CreerNouveauFraisHorsForfait


