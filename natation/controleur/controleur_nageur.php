<?php

// Session pour les  messages d'erreurs
if (!isset($_SESSION['message'])) {
    session_register('message');
}
//Session pour les informations saisies par l'utlilisateur
if (!isset($_SESSION['contenu_nageur'])) {
    session_register('contenu_nageur');
}

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
include '../model/class.nageur.php';

if ($_POST) {

    //Recuparation des donnees du formulaire
    $nom = mysql_escape_string($_POST['nom']);
    $prenom = mysql_escape_string($_POST['prenom']);
    $date_naissance = mysql_escape_string($_POST['date_de_naissance']);
    $sexe = mysql_escape_string($_POST['sexe']);

    //Enregistrement des contenus tapes par l'utilisateur
    $_SESSION['contenu_nageur'] = $_POST;

    /* Definition du groupe du nageur en fonction de la date de naissance (jj/mm/aaaa) */
    //Recuperation de l'annee de naissance
    $explode = explode('/', $date_naissance);
    $annee = intval($explode[2]);
    $groupe = '';
    //Verification de l'annee de naissance
    if ($annee >= 2004) {
        $groupe = 'Avenirs';
    } elseif ($annee == 2002 || $annee == 2003) {
        $groupe = 'Poussins';
    } elseif ($annee == 2000 || $annee == 2001) {
        $groupe = 'Benjamins';
    } elseif ($annee == 1998 || $annee == 1999) {
        $groupe = 'Minimes';
    } elseif ($annee == 1996 || $annee == 1997) {
        $groupe = 'Cadets';
    } elseif ($annee == 1993 || $annee == 1994 || $annee == 1995) {
        $groupe = 'Juniors';
    } elseif ($annee <= 1992) {
        $groupe = 'Seniors';
    }
    //enregistrement du nageur
    $date_naissance = $explode[2] . '-' . $explode[1] . '-' . $explode[0];
    try {
        //Enregistrement
        nageur::enregistrer($nom, $prenom, $date_naissance, $sexe, $groupe);

        //Suppression des session
        unset($_SESSION['message']);
        unset($_SESSION['contenu_nageur']);

        //Redirection vers la page enregistrement_ok
        header('Location: ../enregistrement_ok.php?retour=gestion_nageurs');
    } catch (Exception $exc) {
        $_SESSION['message'] = $exc->getMessage();
        header('Location: ../formulaire_nageur.php');
    }
} elseif ($_GET) {
    if (isset($_GET['idsuppression'])) {
        if (nageur::supprimer($_GET['idsuppression'])) {
            header('Location: ../gestion_nageurs.php?message=La suppression a été effectuée avec succès');
        }
    } elseif (isset($_GET['idmodif'])) {
        //recuperer le nageur par son id
        $nageur = nageur::rechercherParId($_GET['idmodif']);

        //reconstruire la date de naissance
        $explode = explode('-', $nageur['date_de_naissance']);
        $nageur['date_de_naissance'] = $explode[2] . '/' . $explode[1] . '/' . $explode[0];
        //retinir les informations sur le nageur
        $_SESSION['contenu_nageur'] = $nageur;
        header('Location: ../formulaire_nageur.php?action=modif');
    }
}