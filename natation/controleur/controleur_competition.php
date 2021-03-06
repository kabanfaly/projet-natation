<?php

//Session pour les informations saisies par l'utlilisateur
if (!isset($_SESSION['contenu_competition'])) {
    session_register('contenu_competition');
}
//Session pour enregistrer l'id de la competition
if (!isset($_SESSION['idcompetition'])) {
    session_register('idcompetition');
}

include '../model/class.competition.php';

if ($_POST) {

    //Recuparation des donnees du formulaire
    $idnageur = mysql_escape_string($_POST['idnageur']);
    $idepreuve = mysql_escape_string($_POST['idepreuve']);
    $annee = mysql_escape_string($_POST['annee']);

    //Enregistrement des contenus tapes par l'utilisateur
    $_SESSION['contenu_competition'] = $_POST;

    if (isset($_SESSION['idcompetition'])) {
        if ($idnageur === '') {
            header('Location: ../formulaire_competition.php?action=modif&message=Veuillez choisir un nageur');
        } elseif ($idepreuve === '') {
            header('Location: ../formulaire_competition.php?action=modif&message=Veuillez choisir une épreuve');
        } elseif (competition::modifier($_SESSION['idcompetition'], $annee, $idnageur, $idepreuve)) {
            //Redirection vers la page de gestion des competitions
            unset($_SESSION['contenu_competition']);
            header('Location: ../gestion_competitions.php?message=La modification a été effectuée avec succès');
        }
    } else {
        try {
            if ($idnageur === '') {
                header('Location: ../formulaire_competition.php?action=ajout&message=Veuillez choisir un nageur');
            } elseif ($idepreuve === '') {
                header('Location: ../formulaire_competition.php?action=ajout&message=Veuillez choisir une épreuve');
            } else {
                //Enregistrement
                competition::enregistrer($annee, $idnageur, $idepreuve);

                //Redirection vers la page de gestion des competition
                header('Location: ../gestion_competitions.php?message=L\'enregistrement a été effectuée avec succès');
            }
        } catch (Exception $exc) {
            header('Location: ../formulaire_competition.php?action=ajout&message=' . $exc->getMessage());
        }
    }
} elseif ($_GET) {
    if (isset($_GET['idsuppression'])) {
        if (competition::supprimer($_GET['idsuppression'])) {
            header('Location: ../gestion_competitions.php?message=La suppression a été effectuée avec succès');
        }
    } elseif (isset($_GET['idmodif'])) {
        //recuperer la competition par son id
        $competition = competition::rechercherParId($_GET['idmodif']);

        //retinir les informations sur la competition
        $_SESSION['contenu_competition'] = $competition;

        //Engistrement de l'id de la competition dans la session pour la modification
        $_SESSION['idcompetition'] = $_GET['idmodif'];
        header('Location: ../formulaire_competition.php?action=modif');
    }
}